<?php /* Smarty version Smarty-3.1.8, created on 2015-12-16 17:57:53
         compiled from "/home/www//theme/default/page02_item_modify.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1378527303567135a1157b05-34341858%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b8a135d3075ffdefd914845aacfaebe2f054afb2' => 
    array (
      0 => '/home/www//theme/default/page02_item_modify.tpl',
      1 => 1440987445,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1378527303567135a1157b05-34341858',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_567135a11a0e68_19535983',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567135a11a0e68_19535983')) {function content_567135a11a0e68_19535983($_smarty_tpl) {?><div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</label>
    </h3>
    <form id="option-form" action="?" method="post" class="form-horizontal" >
        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->pdi001;?>
" />
        <div class="form-group">
            <label class="control-label col-xs-2 required-field"> 類別名稱 </label>
            <div class="col-xs-3">
                <input type="text" class="form-control" name="name" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->pdi002;?>
"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-2"> 排序 </label>
            <div class="col-xs-3">
                <input type="text" class="form-control" name="sort" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->pdi003/10;?>
"/>
            </div>
        </div>
        <button class="fade"></button>
    </form>
</div>
<?php }} ?>