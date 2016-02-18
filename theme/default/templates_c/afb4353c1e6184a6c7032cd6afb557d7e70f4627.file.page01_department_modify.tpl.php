<?php /* Smarty version Smarty-3.1.8, created on 2015-11-06 09:27:04
         compiled from "/home/www//theme/default/page01_department_modify.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1567017838563c01e8410771-04525835%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'afb4353c1e6184a6c7032cd6afb557d7e70f4627' => 
    array (
      0 => '/home/www//theme/default/page01_department_modify.tpl',
      1 => 1440987444,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1567017838563c01e8410771-04525835',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'id' => 0,
    'types' => 0,
    'row' => 0,
    'modifyreadonly' => 0,
    'modifyhidden' => 0,
    'city' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_563c01e84a5a80_42114608',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_563c01e84a5a80_42114608')) {function content_563c01e84a5a80_42114608($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/www/libraries/smarty/libs/plugins/function.html_options.php';
?><div class="col-xs-12">
    <h3 class="title-bar"> 
        <label> <?php echo $_smarty_tpl->tpl_vars['title']->value;?>
 </label>
    </h3>

    <form id="option-form" acrion="?" class="form-horizontal">
        <input type='hidden' name='id' value='<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
' />

        <div class="form-group">
            <label class="control-label col-xs-1"> 權限 </label>
            <div class="col-xs-2">
                <select class="form-control" name="utp">
                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['types']->value,'selected'=>$_smarty_tpl->tpl_vars['row']->value['age002']),$_smarty_tpl);?>

                </select>
            </div>

            <label class="control-label col-xs-1"> 帳號 </label>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="account" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['age004'];?>
" <?php echo $_smarty_tpl->tpl_vars['modifyreadonly']->value;?>
 />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-1"> 密碼 </label>
            <div class="col-xs-2">
                <input type="password" class="form-control" name="password" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['age005'];?>
" />
            </div>

            <label class="control-label col-xs-1"> 確認密碼 </label>
            <div class="col-xs-2">
                <input type="password" class="form-control" name="password2" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['age005'];?>
" />
            </div>
        </div>

        <div class="form-group" style="<?php echo $_smarty_tpl->tpl_vars['modifyhidden']->value;?>
">
            <label class="control-label col-xs-1"> 姓名 </label>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="name" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['age006'];?>
" />
            </div>

            <label class="control-label col-xs-1"> 手機 </label>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="phone" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['age012'];?>
" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-1"> email </label>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="email" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['age013'];?>
"/>
            </div>
        </div>
        <button class="fade"></button>
    </form>
</div>

        <!-- <div class="form-group">
            <label class="control-label col-xs-1"> 生日 </label>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="born" value="1991-01-01" />
            </div>
        </div> -->
        <!-- <div class="form-group">
            <label class="control-label col-xs-1"> 地址 </label>
            <div class="col-xs-2">
                <select class="form-control" name="city">
                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['city']->value,'selected'=>$_smarty_tpl->tpl_vars['row']->value['age009']),$_smarty_tpl);?>

                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-1">  </label>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="address" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['age010'];?>
" />
            </div>
        </div> -->




<?php }} ?>