<?php /* Smarty version Smarty-3.1.8, created on 2015-10-16 13:07:11
         compiled from "/home/www//theme/default/page06_main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:593625375562085ff2b3b03-69501496%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '814a04f824c3b2eb7372db1d8aaab1ed029314b1' => 
    array (
      0 => '/home/www//theme/default/page06_main.tpl',
      1 => 1440987449,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '593625375562085ff2b3b03-69501496',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_562085ff2fecd6_18873004',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_562085ff2fecd6_18873004')) {function content_562085ff2fecd6_18873004($_smarty_tpl) {?>        <ul class="list-group">
            <!-- <a 
                class="list-group-item" 
                href="point.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">購物金統計表
            </a> -->
            
            <a 
                class="list-group-item" 
                href="give_point.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">購物金發放統計表
            </a>
        </ul><?php }} ?>