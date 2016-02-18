<?php /* Smarty version Smarty-3.1.8, created on 2015-10-28 10:50:27
         compiled from "/home/www//theme/default/page02_company_inventory.tpl" */ ?>
<?php /*%%SmartyHeaderCode:73550138563037f357c0d0-94812280%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2be0c72d806db39b467b59f776f878e5297b1a5e' => 
    array (
      0 => '/home/www//theme/default/page02_company_inventory.tpl',
      1 => 1440987445,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '73550138563037f357c0d0-94812280',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'types' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_563037f35dbed2_80384888',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_563037f35dbed2_80384888')) {function content_563037f35dbed2_80384888($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/www/libraries/smarty/libs/plugins/function.html_options.php';
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
                <label class="label-control">產品分類</label>
                <select class="form-control" id="product-type" name="product-type">
                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['types']->value),$_smarty_tpl);?>

                </select>
            </div>
            <!-- <div id="option-bar" class="pull-right"></div> -->
        </form>
        <!-- <div id="option-main"> </div> -->
        <div id="product-list"> </div>
    </div>
    <script type="text/javascript" src="/js/page02_company_inventory.js?<?php echo time();?>
"></script>
</body>
</html><?php }} ?>