<?php /* Smarty version Smarty-3.1.8, created on 2015-10-16 11:50:58
         compiled from "/home/www//theme/default/page03_main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1780762732562074220c9975-06875323%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '95888543f8961f359b3609fd4d8119781010eb94' => 
    array (
      0 => '/home/www//theme/default/page03_main.tpl',
      1 => 1440987446,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1780762732562074220c9975-06875323',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_562074221075a5_58251501',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_562074221075a5_58251501')) {function content_562074221075a5_58251501($_smarty_tpl) {?>        <ul class="list-group">
            <a 
            	class="list-group-item" 
            	href="command_list.php?sid=<?php echo $_GET['sid'];?>
" 
            	target="ifr-right">訂貨單
            </a>
            <a 
            	class="list-group-item" 
            	href="order_reject_list.php?sid=<?php echo $_GET['sid'];?>
" 
            	target="ifr-right">退貨單
            </a>
            <a 
            	class="list-group-item" 
            	href="order_swap_list.php?sid=<?php echo $_GET['sid'];?>
" 
            	target="ifr-right">換貨單
            </a>
            <a 
                class="list-group-item" 
                href="order_status_list.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">出貨狀態查詢
            </a>
            <a 
                class="list-group-item" 
                href="radar_month_close.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">展示中心月結
            </a>
            <a 
                class="list-group-item" 
                href="sales_analysis.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">銷售分析表
            </a>
            <a 
                class="list-group-item" 
                href="grant.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">獎金、購物金計算
            </a>
        </ul><?php }} ?>