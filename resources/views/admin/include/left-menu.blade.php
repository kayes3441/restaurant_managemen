<div class="vertical-menu">
    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i><span class="badge badge-pill badge-info float-right"></span>
                        <span>Dashboards</span>
                    </a>
                </li>

                <li class="menu-title">Operations</li>
                <li>
                    <a href="{{route('add.purchase')}}" class=" waves-effect">
                        <i class="bx bx-cart-alt"></i>
                        <span>Purchase</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('add.sale')}}" class=" waves-effect">
                        <i class="bx bx-money"></i>
                        <span>Sale</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('receiveAndPay.page')}}" class=" waves-effect">
                        <i class="bx bx-dollar-circle"></i>
                        <span>Receive And Pay</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('income.and.expanse')}}" class=" waves-effect">
                        <i class="bx bxs-hand-right"></i>
                        <span>Other Income/Expense</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('bank.transaction.page')}}" class=" waves-effect">
                        <i class="bx bxs-bank"></i>
                        <span>Bank Transaction</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-file"></i>
                        <span>Report</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('cashbook.report')}}">Cash Book</a></li>
                        <li><a href="{{route('manage.stock')}}">Stock Report</a></li>
                        <li><a href="{{route('purchase.report.page')}}">Credit Purchase Report</a></li>
                        <li><a href="{{route('cash.purchase.report.page')}}">Cash Purchase Report</a></li>
                        <li><a href="{{route('credit.sale.page')}}">Credit Sale Report</a></li>
                        <li><a href="{{route('cash.sale.page')}}">Cash Sale Report</a></li>
                        <li><a href="{{route('receive.report.page')}}">Customer Receive Report</a></li>
                        <li><a href="{{route('supplier_pay.report.page')}}">Supplier Payment Report</a></li>
                        <li><a href="{{route('trans.and.labor.cost.page')}}">Transport & Labor Cost</a></li>
                        <li><a href="{{route('expanse.page')}}">Daily Expanse Report</a></li>
                        <li><a href="{{route('income.report.page')}}">Other Income Report</a></li>
                        <li><a href="{{route('bank.report.page')}}">Bank Report</a></li>
                        <li><a href="{{route('balance.summary.page')}}">Balance Summary Report</a></li>
                    </ul>
                </li>
                <li class="menu-title">Setup</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span>Product Setting</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li><a href="{{'manage'}}"> Purchase Product Type</a></li>
                        <li><a href="{{route('manage.purchase-product')}}"> Purchase Product</a></li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-bank"></i>
                        <span>Bank Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('manage.bank')}}">Bank</a></li>
                        <li><a href="{{route('manage.bank-account')}}">Bank Account</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-user"></i>
                        <span>Client Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('manage.supplier')}}">Supplier</a></li>
                        <li><a href="{{route('manage.customer')}}">Customer</a></li>
                    </ul>
                </li>
{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bxs-store"></i>--}}
{{--                        <span>Stock</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}

{{--                    </ul>--}}
{{--                </li>--}}

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-food-menu"></i>
                        <span>Food</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('food.recipe')}}">Food Recipe</a></li>
                        <li><a href="{{route('manage.food')}}">Food list</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{route('account-chart.page')}}" class=" waves-effect">
                        <i class="bx bxs-bank"></i>
                        <span>Account Chart</span>
                    </a>
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="{{route('account-chart.page')}}">Account List</a></li>--}}
{{--                    </ul>--}}
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-magnet"></i>
                        <span>Measurement</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('manage.unit')}}"> Unit</a></li>
{{--                        <li><a href="{{route('manage.unit.conversion')}}">Unit Measurement</a></li>--}}
                    </ul>
                </li>

{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bx-briefcase-alt-2"></i>--}}
{{--                        <span>Bank</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="{{route('add.bank')}}">Add Bank</a></li>--}}
{{--                        <li><a href="{{route('manage.bank')}}">Manage Bank</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bx-task"></i>--}}
{{--                        <span>Bank Account</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="{{route('add.bank-account')}}">Add Bank Account</a></li>--}}
{{--                        <li><a href="{{route('manage.bank-account')}}">Manage Bank Account</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}








{{--                <li class="menu-title">Components</li>--}}

{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bx-tone"></i>--}}
{{--                        <span>UI Elements</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="ui-alerts.html">Alerts</a></li>--}}
{{--                        <li><a href="ui-buttons.html">Buttons</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="waves-effect">--}}
{{--                        <i class="bx bxs-eraser"></i>--}}
{{--                        <span class="badge badge-pill badge-danger float-right">10</span>--}}
{{--                        <span>Forms</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="form-elements.html">Form Elements</a></li>--}}
{{--                        <li><a href="form-layouts.html">Form Layouts</a></li>--}}
{{--                        <li><a href="form-validation.html">Form Validation</a></li>--}}
{{--                        <li><a href="form-advanced.html">Form Advanced</a></li>--}}
{{--                        <li><a href="form-editors.html">Form Editors</a></li>--}}
{{--                        <li><a href="form-uploads.html">Form File Upload</a></li>--}}
{{--                        <li><a href="form-xeditable.html">Form Xeditable</a></li>--}}
{{--                        <li><a href="form-repeater.html">Form Repeater</a></li>--}}
{{--                        <li><a href="form-wizard.html">Form Wizard</a></li>--}}
{{--                        <li><a href="form-mask.html">Form Mask</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bx-list-ul"></i>--}}
{{--                        <span>Tables</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="tables-basic.html">Basic Tables</a></li>--}}
{{--                        <li><a href="tables-datatable.html">Data Tables</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bxs-bar-chart-alt-2"></i>--}}
{{--                        <span>Charts</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="charts-apex.html">Apex Charts</a></li>--}}
{{--                        <li><a href="charts-echart.html">E Charts</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bx-aperture"></i>--}}
{{--                        <span>Icons</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="icons-boxicons.html">Boxicons</a></li>--}}
{{--                        <li><a href="icons-materialdesign.html">Material Design</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bx-map"></i>--}}
{{--                        <span>Maps</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="false">--}}
{{--                        <li><a href="maps-google.html">Google Maps</a></li>--}}
{{--                        <li><a href="maps-vector.html">Vector Maps</a></li>--}}
{{--                        <li><a href="maps-leaflet.html">Leaflet Maps</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <i class="bx bx-share-alt"></i>--}}
{{--                        <span>Multi Level</span>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="true">--}}
{{--                        <li><a href="javascript: void(0);">Level 1.1</a></li>--}}
{{--                        <li><a href="javascript: void(0);" class="has-arrow">Level 1.2</a>--}}
{{--                            <ul class="sub-menu" aria-expanded="true">--}}
{{--                                <li><a href="javascript: void(0);">Level 2.1</a></li>--}}
{{--                                <li><a href="javascript: void(0);">Level 2.2</a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
