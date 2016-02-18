<?php /* Smarty version Smarty-3.1.8, created on 2015-10-30 16:09:05
         compiled from "/home/www//theme/default/not_allow.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1160019290563325a193fe77-68342595%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7ccb91878df9dcd3108bdcb52c3d4eff78ffbc0f' => 
    array (
      0 => '/home/www//theme/default/not_allow.tpl',
      1 => 1440987444,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1160019290563325a193fe77-68342595',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_563325a197ac85_33078467',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_563325a197ac85_33078467')) {function content_563325a197ac85_33078467($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</head>
<body>
    <div class="col-xs-12">
        <div class="col-xs-8 col-xs-offset-2 well">
            <div> 
                您沒有此頁面的瀏覽權限！ 
                或是您的帳號已被登出，
                請 <a id="re-login" href="#">重新登入</a>。
            </div>
        </div>
    </div>
    <script>
        $('#re-login').bind('click', function() {
            window.top.location = '/';
        });
    </script>
</body>
</html>
<?php }} ?>