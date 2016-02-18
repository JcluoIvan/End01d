<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {{include 'head.tpl'}}
        <style>
            #product-list div > a.enabled {color: blue; }
            #product-list div > a.disabled {color: red; }
            #product-list div.options > a {
                margin: 0 2px;
            }
        </style>
    </head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a class="active">產品類別管理</a></li>
        </ol>
        <h3 class="title-bar"> 
            <div id="option-bar" class="pull-right"></div>
            <label>產品類別管理</label>
        </h3>
        <div id="option-main"></div>
        <div id="product-list">
        </div>
    </div>
    <script type="text/javascript" src="/js/page02_item.js"></script>
</body>
</html>