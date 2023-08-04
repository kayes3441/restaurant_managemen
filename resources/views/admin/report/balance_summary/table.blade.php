<table id="" class="table table-bordered table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr class="text-primary">
        <th colspan="2" class="text-center f-s-small">Assets</th>
        <th colspan="2" class="text-center f-s-small">Liabilities</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Cash</td><td class="text-right">{{$current_cash}}</td>
        <td>Supplier's Payable</td><td class="text-right">{{$payment}}</td></tr>
    <tr>
        <td>Bank Balanced</td><td class="text-right">{{$bank_balance}}</td>
        <td></td><td class="text-right"></td>
    </tr>
    <tr>
        <td>Customer's Receivable</td><td class="text-right">{{$receive}}</td>
        <td></td><td class="text-right"></td>
    </tr>
    <tr>
        <td>Present Stock</td><td class="text-right">{{$stock}}</td>
        <td></td><td></td></tr>
{{--    <tr>--}}
{{--        <td>Advance Purchase</td><td class="text-right"></td>--}}
{{--        <td></td><td></td>--}}
{{--    </tr>--}}
    <tr>
        <th class="text-center f-s-small">Total</th><td class="text-right f-s-small">{{$current_cash+$bank_balance+$receive+$stock}}</td>
        <th class="text-center f-s-small">Total</th><td class="text-right f-s-small">{{$payment}}</td>
    </tr>
    </tbody>
</table>

