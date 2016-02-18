<?php /* Smarty version Smarty-3.1.8, created on 2015-11-02 09:49:15
         compiled from "/home/www//theme/default/page05_main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16428473705636c11ba05350-91610611%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1684a2818a7cfa9fb190ea79d4c3ce85dee67395' => 
    array (
      0 => '/home/www//theme/default/page05_main.tpl',
      1 => 1440987448,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16428473705636c11ba05350-91610611',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5636c11ba60ab5_68490885',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5636c11ba60ab5_68490885')) {function content_5636c11ba60ab5_68490885($_smarty_tpl) {?>        <ul class="list-group">
            <a 
                class="list-group-item" 
                href="report_day.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">日報表
            </a>
            <a 
                class="list-group-item" 
                href="report_month.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">月報表
            </a>
            <a 
                class="list-group-item" 
                href="report_buy.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">購買紀錄
            </a>
        </ul><?php }} ?>