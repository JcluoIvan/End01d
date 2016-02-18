<?php /* Smarty version Smarty-3.1.8, created on 2015-11-23 11:11:53
         compiled from "/home/www//theme/default/page01_friends.tpl" */ ?>
<?php /*%%SmartyHeaderCode:235241354565283f9ec4975-45454312%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0746848ea8673b6e526ff58032d953e8524db034' => 
    array (
      0 => '/home/www//theme/default/page01_friends.tpl',
      1 => 1442246151,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '235241354565283f9ec4975-45454312',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_565283f9f350e5_66084018',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_565283f9f350e5_66084018')) {function content_565283f9f350e5_66084018($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        <?php echo $_smarty_tpl->getSubTemplate ('head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <link rel="stylesheet" type="text/css" href="/css/page01_friends.css?<?php echo time();?>
" />
    </head>
<body>
    <input type='hidden' id='id' value='<?php echo $_smarty_tpl->tpl_vars['row']->value->mem001;?>
' />
    <input type='hidden' id='no' value='<?php echo $_smarty_tpl->tpl_vars['row']->value->mem002;?>
' />
    <input type='hidden' id='name' value='<?php echo $_smarty_tpl->tpl_vars['row']->value->mem005;?>
' />
    <input type='hidden' id='phone' value='<?php echo $_smarty_tpl->tpl_vars['row']->value->mem011;?>
' />
    <input type='hidden' id='point' value='<?php echo $_smarty_tpl->tpl_vars['row']->value->mem021;?>
' />
    <div id="friends-panel" >
        <div id="friends-wrapper">
            <div id="my-wrapper" class="user-wrapper">
                <img src="" />
            </div>
        </div>
    </div>
</body>
<script type='text/javascript' src='/js/page01_friends.js?<?php echo time();?>
'></script>
</html><?php }} ?>