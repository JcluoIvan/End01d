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
                    <th>會員名稱</th>
                    <th>金額</th>
                    <th>宅配單號</th>
                </tr>
            </thead>
            <tbody>
            {{foreach from=$rows item=row}}
                <tr>
                    <td>{{$row.oid}}</td>
                    <td>{{$row.name}}</td>
                    <td>{{$row.money}}</td>
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
    <script src="/js/page12_print_page.js?{{$smarty.now}}"> </script>
</body>
</html>
