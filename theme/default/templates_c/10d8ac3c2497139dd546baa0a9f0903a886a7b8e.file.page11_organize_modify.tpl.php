<?php /* Smarty version Smarty-3.1.8, created on 2015-12-02 14:35:59
         compiled from "/home/www//theme/default/page11_organize_modify.tpl" */ ?>
<?php /*%%SmartyHeaderCode:57868634565e914fd22d22-00012749%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '10d8ac3c2497139dd546baa0a9f0903a886a7b8e' => 
    array (
      0 => '/home/www//theme/default/page11_organize_modify.tpl',
      1 => 1446774997,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '57868634565e914fd22d22-00012749',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'pid' => 0,
    'agent' => 0,
    'modify_readonly' => 0,
    'bank' => 0,
    'country' => 0,
    'city' => 0,
    'store' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_565e914fe40753_09616810',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_565e914fe40753_09616810')) {function content_565e914fe40753_09616810($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/www/libraries/smarty/libs/plugins/function.html_options.php';
?><div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label> <?php echo $_smarty_tpl->tpl_vars['title']->value;?>
 </label>
    </h3>

    <form id="option-form" acrion="?" method="post" class="form-horizontal" target="iframe-save" enctype="multipart/form-data">
        <input type='hidden' name='pid' value='<?php echo $_smarty_tpl->tpl_vars['pid']->value;?>
' />
        <input type='hidden' name='id' value='<?php echo $_smarty_tpl->tpl_vars['agent']->value->age001;?>
' />
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#base" aria-controls="base" role="tab" data-toggle="tab">基本資料</a>
            </li>
            <?php if ($_smarty_tpl->tpl_vars['pid']->value>0){?>
                <li role="presentation">
                    <a href="#store" aria-controls="store" role="tab" data-toggle="tab">門市基本資料</a>
                </li>
                <li role="presentation">
                    <a href="#summary" aria-controls="summary" role="tab" data-toggle="tab">門市簡介</a>
                </li>
                <li role="presentation">
                    <a href="#spending" aria-controls="spending" role="tab" data-toggle="tab">消費</a>
                </li>
                <li role="presentation">
                    <a href="#cursor" aria-controls="cursor" role="tab" data-toggle="tab">課程</a>
                </li>
            <?php }?>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="base">
                <div class="col-xs-6">
                    <div class="form-group">
                        <label class="control-label col-xs-2 required-field"> 帳號 </label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" name="account" value="<?php echo $_smarty_tpl->tpl_vars['agent']->value->age004;?>
" <?php echo $_smarty_tpl->tpl_vars['modify_readonly']->value;?>
 />
                        </div>
                        <label class="control-label col-xs-2 required-field">姓名</label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" name="name" value="<?php echo $_smarty_tpl->tpl_vars['agent']->value->age006;?>
" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-2 required-field"> 密碼 </label>
                        <div class="col-xs-4">
                            <input type="password" class="form-control" name="password" value="<?php echo $_smarty_tpl->tpl_vars['agent']->value->age005;?>
" />
                        </div>

                        <label class="control-label col-xs-2"> 確認密碼 </label>
                        <div class="col-xs-4">
                            <input type="password" class="form-control" name="password2" value="<?php echo $_smarty_tpl->tpl_vars['agent']->value->age005;?>
" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-2 required-field">手機</label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" name="phone" value="<?php echo $_smarty_tpl->tpl_vars['agent']->value->age012;?>
" />
                        </div>

                        <label class="control-label col-xs-2">生日</label>
                        <div class="col-xs-4">
                            <div class="input-group">
                                <input type="text" name='born' id="date" class='form-control pointer' value="<?php echo $_smarty_tpl->tpl_vars['agent']->value->dateFormat('age008');?>
" />
                                <a id="date.onclick" class="input-group-addon btn bt-default" href="#">
                                    <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-xs-2"> 銀行代號 </label>
                        <div class="col-xs-4">
                            <select class='form-control' name='bank_code' id="bank_code">
                                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['bank']->value,'selected'=>$_smarty_tpl->tpl_vars['agent']->value->age011),$_smarty_tpl);?>

                            </select>
                        </div>

                        <label class="control-label col-xs-2">銀行帳號</label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" name="bank_account" value="<?php echo $_smarty_tpl->tpl_vars['agent']->value->age021;?>
" />
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <input type='hidden' id='country_def' value='<?php echo $_smarty_tpl->tpl_vars['country']->value;?>
'>
                    <input type='hidden' id='city_def' value='<?php echo $_smarty_tpl->tpl_vars['city']->value;?>
'>
                    <div class="form-group">
                        <label class="control-label col-xs-2"> 地址 </label>
                        <div class="col-xs-4">
                            <select class="form-control" name="country" id="country"></select>
                        </div>
                        <div class="col-xs-4">
                            <select class="form-control" name='city' id="city"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-8 col-xs-offset-2">
                            <input type="text" class="form-control" name="address" value="<?php echo $_smarty_tpl->tpl_vars['agent']->value->age010;?>
" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2"> email </label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="email" value="<?php echo $_smarty_tpl->tpl_vars['agent']->value->age013;?>
" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">回饋%</label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" name="rebate"  value="<?php echo $_smarty_tpl->tpl_vars['agent']->value->age017;?>
" />
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="store">
                <div class="col-xs-6">
                    <div class="form-group">
                        <label class="control-label col-xs-2">門市名稱</label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" name="shopname" value="<?php echo $_smarty_tpl->tpl_vars['agent']->value->age014;?>
" />
                        </div>
                        <label class="control-label col-xs-2">門市電話</label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" name="tel" value="<?php echo $_smarty_tpl->tpl_vars['agent']->value->age023;?>
" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">圖片</label>
                        <div class="col-xs-8">
                            <input type="file" class="form-control" name="store_img" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-8 col-xs-offset-1">
                            <?php if ($_smarty_tpl->tpl_vars['store']->value->imageUrl()){?>
                                <img class="store-image" src="<?php echo $_smarty_tpl->tpl_vars['store']->value->imageUrl();?>
" />
                            <?php }?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label class="control-label col-xs-2">位置查詢</label>
                        <div class="col-xs-6">
                            <input type="hidden" name="store_map" value="<?php echo $_smarty_tpl->tpl_vars['store']->value->sto003;?>
"/>
                            <div class="input-group">
                                <input type="text" class="form-control" id="store-map" placeholder="查詢地址、地名或店名" />
                                <a id="query-address" class="input-group-addon btn btn-default">
                                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <button type="button" id="copy-address" class="btn btn-default">與地址相同</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div id="map-panel"/>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="summary">
                <div class="col-xs-10">
                    <trix-editor input="store_summary"></trix-editor>
                    <input type="hidden" id="store_summary" name="store_summary" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['store']->value->sto004, ENT_QUOTES, 'UTF-8', true);?>
"/>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="spending">
                <div class="col-xs-10">
                    <trix-editor input="store_spending"></trix-editor>
                    <input type="hidden" id="store_spending" name="store_spending" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['store']->value->sto005, ENT_QUOTES, 'UTF-8', true);?>
"/>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="cursor">
                <div class="col-xs-10">
                    <trix-editor input="store_cursor"></trix-editor>
                    <input type="hidden" id="store_cursor" name="store_cursor" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['store']->value->sto006, ENT_QUOTES, 'UTF-8', true);?>
"/>
                </div>
            </div>
        </div>
        
        <button class="fade"></button>
    </form>
    <iframe id="iframe-save" name="iframe-save" style='display:none;'></iframe>
</div><?php }} ?>