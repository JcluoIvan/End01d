<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include "head.tpl"}}
</head>
<body class="print-page landscape">
    <page size="A4">
        <table class="print-table">
            <thead>
                <tr>
                    <th>訂單編號</th>
                    <th>交易金額</th>
                    <th>購物金</th>
                    <th>總金額</th>
                    <th>收款日期</th>
                    <th>出（取）貨日期</th>
                    <th>核帳日期</th>
                    <th>付款方式</th>
                    <th>取貨方式</th>
                    <th>訂貨人</th>
                    <th>展示中心編號</th>
                    <th>宅配單號（取貨序號）</th>
                </tr>
            </thead>
            <tbody>
            {{foreach from=$rows item=row}}
                <tr>
                    <td>{{$row.oid}}</td>
                    <td>{{$row.total - $row.reject_shopgold}}</td>
                    <td>{{$row.coupon - $row.reject_point}}</td>
                    <td>{{$row.money}}</td>
                    <td>{{$row.date3}}</td>
                    <td>{{$row.date2}}</td>
                    <td>{{$row.check_date}}</td>
                    <td>{{$row.methods}}</td>
                    <td>{{$row.getmode}}</td>
                    <td>{{$row.name}}</td>
                    <td>{{$row.lv2id}}</td>
                    <td>{{$row.getno}}</td>
                </tr>
            {{/foreach}}
            </tbody>
        </table>
        <div class="footer">
            <table class="print-table-footer">
                <thead>
                    <tr>
                        <th>印單人：</th>
                        <th>廠務部：</th>
                        <th>客服部：</th>
                        <th>會計部：</th>
                        <th>資訊部：</th>
                    </tr>
                </thead>
            </table>
        </div>
    </page>
    <button id="print">Print</button>
    <script src="/js/page03_print_page.js?{{$smarty.now}}"> </script>
</body>
</html>
