<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include "head.tpl"}}

        <style>
            #modify-iframe {
                width: 100%;
                border:1px solid #aaa;
                height: 0;
                opacity: 0;
                transition: .25s;
            }
            #modify-iframe.show {
                opacity: 1;
                height: 500px;
            }
            #product-list div > a.selling {color: blue; }
            #product-list div > a.unselling {color: red; }
            #product-list div.options > a {
                margin: 0 2px;
            }
        </style>

</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">展示中心月結 / 明細</li>
        </ol>
        <h3 class="title-bar">
            <!-- <div id="option-bar" class="pull-right"></div> -->
            <label>訂單管理 - 展示中心月結 - 明細</label>
        </h3>
        <div style="display:inline-block; width: 100%">
            <!-- <div id="option-bar" class="pull-right"><button onclick="history.back();">返回</button></div> -->
        </div>
        <!-- <iframe id="bottom-iframe" name="bottom-iframe" style="border: 0px;width: 100%;"></iframe> -->
        <div id="order-list">
        </div>
    </div>
    <form id="search-data">
        <input name="agentid" id="agentid" type="hidden" value="{{$smarty.get.id}}" />
        <input name="year" id="year" type="hidden" value="{{$smarty.get.year}}" />
        <input name="month" id="month" type="hidden" value="{{$smarty.get.month}}" />
    </form>
    <script type="text/javascript" src="/js/page10_radar_month_closeDetails.js?{{$smarty.now}}"></script>


</body>
</html>