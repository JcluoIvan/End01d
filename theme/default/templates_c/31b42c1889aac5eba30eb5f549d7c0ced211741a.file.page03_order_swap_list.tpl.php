<?php /* Smarty version Smarty-3.1.8, created on 2015-10-16 13:07:38
         compiled from "/home/www//theme/default/page03_order_swap_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20060495295620861b004087-04023238%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '31b42c1889aac5eba30eb5f549d7c0ced211741a' => 
    array (
      0 => '/home/www//theme/default/page03_order_swap_list.tpl',
      1 => 1443590588,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20060495295620861b004087-04023238',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'date1' => 0,
    'date2' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5620861b0644f4_28559484',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5620861b0644f4_28559484')) {function content_5620861b0644f4_28559484($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <link rel="stylesheet" type="text/css" href="/css/page03.css" />

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
                    <select id="itemdate" name="itemdate" class="form-control">
                        <option value="build">建立日期</option>
                        <option value="swap">換貨日期</option>
                        <option value="check">核帳日期</option>
                        <option value="cannel">註銷日期</option>
                    </select>
                    <div class="form-group">
                        <div class="input-group">
                            <input readonly name="date1" type="text" id="date1" onpropertychange="zzday();" value="<?php echo $_smarty_tpl->tpl_vars['date1']->value;?>
" class="form-control" />
                            <a id="trigger1" class="input-group-addon btn bt-default" href="#">
                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                            </a>
                        </div>
                        至
                        <div class="input-group">
                            <input readonly name="date2" type="text" id="date2" onpropertychange="zzday();" value="<?php echo $_smarty_tpl->tpl_vars['date2']->value;?>
" class="form-control" />
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
                    -->
                    <button type="button" class="btn btn-primary"id="print" name="print">列印</button>
                    
                </form>

            </div>
            <div id="option-bar" class="pull-right"></div>
            <button type="button" id="checkRadar" class="btn btn-primary pull-right">核帳</button>
            <button type="button" id="cancelRadar" class="btn btn-primary pull-right">註銷</button>
        </div>
        <div id="option-main" ></div>
        <!-- <iframe id="bottom-iframe" name="bottom-iframe" style="border: 0px;width: 100%;"></iframe> -->
        <div id="list-wrapper">
            <div id="order-list"></div>
        </div>
    </div>
    <script type="text/javascript" src="/js/page03_order_swap_list.js?<?php echo time();?>
"></script>


</body>
</html>

<?php }} ?>