<?php /* Smarty version Smarty-3.1.8, created on 2015-12-22 14:35:06
         compiled from "/home/www//theme/default/page99_setting_modify.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20863821535678ef1a80e9b5-06712765%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f0f80120ab52a2e0a0cde4490c2275345df8d8af' => 
    array (
      0 => '/home/www//theme/default/page99_setting_modify.tpl',
      1 => 1450766075,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20863821535678ef1a80e9b5-06712765',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'setting' => 0,
    'codes' => 0,
    'bank' => 0,
    'emails' => 0,
    'disabled' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5678ef1a8c3067_15394006',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5678ef1a8c3067_15394006')) {function content_5678ef1a8c3067_15394006($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/www/libraries/smarty/libs/plugins/function.html_options.php';
?><div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label> 參數設定 </label>
    </h3>
    <form id="option-form" acrion="?" method="post" target="update-iframe" class="form-horizontal" enctype="multipart/form-data">
        <input type='hidden' name='id' value='<?php echo $_smarty_tpl->tpl_vars['setting']->value->set001;?>
' />
        <?php if ($_smarty_tpl->tpl_vars['setting']->value->set002=='BankAccount'){?>
            <input type="hidden" id="setting-key" value="<?php echo $_smarty_tpl->tpl_vars['setting']->value->set002;?>
" />
            <div class="form-group">
                <label class="control-label col-xs-1">
                    銀行編號
                </label>
                <div class="col-xs-3">
                    <select name="bank_code" class="form-control">
                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['codes']->value,'selected'=>$_smarty_tpl->tpl_vars['bank']->value['code']),$_smarty_tpl);?>

                    </select>
                </div>
                <div class="col-xs-2">
                    <input type="text" id="bank-code-filter" class="form-control" value="" placeholder="查詢銀行"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-1">
                    銀行帳號
                </label>
                <div class="col-xs-3">
                    <input type="text" name="bank_account" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['bank']->value['account'];?>
"/>
                </div>
            </div>
        <?php }elseif($_smarty_tpl->tpl_vars['setting']->value->set002=='EmailNotice'){?>
            <input type="hidden" id="setting-key" value="<?php echo $_smarty_tpl->tpl_vars['setting']->value->set002;?>
" />
            <div class="form-group">
                <label class="control-label col-xs-1"> 寄送對象 </label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" name="emails" value="<?php echo $_smarty_tpl->tpl_vars['emails']->value;?>
"/>
                </div>
                <div class="col-xs-4">
                    請用 ; 多個 email 的分隔符號
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox col-xs-4 col-xs-offset-1">
                    <label>
                        <input type="checkbox" name="disabled" value="1" <?php echo $_smarty_tpl->tpl_vars['disabled']->value;?>
/> 停用此功能 
                    </label>
                </div>
            </div>
        <?php }else{ ?>
            <?php echo $_smarty_tpl->tpl_vars['setting']->value->set002;?>

        <?php }?>
        <button class="fade"></button>
    </form>
    <iframe id="update-iframe" name="update-iframe" class="hide"></iframe>
</div><?php }} ?>