<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {{include 'head.tpl'}}
        <link rel="stylesheet" type="text/css" href="/css/page04.css" />
    </head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a class="active">最新消息 <!-- (App 推播) --></a></li>
        </ol>
        <h3 class="title-bar"> 
            <div id="option-bar" class="pull-right"></div>
            <label>最新消息 <!-- (App 推播) --></label>
        </h3>
        <div id="option-main" ></div>
        <div id="news-list">
        </div>
    </div>
    <script type="text/javascript" src="/js/page04_app.js?{{$smarty.now}}"></script>
</body>
</html>