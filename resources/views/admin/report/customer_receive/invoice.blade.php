<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <title> Invoice</title>
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('/')}}admin/assets/invoice/img/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('/')}}admin/assets/invoice/img/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('/')}}admin/assets/invoice/img/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('/')}}admin/assets/invoice/img/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('/')}}admin/assets/invoice/img/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('/')}}admin/assets/invoice/img/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('/')}}admin/assets/invoice/img/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('/')}}admin/assets/invoice/img/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/')}}admin/assets/invoice/img/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('/')}}admin/assets/invoice/img/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/')}}admin/assets/invoice/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('/')}}admin/assets/invoice/img/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/')}}admin/assets/invoice/img/favicons/favicon-16x16.png">
    <link rel="manifest" href="{{asset('/')}}admin/assets/invoice/img/favicons/manifest.json">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/')}}admin/assets/invoice/css/app.min.css">
    <link rel="stylesheet" href="{{asset('/')}}admin/assets/invoice/css/style.css">
</head>
<body>
<div class="invoice-container-wrap">
    <div class="invoice-container">
        <main>
            <div class="as-invoice invoice_style1">
                <div class="download-inner" id="download_section">
                    <header class="as-header header-layout1">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto">
                                <div class="header-logo">
                                    <a href="index.html"><img src="{{asset('/')}}admin/assets/invoice/img/logo.svg" alt="Invce">
                                    </a></div>
                            </div>
                            <div class="col-auto"><h1 class="big-title">Invoice</h1></div>
                        </div>
                        <div class="header-bottom">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="border-line"><img src="{{asset('/')}}admin/assets/invoice/img/bg/line_pattern.svg" alt="line"></div>
                                </div>
                                <div class="col-auto"><p class="invoice-number me-4"><b>Cash Receive Invoice</b></p>
                                </div>
                                <div class="col-auto"><p class="invoice-date"><b>Date: </b>{{dateFormat($receive_amount->created_at,'d-m-Y')}}</p></div>
                            </div>
                        </div>
                    </header>

                    <table class="invoice-table">
                        <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Customer Mobile</th>
                            <th>Past Balance</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$receive_amount->customer->name}}</td>
                                <td>{{$receive_amount->customer->mobile}}</td>
                                <td>{{$receive_amount->past_balance}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <div class="invoice-left"><b></b>
                                <p class="mb-0"></p></div>
                        </div>
                        <div class="col-auto">
                            <table class="total-table">

                                <tr>
                                    <th>Paid Amount</th>
                                    <td>{{$receive_amount->amount}}</td>
                                </tr>
                                <tr>
                                    <th>Discount</th>
                                    <td>{{$receive_amount->discount}}</td>
                                </tr>
                                <tr>
                                    <th>Receivable</th>
                                    <td>{{$receive_amount->new_balance}}</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <p class="invoice-note mt-3">
                        <svg width="13" height="16" viewBox="0 0 13 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.22969 12.6H9.77031V11.4H3.22969V12.6ZM3.22969 9.2H9.77031V8H3.22969V9.2ZM1.21875 16C0.89375 16 0.609375 15.88 0.365625 15.64C0.121875 15.4 0 15.12 0 14.8V1.2C0 0.88 0.121875 0.6 0.365625 0.36C0.609375 0.12 0.89375 0 1.21875 0H8.55156L13 4.38V14.8C13 15.12 12.8781 15.4 12.6344 15.64C12.3906 15.88 12.1063 16 11.7812 16H1.21875ZM7.94219 4.92V1.2H1.21875V14.8H11.7812V4.92H7.94219ZM1.21875 1.2V4.92V1.2V14.8V1.2Z" fill="#1CB9C8"/>
                        </svg>
                        <b>Software By : </b>Tech Intelligence.
                    </p>
                    <div class="body-shape1"></div>
                </div>
                <div class="invoice-buttons">
                    <button class="print_btn" onclick="printInvoice('id')">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.9688 8.46875C12.1146 8.32292 12.2917 8.25 12.5 8.25C12.7083 8.25 12.8854 8.32292 13.0312 8.46875C13.1771 8.61458 13.25 8.79167 13.25 9C13.25 9.20833 13.1771 9.38542 13.0312 9.53125C12.8854 9.67708 12.7083 9.75 12.5 9.75C12.2917 9.75 12.1146 9.67708 11.9688 9.53125C11.8229 9.38542 11.75 9.20833 11.75 9C11.75 8.79167 11.8229 8.61458 11.9688 8.46875ZM13.5 5.5C14.1875 5.5 14.7708 5.75 15.25 6.25C15.75 6.72917 16 7.3125 16 8V12C16 12.1458 15.9479 12.2708 15.8438 12.375C15.7604 12.4583 15.6458 12.5 15.5 12.5H13.5V15.5C13.5 15.6458 13.4479 15.7604 13.3438 15.8438C13.2604 15.9479 13.1458 16 13 16H3C2.85417 16 2.72917 15.9479 2.625 15.8438C2.54167 15.7604 2.5 15.6458 2.5 15.5V12.5H0.5C0.354167 12.5 0.229167 12.4583 0.125 12.375C0.0416667 12.2708 0 12.1458 0 12V8C0 7.3125 0.239583 6.72917 0.71875 6.25C1.21875 5.75 1.8125 5.5 2.5 5.5V1C2.5 0.729167 2.59375 0.5 2.78125 0.3125C2.96875 0.104167 3.1875 0 3.4375 0H10.375C10.7917 0 11.1458 0.145833 11.4375 0.4375L13.0625 2.0625C13.3542 2.35417 13.5 2.70833 13.5 3.125V5.5ZM4 1.5V5.5H12V3.5H10.5C10.3542 3.5 10.2292 3.45833 10.125 3.375C10.0417 3.27083 10 3.14583 10 3V1.5H4ZM12 14.5V12.5H4V14.5H12ZM14.5 11V8C14.5 7.72917 14.3958 7.5 14.1875 7.3125C14 7.10417 13.7708 7 13.5 7H2.5C2.22917 7 1.98958 7.10417 1.78125 7.3125C1.59375 7.5 1.5 7.72917 1.5 8V11H14.5Z"
                                  fill="white"/>
                        </svg>
                        <span>Print</span>
                    </button>
                    <a id="download_btn" class="download_btn"  href="{{route('receive.report.page')}}">
                        <svg width="18" height="16" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:#101820;}</style></defs><title/><g data-name="Layer 50" id="Layer_50"><path class="cls-1" d="M30,29a1,1,0,0,1-.81-.41l-2.12-2.92A18.66,18.66,0,0,0,15,18.25V22a1,1,0,0,1-1.6.8l-12-9a1,1,0,0,1,0-1.6l12-9A1,1,0,0,1,15,4V8.24A19,19,0,0,1,31,27v1a1,1,0,0,1-.69.95A1.12,1.12,0,0,1,30,29ZM14,16.11h.1A20.68,20.68,0,0,1,28.69,24.5l.16.21a17,17,0,0,0-15-14.6,1,1,0,0,1-.89-1V6L3.67,13,13,20V17.11a1,1,0,0,1,.33-.74A1,1,0,0,1,14,16.11Z"/></g></svg>
                        <span>Back</span>
                    </a>
                </div>
            </div>
        </main>
    </div>
</div>
<script src="{{asset('/')}}admin/assets/invoice/js/vendor/jquery-3.6.0.min.js"></script>
{{--<script src="{{asset('/')}}admin/assets/invoice/js/app.min.js"></script>--}}
{{--<script src="{{asset('/')}}admin/assets/invoice/js/main.js"></script>--}}

<script>
    function printInvoice(id)
    {
        // e.preventDefault();
        window.print();
    }
</script>
</body>
</html>
