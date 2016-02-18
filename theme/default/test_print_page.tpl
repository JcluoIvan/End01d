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
                    <th>總金額</th>
                    <th>核帳日期</th>
                    <th>取貨中心</th>
                    <th>專業經理人</th>
                    <th>展示中心</th>
                </tr>
            </thead>
            <tbody>
            {{foreach from=$rows item=row}}
                <tr>
                    <td>{{$row->odm002}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            {{/foreach}}
            </tbody>
    </page>
    <button id="print">Print</button>
    <script src="/js/test_print_page.js?{{$smarty.now}}"> </script>
</body>
</html>
