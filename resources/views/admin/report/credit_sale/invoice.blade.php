<!DOCTYPE html>
<html lang="en" >
<head>

    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="https://static.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" />
    <link rel="mask-icon" type="" href="https://static.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
    <link href="{{asset('/')}}admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <title>Invoice</title>

    <style>
        @media print {
            .page-break { display: block; page-break-before: always; }
        }
        #invoice-POS {
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
            padding: 2mm;
            margin: 0 auto;
            width: 44mm;
            background: #FFF;
        }
        #invoice-POS ::selection {
            background: #f31544;
            color: #FFF;
        }
        #invoice-POS ::-moz-selection {
            background: #f31544;
            color: #FFF;
        }
        #invoice-POS h1 {
            font-size: 1.5em;
            color: #222;
        }
        #invoice-POS h2 {
            font-size: .9em;
        }
        #invoice-POS h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }
        #invoice-POS p {
            font-size: .7em;
            color: #666;
            line-height: 1.2em;
        }
        #invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
            /* Targets all id with 'col-' */
            border-bottom: 1px dashed #EEE;
        }
        #invoice-POS #top {
            min-height: 100px;
        }
        #invoice-POS #mid {
            min-height: 80px;
        }
        #invoice-POS #bot {
            min-height: 50px;
        }
        #invoice-POS #top .logo {
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
            background-size: 60px 60px;
        }
        #invoice-POS .clientlogo {
            float: left;
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
            background-size: 60px 60px;
            border-radius: 50px;
        }
        #invoice-POS .info {
            display: block;
            margin-left: 0;
        }
        #invoice-POS .title {
            float: right;
        }
        #invoice-POS .title p {
            text-align: right;
        }
        #invoice-POS table {
            width: 100%;
            border-collapse: collapse;
        }
        #invoice-POS .tabletitle {
            font-size: .5em;
            background: #EEE;

        }
        #invoice-POS .service {
            border-bottom: 1px dashed #EEE;
        }
        #invoice-POS .item {
            width: 24mm;
        }
        #invoice-POS .itemtext {
            font-size: .5em;
        }
        #invoice-POS #legalcopy {
            margin-top: 5mm;
        }

        #print{
            width: 90px;
            position: fixed;
            right: -130px;
            top: 5px;
            z-index: 9999;
        }

        body:hover #print{
            right: 5px;
            transition: all 0.2s;
        }

        .button1 {
            background-color: #0d0a05;
            border: none;
            color: rgb(254, 251, 251);
            width: 79px;
            text-align: center;
            text-decoration: none;
            font-size: 15px;
            padding: 11px 16px;
            margin: 3px 2px;
            border-radius: 8px;
            cursor: pointer;
            font-family: "Times New Roman", Times, serif;
        }
        .button2 {
            background-color: #15b193;
            border: none;
            color: white;
            width: 100px;
            text-align: center;
            text-decoration: none;
            font-size: 15px;
            padding: 11px 13px;
            margin: 4px 3px;
            border-radius: 8px;
            cursor: pointer;

        }
        @media print {
            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
        }

    </style>
    <script>
        window.console = window.console || function(t) {};
    </script>
    <script>
        if (document.location.search.match(/type=embed/gi)) {
            window.parent.postMessage("resize", "*");
        }
    </script>

</head>
<body>
<div id="print" class="hidden-print">
    <button class="button1" style="margin-bottom: 15px" onclick="window.print()">
        <i style="padding-right: 3px;height: 5px" class="fa fa-print ">Print</i></button>
    <br>
    <a class="button2" href="{{route('credit.sale.page')}}" ><i class="fa fa-arrow-left">Back</i> </a>
    <br>
