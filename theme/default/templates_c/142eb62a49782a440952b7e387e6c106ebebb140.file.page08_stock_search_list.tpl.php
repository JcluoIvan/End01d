<?php /* Smarty version Smarty-3.1.8, created on 2015-11-26 14:29:48
         compiled from "/home/www//theme/default/page08_stock_search_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4199524035656a6dc25b6a3-59692471%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '142eb62a49782a440952b7e387e6c106ebebb140' => 
    array (
      0 => '/home/www//theme/default/page08_stock_search_list.tpl',
      1 => 1440987451,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4199524035656a6dc25b6a3-59692471',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5656a6dc2a1e82_88279039',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5656a6dc2a1e82_88279039')) {function content_5656a6dc2a1e82_88279039($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</head>
<body>
	<div class="col-xs-12">
		<ol class="breadcrumb">
				<li class="active">存貨庫存</li>
		</ol>
		<h3 class="title-bar">
				<!-- <div id="option-bar" class="pull-right"></div> -->
				<label>展示中心專區 - 存貨庫存</label>
		</h3>
		<div style="display:inline-block; width: 100%">
				<!--
				<div class="pull-left" >
						<form id="command-search" class="form-inline">
								<label for="exampleInputName2">搜尋</label>
								<select id="search" name="search" class="form-control">
										<option value="id">雷達站編號</option>
										<option value="name">雷達站名稱</option>
								</select>
								<input name="rno" id="rno" type="text" class="form-control" placeholder="請輸入編號 or 名稱" />
								<button type="submit" class="btn btn-default">查詢</button>
						</form>
				</div>
				-->
				<div id="option-bar" class="pull-right"></div>
		</div>
		<div id="option-main"></div>
		<!-- <iframe id="bottom-iframe" name="bottom-iframe" style="border: 0px;width: 100%;"></iframe> -->
		<div id="order-list"></div>
	</div>
	<script type="text/javascript" src="/js/page08_stock_search_list.js?<?php echo time();?>
"></script>


</body>
</html><?php }} ?>