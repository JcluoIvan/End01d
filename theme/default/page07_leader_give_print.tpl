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
                    <th>專業經理人編號</th>
                    <th>獎金統計</th>
                    <th>%</th>
                </tr>
            </thead>
            <tbody>
            {{foreach from=$rows item=row}}
                <tr>
                    <td>{{$row.ano}}</td>
                    <td>{{$row.bonus}}</td>
                    <td>{{$row.percent}}</td>
                </tr>
            {{/foreach}}
            </tbody>
    </page>
    <button id='print'>Print</button>
    <script src='/js/page07_print_page.js'> </script>
</body>
</html>
