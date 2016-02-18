<?php /* Smarty version Smarty-3.1.8, created on 2015-10-29 13:36:24
         compiled from "/home/www//theme/default/page04_app_modify.tpl" */ ?>
<?php /*%%SmartyHeaderCode:888731855562764483254a8-76085786%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '82e4f609583853c2a8acbe6a9a70577ba4f7887d' => 
    array (
      0 => '/home/www//theme/default/page04_app_modify.tpl',
      1 => 1446096777,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '888731855562764483254a8-76085786',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_562764483a8d61_56622122',
  'variables' => 
  array (
    'row' => 0,
    'notice_for' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_562764483a8d61_56622122')) {function content_562764483a8d61_56622122($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/www/libraries/smarty/libs/plugins/function.html_options.php';
?><div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label>新增通知</label>
    </h3>
    <form id="option-form" action="?" method="post" target="iframe-save" class="form-horizontal" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->new001;?>
" />
        <input type="hidden" name="type" value="app" />
        <input type="hidden" name="users" id="users" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->new006;?>
" />
            <!--             
                <div class="form-group">
                    <label class="control-label col-xs-2"> 通知對象 </label>
                    <div class="col-xs-6">
                        <select id="notice-for" name="notice_for" class="form-control">
                            <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['notice_for']->value,'selected'=>$_smarty_tpl->tpl_vars['row']->value->new005),$_smarty_tpl);?>

                        </select>
                    </div>
                </div> 
            -->
        <div class="col-xs-6">
            <div class="form-group">
                <label class="control-label col-xs-2 required-field"> 標題 </label>
                <div class="col-xs-7">
                    <input type="text" class="form-control title" name="title" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->new003;?>
"/>
                </div>
                <div class="col-xs-3 checkbox">
                    <label>
                        <input type="checkbox" name="notice" value="1" />
                        推播通知
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-2"> 附加圖片 </label>
                <?php if ($_smarty_tpl->tpl_vars['row']->value->new008){?>
                    <div class="col-xs-8" id="image-wrapper" >
                        <div class="input-group">
                            <a id="image-link" class="form-control" href="<?php echo $_smarty_tpl->tpl_vars['row']->value->url();?>
" target="_blank"> 
                                開啟圖片
                                <img id="receipt-image" src="<?php echo $_smarty_tpl->tpl_vars['row']->value->url();?>
" />
                            </a>
                            <a id="remove-image" class="input-group-addon" href="#" news-id="<?php echo $_smarty_tpl->tpl_vars['row']->value->new001;?>
">
                                <span class="glyphicon glyphicon-remove" title="移除" aria-hidden="true"></span>
                            </a>
                        </div>
                    </div>
                <?php }else{ ?>
                    <div class="col-xs-8">
                        <input type="file" name="image" class="form-control"/>
                    </div>
                <?php }?>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <div class="col-xs-12">
                    <trix-editor input="content"></trix-editor>
                    <input type="hidden" id="content" name="content" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['row']->value->new004, ENT_QUOTES, 'UTF-8', true);?>
"/>
                </div>
            </div>
        </div>

    </form>
    <iframe id="iframe-save" name="iframe-save" class="hide"></iframe>
</div>

<?php }} ?>