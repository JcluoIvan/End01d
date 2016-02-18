<?php /* Smarty version Smarty-3.1.8, created on 2015-10-16 11:51:00
         compiled from "/home/www//theme/default/page02_inventory.tpl" */ ?>
<?php /*%%SmartyHeaderCode:60399907356207424ef6b36-99456062%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c2e605900dde881da419c99fe6768d634d7914e' => 
    array (
      0 => '/home/www//theme/default/page02_inventory.tpl',
      1 => 1440987445,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '60399907356207424ef6b36-99456062',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'l_agent' => 0,
    'r_agent' => 0,
    'def_agent' => 0,
    'types' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5620742502a6e9_20022360',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5620742502a6e9_20022360')) {function content_5620742502a6e9_20022360($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/www/libraries/smarty/libs/plugins/function.html_options.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ('head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

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
                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['l_agent']->value),$_smarty_tpl);?>

                </select>
            </div>
            <div class="form-group">
                <label class="label-control">展示中心</label>
                <select id="r-agent" name="rid" class="form-control">
                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['r_agent']->value,'selected'=>$_smarty_tpl->tpl_vars['def_agent']->value->age001),$_smarty_tpl);?>

                </select>
            </div>
            <div class="form-group">
                <label class="label-control">產品分類</label>
                <select class="form-control" id="product-type" name="product-type">
                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['types']->value),$_smarty_tpl);?>

                </select>
            </div>
            <!-- <div id="option-bar" class="pull-right"></div> -->
        </form>
        <!-- <div id="option-main"> </div> -->
        <div id="inventory-list"> </div>
    </div>
    <script type="text/javascript" src="/js/page02_inventory.js?<?php echo time();?>
"></script>
</body>
</html><?php }} ?>