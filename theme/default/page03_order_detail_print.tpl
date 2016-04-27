<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include "head.tpl"}}
</head>
<body class="print-page landscape">
    <page size="A4">
        <table width="100%" border="0">
            <tr>
                <td>會員編號： {{$memberData->mem002}}</td>
                <td>　訂貨人： {{$orderData['name']}}</td>
                <td>訂單編號： {{$orderData['oid']}}</td>
            </tr>
            <tr>
                <td>聯絡電話： {{$orderData['phone']}}</td>
                <td>訂貨方式： {{$orderData['getmode']}}</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td >送貨地址： {{$orderData['address']}}</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="right" colspan="3">
                    現金: {{$pmoney}} + 運費: {{$shipment}} - 使用購物金: {{$use_shoppinggold}} - 退貨金: {{$rmoney}} = 總金額: {{$correct_sum}} ，本次新增購物金: {{$shoppinggold}}
                </td>
            </tr>
        </table>
        <table class="print-table">
            <thead>
                <tr>
                    <th>產品編號</th>
                    <th>品名</th>
                    <th>產品單價</th>
                    <th>購買數量</th>
                    <th>退貨數量</th>
                    <th>剩餘數量</th>
                    <th>購買金額</th>
                    <th>退貨金額</th>
                    <th>剩餘金額</th>
                </tr>
            </thead>
            <tbody>
            {{foreach from=$detail item=row}}
                <tr>
                    <td>{{$row['no']}}</td>
                    <td>{{$row['name']}}</td>
                    <td>{{$row['money']}}</td>
                    <td>{{$row['count']}}</td>
                    <td>{{$row['reject_count']}}</td>
                    <td>{{$row['totalcount']}}</td>
                    <td>{{$row['total']}}</td>
                    <td>{{$row['reject_money']}}</td>
                    <td>{{$row['totalmoney']}}</td>
                </tr>
            {{/foreach}}
            </tbody>
    </page>
    <button id="print">Print</button>
    <script src="/js/page03_print_page.js?{{$smarty.now}}"> </script>
</body>
</html>
