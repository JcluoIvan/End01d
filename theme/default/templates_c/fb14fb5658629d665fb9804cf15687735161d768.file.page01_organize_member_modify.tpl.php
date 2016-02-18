<?php /* Smarty version Smarty-3.1.8, created on 2015-11-05 18:09:39
         compiled from "/home/www//theme/default/page01_organize_member_modify.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1368928801563b2ae3dfafa9-18655543%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fb14fb5658629d665fb9804cf15687735161d768' => 
    array (
      0 => '/home/www//theme/default/page01_organize_member_modify.tpl',
      1 => 1440987445,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1368928801563b2ae3dfafa9-18655543',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'pid' => 0,
    'id' => 0,
    'member' => 0,
    'bank' => 0,
    'post' => 0,
    'row' => 0,
    'country' => 0,
    'city' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_563b2ae3f18e26_31259435',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_563b2ae3f18e26_31259435')) {function content_563b2ae3f18e26_31259435($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/www/libraries/smarty/libs/plugins/function.html_options.php';
?><div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label> <?php echo $_smarty_tpl->tpl_vars['title']->value;?>
 </label>
    </h3>

    <form id="option-form" acrion="?" class="form-horizontal">
        <input type='hidden' name='pid' value='<?php echo $_smarty_tpl->tpl_vars['pid']->value;?>
' />
        <input type='hidden' name='id' value='<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
' />

        <div class="form-group">
            <label class="control-label col-xs-1 required-field">姓名</label>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="name" value="<?php echo $_smarty_tpl->tpl_vars['member']->value['mem005'];?>
" />
            </div>

            <label class="control-label col-xs-1 required-field">手機</label>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="phone" value="<?php echo $_smarty_tpl->tpl_vars['member']->value['mem011'];?>
" />
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-xs-1 required-field"> 密碼 </label>
            <div class="col-xs-2">
                <input type="password" class="form-control" name="password" value="<?php echo $_smarty_tpl->tpl_vars['member']->value['mem004'];?>
" />
            </div>

            <label class="control-label col-xs-1 required-field"> 確認密碼 </label>
            <div class="col-xs-2">
                <input type="password" class="form-control" name="password2" value="<?php echo $_smarty_tpl->tpl_vars['member']->value['mem004'];?>
" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-1">生日</label>
            <div class="col-xs-2">
                <div class="input-group">
                    <input type="text" name='born' id="date" class='form-control pointer' value="<?php echo $_smarty_tpl->tpl_vars['member']->value['mem007'];?>
" />
                    <a id="date.onclick" class="input-group-addon btn bt-default" href="#">
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                    </a>
                </div>
            </div>

            <label class="control-label col-xs-1"> email </label>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="email" value="<?php echo $_smarty_tpl->tpl_vars['member']->value['mem012'];?>
" />
            </div>
        </div>
        <!-- <div class="form-group">
            <label class="control-label col-xs-1"> 銀行代號 </label>
            <div class="col-xs-2">
                <select class='form-control' name='bank_code' id="bank_code">
                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['bank']->value,'selected'=>$_smarty_tpl->tpl_vars['member']->value['mem027']),$_smarty_tpl);?>

                </select>
            </div>

            <label class="control-label col-xs-1">銀行帳號</label>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="bank_account" value="<?php echo $_smarty_tpl->tpl_vars['member']->value['mem010'];?>
" />
            </div>
        </div> -->

        <div class="form-group">
            <label class="control-label col-xs-1"> 地址 </label>
            <div class="col-xs-2">
                <select class="form-control" id="country">
                    <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['post']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['row']->value['id']==$_smarty_tpl->tpl_vars['country']->value){?> selected <?php }?>>
                            <?php echo $_smarty_tpl->tpl_vars['row']->value['name'];?>

                        </option>
                    <?php } ?>
                </select>
            </div>
            <div id='is_city'><?php echo $_smarty_tpl->tpl_vars['city']->value;?>
</div>
            <div class="col-xs-2">
                <select class="form-control" name="city" id="city">
                    <?php  $_smarty_tpl->tpl_vars['country'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['country']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['post']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['country']->key => $_smarty_tpl->tpl_vars['country']->value){
$_smarty_tpl->tpl_vars['country']->_loop = true;
?>
                        <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['country']->value['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                            <option class="pid-<?php echo $_smarty_tpl->tpl_vars['row']->value['pid'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['row']->value['id']==$_smarty_tpl->tpl_vars['city']->value){?> id='city-<?php echo $_smarty_tpl->tpl_vars['city']->value;?>
' <?php }?>>
                                <?php echo $_smarty_tpl->tpl_vars['row']->value['name'];?>

                            </option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-4 col-xs-offset-1">
                <input type="text" class="form-control" name="address" value="<?php echo $_smarty_tpl->tpl_vars['member']->value['mem009'];?>
" />
            </div>
        </div>
        <button class="fade"></button>
    </form>
</div>

<?php }} ?>