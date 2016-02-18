<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include "head.tpl"}}
</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="/page/page03/command_list.php?sid={{$smarty.get.sid}}">訂貨單</a></li>
            <li class="active">退貨單列表 [ 訂單編號：{{$ooid}} ] </li>
        </ol>
        <h3 class="title-bar">
            <!-- <div id="option-bar" class="pull-right"></div> -->
            <label>訂單管理 - 退貨單列表</label>
        </h3>
        <div style="display:inline-block; width: 100%">
            <div class="pull-left" >
                <form id="command-search" class="form-inline">
                    <input name="oid" id="oid" type="hidden" value="{{$oid}}">
                    <input name="date1" id="date1" type="hidden" value="{{$date1}}">
                    <input name="date2" id="date2" type="hidden" value="{{$date2}}">
                    <input id="check-date" type="hidden" value="{{$datecheck}}">
                    
                    <button type="button" class="btn btn-primary"id="print" name="print">列印</button>
                    
                </form>

            </div>
            <div id="option-bar" class="pull-right"></div>
        </div>
        <div id="option-main" ></div>
        <!-- <iframe id="bottom-iframe" name="bottom-iframe" style="border: 0px;width: 100%;"></iframe> -->
        <div id="order-list">
        </div>
    </div>
    <script type="text/javascript" src="/js/page03_reject_list.js?{{$smarty.now}}"></script>


</body>
</html>