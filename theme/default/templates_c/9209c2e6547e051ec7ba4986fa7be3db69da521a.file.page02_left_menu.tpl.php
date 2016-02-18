<?php /* Smarty version Smarty-3.1.8, created on 2015-12-22 09:59:05
         compiled from "/home/www//theme/default/page02_left_menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1657915722562074249e5025-83340305%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9209c2e6547e051ec7ba4986fa7be3db69da521a' => 
    array (
      0 => '/home/www//theme/default/page02_left_menu.tpl',
      1 => 1450749498,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1657915722562074249e5025-83340305',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_56207424a41431_45200317',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56207424a41431_45200317')) {function content_56207424a41431_45200317($_smarty_tpl) {?><ul class="list-group">
    <a 
        class="list-group-item" 
        href="inventory.php?sid=<?php echo $_GET['sid'];?>
" 
        target="ifr-right">
        展示中心庫存查詢
    </a>
    <a 
        class="list-group-item" 
        href="purchase.php?sid=<?php echo $_GET['sid'];?>
" 
        target="ifr-right">
        展示中心進/退貨記錄表
    </a>
    <a 
        class="list-group-item" 
        href="company_inventory.php?sid=<?php echo $_GET['sid'];?>
" 
        target="ifr-right">
        公司庫存查詢
    </a>
    <a 
        class="list-group-item" 
        href="company_purchase.php?sid=<?php echo $_GET['sid'];?>
" 
        target="ifr-right">
        公司進貨記錄表
    </a>
    <a 
        class="list-group-item" 
        href="product.php?sid=<?php echo $_GET['sid'];?>
" 
        target="ifr-right">
        產品管理
    </a>
    <a 
        class="list-group-item" 
        href="item.php?sid=<?php echo $_GET['sid'];?>
" 
        target="ifr-right">
        產品類別管理
    </a>
</ul><?php }} ?>