<?php /* Smarty version Smarty-3.1.8, created on 2015-10-29 16:46:48
         compiled from "/home/www//theme/default/page02_product_modify.tpl" */ ?>
<?php /*%%SmartyHeaderCode:917086668562074360bcf51-17006855%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '587554d0bf3aedf948c35566ecc37ddcdf890b6d' => 
    array (
      0 => '/home/www//theme/default/page02_product_modify.tpl',
      1 => 1446016688,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '917086668562074360bcf51-17006855',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_56207436223f61_25544820',
  'variables' => 
  array (
    'title' => 0,
    'row' => 0,
    'items' => 0,
    'i' => 0,
    'photo' => 0,
    'img' => 0,
    'sgs' => 0,
    'edm' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56207436223f61_25544820')) {function content_56207436223f61_25544820($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/www/libraries/smarty/libs/plugins/function.html_options.php';
?><div id="product-modify-panel" class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</label>
    </h3>
    <form id="option-form" action="?" method="post" class="form-horizontal" target="iframe-save" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->pdm001;?>
" />
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#home" aria-controls="home" role="tab" data-toggle="tab">產品基本資料</a>
            </li>
            <li role="presentation">
                <a href="#content" aria-controls="content" role="tab" data-toggle="tab">詳細介紹 & 使用方法</a>
            </li>
            <li role="presentation">
                <a href="#images" aria-controls="images" role="tab" data-toggle="tab">產品圖片 & SGS圖片</a>
            </li>
            <li role="presentation">
                <a href="#edm" aria-controls="edm" role="tab" data-toggle="tab">E-DM 圖片</a>
            </li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <div class="col-xs-6">
                    <div class="form-group">
                        <label class="control-label col-xs-2 required-field"> 產品名稱 </label>
                        <div class="col-xs-10">
                            <input type="text" class="form-control" name="name" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->pdm004;?>
"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2"> 類別 </label>
                        <div class="col-xs-4">
                            <select class="form-control" name="type">
                                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['items']->value,'selected'=>$_smarty_tpl->tpl_vars['row']->value->pdm003),$_smarty_tpl);?>

                            </select>
                        </div>
                        <label class="control-label col-xs-2 required-field"> 產品序號 </label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" name="no" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->pdm002;?>
"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2 required-field"> 售價 </label>
                        <div class="col-xs-4">
                            <input type="number" class="form-control" name="price" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->pdm005;?>
"/>
                        </div>
                        <label class="control-label col-xs-2 required-field"> 會員價 </label>
                        <div class="col-xs-4">
                            <input type="number" class="form-control" name="member_price" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->pdm006;?>
"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2"> 排序 </label>
                        <div class="col-xs-4">
                            <input type="number" class="form-control" name="sort" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->pdm014/10;?>
"/>
                        </div>
                        <div class="col-xs-3 checkbox">
                            <label > 
                                <input 
                                    type="checkbox" 
                                    name="selling" 
                                    value="1"
                                    <?php if ($_smarty_tpl->tpl_vars['row']->value->pdm007){?> checked <?php }?>
                                    />
                                是否上架 
                            </label>
                        </div>
                        <div class="col-xs-3 checkbox">
                            <label > 
                                <input 
                                    type="checkbox" 
                                    name="main" 
                                    value="1"
                                    <?php if ($_smarty_tpl->tpl_vars['row']->value->pdm013){?> checked <?php }?>
                                    />
                                主力產品 
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2"> 容量 </label>
                        <div class="col-xs-4">
                            <input type="text" name="capacity" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->pdm010;?>
"/>
                        </div>
                        <div class="col-xs-3 radio">
                            <label>
                                <input type="radio" name="sell_type" value="0" <?php if ($_smarty_tpl->tpl_vars['row']->value->pdm019==0){?> checked <?php }?> />
                                現金商品
                                <span class="glyphicon glyphicon-usd"></span>
                            </label>
                        </div>
                        <div class="col-xs-3 radio">
                            <label>
                                <input type="radio" name="sell_type" value="1" <?php if ($_smarty_tpl->tpl_vars['row']->value->pdm019==1){?> checked <?php }?> />
                                購物金商品
                                <span class="glyphicon glyphicon-asterisk"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2"> 備註 </label>
                        <div class="col-xs-10">
                            <textarea class="form-control" name="remark"><?php echo $_smarty_tpl->tpl_vars['row']->value->pdm018;?>
</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <fieldset>
                        <?php if ($_smarty_tpl->tpl_vars['row']->value->pdm001){?>
                            <legend>
                                Youtube 影片管理
                                <button id="add-video" type="button" class="btn btn-primary pull-right">
                                    新增
                                </button>
                            </legend>
                            <div id="video-list"></div>
                        <?php }else{ ?>
                            <legend>Youtube 影片管理</legend>
                            <div class="alert alert-warning" role="alert">
                                請先儲存商品資料後, 再建立影片清單
                            </div>
                        <?php }?>
                    </fieldset>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="content">
                <div class="form-group">
                    <label class="control-label col-xs-1 col-xs-offset-5"> 簡介 </label>
                    <label class="control-label col-xs-1"> 使用方法 </label>
                </div>
                <div class="form-group">
                    <div class="col-xs-6">
                        <trix-editor input="introduce"></trix-editor>
                        <input type="hidden" id="introduce" name="introduce" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['row']->value->pdm015, ENT_QUOTES, 'UTF-8', true);?>
"/>
                    </div>
                    <div class="col-xs-6">
                        <trix-editor input="how_use"></trix-editor>
                        <input type="hidden" id="how_use" name="how_use" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['row']->value->pdm009, ENT_QUOTES, 'UTF-8', true);?>
"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-1 col-xs-offset-5"> 成份 </label>
                    <label class="control-label col-xs-1"> 推薦對象 </label>
                </div>
                <div class="form-group">
                    <div class="col-xs-6">
                        <trix-editor input="element"></trix-editor>
                        <input type="hidden" id="element" name="element" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['row']->value->pdm016, ENT_QUOTES, 'UTF-8', true);?>
"/>
                    </div>
                    <div class="col-xs-6">
                        <trix-editor input="object"></trix-editor>
                        <input type="hidden" id="object" name="object" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['row']->value->pdm017, ENT_QUOTES, 'UTF-8', true);?>
"/>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane col-xs-10" id="images">
                <!-- 產品圖片 -->
                <fieldset>
                    <legend>
                        產品圖片 
                        <button type="button" class="btn btn-danger remove-image"> 刪除圖片 </button>
                    </legend>
                    <div class="image-list">
                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 2+1 - (0) : 0-(2)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                            <?php $_smarty_tpl->tpl_vars["img"] = new Smarty_variable($_smarty_tpl->tpl_vars['photo']->value[$_smarty_tpl->tpl_vars['i']->value], null, 0);?>
                            <div class="image-item" image-id="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['img']->value->pdo001)===null||$tmp==='' ? 0 : $tmp);?>
">
                                <div class="remove-active-background">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </div>
                                <img src="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['img']->value->url())===null||$tmp==='' ? null : $tmp);?>
" />
                                <input type="file" name="photo[]" class="form-control"/>
                            </div>
                        <?php }} ?>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>SGS 圖片</legend>
                    <div class="image-list">
                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 2+1 - (0) : 0-(2)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                            <?php $_smarty_tpl->tpl_vars["img"] = new Smarty_variable($_smarty_tpl->tpl_vars['sgs']->value[$_smarty_tpl->tpl_vars['i']->value], null, 0);?>
                            <div class="image-item" image-id="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['img']->value->pdo001)===null||$tmp==='' ? 0 : $tmp);?>
">
                                <div class="remove-active-background">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </div>
                                <img src="<?php echo $_smarty_tpl->tpl_vars['img']->value->url();?>
" />
                                <input type="file" name="sgs[]" class="form-control"/>
                            </div>
                        <?php }} ?>
                    </div>
                </fieldset>
            </div>
            <div role="tabpanel" class="tab-pane col-xs-10" id="edm">
                <fieldset>
                    <legend> 
                        E-DM 圖片 
                        <button type="button" class="btn btn-danger remove-image"> 刪除圖片 </button>
                    </legend>
                    <div class="image-list">
                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 0+1 - (0) : 0-(0)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                            <?php $_smarty_tpl->tpl_vars["img"] = new Smarty_variable($_smarty_tpl->tpl_vars['edm']->value[$_smarty_tpl->tpl_vars['i']->value], null, 0);?>
                            <div class="image-item" image-id="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['img']->value->pdo001)===null||$tmp==='' ? 0 : $tmp);?>
">
                                <div class="remove-active-background">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </div>
                                <img src="<?php echo $_smarty_tpl->tpl_vars['img']->value->url();?>
" />
                                <input type="file" name="edm[]" class="form-control"/>
                            </div>
                        <?php }} ?>
                    </div>
                </fieldset>
            </div>
        </div>
        <button class="fade"></button>
    </form>
    <iframe id="iframe-save" name="iframe-save" style='display:none;'></iframe>
</div>

<div class="modal fade" id="video-wrapper">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="?" method="post" class="form-horizontal" target="iframe-save">
                <input type="hidden" class="form-control" name="pid" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->pdm001;?>
"/>
                <input type="hidden" class="form-control" name="video_id" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Youtube 影片</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-xs-2 control-label"> 影片標題 </label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="video_title" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label"> 影片網址 </label>
                        <div class="col-xs-8">
                            <input id="video-url" type="text" class="form-control" />
                            <input type="hidden" class="form-control" name="video_no" />
                        </div>
                    </div>
                    <fieldset>
                        <iframe id="youtube-iframe"></iframe>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary" >存檔</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php }} ?>