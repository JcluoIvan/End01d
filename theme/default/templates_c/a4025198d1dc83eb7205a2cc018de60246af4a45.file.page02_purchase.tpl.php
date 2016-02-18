<?php /* Smarty version Smarty-3.1.8, created on 2015-12-22 09:59:10
         compiled from "/home/www//theme/default/page02_purchase.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13273289525639949436de00-16126187%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a4025198d1dc83eb7205a2cc018de60246af4a45' => 
    array (
      0 => '/home/www//theme/default/page02_purchase.tpl',
      1 => 1450749498,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13273289525639949436de00-16126187',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_56399494402de4_54120436',
  'variables' => 
  array (
    'l_agent' => 0,
    'r_agent' => 0,
    'types' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56399494402de4_54120436')) {function content_56399494402de4_54120436($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/www/libraries/smarty/libs/plugins/function.html_options.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ('head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">進貨記錄表</li>
        </ol>
        <h3 class="title-bar">
            <label>進貨記錄表</label>
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
                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['r_agent']->value),$_smarty_tpl);?>

                </select>
            </div>
            <div class="form-group">
                <label class="label-control">產品分類</label>
                <select class="form-control" id="product-item" name="item">
                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['types']->value),$_smarty_tpl);?>

                </select>
            </div>
            
            <div id="option-bar" class="pull-right">
                <button id="return-button" type="button" class="btn btn-default type-return">新增退貨</button>
            </div>
        </form>
        <div id="option-main"> </div>
        <div id="purchase-list"> </div>
        <script type="text/javascript" src="/js/page02_purchase_modify.js?<?php echo time();?>
"></script>
        <script type="text/javascript" src="/js/page02_return_modify.js?<?php echo time();?>
"></script>
        <script type="text/javascript" src="/js/page02_purchase.js?<?php echo time();?>
"></script>
    </div>
</body>
</html><?php }} ?>