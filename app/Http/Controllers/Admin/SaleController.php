<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Food;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Cart;
use  NumberToWords\NumberToWords;

class SaleController extends Controller
{
    public function addSale(Request $request)
    {

        return view('admin.sale.add-sale',
            [
                'foods' => Food::all(),
                'customers' => Customer::all(),
                'cartFood' => Cart::content()
            ]);
    }


    public function getFoodIdByCode()
    {
        $foodId = $_GET['id'];
        $foodDetail = Food::where('id', $foodId)->first();
        return response()->json($foodDetail);
    }

    public function addToCart(Request $request)
    {
        $food = Food::find($request->id);
        Cart::add([
            'id' => $food->id,
            'name' => $food->food_name,
            'qty' => 1,
            'price' => $food->price,
            'weight' => 0,
            'options' => ['size' => 'large',
//                'sl'=>count(Cart::content())

            ]
        ]);
        $singleFood = Cart::content()->where('id', $food->id)->first();
//        $singleFood->sl = count(Cart::content());

        return response()->json($singleFood);
//        return Cart::content();
    }

    public function addToCartByCode(Request $request)
    {
        $food = Food::where(['code' => $request->code])->first();
        Cart::add([
            'id' => $food->id,
            'name' => $food->food_name,
            'qty' => $request->qty,
            'price' => $food->price,
            'weight' => 0,
            'options' => ['size' => 'large',
            ]
        ]);
        $singleFood = Cart::content()->where('id', $food->id)->first();
        return response()->json($singleFood);

    }

    public function removeCart(Request $request)
    {
        Cart::remove($request->id);
        return view('admin.sale.cart-collection',
            [
                'cartFood' => Cart::content(),
            ]);
    }

    public function updateCart(Request $request)
    {
//        return Cart::get($request->id);
        Cart::update($request->id, $request->qty);
    }


    public function customerId(Request $request)
    {
        if ($request->ajax()) {
            $customerId = Customer::find($request->id);
            $customerBalance = customerBalanceCal($request->id);
            $customerId->result = $customerBalance;
            return $customerId;


        } else
            return 'Not Success';
    }


    public function create(Request $request)
    {

        $request->validate([
            'memo_number' => 'unique:sales',
            'sale_type'=>'required',
        ]);
        if ($request->sale_type == "Credit")
        {
            $request->validate([
                'customer_id' => 'required',
            ]);
        }

        if (count(Cart::content()) !=0)
        {
            $sale = new Sale();
            if (Sale::all()->count() == 0) {
                $sale->memo_number = '000' . '1';
            } else {
                $count = Sale::latest()->first()->id;
                if ($count < 100) {
                    $sale->memo_number = '000' . $count + 1;
                } else {
                    $sale->memo_number = '00' . $count + 1;
                }
            }
            $sale->sale_type        = $request->sale_type;
            $sale->customer_name    = $request->customer_name;
            $sale->customer_mobile  = $request->customer_mobile;
            $sale->customer_id      = $request->customer_id;
            $sale->customer_balance = $request->customer_balance;
            $sale->balance_type     = $request->balance_type;
            $sale->amount           = $request->amount;
            $sale->vat              = $request->vat;
            $sale->vatAmount        = $request->vatAmount;
            $sale->subtotal         = $request->subtotal;
            $sale->discount         = $request->discount;
            $sale->totalPayable     = $request->totalPayable;
            $sale->cashPaid         = $request->cashPaid;
            $sale->changeAmount     = $request->changeAmount;
            $sale->save();

            $cartItems = Cart::content();
            foreach ($cartItems as $cartItem) {
                $saleItem = new SaleItem();
                $saleItem->sale_id = $sale->id;
                $saleItem->food_id = $cartItem->id;
                $saleItem->food_name = $cartItem->name;
                $saleItem->price = $cartItem->price;
                $saleItem->quantity = $cartItem->qty;
                $saleItem->save();
            }
            foreach ($cartItems as $cartItem) {
                Cart::remove($cartItem->rowId);
            }
            return redirect('/invoice-sale/'."$sale->id");
        }
        else
            return redirect()->back();
//        return view('admin.sale.invoice.invoice',
//            [
//                'sale' => Sale::where('id', $sale->id)->with('saleItems')->first(),
//            ]);

    }
    public function invoice($id)
    {

        return view('admin.sale.invoice.invoice',
        [
             'sale'=> Sale::find($id)
        ]);

    }
}
