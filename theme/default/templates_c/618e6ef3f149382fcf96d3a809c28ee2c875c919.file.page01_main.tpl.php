<?php /* Smarty version Smarty-3.1.8, created on 2015-10-20 18:01:40
         compiled from "/home/www//theme/default/page01_main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:197417341856261104e36a17-73792999%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '618e6ef3f149382fcf96d3a809c28ee2c875c919' => 
    array (
      0 => '/home/www//theme/default/page01_main.tpl',
      1 => 1440987444,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '197417341856261104e36a17-73792999',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_56261104e9d4a7_77587949',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56261104e9d4a7_77587949')) {function content_56261104e9d4a7_77587949($_smarty_tpl) {?>        <ul class="list-group">
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
            
            <a 
                class="list-group-item" 
                href="department.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">部門管理
            </a>
            
            <a 
            	class="list-group-item" 
            	href="blacklist.php?sid=<?php echo $_GET['sid'];?>
" 
            	target="ifr-right">黑名單
            </a>
            <!-- <a 
            	class="list-group-item" 
            	href="organize.php?sid=<?php echo $_GET['sid'];?>
" 
            	target="ifr-right">除會管理
            </a> -->
        </ul><?php }} ?>