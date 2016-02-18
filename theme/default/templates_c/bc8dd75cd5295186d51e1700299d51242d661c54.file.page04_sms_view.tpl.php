<?php /* Smarty version Smarty-3.1.8, created on 2015-10-29 15:52:15
         compiled from "/home/www//theme/default/page04_sms_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1970988585631d02f16dc34-94432439%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bc8dd75cd5295186d51e1700299d51242d661c54' => 
    array (
      0 => '/home/www//theme/default/page04_sms_view.tpl',
      1 => 1440987448,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1970988585631d02f16dc34-94432439',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5631d02f1acdf5_72079558',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5631d02f1acdf5_72079558')) {function content_5631d02f1acdf5_72079558($_smarty_tpl) {?><div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label>檢視簡訊通知 (SMS)</label>
    </h3>
    <div class="form-horizontal">
        <div class="col-xs-6">
            <div class="form-group">
                <label class="control-label col-xs-3"> 通知對象 </label>
                <div class="col-xs-6">
                    <span class="form-control"><?php echo $_smarty_tpl->tpl_vars['row']->value->noticeFor();?>
</span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3"> 內文 </label>
                <div class="col-xs-8">
                    <pre><?php echo $_smarty_tpl->tpl_vars['row']->value->new004;?>
</pre>
                </div>
            </div>
        </div>
    </div>
</div>

<?php }} ?>