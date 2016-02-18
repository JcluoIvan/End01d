<?php /* Smarty version Smarty-3.1.8, created on 2015-12-08 16:50:32
         compiled from "/home/www//theme/default/page03_reject_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:537263183566699d8c02a09-39851047%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '817cf7c87bbd27d2a4ed3b08afa368bd2a7860a0' => 
    array (
      0 => '/home/www//theme/default/page03_reject_list.tpl',
      1 => 1444269372,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '537263183566699d8c02a09-39851047',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ooid' => 0,
    'oid' => 0,
    'date1' => 0,
    'date2' => 0,
    'datecheck' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_566699d8c7c0e9_77555329',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_566699d8c7c0e9_77555329')) {function content_566699d8c7c0e9_77555329($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="/page/page03/command_list.php?sid=<?php echo $_GET['sid'];?>
">訂貨單</a></li>
            <li class="active">退貨單列表 [ 訂單編號：<?php echo $_smarty_tpl->tpl_vars['ooid']->value;?>
 ] </li>
        </ol>
        <h3 class="title-bar">
            <!-- <div id="option-bar" class="pull-right"></div> -->
            <label>訂單管理 - 退貨單列表</label>
        </h3>
        <div style="display:inline-block; width: 100%">
            <div class="pull-left" >
                <form id="command-search" class="form-inline">
                    <input name="oid" id="oid" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['oid']->value;?>
">
                    <input name="date1" id="date1" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['date1']->value;?>
">
                    <input name="date2" id="date2" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['date2']->value;?>
">
                    <input id="check-date" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['datecheck']->value;?>
">
                    
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
    <script type="text/javascript" src="/js/page03_reject_list.js?<?php echo time();?>
"></script>


</body>
</html><?php }} ?>