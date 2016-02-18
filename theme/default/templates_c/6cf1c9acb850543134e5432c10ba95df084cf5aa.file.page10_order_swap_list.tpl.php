<?php /* Smarty version Smarty-3.1.8, created on 2015-12-23 11:05:27
         compiled from "/home/www//theme/default/page10_order_swap_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1426763474565405be7f6ff7-03199624%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6cf1c9acb850543134e5432c10ba95df084cf5aa' => 
    array (
      0 => '/home/www//theme/default/page10_order_swap_list.tpl',
      1 => 1450090773,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1426763474565405be7f6ff7-03199624',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_565405be846255_58618487',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_565405be846255_58618487')) {function content_565405be846255_58618487($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
            <li><a class="active">換貨單</a></li>
        </ol>
        <h3 class="title-bar">
            <!-- <div id="option-bar" class="pull-right"></div> -->
            <label>訂單管理 - 換貨單</label>
        </h3>
        <div style="display:inline-block; width: 100%">
            <div class="pull-left" >
                <form id="command-search" class="form-inline">
                    <label for="exampleInputName2">搜尋</label>
                    <input name="no" id="no" type="text" class="form-control" placeholder="請輸入訂單編號" />
                    <select id="item" name="item" class="form-control">
                        <option value="all">全部</option>
                        <option value="SN">未換貨</option>
                        <option value="SY">已換貨</option>
                        <option value="N">未核帳</option>
                        <option value="Y">已核帳</option>
                        <option value="cannel">已註銷</option>
                    </select>
                    <div class="form-group">
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
                    <!--
                    <button type="button" class="btn btn-primary" onclick="fastdata(7)">本日</button>
                    <button type="button" class="btn btn-primary" onclick="fastdata(2)">昨日</button>
                    <button type="button" class="btn btn-primary" onclick="fastdata(3)">本周</button>
                    <button type="button" class="btn btn-primary" onclick="fastdata(5)">本月</button> 
                    
                    <button type="button" class="btn btn-primary"id="print" name="print">列印</button>
                    -->
                </form>

            </div>
            <div id="option-bar" class="pull-right"></div>
            <!--
            <button type="button" id="checkRadar" class="btn btn-primary pull-right">核帳</button>
            <button type="button" id="cancelRadar" class="btn btn-primary pull-right">註銷</button>
            -->
        </div>
        <div id="option-main" ></div>
        <!-- <iframe id="bottom-iframe" name="bottom-iframe" style="border: 0px;width: 100%;"></iframe> -->
        <div id="list-wrapper">
            <div id="order-list"></div>
        </div>
    </div>
    <script type="text/javascript" src="/js/page10_order_swap_list.js?<?php echo time();?>
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

new Calendar({
      inputField: "date1",
      dateFormat: "%Y-%m-%d",
      trigger: "trigger1",
      bottomBar: true,
      weekNumbers: true,
      onSelect: function() {this.hide();}
    });
new Calendar({
      inputField: "date2",
      dateFormat: "%Y-%m-%d",
      trigger: "trigger2",
      bottomBar: true,
      weekNumbers: true,
      onSelect: function() {this.hide();}
    });

function zzday(){
  var data1=document.getElementById('date1');
  var data2=document.getElementById('date2');
  }

fastdata(1);
</script><?php }} ?>