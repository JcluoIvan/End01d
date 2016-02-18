<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include 'head.tpl'}}
</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a class="active">庫存查詢</a></li>
        </ol>
        <h3 class="title-bar"> 
            <label>庫存查詢</label>
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
                    {{html_options options=$r_agent selected=$def_agent->age001}}
                </select>
            </div>
            <div class="form-group">
                <label class="label-control">產品分類</label>
                <select class="form-control" id="product-type" name="product-type">
                    {{html_options options=$types}}
                </select>
            </div>
            <!-- <div id="option-bar" class="pull-right"></div> -->
        </form>
        <!-- <div id="option-main"> </div> -->
        <div id="inventory-list"> </div>
    </div>
    <script type="text/javascript" src="/js/page02_inventory.js?{{$smarty.now}}"></script>
</body>
</html>