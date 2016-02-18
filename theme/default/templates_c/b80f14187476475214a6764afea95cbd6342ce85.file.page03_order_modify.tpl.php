<?php /* Smarty version Smarty-3.1.8, created on 2015-12-05 09:12:03
         compiled from "/home/www//theme/default/page03_order_modify.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1196259813566132b824e413-03072048%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b80f14187476475214a6764afea95cbd6342ce85' => 
    array (
      0 => '/home/www//theme/default/page03_order_modify.tpl',
      1 => 1449229410,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1196259813566132b824e413-03072048',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_566132b833b009_97179930',
  'variables' => 
  array (
    'orderData' => 0,
    'memberData' => 0,
    'getMethods' => 0,
    'get_No' => 0,
    'getNo' => 0,
    'get_Date' => 0,
    'delivery' => 0,
    'receivable' => 0,
    'signoff' => 0,
    'sum' => 0,
    'correct_sum' => 0,
    'shoppinggold' => 0,
    'address' => 0,
    'photo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_566132b833b009_97179930')) {function content_566132b833b009_97179930($_smarty_tpl) {?><div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label>修改訂貨單 [<?php echo $_smarty_tpl->tpl_vars['orderData']->value->odm002;?>
] </label>
    </h3>
    <form id="option-form" method="post" class="modify form-horizontal" target="iframe-save" enctype="multipart/form-data">
        <input name="sn" type="hidden" id="sn" value="<?php echo $_smarty_tpl->tpl_vars['orderData']->value->odm001;?>
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
            <label class="control-label col-xs-2"> <?php echo $_smarty_tpl->tpl_vars['get_No']->value;?>
 </label>
            <div class="col-xs-2">
                <input type="text" name="getno" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['getNo']->value;?>
" />
            </div>

            <label class="control-label col-xs-2 "> <?php echo $_smarty_tpl->tpl_vars['get_Date']->value;?>
 </label>
            <div class="col-xs-3">
                <div class="input-group">
                    <input class="form-control" name="delivery" type="text" id="delivery" onpropertychange="zzday();" value="<?php echo $_smarty_tpl->tpl_vars['delivery']->value;?>
" />
                    <a id="delivery.onclick" class="input-group-addon" class="btn bt-default" href="#">
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                    </a>
                    <a id="delivery.clear" class="input-group-addon btn bt-default clear-date" clear-target="input#delivery" href="#">
                        <span class="glyphicon glyphicon-remove" title="移除" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2" > 收款日期 </label>
            <div class="col-xs-3">
                <div class="input-group">
                    <input class="form-control" name="receivable" type="text" id="receivable" onpropertychange="zzday();" value="<?php echo $_smarty_tpl->tpl_vars['receivable']->value;?>
" />
                    <a id="receivable.onclick" class="input-group-addon" class="btn bt-default" href="#">
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                    </a>
                    <a id="receivable.clear" class="input-group-addon btn bt-default clear-date" href="#" clear-target="input#receivable">
                        <span class="glyphicon glyphicon-remove" title="移除" aria-hidden="true"></span>
                    </a>
                </div>
            </div>

            <label class="control-label col-xs-1" col-xs-offset-1> 核帳日期 </label>
            <div class="col-xs-3">
                <div class="input-group">
                    <input class="form-control" name="signoff" type="text" id="signoff" onpropertychange="zzday();" value="<?php echo $_smarty_tpl->tpl_vars['signoff']->value;?>
" />
                    <a id="signoff.onclick" class="input-group-addon btn bt-default" href="#">
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                    </a>
                    <a id="signoff.clear" class="input-group-addon btn bt-default clear-date" href="#" clear-target="input#signoff">
                        <span class="glyphicon glyphicon-remove" title="移除" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
            <input class="form-control" name="info" type="hidden" id="info" value="現金: <?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
 + 運費: <?php echo $_smarty_tpl->tpl_vars['orderData']->value->odm029;?>
 - 使用購物金: <?php echo $_smarty_tpl->tpl_vars['orderData']->value->odm004;?>
 - 退貨金: <?php echo $_smarty_tpl->tpl_vars['orderData']->value->odm032;?>
 = 總金額: <?php echo $_smarty_tpl->tpl_vars['correct_sum']->value;?>
 ，本次新增購物金: <?php echo $_smarty_tpl->tpl_vars['shoppinggold']->value;?>
" />
            <input class="form-control" name="oid" type="hidden" id="oid" value="<?php echo $_smarty_tpl->tpl_vars['orderData']->value->odm001;?>
" />
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 送貨地址 </label>
            <div class="col-xs-8">
                <input readonly type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
" />
            </div>
        </div>

        <!-- 產品圖片 -->
        <div class="form-group">
            <label class="control-label col-xs-2"> 電子發票 </label>
            <div class="col-xs-2">
                <div class="input-group">
                    <?php if ($_smarty_tpl->tpl_vars['photo']->value->rec001){?> 
                        <a id="receipt-wrapper" class="form-control" href="<?php echo $_smarty_tpl->tpl_vars['photo']->value->getImageUrl();?>
" target="_blank"> 
                            發票 
                            <img id="receipt-image" src="<?php echo $_smarty_tpl->tpl_vars['photo']->value->getMinImageUrl();?>
" />
                        </a>
                        <a id="remove-receipt-image" class="input-group-addon" href="#" rid="<?php echo $_smarty_tpl->tpl_vars['photo']->value->rec001;?>
">
                            <span class="glyphicon glyphicon-remove" title="移除" aria-hidden="true"></span>
                        </a>
                    <?php }else{ ?>
                        <label class="form-control"> 未上傳發票 </label>
                    <?php }?>
                </div>
            </div>
            <div class="col-xs-3">
                <input type="file" name="files[receipt][]" class="form-control"/>
            </div>
        </div>

        <div id="member-list-options" class="col-xs-12">
            <div id="member-grid"></div>
        </div>
    <!-- <button class="btn btn-primary" onclick="history.back();">返回</button> -->
    
    </form>
    <iframe id="iframe-save" name="iframe-save" style='display:none;'></iframe>
</div>

<?php }} ?>