<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    @include('print.style')
</head>
<body>
<div class="invoice-container-wrap">
    <div class="invoice-container">
        <main>
            <div class="as-invoice invoice_style1">
                <div class="download-inner" id="download_section">

                   @include('print.header')
                    @yield('detail')
                    @yield('table')
                    <p class="invoice-note mt-3">
                        <svg width="13" height="16" viewBox="0 0 13 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.22969 12.6H9.77031V11.4H3.22969V12.6ZM3.22969 9.2H9.77031V8H3.22969V9.2ZM1.21875 16C0.89375 16 0.609375 15.88 0.365625 15.64C0.121875 15.4 0 15.12 0 14.8V1.2C0 0.88 0.121875 0.6 0.365625 0.36C0.609375 0.12 0.89375 0 1.21875 0H8.55156L13 4.38V14.8C13 15.12 12.8781 15.4 12.6344 15.64C12.3906 15.88 12.1063 16 11.7812 16H1.21875ZM7.94219 4.92V1.2H1.21875V14.8H11.7812V4.92H7.94219ZM1.21875 1.2V4.92V1.2V14.8V1.2Z"
                                  fill="#1CB9C8"/>
                        </svg>
                        <b>Software By : </b>Tech Intelligence.
                    </p>
                    <div class="body-shape1"></div>
                </div>
                @include('print.footer')
            </div>
        </main>
    </div>
</div>
@include('print.js')
</body>
</html>
