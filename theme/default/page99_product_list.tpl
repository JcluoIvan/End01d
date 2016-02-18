<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {{include 'head.tpl'}}
        <!-- <link rel="stylesheet" type="text/css" href="/css/page99.css" /> -->
    </head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="/page/page99/product.php?sid={{$smarty.get.sid}}">產品操作記錄</a></li>
            <li class="active">[ {{$product->pdm004}} ] 產品修改歷程</li>
        </ol>
        <h3 class="title-bar"> 
            <div id="option-bar" class="pull-right"></div>
            <label>[ {{$product->pdm004}} ] 產品修改歷程</label>
        </h3>
        <div id="option-main" ></div>
        <div id="news-list">
        </div>
    </div>
    <form id="product-log" method="post">
        <input type="hidden" name="pid" value="{{$product->pdm001}}" />
    </form>
    <script type="text/javascript" src="/js/page99_product_list.js?{{$smarty.now}}"></script>
</body>
</html>