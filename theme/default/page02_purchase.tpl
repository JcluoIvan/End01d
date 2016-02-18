<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include 'head.tpl'}}
</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">進貨記錄表</li>
        </ol>
        <h3 class="title-bar">
            <label>進貨記錄表</label>
        </h3>
        <form id="form-search" method="post" class="form-inline">
            <div class="form-group">
                <label class="label-control">專業經理人</label>
                <select id="l-agent" class="form-control">
                    {{html_options options=$l_agent}}
                </select>
            </div>
            <div class="form-group">
                <label class="label-control">展示中心</label>
                <select id="r-agent" name="rid" class="form-control">
                    {{html_options options=$r_agent}}
                </select>
            </div>
            <div class="form-group">
                <label class="label-control">產品分類</label>
                <select class="form-control" id="product-item" name="item">
                    {{html_options options=$types}}
                </select>
            </div>
            
            <div id="option-bar" class="pull-right">
                <button id="return-button" type="button" class="btn btn-default type-return">新增退貨</button>
            </div>
        </form>
        <div id="option-main"> </div>
        <div id="purchase-list"> </div>
        <script type="text/javascript" src="/js/page02_purchase_modify.js?{{$smarty.now}}"></script>
        <script type="text/javascript" src="/js/page02_return_modify.js?{{$smarty.now}}"></script>
        <script type="text/javascript" src="/js/page02_purchase.js?{{$smarty.now}}"></script>
    </div>
</body>
</html>