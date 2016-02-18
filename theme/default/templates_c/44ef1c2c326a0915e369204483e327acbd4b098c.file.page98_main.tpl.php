<?php /* Smarty version Smarty-3.1.8, created on 2015-12-04 09:24:00
         compiled from "/home/www//theme/default/page98_main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1176150815620b511372529-45183248%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '44ef1c2c326a0915e369204483e327acbd4b098c' => 
    array (
      0 => '/home/www//theme/default/page98_main.tpl',
      1 => 1449191924,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1176150815620b511372529-45183248',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5620b511450ea9_87162892',
  'variables' => 
  array (
    'agent' => 0,
    'country' => 0,
    'city' => 0,
    'codes' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5620b511450ea9_87162892')) {function content_5620b511450ea9_87162892($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/www/libraries/smarty/libs/plugins/function.html_options.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ('head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <link rel="stylesheet" type="text/css" href="/css/page98.css" />
</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">個人資料修改</li>
        </ol>
        <h3 class="title-bar">
            <label>個人資料修改</label>
        </h3>
        <form id="save-form" method="post" class="form-horizontal">
            <div class="col-xs-8">
                <fieldset>
                    <legend>基本資料</legend>
                    <div class="form-group">
                        <label class="control-label col-xs-2">帳號</label>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['agent']->value->age004;?>
" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">姓名</label>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['agent']->value->age006;?>
" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">生日</label>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['agent']->value->dateFormat('age008');?>
" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">手機</label>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['agent']->value->age012;?>
" readonly/>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>詳細資料</legend>
                    <div class="form-group">
                        <label class="control-label col-xs-2">地址</label>
                        <div class="col-xs-2">
                            <select class="form-control" id="country" name="country">
                                <option value="<?php echo $_smarty_tpl->tpl_vars['country']->value->pos001;?>
" selected><?php echo $_smarty_tpl->tpl_vars['country']->value->pos004;?>
</option>
                            </select>
                        </div>
                        <div class="col-xs-2">
                            <select class="form-control" id="city" name="city">
                                <option value="<?php echo $_smarty_tpl->tpl_vars['city']->value->pos001;?>
" selected><?php echo $_smarty_tpl->tpl_vars['city']->value->pos004;?>
</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-4 col-xs-offset-2">
                            <input type="text" class="form-control" name="address" value="<?php echo $_smarty_tpl->tpl_vars['agent']->value->age010;?>
" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">銀行代碼</label>
                        <div class="col-xs-3">
                            <select name="bank_code" class="form-control">
                                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['codes']->value,'selected'=>$_smarty_tpl->tpl_vars['agent']->value->age021),$_smarty_tpl);?>

                            </select>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" id="bank-code-filter" class="form-control" value="" placeholder="查詢銀行"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">銀行帳號</label>
                        <div class="col-xs-3">
                            <input type="text" name="bank_account" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['agent']->value->age011;?>
" />
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>密碼修改</legend>
                    <div class="form-group">
                        <label class="control-label col-xs-2">原密碼</label>
                        <div class="col-xs-3">
                            <input type="password" class="form-control" name="source_password"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">新密碼</label>
                        <div class="col-xs-3">
                            <input type="password" class="form-control" name="new_password" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">密碼確認</label>
                        <div class="col-xs-3">
                            <input type="password" class="form-control" name="confirm_password" />
                        </div>
                    </div>
                </fieldset>
                <div class="form-group">
                    <div class="col-xs-2 col-xs-offset-5">
                        <button type="submit" class="btn btn-primary btn-block"> 儲存 </button>
                    </div>
                </div>
            </div>
        </form>
        <script type="text/javascript" src="/js/page98_main.js?<?php echo time();?>
"></script>
    </div>
</body>
</html><?php }} ?>