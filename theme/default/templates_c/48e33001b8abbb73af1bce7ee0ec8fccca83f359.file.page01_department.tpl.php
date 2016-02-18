<?php /* Smarty version Smarty-3.1.8, created on 2015-11-06 09:26:13
         compiled from "/home/www//theme/default/page01_department.tpl" */ ?>
<?php /*%%SmartyHeaderCode:948697266563c01b5b3db94-98302271%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '48e33001b8abbb73af1bce7ee0ec8fccca83f359' => 
    array (
      0 => '/home/www//theme/default/page01_department.tpl',
      1 => 1440987444,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '948697266563c01b5b3db94-98302271',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_563c01b5b87611_42388257',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_563c01b5b87611_42388257')) {function content_563c01b5b87611_42388257($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $_smarty_tpl->getSubTemplate ('head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li>部門管理</li>
        </ol>
        <h3 class="title-bar"> 
            <div id="option-bar" class="pull-right"></div>
            <label>部門管理</label>
        </h3>
        <div id="option-main" ></div>
        <div id="department-list">
        </div>
    </div>
    <script type="text/javascript" src="/js/page01_department.js?<?php echo time();?>
"></script>
</body>
</html><?php }} ?>