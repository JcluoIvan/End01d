<?php /* Smarty version Smarty-3.1.8, created on 2015-10-16 13:05:38
         compiled from "/home/www//theme/default/page97_title_image.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1076005112562085a28b9478-56441491%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a6a9dfe761b33a941d4a6df9727a3ebf3b0387bd' => 
    array (
      0 => '/home/www//theme/default/page97_title_image.tpl',
      1 => 1444890436,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1076005112562085a28b9478-56441491',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'images' => 0,
    'img' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_562085a2935577_10573828',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_562085a2935577_10573828')) {function content_562085a2935577_10573828($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $_smarty_tpl->getSubTemplate ('head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <link rel="stylesheet" type="text/css" href="/css/page97.css" />
    </head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">首頁上橫幅圖片</li>
        </ol>
        <h3 class="title-bar"> 
            <div id="option-bar" class="pull-right"></div>
            <label>首頁上橫幅圖片</label>
        </h3>
    </div>
    <div class="row">
        <div class="col-xs-2 col-xs-offset-4">
            <button id="save-button" class="btn btn-primary" disabled> Setting </button>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <div id="title-images-wrapper">
                <?php  $_smarty_tpl->tpl_vars['img'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['img']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['images']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['img']->key => $_smarty_tpl->tpl_vars['img']->value){
$_smarty_tpl->tpl_vars['img']->_loop = true;
?>
                    <div class="image-item <?php echo $_smarty_tpl->tpl_vars['img']->value->activeClass();?>
 img-id-<?php echo $_smarty_tpl->tpl_vars['img']->value->mbt001;?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['img']->value->mbt001;?>
">
                        <img src="<?php echo $_smarty_tpl->tpl_vars['img']->value->url();?>
" />
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-xs-6">
            <form id="update-form" action="#" method="post" target="update-iframe" class="form-horizontal" enctype="multipart/form-data">
                <div id="update-images-wrapper">
                    <div class="form-group update-image"> 
                        <label class="control-label col-xs-2">上傳圖片</label>
                        <div class="col-xs-6">
                            <div class="input-group">
                                <input type="file" name="images[]" class="form-control" />
                                <a class="input-group-addon remove-button">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"> </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div clas="form-group">
                    <div class="col-xs-4 col-xs-offset-6">
                        <button class="btn btn-primary">上傳</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <iframe id="update-iframe" name="update-iframe" class="hide"></iframe>

    <script type="text/javascript" src="/js/page97_title_image.js?<?php echo time();?>
"></script>
</body>
</html><?php }} ?>