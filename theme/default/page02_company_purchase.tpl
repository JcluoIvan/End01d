<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include 'head.tpl'}}
</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">公司進貨記錄表</li>
        </ol>
        <h3 class="title-bar">
            <label>公司進貨記錄表</label>
        </h3>
        <form id="form-search" method="post" class="form-inline">
            <div class="form-group">
                <label class="label-control">產品分類</label>
                <select class="form-control" id="product-item" name="item">
                    {{html_options options=$types}}
                </select>
            </div>
            <input type="hidden" name="rid" value="0" />
            <div id="option-bar" class="pull-right"></div>
        </form>
        <div id="option-main"> </div>
        <div id="purchase-list"> </div>
        <script type="text/javascript" src="/js/page02_company_purchase.js?{{$smarty.now}}"></script>
    </div>
</body>
</html>