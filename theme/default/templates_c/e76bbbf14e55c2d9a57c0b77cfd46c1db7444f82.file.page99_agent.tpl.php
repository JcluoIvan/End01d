<?php /* Smarty version Smarty-3.1.8, created on 2015-10-16 13:06:27
         compiled from "/home/www//theme/default/page99_agent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:796249849562085d3f38076-64165407%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e76bbbf14e55c2d9a57c0b77cfd46c1db7444f82' => 
    array (
      0 => '/home/www//theme/default/page99_agent.tpl',
      1 => 1440987453,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '796249849562085d3f38076-64165407',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'type_options' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_562085d4065b91_94878815',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_562085d4065b91_94878815')) {function content_562085d4065b91_94878815($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/www/libraries/smarty/libs/plugins/function.html_options.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $_smarty_tpl->getSubTemplate ('head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <!-- <link rel="stylesheet" type="text/css" href="/css/page99.css" /> -->
    </head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">部門、組織操作記錄</li>
        </ol>
        <h3 class="title-bar"> 
            <label>部門、組織操作記錄</label>
        </h3>
        <form class="form-inline search-form">
            <div id="option-bar" class="pull-right"></div>
            <div class="form-group">
                <label> 帳號類型 </label>
                <select name="type" class="form-control">
                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['type_options']->value,'selected'=>(($tmp = @$_POST['type'])===null||$tmp==='' ? '' : $tmp)),$_smarty_tpl);?>

                </select>
            </div>
            <div class="form-group">
                <label> 帳號 / 姓名 </label>
                <div class="input-group">
                    <input type="text" name="query" class="form-control" value="<?php echo (($tmp = @$_POST['query'])===null||$tmp==='' ? '' : $tmp);?>
" />
                    <a id="clear-query" class="input-group-addon" href="#">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
            <button type="submit" class="btn btn-default">查詢</button>
        </form>
        <div id="option-main" ></div>
        <div id="log-list">
        </div>
    </div>
    <script type="text/javascript" src="/js/page99_agent.js?<?php echo time();?>
"></script>
</body>
</html><?php }} ?>