<?php /* Smarty version Smarty-3.1.8, created on 2015-12-23 09:51:08
         compiled from "/home/www//theme/default/page02_return_modify.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17383163225678ae7bb560c7-12351223%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '43764faa3aae039827fe92f3a651084b4d3e5ac3' => 
    array (
      0 => '/home/www//theme/default/page02_return_modify.tpl',
      1 => 1450751296,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17383163225678ae7bb560c7-12351223',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5678ae7bc15b75_74391921',
  'variables' => 
  array (
    'title' => 0,
    'purchase' => 0,
    'agent' => 0,
    'items' => 0,
    'products' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5678ae7bc15b75_74391921')) {function content_5678ae7bc15b75_74391921($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/www/libraries/smarty/libs/plugins/function.html_options.php';
?><div class="col-xs-12">
  
    <h3 class="sub-title-bar"> 
        <label><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</label>
    </h3>
    <form id="option-form" method="post" class="form-horizontal type-return">
        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['purchase']->value->pdp001;?>
" />
        <input type="hidden" name="aid" value="<?php echo $_smarty_tpl->tpl_vars['agent']->value->age001;?>
" />
        <div class="form-group">
            <div class="col-xs-4">
                <div class="form-group">
                    <label class="control-label col-xs-4"> 展示中心 </label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['agent']->value->age006;?>
" readonly/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-4"> 退貨單號 </label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['purchase']->value->pdp002)===null||$tmp==='' ? '尚未建立' : $tmp);?>
" readonly />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-4"> 郵寄編號 </label>
                    <div class="col-xs-8">
                        <input type="text" name="parcel_number" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['purchase']->value->pdp007;?>
" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-4"> 到貨日期 </label>
                    <div class="col-xs-8">
                        <div class="input-group">
                            <input id="purchase-date" type="text" name="date" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['purchase']->value->pdp004->format('Y-m-d');?>
" />
                            <a id="purchase-date-active" class="input-group-addon" class="btn btn-default" href="#">
                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                            </a>
                        </div>
                        <!-- <input type="text" id="purchase_date" name="date" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['purchase']->value->pdp004->format('Y-m-d');?>
" readonly /> -->
                    </div>
                </div>
                <?php if ($_smarty_tpl->tpl_vars['purchase']->value->pdp001){?>
                    <fieldset>
                        <legend> 建立退貨清單 </legend>
                        <div class="form-group">
                            <label class="control-label col-xs-4"> 產品類別 </label>
                            <div class="col-xs-8">
                                <select id="product-item" class="form-control">
                                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['items']->value),$_smarty_tpl);?>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-4"> 產品名稱 </label>
                            <div class="col-xs-8">
                                <select id="product-name" name="product_id" class="form-control">
                                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['products']->value),$_smarty_tpl);?>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-4"> 退貨數量 </label>
                            <div class="col-xs-5">
                                <input type="number" id="count" class="form-control" value="10" />
                            </div>
                            <div class="col-xs-3">
                                <button type="button" id="add-purchase" class="btn btn-primary pull-right">新增</button>
                            </div>
                        </div>
                    </fieldset>
                <?php }else{ ?>
                    <div class="alert alert-warning" role="alert">
                        請點選下方按鈕，完成退貨單記錄建立，方可建立退貨清單。
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6 col-xs-offset-3">
                            <button type="button" id="save-purchase" class="btn btn-primary btn-block">
                                建立退貨記錄
                            </button>
                        </div>

                    </div>
                <?php }?>
            </div>
            <div class="col-xs-8">
                <div id="purchase-list"> </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <label class="col-xs-1 control-label">備註</label>
                <div class="col-xs-10">
                    <input type="text" class="form-control" name="remark" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['purchase']->value->pdp009, ENT_QUOTES, 'UTF-8', true);?>
"/>
                </div>
            </div>
        </div>


        <button class="fade" type="submit"></button>
    </form>
</div>
<?php }} ?>