<?php /* Smarty version Smarty-3.1.8, created on 2015-10-16 13:05:40
         compiled from "/home/www//theme/default/page99_setting.tpl" */ ?>
<?php /*%%SmartyHeaderCode:921077614562085a41c9ed0-81988626%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9ae1824e135a4dcd694022705bd3839f5551f927' => 
    array (
      0 => '/home/www//theme/default/page99_setting.tpl',
      1 => 1440987454,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '921077614562085a41c9ed0-81988626',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_562085a42111a2_68337195',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_562085a42111a2_68337195')) {function content_562085a42111a2_68337195($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $_smarty_tpl->getSubTemplate ('head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <link rel="stylesheet" type="text/css" href="/css/page99.css" />
    </head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">系統設定</li>
        </ol>
        <h3 class="title-bar"> 
            <div id="option-bar" class="pull-right"></div>
            <label>系統設定</label>
        </h3>
        <div id="option-main"></div>
        <div id="setting-list"></div>
    </div>

    <script type="text/javascript" src="/js/page99_setting.js?<?php echo time();?>
"></script>
</body>
</html><?php }} ?>