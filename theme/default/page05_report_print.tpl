<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
    {{include 'head.tpl'}}
</head>
<body class='print-page landscape'>
    <page size='A4'>
        <table class='print-table'>
            <thead>
                <tr>
                    <th>展示中心編號</th>
                    <th>展示中心名稱</th>
                    <th>展示中心店名</th>
                    <th>商品金額</th>
                    <th>+ 運費</th>
                    <th>- 退貨金額</th>
                    <th>= 總金額</th>
                    <th>使用購物金</th>
                </tr>
            </thead>
            <tbody>
            {{foreach from=$rows item=row}}
                <tr>
                    <td>{{$row.age_no}}</td>
                    <td>{{$row.age_name}}</td>
                    <td>{{$row.age_store}}</td>
                    <td>{{$row.pay_amount}}</td>
                    <td>{{$row.fare}}</td>
                    <td>{{$row.reject_amount}}</td>
                    <td>{{$row.amount}}</td>
                    <td>{{$row.pay_point}}</td>
                </tr>
            {{/foreach}}
            </tbody>
    </page>
    <button id='print'>Print</button>
    <script src='/js/page05_print_page.js'> </script>
</body>
</html>
