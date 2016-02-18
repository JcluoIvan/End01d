<?php /* Smarty version Smarty-3.1.8, created on 2015-10-21 18:09:10
         compiled from "/home/www//theme/default/page04_app.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1943117480562764464cf4e6-49806715%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6d896c1104c1d8d40ba7e7abab42932800493f0b' => 
    array (
      0 => '/home/www//theme/default/page04_app.tpl',
      1 => 1440987448,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1943117480562764464cf4e6-49806715',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5627644650dc00_05454291',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5627644650dc00_05454291')) {function content_5627644650dc00_05454291($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $_smarty_tpl->getSubTemplate ('head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <link rel="stylesheet" type="text/css" href="/css/page04.css" />
    </head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a class="active">最新消息 <!-- (App 推播) --></a></li>
        </ol>
        <h3 class="title-bar"> 
            <div id="option-bar" class="pull-right"></div>
            <label>最新消息 <!-- (App 推播) --></label>
        </h3>
        <div id="option-main" ></div>
        <div id="news-list">
        </div>
    </div>
    <script type="text/javascript" src="/js/page04_app.js?<?php echo time();?>
"></script>
</body>
</html><?php }} ?>