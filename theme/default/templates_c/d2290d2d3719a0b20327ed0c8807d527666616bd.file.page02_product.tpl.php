<?php /* Smarty version Smarty-3.1.8, created on 2015-10-16 11:51:02
         compiled from "/home/www//theme/default/page02_product.tpl" */ ?>
<?php /*%%SmartyHeaderCode:131347385156207426db7da7-18092979%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd2290d2d3719a0b20327ed0c8807d527666616bd' => 
    array (
      0 => '/home/www//theme/default/page02_product.tpl',
      1 => 1442892800,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '131347385156207426db7da7-18092979',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'types' => 0,
    'sell_types' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_56207426e0a709_86832231',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56207426e0a709_86832231')) {function content_56207426e0a709_86832231($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/www/libraries/smarty/libs/plugins/function.html_options.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $_smarty_tpl->getSubTemplate ('head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <link rel="stylesheet" type="text/css" href="/css/page02.css?<?php echo time();?>
" />
    </head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a class="active">產品管理</a></li>
        </ol>
        <h3 class="title-bar"> 
            <label>產品管理</label>
        </h3>
        <form id="search-form" class="form-inline">
            <div class="form-group">
                <label> 產品分類 </label>
                <select class="form-control" name="product-type">
                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['types']->value),$_smarty_tpl);?>

                </select>
            </div>
            <div class="form-group">
                <label> 販售方式 </label>
                <select class="form-control" name="sell-type">
                    <option value="all">所有類型</option>
                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['sell_types']->value),$_smarty_tpl);?>

                </select>
            </div>
            <div class="form-group">
                <label> 上架狀態 </label>
                <select class="form-control" name="selling">
                    <option value="all">全部</option>
                    <option value="1">上架中</option>
                    <option value="0">已下架</option>
                </select>
            </div>
            <div class="form-group">
                <label> 主力產品 </label>
                <select class="form-control" name="main">
                    <option value="all">全部</option>
                    <option value="1">主力</option>
                    <option value="0">非主力</option>
                </select>
            </div>
            <div id="option-bar" class="pull-right"></div>
        </form>
        <div id="option-main"></div>
        <div id="product-list">
        </div>
    </div>
    <script type="text/javascript" src="/js/page02_product.js?<?php echo time();?>
"></script>
</body>
</html><?php }} ?>