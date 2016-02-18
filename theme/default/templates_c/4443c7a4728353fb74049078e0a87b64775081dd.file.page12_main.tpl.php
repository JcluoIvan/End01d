<?php /* Smarty version Smarty-3.1.8, created on 2015-11-24 16:39:21
         compiled from "/home/www//theme/default/page12_main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:123747258856542239a518e0-43056191%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4443c7a4728353fb74049078e0a87b64775081dd' => 
    array (
      0 => '/home/www//theme/default/page12_main.tpl',
      1 => 1442485200,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '123747258856542239a518e0-43056191',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_56542239ad3558_32215732',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56542239ad3558_32215732')) {function content_56542239ad3558_32215732($_smarty_tpl) {?>        <ul class="list-group">
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
                href="sales_analysis.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">銷售分析表
            </a>
        </ul><?php }} ?>