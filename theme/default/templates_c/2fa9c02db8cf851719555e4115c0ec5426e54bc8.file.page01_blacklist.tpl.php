<?php /* Smarty version Smarty-3.1.8, created on 2016-01-29 14:14:09
         compiled from "/home/www//theme/default/page01_blacklist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:110682201256ab0331293853-61563549%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2fa9c02db8cf851719555e4115c0ec5426e54bc8' => 
    array (
      0 => '/home/www//theme/default/page01_blacklist.tpl',
      1 => 1440987444,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '110682201256ab0331293853-61563549',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_56ab03312d98e1_72758987',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56ab03312d98e1_72758987')) {function content_56ab03312d98e1_72758987($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">黑名單</li>
        </ol>
        <h3 class="title-bar"> 
            <label> 黑名單 </label>
        </h3>
        <div class="form-group">
            <form class="form-inline" id="form-search">

                <label>搜尋</label>
                <select class="form-control" name="searchKind">
                    <option value="no">會員編號</option>
                    <option value="name">會員名稱</option>
                    <option value="phone">會員手機</option>
                </select>
                <input type="text" name="search"  class="form-control">
                <button type="button" id="search-btn" class="btn btn-default">查詢</button>

            </form>
        </div>
        <div id="blacklist-list">
        </div>
    </div>
    <script type="text/javascript" src="/js/page01_blacklist.js?<?php echo time();?>
"></script>
</body>
</html><?php }} ?>