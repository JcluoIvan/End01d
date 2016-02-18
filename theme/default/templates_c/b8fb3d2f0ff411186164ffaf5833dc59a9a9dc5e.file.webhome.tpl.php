<?php /* Smarty version Smarty-3.1.8, created on 2015-10-16 11:50:30
         compiled from "/home/www//theme/default/webhome.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18587682475620740656edd0-95044541%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b8fb3d2f0ff411186164ffaf5833dc59a9a9dc5e' => 
    array (
      0 => '/home/www//theme/default/webhome.tpl',
      1 => 1440987455,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18587682475620740656edd0-95044541',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_562074065c1bc8_80566467',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_562074065c1bc8_80566467')) {function content_562074065c1bc8_80566467($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $_smarty_tpl->getSubTemplate ('head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <link rel="stylesheet" type="text/css" href="/css/webhome.css" />

    </head>
    <body>
        <div class="container ">
            <form id="login-form" action="?" class="form-horizontal">
                <div id="form-header"> 後台管理 </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">帳號</label>
                    <div class="col-xs-4">
                        <input type="text" id="input-account" name="account" class="form-control" value="" placeholder="請輸入帳號" tabindex="1" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">密碼</label>
                    <div class="col-xs-4">
                        <input type="password" id="input-password" name="password" class="form-control" value=""  placeholder="請輸入密碼" tabindex="2"/>
                    </div>
                    <div class="col-xs-4">
                        <button id="login-button" type="submit" class="btn btn-primary btn-block"  tabindex="4">登入</button>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">驗證碼</label>
                    <div class="col-xs-4">
                            <input type="text" name="captcha" class="form-control" value=""  placeholder="請輸入驗證碼" tabindex="3"/>
                    </div>
                    <div class="col-xs-4">
                        <div class="input-group">
                            <img id="captcha-image" class="form-control" src="/page/home/captcha.php?<?php echo time();?>
" />
                            <a id="reload-captcha-image" href="#" class="input-group-addon">
                                <span class="glyphicon glyphicon-refresh"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <script type="text/javascript" src="/js/webhome.js?<?php echo time();?>
"></script>
    </body>
</html><?php }} ?>