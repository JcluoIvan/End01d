<?php /* Smarty version Smarty-3.1.8, created on 2015-12-10 13:01:57
         compiled from "/home/www//theme/default/page05_report_month.tpl" */ ?>
<?php /*%%SmartyHeaderCode:367169484566907458e5571-66127847%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e72c1a2993a92f8b13761643e43f3e5ff2c301b3' => 
    array (
      0 => '/home/www//theme/default/page05_report_month.tpl',
      1 => 1440987449,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '367169484566907458e5571-66127847',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'year_ary' => 0,
    'month_ary' => 0,
    'month' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_56690745986c22_24675993',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56690745986c22_24675993')) {function content_56690745986c22_24675993($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/www/libraries/smarty/libs/plugins/function.html_options.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <link rel="stylesheet" type="text/css" href="/css/page05.css" />
</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">統計報表 - 月報表</li>
        </ol>
        <h3 class="title-bar"> 
            <label> 月報表 </label>
        </h3>
        <div class="form-group">
            <form class="form-inline" id="form-search">
                <input type='hidden' name='kind' id='kind' value='month' />
                <label>交易日期</label>
                <div class="form-group">
                    <?php echo smarty_function_html_options(array('name'=>'year','id'=>'year','class'=>'form-control','options'=>$_smarty_tpl->tpl_vars['year_ary']->value),$_smarty_tpl);?>

                </div>
                <div class="form-group">
                    <?php echo smarty_function_html_options(array('name'=>'month','id'=>'month','class'=>'form-control','options'=>$_smarty_tpl->tpl_vars['month_ary']->value,'selected'=>$_smarty_tpl->tpl_vars['month']->value),$_smarty_tpl);?>

                </div>
                <button type="button" id="search-btn" class="btn btn-default">查詢</button>
                <button class='btn btn-primary' href='#' id='print'>列印</button>

                <div id="option-bar" class="pull-right"></div>
            </form>
        </div>

        <div id="option-main" ></div>
        <div id="report-month-list">
        </div>
    </div>
    <script type="text/javascript" src="/js/page05_report_month.js?<?php echo time();?>
"></script>
</body>
</html><?php }} ?>