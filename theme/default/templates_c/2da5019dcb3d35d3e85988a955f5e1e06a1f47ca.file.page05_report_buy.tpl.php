<?php /* Smarty version Smarty-3.1.8, created on 2015-12-10 13:01:59
         compiled from "/home/www//theme/default/page05_report_buy.tpl" */ ?>
<?php /*%%SmartyHeaderCode:151154512556690747103e46-46760987%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2da5019dcb3d35d3e85988a955f5e1e06a1f47ca' => 
    array (
      0 => '/home/www//theme/default/page05_report_buy.tpl',
      1 => 1441937620,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '151154512556690747103e46-46760987',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_56690747166315_70274445',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56690747166315_70274445')) {function content_56690747166315_70274445($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">購買紀錄</li>
        </ol>
        <h3 class="title-bar"> 
            <label> 購買紀錄 </label>
        </h3>
        <form class="form-horizontal" id="form-search">
            <div class="form-group">
                <label class="col-xs-1 control-label">搜尋</label>
                <div class="col-xs-2">
                    <select class="form-control" name="is_verification">
                        <option value="all">全部</option>
                        <option value="verification">核帳</option>
                        <option value="not_verification">未核帳</option>
                    </select>
                </div>
                <div class="col-xs-2">
                    <select class="form-control" name="searchKind">
                        <option value="phone">會員手機</option>
                        <option value="no">會員編號</option>
                    </select>
                </div>
                <div class="col-xs-2">
                    <input type="text" name="search"  class="form-control">
                </div>
                <div class="col-xs-2">
                    <button type="button" id="search-btn" class="btn btn-default">查詢</button>
                </div>
            </div>

            <div id="option-bar" class="pull-right"></div>

            <div class="form-group has-warning">
                <label class='col-xs-1 control-label'>會員編號:</label>
                <div class="col-xs-2">
                    <input type="text" id="no-return"  class="form-control" readonly />
                </div>
                <label class='col-xs-1 control-label'>會員名稱:</label>
                <div class="col-xs-2">
                    <input type="text" id="name-return"  class="form-control" readonly />
                </div>
                <label class='col-xs-1 control-label'>會員手機:</label>
                <div class="col-xs-2">
                    <input type="text" id="phone-return"  class="form-control" readonly />
                </div>
            </div>
        </form>

        <div id="option-main"></div>
        <div id="report-buy-list">
        </div>
    </div>
    <script type="text/javascript" src="/js/page05_report_buy.js?<?php echo time();?>
"></script>
</body>
</html><?php }} ?>