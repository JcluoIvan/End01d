<?php /* Smarty version Smarty-3.1.8, created on 2015-11-04 13:16:06
         compiled from "/home/www//theme/default/page02_company_purchase.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1054293087563994966f6ab0-55438638%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'baf8def0e3fb811d83a3148f41783659f31bc772' => 
    array (
      0 => '/home/www//theme/default/page02_company_purchase.tpl',
      1 => 1440987445,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1054293087563994966f6ab0-55438638',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'types' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_563994967416f8_50435529',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_563994967416f8_50435529')) {function content_563994967416f8_50435529($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/www/libraries/smarty/libs/plugins/function.html_options.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ('head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">公司進貨記錄表</li>
        </ol>
        <h3 class="title-bar">
            <label>公司進貨記錄表</label>
        </h3>
        <form id="form-search" method="post" class="form-inline">
            <div class="form-group">
                <label class="label-control">產品分類</label>
                <select class="form-control" id="product-item" name="item">
                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['types']->value),$_smarty_tpl);?>

                </select>
            </div>
            <input type="hidden" name="rid" value="0" />
            <div id="option-bar" class="pull-right"></div>
        </form>
        <div id="option-main"> </div>
        <div id="purchase-list"> </div>
        <script type="text/javascript" src="/js/page02_company_purchase.js?<?php echo time();?>
"></script>
    </div>
</body>
</html><?php }} ?>