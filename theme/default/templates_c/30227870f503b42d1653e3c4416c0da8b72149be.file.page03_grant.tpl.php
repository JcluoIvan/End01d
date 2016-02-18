<?php /* Smarty version Smarty-3.1.8, created on 2015-10-16 16:27:54
         compiled from "/home/www//theme/default/page03_grant.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19726575775620b50aebf2a5-91894423%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '30227870f503b42d1653e3c4416c0da8b72149be' => 
    array (
      0 => '/home/www//theme/default/page03_grant.tpl',
      1 => 1442329762,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19726575775620b50aebf2a5-91894423',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5620b50af109f9_63993368',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5620b50af109f9_63993368')) {function content_5620b50af109f9_63993368($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $_smarty_tpl->getSubTemplate ('head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <link rel="stylesheet" type="text/css" href="/css/page03.css" />
    </head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a class="active">獎金、購物金計算</a></li>
        </ol>
        <h3 class="title-bar"> 
            <div id="option-bar" class="pull-right"></div>
            <label>獎金、購物金計算</label>
        </h3>
        <div id="option-main"></div>
        <div id="grant-list"> </div>
    </div>
    <script type="text/javascript" src="/js/page03_grant.js?<?php echo time();?>
"></script>

</body>
</html><?php }} ?>