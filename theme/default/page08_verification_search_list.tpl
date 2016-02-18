<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include "head.tpl"}}
    <link rel="stylesheet" type="text/css" href="/css/page08.css" />
</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">取貨操作</li>
        </ol>
        <h3 class="title-bar">
            <label>展示中心專區 - 取貨操作</label>
        </h3>
        <div style="display:inline-block; width: 100%">
            <div class="pull-left" >
                <form id="command-search" class="form-inline" autocomplete="off">
                    <label for="exampleInputName2">訂單編號</label>
                    <input name="no" id="no" type="text" class="form-control" placeholder="請輸入訂單編號" />
                    <button type="submit" class="btn btn-default">查詢</button>
                </form>
            </div>
            <div id="option-bar" class="pull-right"></div>
        </div>
        <!-- <iframe id="bottom-iframe" name="bottom-iframe" style="border: 0px;width: 100%;"></iframe> -->
        <div id="order-list">
        </div>
        <div class="col-xs-12">
            <pre class="well" id="success"></pre>
            <button type="button" id="checkDate" class="btn btn-primary pull-left">確認核帳</button>
        </div>
    </div>
    <script type="text/javascript" src="/js/page08_verification_search_list.js?{{$smarty.now}}"></script>


</body>
</html>