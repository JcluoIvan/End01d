<?php /* Smarty version Smarty-3.1.8, created on 2015-12-24 10:41:11
         compiled from "/home/www//theme/default/page12_order_detail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17083769005664f21f202537-18276323%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fb8d47e0f74733d7ec877a98cd233d03905110c7' => 
    array (
      0 => '/home/www//theme/default/page12_order_detail.tpl',
      1 => 1450090777,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17083769005664f21f202537-18276323',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5664f21f284ea0_40978273',
  'variables' => 
  array (
    'sum' => 0,
    'orderData' => 0,
    'correct_sum' => 0,
    'shoppinggold' => 0,
    'memberData' => 0,
    'getMethods' => 0,
    'address' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5664f21f284ea0_40978273')) {function content_5664f21f284ea0_40978273($_smarty_tpl) {?><div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label>訂貨單明細</label>
    </h3>
    <form id="option-form" acrion="?" class="swapC form-horizontal">
        <input class="form-control" name="info" type="hidden" id="info" value="現金: <?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
 + 運費: <?php echo $_smarty_tpl->tpl_vars['orderData']->value->odm029;?>
 - 使用購物金: <?php echo $_smarty_tpl->tpl_vars['orderData']->value->odm004;?>
 - 退貨金: <?php echo $_smarty_tpl->tpl_vars['orderData']->value->odm032;?>
 = 總金額: <?php echo $_smarty_tpl->tpl_vars['correct_sum']->value;?>
 ，本次新增購物金: <?php echo $_smarty_tpl->tpl_vars['shoppinggold']->value;?>
" />
        <input class="form-control" name="oid" type="hidden" id="oid" value="<?php echo $_smarty_tpl->tpl_vars['orderData']->value->odm001;?>
" />
        <div class="form-group">
            <label class="control-label col-xs-2"> 會員編號 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['memberData']->value->mem002;?>
" />
            </div>

            <label class="control-label col-xs-2"> 訂貨人 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['orderData']->value->odm014;?>
" />
            </div>

            <label class="control-label col-xs-2"> 訂單編號 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['orderData']->value->odm002;?>
" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 聯絡電話 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['orderData']->value->odm015;?>
" />
            </div>
            <label class="control-label col-xs-2"> 取貨方式 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['getMethods']->value;?>
" />
            </div>
            
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 送貨地址 </label>
            <div class="col-xs-6">
                <input readonly type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
" />
            </div>

        </div>

        <div id="member-list-options" class="col-xs-12">
            <div id="member-grid"></div>
        </div>

    </form>
    
    <!-- <button class="btn btn-primary" onclick="history.back();">返回</button> -->
</div>
<?php }} ?>