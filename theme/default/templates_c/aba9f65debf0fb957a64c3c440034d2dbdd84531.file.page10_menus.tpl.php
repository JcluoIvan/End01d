<?php /* Smarty version Smarty-3.1.8, created on 2015-11-24 14:35:55
         compiled from "/home/www//theme/default/page10_menus.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18135746865654054b6eb041-25262514%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aba9f65debf0fb957a64c3c440034d2dbdd84531' => 
    array (
      0 => '/home/www//theme/default/page10_menus.tpl',
      1 => 1440987452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18135746865654054b6eb041-25262514',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5654054b759024_91142225',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5654054b759024_91142225')) {function content_5654054b759024_91142225($_smarty_tpl) {?>        <div class="list-group">
            <a 
                class="list-group-item" 
                href="\page\page10\leader.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">組織、會員查詢
            </a>

            <a 
                class="list-group-item" 
                href="\page\page10\ordersearch.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">訂單狀態查詢
            </a>

            <a 
                class="list-group-item" 
                href="\page\page10\order_reject_list.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">退貨單查詢
            </a>

            <a 
                class="list-group-item" 
                href="\page\page10\order_swap_list.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">換貨單查詢
            </a>
            <!-- 
            <a 
                class="list-group-item" 
                href="\page\page10\radar_month_close.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">展示中心月結查詢
            </a> -->
        </div><?php }} ?>