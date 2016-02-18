<?php /* Smarty version Smarty-3.1.8, created on 2015-10-21 18:09:09
         compiled from "/home/www//theme/default/page04_left_menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6932436325627644531d599-38298285%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '24238c94aadc4ac4eaf5f359ffdba46d727f7d5b' => 
    array (
      0 => '/home/www//theme/default/page04_left_menu.tpl',
      1 => 1440987448,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6932436325627644531d599-38298285',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_56276445360a51_45589279',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56276445360a51_45589279')) {function content_56276445360a51_45589279($_smarty_tpl) {?><ul class="list-group">
    <a 
        class="list-group-item" 
        href="sms.php?sid=<?php echo $_GET['sid'];?>
" 
        target="ifr-right">
        簡訊通知 (SMS)
    </a>
    <a 
        class="list-group-item" 
        href="app.php?sid=<?php echo $_GET['sid'];?>
" 
        target="ifr-right">
        最新消息 <!-- (App 推播) -->
    </a>
</ul><?php }} ?>