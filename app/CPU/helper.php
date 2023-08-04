<?php
use  NumberToWords\NumberToWords;

function numberToWord($number)
{
//    $numberToWords = new NumberToWords();
//    $numberTransformer = $numberToWords->getNumberTransformer('en');
//    $numberTransformer->toWords($number);
    $number=NumberToWords::transformNumber('en', $number);
    return $number;
}

function dateFormat($date,$format){
    return Carbon\Carbon::parse($date)->format($format);
}

function total_bank_balance($date=null)
{

    $bank_accounts=App\Models\BankAccount::all();
    $total=0;
    foreach ($bank_accounts as $bank_account)
    {
        $bank_account_total=bank_balance_cal($bank_account->id);
        $total+=$bank_account_total;
    }
    return  $total;
}

function bank_balance_cal($id,$date=null)
{
    $initial_balance=\App\Models\BankAccount::where('id',$id)->sum('initial_balance');
    $deposit_amount=App\Models\BankTransaction::where('type','Deposit')->where('account_id',$id)->sum('amount');
    $withdraw_amount=App\Models\BankTransaction::where('type','Withdrawal')->where('account_id',$id)->sum('amount');
    $purchase_amount=App\Models\Purchase::where('payment_media','Bank')->where('bank_account_id',$id)->sum('pay_amount');
    $payment=App\Models\ReceiveAndPay::where('client_type','Supplier')->where('payment_media','Bank')->with('BankAccount')->where('bank_account_id',$id)->sum('amount');
    $receive=App\Models\ReceiveAndPay::where('client_type','Customer')->where('payment_media','Bank')->with('BankAccount')->where('bank_account_id',$id)->sum('amount');

    $current_balance=$initial_balance+$deposit_amount-$withdraw_amount-$purchase_amount-$payment+$receive;
    return $current_balance;
}

function total_prev_bank_balance($date)
{
    $start=dateFormat($date,'Y-m-d H:i:s');

    $bank_accounts=App\Models\BankAccount::where('created_at','<',$start)->get();
    $total=0;
    foreach ($bank_accounts as $bank_account)
    {
        $bank_account_total=prev_bank_balance_cal($bank_account->id,$start);
        $total+=$bank_account_total;
    }
    return  $total;
}


function prev_bank_balance_cal($id,$date)
{
    $start=dateFormat($date,'Y-m-d H:i:s');
    $deposit_amount=App\Models\BankTransaction::where('type','Deposit')->where('created_at','<',$start)->where('account_id',$id)->sum('amount');
    $withdraw_amount=App\Models\BankTransaction::where('type','Withdrawal')->where('created_at','<',$start)->where('account_id',$id)->sum('amount');
    $purchase_amount=App\Models\Purchase::where('payment_media','Bank')->where('created_at','<',$start)->where('bank_account_id',$id)->get()->sum('pay_amount');
    $payment=App\Models\ReceiveAndPay::where('client_type','Supplier')->where('created_at','<',$start)->where('payment_media','Bank')->with('BankAccount')->where('bank_account_id',$id)->get()->sum('amount');
    $receive=App\Models\ReceiveAndPay::where('client_type','Customer')->where('created_at','<',$start)->where('payment_media','Bank')->with('BankAccount')->where('bank_account_id',$id)->get()->sum('amount');
    $current_balance=$deposit_amount-$withdraw_amount-$purchase_amount-$payment+$receive;
    return $current_balance;
}

function presentRawMaterialQuantity($rawMaterialId,$date=null){
    $start_date=dateFormat($date,'Y-m-d H:i:s');
    $rawMaterialQuantity = App\Models\Detail::where('product_id',$rawMaterialId)->where('created_at','<=',$start_date)->get()->sum('quantity');
    $sales = App\Models\Sale::with('saleItems')->where('created_at','<=',$start_date)->get();
   foreach ($sales as $sale){
       foreach ($sale->saleItems as $saleItem){
           if ($saleItem->food !=null){
               foreach ($saleItem->food->recipe as $item){
                   if ($item->product_id == $rawMaterialId){
                       $saleQuantity = $saleItem->quantity;
                       $usedRawMaterialQuantity = $item->quantity;
                       $rawMaterialQuantity -= ($saleQuantity*$usedRawMaterialQuantity);
                   }
               }
           }
       }
   }
   return $rawMaterialQuantity;
}

