<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {{include 'head.tpl'}}
        <link rel="stylesheet" type="text/css" href="/css/page02.css?{{$smarty.now}}" />
    </head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a class="active">產品管理</a></li>
        </ol>
        <h3 class="title-bar"> 
            <label>產品管理</label>
        </h3>
        <form id="search-form" class="form-inline">
            <div class="form-group">
                <label> 產品分類 </label>
                <select class="form-control" name="product-type">
                    {{html_options options=$types}}
                </select>
            </div>
            <div class="form-group">
                <label> 販售方式 </label>
                <select class="form-control" name="sell-type">
                    <option value="all">所有類型</option>
                    {{html_options options=$sell_types}}
                </select>
            </div>
            <div class="form-group">
                <label> 上架狀態 </label>
                <select class="form-control" name="selling">
                    <option value="all">全部</option>
                    <option value="1">上架中</option>
                    <option value="0">已下架</option>
                </select>
            </div>
            <div class="form-group">
                <label> 主力產品 </label>
                <select class="form-control" name="main">
                    <option value="all">全部</option>
                    <option value="1">主力</option>
                    <option value="0">非主力</option>
                </select>
            </div>
            <div id="option-bar" class="pull-right"></div>
        </form>
        <div id="option-main"></div>
        <div id="product-list">
        </div>
    </div>
    <script type="text/javascript" src="/js/page02_product.js?{{$smarty.now}}"></script>
</body>
</html>