</div>
<div id="invoice-POS">

    <center id="top">
        <div class="logo"></div>
        <div class="info">
            <h2>Red-Chilli</h2>
            <p>i/22 kazi Nazrul Islam Road, Mohammadpur Dhaka</br> Hotline:01780584408 kayes@gmail.com</p>
            <p></p>
        </div><!--End Info-->
    </center><!--End InvoiceTop-->
    <p style="margin-top: 1px;margin-bottom: 1px ;text-align: center ;border-bottom: 1px dashed #EEE;" >Credit Sale Invoice</p>

    <div id="mid">
        <div class="info">
            <p>BIN:1231231231</p>
            <p>
                Invoice : {{$sale->memo_number}}</br>
                Cashier : {{Auth::user()->name}}</br>
                Date    : {{dateFormat($sale->created_at,'d-m-Y')}} &nbsp &nbsp &nbsp Time:{{dateFormat($sale->created_at,'H:i:s')}}</br>
            </p>
        </div>
    </div><!--End Invoice Mid-->

    <div id="bot">

        <div id="table">
            <table>
                <tr class="tabletitle">
                    <td class="item">SL</td>
                    <td class="item">Details</td>
                    <td class="item">Qty</td>
                    <td class="Hours">Price</td>
                    <td class="Rate">Amount</td>
                </tr>
                @foreach($sale->saleItems as $saleItem)
                    <tr class="service">
                        <td class="tableitem"><p class="itemtext">{{$loop->iteration}}</p></td>
                        <td class="tableitem"><p class="itemtext">{{$saleItem->food_name}}</p></td>
                        <td class="tableitem"><p class="itemtext">{{$saleItem->quantity}}</p></td>
                        <td class="tableitem"><p class="itemtext">{{$saleItem->price}}</p></td>
                        <td class="tableitem"><p class="itemtext" style="text-align: right">{{$saleItem->price*$saleItem->quantity}}</p></td>
                    </tr>
                @endforeach
                <tr style="font-size: .5em;height: 20px">
                    <td class="" colspan="3" style="text-align:right;">Sub Total:</td>
                    <td class="" colspan="2" style="text-align:right">{{$sale->amount}}</td>
                </tr>
                <tr class="" style="font-size: .5em;height: 20px">
                    <td class="" colspan="3" style="text-align:right;">Vat Amount:</td>
                    <td class="" colspan="2" style="text-align:right">{{$sale->vatAmount}}</td>
                </tr>
                <tr class="" style="font-size: .5em;height: 20px">
                    <td class="" colspan="3" style="text-align:right;">Discount:</td>
                    <td class="" colspan="2" style="text-align:right">{{$sale->discount}}</td>
                </tr>
                <tr class="" >
                    <td class="" colspan="2" style="text-align:right;"></td>
                    <td class="" colspan="3" style="text-align:right">-----------</td>
                </tr>
                @if($sale->sale_type=='Cash')
                    <tr class="service" style="font-size: .5em;height: 20px">
                        <th class="" colspan="3" style="text-align:right;">Total Payable:</th>
                        <td class="" colspan="2" style="text-align:right">{{$sale->totalPayable}}</td>
                    </tr>
                    <tr class=""style="font-size: .5em;height: 25px">
                        <td class="" colspan="3" style="text-align:right;">Cash Paid:</td>
                        <td class="" colspan="2" style="text-align:right">{{$sale->cashPaid}}</td>
                    </tr>
                    <tr class="service"style="font-size: .5em;height: 20px">
                        <td class="" colspan="3" style="text-align:right;">Change Amount:</td>
                        <td class="" colspan="2" style="text-align:right">{{$sale->changeAmount}}</td>
                    </tr>
                @elseif($sale->sale_type=='Credit')
                    <tr class="service" style="font-size: .5em;height: 20px">
                        <th class="" colspan="3" style="text-align:right;">Due Amount:</th>
                        <td class="" colspan="2" style="text-align:right">{{$sale->totalPayable}}</td>
                    </tr>
                @endif
                <tr class="service"style="font-size: .5em;height: 20px">
                    <td class="item" colspan="5">{{numberToWord($sale->totalPayable)}}&nbsp taka only</td>
                </tr>
            </table>
            <div id="legalcopy">
                <p class="legal "style="text-align: center">Thank for comming at </br>
                    <strong>Red-Chilli Restaurant & Hotel</strong>
                </p>
            </div>

        </div>

    </div><!--End Invoice-->
    <p style="margin-top: 3px; ;font-size:0.5rem; text-align: left ;border-bottom: 1px dashed #EEE;" >Software Developed By TechIntelligence</p><!--End InvoiceBot-->
    <p style="margin-bottom: 1px ;margin-top:1px;font-size:0.5rem; text-align: center ;border-bottom: 1px dashed #EEE;" >**VAT & Service Charge Included</p><!--End InvoiceBot-->
</div>


</body>

</html>
