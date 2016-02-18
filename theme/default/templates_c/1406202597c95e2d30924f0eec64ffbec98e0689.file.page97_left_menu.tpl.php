<?php /* Smarty version Smarty-3.1.8, created on 2015-10-16 13:05:38
         compiled from "/home/www//theme/default/page97_left_menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1574528962562085a20dbc97-04626576%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1406202597c95e2d30924f0eec64ffbec98e0689' => 
    array (
      0 => '/home/www//theme/default/page97_left_menu.tpl',
      1 => 1444269378,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1574528962562085a20dbc97-04626576',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'menus' => 0,
    'name' => 0,
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_562085a213dda9_69803470',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_562085a213dda9_69803470')) {function content_562085a213dda9_69803470($_smarty_tpl) {?><ul id="left-menu" class="list-group">
    <?php  $_smarty_tpl->tpl_vars['title'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['title']->_loop = false;
 $_smarty_tpl->tpl_vars['name'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['menus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['title']->key => $_smarty_tpl->tpl_vars['title']->value){
$_smarty_tpl->tpl_vars['title']->_loop = true;
 $_smarty_tpl->tpl_vars['name']->value = $_smarty_tpl->tpl_vars['title']->key;
?>
        <a
            class="list-group-item"
            href="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
.php?sid=<?php echo $_GET['sid'];?>
"
            target="ifr-right">
            <?php echo $_smarty_tpl->tpl_vars['title']->value;?>

        </a>
    <?php } ?>
</ul><?php }} ?>