function total_stock($date=null){
    $start_date=dateFormat($date,'Y-m-d H:i:s');
    $rawMaterials=App\Models\PurchaseProduct::where('created_at','<=',$start_date)->get();
    $total=0;
    foreach ($rawMaterials as $rawMaterial)
    {
        $productTotalQuantity=0;
        $productTotalCost=0;
        foreach ($rawMaterial->details as $detail)
        {
            $productTotalQuantity +=$detail->quantity;
            $productTotalCost +=$detail->quantity*$detail->price;
            $rate=$productTotalCost/$productTotalQuantity;
        }
        $total+=presentRawMaterialQuantity($rawMaterial->id,$start_date)*$rate;
    }
    return $total;
}
function supplierBalanceCal($id)
{
    $supplierId=App\Models\Supplier::find($id);
    $initialBalance=$supplierId->initial_balance;$balance = $initialBalance;
    $balanceTitle = $supplierId->balance_title; $title = $balanceTitle;

    $purchase_amount = App\Models\Purchase::where('purchase_type', 'Credit')->where('supplier_id', $id)->get()->sum('total_amount');
    $purchase_pay_amount = App\Models\Purchase::where('purchase_type', 'Credit')->where('supplier_id', $id)->get()->sum('pay_amount');

    $total_pay = 0;
    $payment_amount = App\Models\ReceiveAndPay::where('client_type', 'Supplier')->where('client_id', $id)->sum('amount');
    $payment_discount = App\Models\ReceiveAndPay::where('client_type', 'Supplier')->where('client_id', $id)->sum('discount');

    $total_pay=$payment_amount+$payment_discount;

    if ($balanceTitle=='Debit')
    {
        if($purchase_amount >=$purchase_pay_amount){
            $balance+=($purchase_amount-$purchase_pay_amount)-$total_pay;
            $title ='Debit';
        }

        else
        {
            $balance-=abs($purchase_pay_amount-$purchase_amount)+$total_pay;
            $title='Credit';
        }
    }
    else if ($balanceTitle=='Credit')
    {
        if($purchase_amount >=$purchase_pay_amount){
            $balance-=abs($purchase_amount-$purchase_pay_amount)+$total_pay;
            $title ='Credit';
        }
        else
        {
            $balance+=($purchase_pay_amount-$purchase_amount)-$total_pay;
            $title='Debit';
        }

    }
    $result=[
        'balance'=>abs($balance),
        'title'=>$title,
    ];
    return $result;
}

function customerBalanceCal($id)
{
    $customerId=App\Models\Customer::find($id);
    $initialBalance=$customerId->initial_balance;$balance = $initialBalance;
    $balanceTitle = $customerId->balance_title; $title = $balanceTitle;

    $sale_amount=App\Models\Sale::where('sale_type','Credit')->where('customer_id', $id)->sum('totalPayable');
    $total_receive=0;
    $receive_amount=App\Models\ReceiveAndPay::where('client_type','Customer')->where('client_id', $id)->sum('amount');
    $discount=App\Models\ReceiveAndPay::where('client_type','Customer')->where('client_id', $id)->sum('discount');
    $total_receive=$receive_amount+$discount;

    $total=$sale_amount-$total_receive;

    if ($balanceTitle=='Credit'){
        if ($total>0){
            $balance += $total; $title = 'Credit';
        }else{
            $balance -= abs($total);
            $balance>0 ? $title='Credit':'Debit';
        }
    }
    else
    {
        if ($total>0){
            $balance -= $total;
            $balance>0 ? $title='Debit':'Credit';
        }else{
            $balance += abs($total); $title = 'Debit';
        }
    }
    $result=[
        'balance'=>$balance,
        'title'=>$title
    ];
    return $result;
}

function todayCashSale(){
   $date= date('Y-m-d');
    $sales=\App\Models\Sale::where('sale_type','Cash')->where('created_at',$date)->get()->sum('totalPayable');
    return $sales;
}
function todayCreditSale(){
    $date= date('Y-m-d');
    $sales=\App\Models\Sale::where('sale_type','Credit')->where('created_at',$date)->get()->sum('totalPayable');
    return $sales;
}
function todayCashPurchase(){
    $date=date('Y-m-d');
    $purchase=\App\Models\Purchase::where('purchase_type','Debit')->where('created_at',$date)->get()->sum('total_amount');
    return $purchase;
}
function todayCreditPurchase(){
    $date=date('Y-m-d');
    $purchase_total=\App\Models\Purchase::where('purchase_type','Credit')->where('created_at',$date)->get()->sum('total_amount');
    $purchase_pay=\App\Models\Purchase::where('purchase_type','Credit')->where('created_at',$date)->get()->sum('pay_amount');
    $purchase=$purchase_total-$purchase_pay;
    return $purchase;
}


function productAvgPrice($id)
{
    $getPrice=\App\Models\Detail::where('product_id',$id)->get()->sum('sub_total');
    $getQuantity=\App\Models\Detail::where('product_id',$id)->get()->sum('quantity');
    $avgPrice=$getPrice/$getQuantity;
    return $avgPrice;
}

