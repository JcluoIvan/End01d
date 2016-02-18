<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include "head.tpl"}}
</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="/page/page08/command_list.php?sid={{$smarty.get.sid}}">業務獎金查詢</a></li>
            <li class="active">退貨單列表 [ 會員編號：{{$member->mem002}} ] </li>
        </ol>
        <h3 class="title-bar">
            <!-- <div id="option-bar" class="pull-right"></div> -->
            <label>業務獎金查詢 - 退貨單列表</label>
        </h3>
        <div style="display:inline-block; width: 100%">
            <div class="pull-left" >
                <form id="command-search" class="form-inline">
                    <input name="sn" id="sn" type="hidden" value="{{$sn}}">
                    <input name="getdate1" id="getdate1" type="hidden" value="{{$date1}}">
                    <input name="getdate2" id="getdate2" type="hidden" value="{{$date2}}"> 
                </form>
            </div>
            <div id="option-bar" class="pull-right"></div>
        </div>
        <div id="option-main" ></div>
        <!-- <iframe id="bottom-iframe" name="bottom-iframe" style="border: 0px;width: 100%;"></iframe> -->
        <div id="order-list">
        </div>
    </div>
    <script type="text/javascript" src="/js/page08_reject_record_list.js?{{$smarty.now}}"></script>


</body>
</html>