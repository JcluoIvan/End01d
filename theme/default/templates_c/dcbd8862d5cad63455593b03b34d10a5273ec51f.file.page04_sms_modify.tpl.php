<?php /* Smarty version Smarty-3.1.8, created on 2015-12-10 09:36:47
         compiled from "/home/www//theme/default/page04_sms_modify.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7479661885668d72fa0f7a4-61414367%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dcbd8862d5cad63455593b03b34d10a5273ec51f' => 
    array (
      0 => '/home/www//theme/default/page04_sms_modify.tpl',
      1 => 1441939683,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7479661885668d72fa0f7a4-61414367',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'row' => 0,
    'notice_for' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5668d72fa6a418_59921432',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5668d72fa6a418_59921432')) {function content_5668d72fa6a418_59921432($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/www/libraries/smarty/libs/plugins/function.html_options.php';
?><div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label>發送簡訊通知 (SMS)</label>
    </h3>
    <form id="option-form" action="?" class="form-horizontal">
        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->new001;?>
" />
        <input type="hidden" name="type" value="sms" />
        <input type="hidden" name="users" id="users" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->new006;?>
" />
        <div class="col-xs-6">
            <div class="form-group">
                <label class="control-label col-xs-3"> 通知對象 </label>
                <div class="col-xs-6">
                    <select id="notice-for" name="notice_for" class="form-control">
                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['notice_for']->value,'selected'=>$_smarty_tpl->tpl_vars['row']->value->new005),$_smarty_tpl);?>

                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3 required-field"> 內文 </label>
                <div class="col-xs-8">
                    <textarea class="form-control" name="content" ><?php echo $_smarty_tpl->tpl_vars['row']->value->new004;?>
</textarea>
                </div>
            </div>
        </div>
        <div id="member-list-options" class="col-xs-6 hide">
            <div class="form-group">
                <div class="col-xs-4">
                    <select id="query-type" class="form-control">
                        <option value="phone">手機</option>
                        <option value="name">姓名</option>
                    </select>
                </div>
                <div class="col-xs-6">
                    <input type="text" id="query-text" class="form-control" placeholder="查詢"/>
                </div>
                <button type="button" id="query-button" class="btn btn-default">查詢</button>
            </div>
            <div id="member-grid"></div>
        </div>
    </form>
</div>

<?php }} ?>