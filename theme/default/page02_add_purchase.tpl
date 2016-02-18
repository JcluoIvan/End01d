<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include 'head.tpl'}}
</head>
<body>
    <div class="col-xs-12">
        <h3 class="title-bar">
            <label>{{$title}}</label>
        </h3>
        <div id="purchase-list">
        </div>
        <iframe id="detail-iframe" name="detail-iframe"></iframe>
        <script type="text/javascript" src="/js/page02_purchase.js?{{$smarty.now}}"></script>
    </div>
</body>
</html>