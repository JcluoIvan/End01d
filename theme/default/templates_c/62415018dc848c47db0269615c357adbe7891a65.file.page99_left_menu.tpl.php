<?php /* Smarty version Smarty-3.1.8, created on 2015-10-16 13:05:39
         compiled from "/home/www//theme/default/page99_left_menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1944828539562085a3645bd4-63334847%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '62415018dc848c47db0269615c357adbe7891a65' => 
    array (
      0 => '/home/www//theme/default/page99_left_menu.tpl',
      1 => 1440987453,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1944828539562085a3645bd4-63334847',
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
  'unifunc' => 'content_562085a36ab0b9_75470825',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_562085a36ab0b9_75470825')) {function content_562085a36ab0b9_75470825($_smarty_tpl) {?><ul id="left-menu" class="list-group">
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