<?php /* Smarty version Smarty-3.1.8, created on 2015-11-26 14:29:52
         compiled from "/home/www//theme/default/page08_verification_reject_search_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16910036665656a6e024e108-02610588%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd3f7ebc2f1b2eda73dd68429f44af55e98412987' => 
    array (
      0 => '/home/www//theme/default/page08_verification_reject_search_list.tpl',
      1 => 1442834146,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16910036665656a6e024e108-02610588',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5656a6e029f2a2_83985363',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5656a6e029f2a2_83985363')) {function content_5656a6e029f2a2_83985363($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <link rel="stylesheet" type="text/css" href="/css/page08.css" />
</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">退貨操作</li>
        </ol>
        <h3 class="title-bar">
            <label>展示中心專區 - 退貨操作</label>
        </h3>
        <div style="display:inline-block; width: 100%">
            <div class="pull-left" >
                <form id="command-search" class="form-inline" autocomplete="off">
                    <label for="exampleInputName2">訂單編號</label>
                    <input name="no" id="no" type="text" class="form-control" placeholder="請輸入訂單編號" />
                    <button type="submit" class="btn btn-default">查詢</button>
                </form>
            </div>
            <div id="option-bar" class="pull-right"></div>
        </div>
        <!-- <iframe id="bottom-iframe" name="bottom-iframe" style="border: 0px;width: 100%;"></iframe> -->
        <div id="order-list">
        </div>
        <div class="col-xs-12">
            <pre class="well" id="success"></pre>
            <button type="button" id="checkDate" class="btn btn-primary pull-left">確認退貨</button>
        </div>
    </div>
    <script type="text/javascript" src="/js/page08_verification_reject_search_list.js?<?php echo time();?>
"></script>


</body>
</html><?php }} ?>