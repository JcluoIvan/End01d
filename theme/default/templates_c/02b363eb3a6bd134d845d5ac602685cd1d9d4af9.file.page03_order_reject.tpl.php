<?php /* Smarty version Smarty-3.1.8, created on 2015-12-08 16:50:35
         compiled from "/home/www//theme/default/page03_order_reject.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1462667631566699db5a81a2-12629853%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '02b363eb3a6bd134d845d5ac602685cd1d9d4af9' => 
    array (
      0 => '/home/www//theme/default/page03_order_reject.tpl',
      1 => 1449229410,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1462667631566699db5a81a2-12629853',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'orderData' => 0,
    'member' => 0,
    'acc' => 0,
    'pdata' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_566699db64fea3_62560541',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_566699db64fea3_62560541')) {function content_566699db64fea3_62560541($_smarty_tpl) {?><div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label>新增退貨單</label>
    </h3>
    <form id="option-form" acrion="?" class="reject form-horizontal">
        <input type="hidden" name="oid" value="<?php echo $_smarty_tpl->tpl_vars['orderData']->value->odm001;?>
" />
        <input type="hidden" name="mname" value="<?php echo $_smarty_tpl->tpl_vars['orderData']->value->odm014;?>
" />
        <input type="hidden" name="mid" value="<?php echo $_smarty_tpl->tpl_vars['orderData']->value->odm013;?>
" />
        <input type="hidden" name="lv2" value="<?php echo $_smarty_tpl->tpl_vars['orderData']->value->odm022;?>
" />
        <input type="hidden" name="status" value="0" />
        <div class="form-group">
            <label class="control-label col-xs-2"> 訂貨人名稱 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['orderData']->value->odm014;?>
" />
            </div>

            <label class="control-label col-xs-2"> 會員編號 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['member']->value['no'];?>
" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 訂單編號 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['orderData']->value->odm002;?>
" />
            </div>

            <label class="control-label col-xs-2"> 退貨編號 </label>
            <div class="col-xs-2">
                <input name="rNO" id="rNO" type="text" class="form-control" value="" readonly />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 退款帳號 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['acc']->value;?>
" />
            </div>

            <label class="control-label col-xs-2"> 退貨商品 </label>
            <div class="col-xs-2">
                <select name="pid" id="pid" class="form-control">
                    <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['pdata']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                    <!-- <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['pid'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['pname'];?>
(<?php echo $_smarty_tpl->tpl_vars['row']->value['amount'];?>
)</option> -->
                    <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['pid'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['pname'];?>
</option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 退貨數量 </label>
            <div class="col-xs-2">
                <input name="amount" id="amount" type="number" class="form-control" value="" />
            </div>

            <label class="control-label col-xs-2"> 退貨總金額 </label>
            <div class="col-xs-2">
                <input name="rTmoney" id="rTmoney" type="text" class="form-control" value="" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 退購物金 </label>
            <div class="col-xs-2">
                <input name="rTpoint" id="rTpoint" type="text" class="form-control" value="" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 退貨原因 </label>
            <div class="col-xs-6">
                <textarea class="form-control" name="reason" id="reason" cols="45" rows="5"></textarea>
            </div>
        </div>
    <!-- <button class="btn btn-primary" onclick="history.back();">返回</button> -->
    </form>
</div>
<?php }} ?>