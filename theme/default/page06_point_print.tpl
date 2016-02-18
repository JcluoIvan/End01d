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
                    <th>訂單編號</th>
                    <th>交易日</th>
                    <th>核帳日</th>
                    <th>入帳日</th>
                    <th>會員編號</th>
                    <th>實收金額</th>
                    <th>發放點數</th>
                    <th>展示中心編號</th>
                    <th>上一層名稱/發放點數</th>
                    <th>上二層名稱/發放點數</th>
                    <th>上三層名稱/發放點數</th>
                </tr>
            </thead>
            <tbody>
            {{foreach from=$rows item=row}}
                <tr>
                    <td>{{$row.ono}}</td>
                    <td>{{$row.trans_date}}</td>
                    <td>{{$row.verification_date}}</td>
                    <td>{{$row.give_date}}</td>
                    <td>{{$row.mem_no}}</td>
                    <td>{{$row.pay_amount}}</td>
                    <td>{{$row.give_point}}</td>
                    <td>{{$row.age_no}}</td>
                    <td>{{$row.mlv1}}</td>
                    <td>{{$row.mlv2}}</td>
                    <td>{{$row.mlv3}}</td>
                </tr>
            {{/foreach}}
            </tbody>
    </page>
    <button id='print'>Print</button>
    <script src='/js/page06_print_page.js'> </script>
</body>
</html>
