<?php /* Smarty version Smarty-3.1.8, created on 2015-11-24 14:15:52
         compiled from "/home/www//theme/default/page06_give_point.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1048751518562085ff8910c8-13081614%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1861d076dec8588f889f282d4885b7add24030ee' => 
    array (
      0 => '/home/www//theme/default/page06_give_point.tpl',
      1 => 1448345748,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1048751518562085ff8910c8-13081614',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_562085ff8e3d73_27082448',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_562085ff8e3d73_27082448')) {function content_562085ff8e3d73_27082448($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">購物金 - 發放管理</li>
        </ol>
        <h3 class="title-bar"> 
            <label> 發放管理 </label>
        </h3>
        <form class="form-inline" id="form-search">
            <label class="control-label"> 入帳日期 </label>
            <div class="input-group">
                <input type="text" name='date1' id="date1" class='form-control pointer' readonly />
                <a id="trigger1" class="input-group-addon btn bt-default" href="#">
                    <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                </a>
            </div>
            至
            <div class="input-group">
                <input type="text" name='date2' id="date2" class='form-control pointer' readonly />
                <a id="trigger2" class="input-group-addon btn bt-default" href="#">
                    <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                </a>
            </div>
            <label class="control-label"> 搜尋 </label>
            <div class="form-group">
                <select class='form-control' name='searchKind' id='searchKind'>
                    <option value='mem_phone'>會員手機</option>
                    <option value='mem_no'>會員編號</option>
                    <option value='mem_name'>會員名稱</option>
                    <option value='age_phone'>展示中心手機</option>
                    <option value='age_no'>展示中心編號</option>
                    <option value='age_name'>展示中心名稱</option>
                </select>
            </div>
            <input type='text' name='search' id='search' class='form-control'>
            <button class='btn btn-default' id='search-btn'>查詢</button>
            <button class='btn btn-primary' type="button" href='#' id='print'>列印</button>
            <div id='option-bar' class='pull-right'></div>
        </form>

        <div id="option-main" ></div>
        <div id="give-point-list"></div>

    </div>
    <script type="text/javascript" src="/js/page06_give_point.js?<?php echo time();?>
"></script>
    <script>
        fastdata(5);
        function fastdata(a){   //1今日,2昨日,3本週,4上週,5本月,6上月
            data1 = document.getElementById("date1");
            data2 = document.getElementById("date2");
            today = Date.today();
            var d1, d2, d3, weekday;
            switch(a){
                case 1:
                    d1 = today;
                    d2 = today;
                    break;
                case 2:
                    d1 = Date.parse('yesterday');
                    d2 = Date.parse('yesterday');
                    break;
                case 3:
                    weekday = (new Date()).getDay();
                    if(weekday==0){ weekday = 7; }

                    d1 = today.add(((weekday-1)*-1)).days();
                    if(weekday==1){ d1 = Date.parse('today'); }
                    d1 = d1.toString("yyyy-MM-dd");

                    d2 = today.add(6).days();
                    d2 = d2.toString("yyyy-MM-dd");
                    break;
                case 4:
                    weekday = (new Date()).getDay();
                    if(weekday==0){ weekday = 7; }

                    d1 = today.add(((weekday-1)*-1)+(-7)).days();
                    d1 = d1.toString("yyyy-MM-dd");

                    d2 = today.add(6).days();
                    d2 = d2.toString("yyyy-MM-dd");
                    break;
                case 5:
                    todaynum=new Date().toString('yyyy-M-d');
                    todayarr=todaynum.split("-");
                    d1 = today.add((todayarr[2]*-1+1)).days();
                    d2 = Date.parse('today');
                    break;
                case 6:
                    todaynum=new Date().toString('yyyy-M-d');
                    todayarr=todaynum.split("-");
                    d2 = today.add((todayarr[2]*-1)).days().toString('yyyy-M-d');
                    d3arr=d2.split("-");
                    var d1 = today.add((d3arr[2]*-1+1)).days();
                    break;
                }
            data1.value = d1.toString("yyyy-MM-dd");
            data2.value = d2.toString("yyyy-MM-dd");
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
    </script>
</body>
</html><?php }} ?>