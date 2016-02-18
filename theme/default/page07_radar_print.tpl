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
                    <th>展示中心編號</th>
                    <th>店名</th>
                    <th>使用購物金</th>
                    <th>%</th>
                    <th>實付獎金</th>
                    <th>獎金核帳日</th>
                </tr>
            </thead>
            <tbody>
            {{foreach from=$rows item=row}}
                <tr>
                    <td>{{$row.ono}}</td>
                    <td>{{$row.trans_date}}</td>
                    <td>{{$row.verification_date}}</td>
                    <td>{{$row.age_no}}</td>
                    <td>{{$row.age_store}}</td>
                    <td>{{$row.pay_point}}</td>
                    <td>{{$row.percent}}</td>
                    <td>{{$row.give_bonus}}</td>
                    <td>{{$row.bonus_verification}}</td>
                </tr>
            {{/foreach}}
            </tbody>
    </page>
    <button id='print'>Print</button>
    <script src='/js/page07_print_page.js'> </script>
</body>
</html>
