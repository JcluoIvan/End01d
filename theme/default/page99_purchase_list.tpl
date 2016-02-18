<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {{include 'head.tpl'}}
        <!-- <link rel="stylesheet" type="text/css" href="/css/page99.css" /> -->
    </head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="/page/page99/purchase.php?sid={{$smarty.get.sid}}">進貨操作歷程</a></li>
            <li class="active">{{$tag}}</li>
        </ol>
        <h3 class="title-bar"> 
            <div id="option-bar" class="pull-right"></div>
            <label>{{$title}}</label>
        </h3>
        <div id="option-main" ></div>
        <div id="news-list">
        </div>
    </div>
    <form id="purchase-log" method="post">
        <input type="hidden" name="id" value="{{$log->lpc001}}" />
    </form>
    <script type="text/javascript" src="/js/page99_purchase_list.js?{{$smarty.now}}"></script>
</body>
</html>