<?php /* Smarty version Smarty-3.1.8, created on 2015-10-21 18:09:09
         compiled from "/home/www//theme/default/page04_sms.tpl" */ ?>
<?php /*%%SmartyHeaderCode:576215885562764458b8de2-39354534%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4f8487d828a747c91ce1ea9c65c08a262dccb129' => 
    array (
      0 => '/home/www//theme/default/page04_sms.tpl',
      1 => 1440987448,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '576215885562764458b8de2-39354534',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_562764458f8882_82075080',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_562764458f8882_82075080')) {function content_562764458f8882_82075080($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $_smarty_tpl->getSubTemplate ('head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <link rel="stylesheet" type="text/css" href="/css/page04.css" />
    </head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a class="active">簡訊通知 (SMS)</a></li>
        </ol>
        <h3 class="title-bar"> 
            <div id="option-bar" class="pull-right"></div>
            <label>簡訊通知 (SMS)</label>
        </h3>
        <div id="option-main" ></div>
        <div id="news-list">
        </div>
    </div>
    <script type="text/javascript" src="/js/page04_sms.js?<?php echo time();?>
"></script>
</body>
</html><?php }} ?>