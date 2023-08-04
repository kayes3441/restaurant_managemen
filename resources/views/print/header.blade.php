<header class="as-header header-layout1">
    <div class="row align-items-center justify-content-between">
        <div class="col-auto">
            <div class="header-logo">
                <a href="#"><img src="{{asset('/')}}admin/assets/invoice/img/logo.svg" alt="Invce">
                </a></div>
        </div>
        <div class="col-auto"><h1 class="big-title">Invoice</h1></div>
    </div>
    <div class="header-bottom">
        <div class="row align-items-center">
            <div class="col">
                <div class="border-line"><img src="{{asset('/')}}admin/assets/invoice/img/bg/line_pattern.svg" alt="line"></div>
            </div>
            <div class="col-auto"><p class="invoice-number me-4"><b>@yield('invoice')</b></p>
            </div>
            <div class="col-auto"><p class="invoice-date"><b>Date:</b>@yield('date')</p></div>
        </div>
    </div>
</header>
