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
                    <th>退貨單編號</th>
                    <th>展示中心編號</th>
                    <th>會員編號</th>
                    <th>退貨項目</th>
                    <th>退貨數量</th>
                    <th>退貨單狀態</th>
                    <th>操作人員</th>

                </tr>
            </thead>
            <tbody>
            {{foreach from=$rows item=row}}
                <tr>
                    <td>{{$row.rNO}}</td>
                    <td>{{$row.aid}}</td>
                    <td>{{$row.mid}}</td>
                    <td>{{$row.pid}}</td>
                    <td>{{$row.amount}}</td>
                    <td>{{$row.status}}</td>
                    <td>{{$row.keyman}}</td>
                </tr>
            {{/foreach}}
            </tbody>
    </page>
    <button id="print">Print</button>
    <script src="/js/page12_print_page.js?{{$smarty.now}}"> </script>
</body>
</html>
