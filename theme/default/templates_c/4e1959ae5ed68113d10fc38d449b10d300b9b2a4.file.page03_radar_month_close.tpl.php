<?php /* Smarty version Smarty-3.1.8, created on 2015-10-16 16:27:56
         compiled from "/home/www//theme/default/page03_radar_month_close.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10281733045620b50c554849-82091428%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4e1959ae5ed68113d10fc38d449b10d300b9b2a4' => 
    array (
      0 => '/home/www//theme/default/page03_radar_month_close.tpl',
      1 => 1443171017,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10281733045620b50c554849-82091428',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5620b50c5bff77_62807234',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5620b50c5bff77_62807234')) {function content_5620b50c5bff77_62807234($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


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
            <li><a class="active">展示中心月結</a></li>
        </ol>
        <h3 class="title-bar">
            <!-- <div id="option-bar" class="pull-right"></div> -->
            <label>訂單管理 - 展示中心月結</label>
        </h3>
        <div style="display:inline-block; width: 88%">
            <div class="pull-left" >
                <form id="command-search" class="form-inline">
                    <label for="exampleInputName2">搜尋</label>
                    <input name="no" id="no" type="text" class="form-control" placeholder="請輸入展示中心編號或名稱" />
                    <div class="form-group">
                        <label for="exampleInputName2">核帳日期</label>
                        <div class="input-group">
                            <input readonly name="date1" type="text" id="date1" onpropertychange="zzday();" style='width:140px;' class="form-control" />
                            <a id="trigger1" class="input-group-addon btn bt-default" href="#">
                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                            </a>
                        </div>
                        至
                        <div class="input-group">
                            <input readonly name="date2" type="text" id="date2" onpropertychange="zzday();" style='width:140px;' class="form-control" />
                            <a id="trigger2" class="input-group-addon btn bt-default" href="#">
                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                            </a>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-default">查詢</button>
                </form>

            </div>
            <div id="option-bar" class="pull-right"></div>
            <!-- <button type="button" id="checkRadar" class="btn btn-primary pull-right">核帳</button> -->
        </div>
        <!-- <iframe id="bottom-iframe" name="bottom-iframe" style="border: 0px;width: 100%;"></iframe> -->
        <div id="list-wrapper">
            <div id="order-list"></div>
        </div>
    </div>
    <script type="text/javascript" src="/js/page03_radar_month_close.js?<?php echo time();?>
"></script>


</body>
</html>

<script language="javascript">
function fastdata(a){//1今日,2昨日,3本週,4上週,5本月,6上月
  data1=document.getElementById("date1");
  data2=document.getElementById("date2");
  today=Date.today();
  var d1, d2, d3, weekday;
  switch(a){
    // 本日
    case 1:
       todaynum=new Date().toString('yyyy-M-d');
       todayarr=todaynum.split("-");
       d1 = today.add((todayarr[2]*-1+1)).days();
       // d1 = today;
       d2 = Date.parse('today');
      break;
    // 昨日
    case 2:
       d1 = Date.parse('yesterday');
       d2 = Date.parse('yesterday');
      break;
    // 本週
    case 3:
       weekday = (new Date()).getDay();
       if(weekday==0){ weekday = 7; }

       d1 = today.add(((weekday-1)*-1)).days();
       if(weekday==1){ d1 = Date.parse('today'); }
       d1 = d1.toString("yyyy-MM-dd");

       d2 = today.add(6).days();
       d2 = d2.toString("yyyy-MM-dd");
      break;
    // 上週
    case 4:
       weekday = (new Date()).getDay();
       if(weekday==0){ weekday = 7; }

       d1 = today.add(((weekday-1)*-1)+(-7)).days();
       d1 = d1.toString("yyyy-MM-dd");

       d2 = today.add(6).days();
       d2 = d2.toString("yyyy-MM-dd");
      break;
    // 本月
    case 5:
      todaynum=new Date().toString('yyyy-M-d');
      todayarr=todaynum.split("-");
      d1 = today.add((todayarr[2]*-1+1)).days();
      d2 = Date.parse('today');
      break;
    // 上月
    case 6:
      todaynum=new Date().toString('yyyy-M-d');
      todayarr=todaynum.split("-");
      d2 = today.add((todayarr[2]*-1)).days().toString('yyyy-M-d');
      d3arr=d2.split("-");
      var d1 = today.add((d3arr[2]*-1+1)).days();
      break;
    // 本日
    case 7:
      d1 = Date.parse('today');
      d2 = Date.parse('today');
      break;
  }
  data1.value=d1.toString("yyyy-MM-dd");
  data2.value=d2.toString("yyyy-MM-dd");
}


function zzday(){
  var data1=document.getElementById('date1');
  var data2=document.getElementById('date2');
  }

fastdata(1);

</script>
<?php }} ?>