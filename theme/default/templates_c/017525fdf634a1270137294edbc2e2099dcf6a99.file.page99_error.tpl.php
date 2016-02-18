<?php /* Smarty version Smarty-3.1.8, created on 2015-12-23 09:52:38
         compiled from "/home/www//theme/default/page99_error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10584857135679fe66f2f361-22355663%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '017525fdf634a1270137294edbc2e2099dcf6a99' => 
    array (
      0 => '/home/www//theme/default/page99_error.tpl',
      1 => 1440987453,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10584857135679fe66f2f361-22355663',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5679fe67031474_86111723',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5679fe67031474_86111723')) {function content_5679fe67031474_86111723($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $_smarty_tpl->getSubTemplate ('head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <!-- <link rel="stylesheet" type="text/css" href="/css/page99.css" /> -->
    </head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">系統錯誤記錄</li>
        </ol>
        <h3 class="title-bar"> 
            <div id="option-bar" class="pull-right"></div>
            <label>系統錯誤記錄</label>
        </h3>
        <div id="option-main" ></div>
        <div id="log-list">
        </div>
    </div>

    <script type="text/javascript" src="/js/page99_error.js?<?php echo time();?>
"></script>
</body>
</html><?php }} ?>