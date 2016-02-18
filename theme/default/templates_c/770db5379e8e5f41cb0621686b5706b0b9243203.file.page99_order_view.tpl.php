<?php /* Smarty version Smarty-3.1.8, created on 2015-12-07 12:26:53
         compiled from "/home/www//theme/default/page99_order_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22822665256650a8d047eb0-67234456%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '770db5379e8e5f41cb0621686b5706b0b9243203' => 
    array (
      0 => '/home/www//theme/default/page99_order_view.tpl',
      1 => 1440987454,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22822665256650a8d047eb0-67234456',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'log' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_56650a8d096436_63330380',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56650a8d096436_63330380')) {function content_56650a8d096436_63330380($_smarty_tpl) {?><div class="col-xs-12">
    <input type="hidden" id="log-id" value="<?php echo $_smarty_tpl->tpl_vars['log']->value->lod001;?>
" />
    <input 
        type="hidden" 
        id="sub-title" 
        value="<?php echo $_smarty_tpl->tpl_vars['log']->value->action();?>
<?php echo $_smarty_tpl->tpl_vars['log']->value->type_name();?>
資料" 
        />
    <div id="log-view"></div>
</div>

<?php }} ?>