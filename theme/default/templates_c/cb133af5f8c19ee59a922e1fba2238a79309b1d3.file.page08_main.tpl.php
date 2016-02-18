<?php /* Smarty version Smarty-3.1.8, created on 2015-11-26 14:29:40
         compiled from "/home/www//theme/default/page08_main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19789714505656a6d44bfb68-52537509%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cb133af5f8c19ee59a922e1fba2238a79309b1d3' => 
    array (
      0 => '/home/www//theme/default/page08_main.tpl',
      1 => 1443590593,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19789714505656a6d44bfb68-52537509',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5656a6d4586e91_19572190',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5656a6d4586e91_19572190')) {function content_5656a6d4586e91_19572190($_smarty_tpl) {?>        <div class="list-group">
            <a 
                class="list-group-item" 
                href="command_list.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">業務獎金查詢
            </a>
            <a 
                class="list-group-item" 
                href="stock_search.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">商品庫存
            </a>   
            <a class="list-group-item disabled"> > 產品操作 </a>
            <a 
                class="list-group-item" 
                href="verification_search.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">取貨操作
            </a>
            <a 
                class="list-group-item" 
                href="verification_reject_search.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">退貨操作
            </a>
            <a 
                class="list-group-item" 
                href="verification_swap_search.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">換貨操作
            </a>
            <a class="list-group-item disabled"> > 訂單記錄 </a>
            <a 
                class="list-group-item" 
                href="getorder_search.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">訂貨記錄
            </a>
            <a 
                class="list-group-item" 
                href="order_search.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">取貨記錄
            </a>
            <a 
                class="list-group-item" 
                href="order_reject_list.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">退貨記錄
            </a>
            <a 
                class="list-group-item" 
                href="order_swap_list.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">換貨記錄
            </a>
            <!-- <a 
                class="list-group-item" 
                href="sales_analysis.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">銷售分析表
            </a> -->
        </div><?php }} ?>