<?php /* Smarty version Smarty-3.1.8, created on 2015-10-16 16:28:09
         compiled from "/home/www//theme/default/page11_main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10497572065620b519adb1c0-56875685%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4eab159ca2fef3ed02a2b3cb7d29175681030061' => 
    array (
      0 => '/home/www//theme/default/page11_main.tpl',
      1 => 1442369632,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10497572065620b519adb1c0-56875685',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5620b519b42651_51844843',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5620b519b42651_51844843')) {function content_5620b519b42651_51844843($_smarty_tpl) {?>        <ul class="list-group">
            <a 
                class="list-group-item" 
                href="organize.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">組織管理
            </a>
            <a 
                class="list-group-item" 
                href="leader.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">組織管理 - 非組織線
            </a>
        </ul><?php }} ?>