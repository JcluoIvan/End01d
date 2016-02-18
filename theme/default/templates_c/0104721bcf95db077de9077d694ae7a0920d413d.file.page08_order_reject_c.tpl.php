<?php /* Smarty version Smarty-3.1.8, created on 2015-12-09 16:30:27
         compiled from "/home/www//theme/default/page08_order_reject_c.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9683193835667e6a36c7d80-23947488%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0104721bcf95db077de9077d694ae7a0920d413d' => 
    array (
      0 => '/home/www//theme/default/page08_order_reject_c.tpl',
      1 => 1449229410,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9683193835667e6a36c7d80-23947488',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'reject' => 0,
    'orderData' => 0,
    'mno' => 0,
    'oorder' => 0,
    'acc' => 0,
    'pname' => 0,
    'dRecord' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5667e6a37c59b8_14278078',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5667e6a37c59b8_14278078')) {function content_5667e6a37c59b8_14278078($_smarty_tpl) {?><div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label>修改退貨單</label>
    </h3>
    <form id="option-form" acrion="?" class="rejectC form-horizontal">
        <input type="hidden" name="sn" value="<?php echo $_smarty_tpl->tpl_vars['reject']->value['sn'];?>
" />
        <input type="hidden" name="oid" value="<?php echo $_smarty_tpl->tpl_vars['reject']->value['oid'];?>
" />
        <input type="hidden" name="mname" value="<?php echo $_smarty_tpl->tpl_vars['orderData']->value->odm014;?>
" />
        <input type="hidden" name="mid" value="<?php echo $_smarty_tpl->tpl_vars['reject']->value['mid'];?>
" />
        <input type="hidden" name="lv2" value="<?php echo $_smarty_tpl->tpl_vars['reject']->value['aid'];?>
" />
        <input type="hidden" name="money" value="<?php echo $_smarty_tpl->tpl_vars['reject']->value['money'];?>
" />
        <input type="hidden" name="address" value="<?php echo $_smarty_tpl->tpl_vars['reject']->value['address'];?>
" />
        <input type="hidden" name="keyman" value="<?php echo $_smarty_tpl->tpl_vars['reject']->value['keyman'];?>
" />
        <input type="hidden" name="pid" value="<?php echo $_smarty_tpl->tpl_vars['reject']->value['pid'];?>
" />
        <div class="form-group">
            <label class="control-label col-xs-2"> 訂貨人名稱 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['orderData']->value->odm014;?>
" />
            </div>

            <label class="control-label col-xs-2"> 會員編號 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['mno']->value;?>
" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 訂單編號 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['oorder']->value['oid'];?>
" />
            </div>

            <label class="control-label col-xs-2"> 退貨單編號 </label>
            <div class="col-xs-2">
                <input type="text" name="rNO" id="rNO" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['reject']->value['rNO'];?>
" readonly />
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
                <input readonly type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['pname']->value;?>
" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 退貨數量 </label>
            <div class="col-xs-2">
                <input readonly name="amount" id="amount" type="number" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['reject']->value['amount'];?>
" />
            </div>

            <label class="control-label col-xs-2"> 退貨總金額 </label>
            <div class="col-xs-2">
                <input readonly type="text" name="rTmoney" id="rTmoney" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['reject']->value['rTmoney'];?>
" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 退購物金 </label>
            <div class="col-xs-2">
                <input readonly name="rTpoint" id="rTpoint" type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['reject']->value['rTpoint'];?>
" />
            </div>

            <label class="control-label col-xs-2"> 建立日期 </label>
            <div class="col-xs-2">
                <div class="input-group">
                    <input readonly class="form-control" name="signoff" type="text" id="signoff" onpropertychange="zzday();" value="<?php echo $_smarty_tpl->tpl_vars['dRecord']->value;?>
" />
                    <!--
                    <a id="signoff.onclick" class="input-group-addon btn bt-default" href="#">
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                    </a>
                    -->
                    <!-- 
                    <a id="signoff.clear" class="input-group-addon btn bt-default clear-date" href="#" clear-target="input#signoff">
                        <span class="glyphicon glyphicon-remove" title="移除" aria-hidden="true"></span>
                    </a>
                     -->
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 退貨日期 </label>
            <div class="col-xs-2">
            
                <?php if ($_smarty_tpl->tpl_vars['reject']->value['status']>0){?>
                    <input class="form-control" type="text" value="<?php echo $_smarty_tpl->tpl_vars['reject']->value['rejectdate'];?>
" readonly />
                <?php }else{ ?>
                    <div class="input-group">
                        <input class="form-control" name="rejectdate" type="text" id="rejectdate" onpropertychange="zzday();" value="<?php echo $_smarty_tpl->tpl_vars['reject']->value['rejectdate'];?>
" />
                        <a id="rejectdate.onclick" class="input-group-addon btn bt-default" href="#">
                            <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                        </a>
                    </div>
                <?php }?>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 退貨原因 </label>
            <div class="col-xs-6">
                <textarea readonly class="form-control" name="reason" id="reason" cols="45" rows="5"><?php echo $_smarty_tpl->tpl_vars['reject']->value['reason'];?>
</textarea>
            </div>
        </div>
        
    <!-- <button class="btn btn-primary" onclick="history.back();">返回</button> -->
    </form>
</div>
<?php }} ?>