<?php /* Smarty version Smarty-3.1.8, created on 2015-10-16 11:51:01
         compiled from "/home/www//theme/default/page03_command_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:208658090556207425568fe5-78446919%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '02a205d2d0c37e5e0c859212b696d202ac660937' => 
    array (
      0 => '/home/www//theme/default/page03_command_list.tpl',
      1 => 1444269372,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '208658090556207425568fe5-78446919',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sdate' => 0,
    'edate' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_562074255d3074_89464544',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_562074255d3074_89464544')) {function content_562074255d3074_89464544($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <link rel="stylesheet" type="text/css" href="/css/page03.css" />

</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a class="active">訂貨單</a></li>
        </ol>
        <h3 class="title-bar">
            <!-- <div id="option-bar" class="pull-right"></div> -->
            <label>訂單管理 - 訂貨單</label>
        </h3>
        <div style="display:inline-block; width: 100%">
            <div class="pull-left" >
                <form id="command-search" class="form-inline">
                    <label for="exampleInputName2">搜尋</label>
                    <input name="no" id="no" type="text" class="form-control" placeholder="請輸入訂單編號或手機號碼" />
                    <label for="exampleInputName2">交易日期</label>
                    <div class="form-group">
                        <div class="input-group">
                            <input readonly name="date1" type="text" id="date1" onpropertychange="zzday();" style='width:140px;' class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['sdate']->value;?>
" />
                            <a id="trigger1" class="input-group-addon btn bt-default" href="#">
                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                            </a>
                        </div>
                        至
                        <div class="input-group">
                            <input readonly name="date2" type="text" id="date2" onpropertychange="zzday();" style='width:140px;' class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['edate']->value;?>
" />
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
        </div>
        <div id="option-main" ></div>
        <!-- <iframe id="bottom-iframe" name="bottom-iframe" style="border: 0px;width: 100%;"></iframe> -->
        <div id="order-list">
        </div>
    </div>

    <div id="demo-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" class="form-horizontal">
                    <input type="hidden" id="orderID" name="orderID"/>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">輸入郵寄日期與序號</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-xs-2"> 郵寄日期 </label>
                            <div class="col-xs-5">
                                <div class="input-group">
                                    <input class="form-control" name="date3" type="text" id="date3" onpropertychange="zzday();">
                                    <a id="date3.onclick" class="input-group-addon" href="#">
                                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                    </a>
                                    <a id="date3.clear" class="input-group-addon btn bt-default clear-date" clear-target="input#date3" href="#">
                                        <span class="glyphicon glyphicon-remove" title="移除" aria-hidden="true"></span>
                                    </a> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-2"> 郵寄序號 </label>
                            <div class="col-xs-5">
                                <input class="form-control" type="text" id="sendNo" name="sendNo" value="" />
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary">存檔</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script type="text/javascript" src="/js/page03_main.js?<?php echo time();?>
"></script>


</body>
</html>
<?php }} ?>