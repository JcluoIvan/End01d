<?php /* Smarty version Smarty-3.1.8, created on 2015-10-16 13:07:13
         compiled from "/home/www//theme/default/page07_main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:55270498056208601980ff1-85280918%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '16c5e6fd7b601a819e3a797607a3c069c0097eae' => 
    array (
      0 => '/home/www//theme/default/page07_main.tpl',
      1 => 1440987449,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '55270498056208601980ff1-85280918',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_562086019e2290_41275112',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_562086019e2290_41275112')) {function content_562086019e2290_41275112($_smarty_tpl) {?>        <ul class="list-group">
            <a 
                class="list-group-item" 
                href="radar_bonus.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">獎金統計(展示中心)
            </a>
            
            <a 
                class="list-group-item" 
                href="radar_give_bonus.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">獎金發放(展示中心)
            </a>

            <a 
                class="list-group-item" 
                href="leader_bonus.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">獎金統計(專業經理人)
            </a>
            
            <a 
                class="list-group-item" 
                href="leader_give_bonus.php?sid=<?php echo $_GET['sid'];?>
" 
                target="ifr-right">獎金發放(專業經理人)
            </a>
        </ul><?php }} ?>