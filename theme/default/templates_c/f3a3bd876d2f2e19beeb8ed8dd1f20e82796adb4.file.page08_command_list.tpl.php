<?php /* Smarty version Smarty-3.1.8, created on 2015-11-26 14:29:40
         compiled from "/home/www//theme/default/page08_command_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15838915485656a6d48da727-32722407%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f3a3bd876d2f2e19beeb8ed8dd1f20e82796adb4' => 
    array (
      0 => '/home/www//theme/default/page08_command_list.tpl',
      1 => 1442329777,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15838915485656a6d48da727-32722407',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'bank_account' => 0,
    'bank_code' => 0,
    'year' => 0,
    'vy' => 0,
    'month' => 0,
    'vm' => 0,
    'right_now_month' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5656a6d4986a01_49533302',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5656a6d4986a01_49533302')) {function content_5656a6d4986a01_49533302($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


				<style>
						#modify-iframe {
								width: 100%;
								border:1px solid #aaa;
								height: 0;
								opacity: 0;
								transition: .25s;
						}
						#modify-iframe.show {
								opacity: 1;
								height: 500px;
						}
						#product-list div > a.selling {color: blue; }
						#product-list div > a.unselling {color: red; }
						#product-list div.options > a {
								margin: 0 2px;
						}
				</style>

</head>
<body>
		<div class="col-xs-12">
				<ol class="breadcrumb">
						<li class="active">業務獎金查詢</li>
				</ol>
				<h3 class="title-bar">
						<!-- <div id="option-bar" class="pull-right"></div> -->
						<label>展示中心專區 - 業務獎金查詢</label>
				</h3>
				<div class="col-xs-8">
	                <fieldset>
	                    <legend>
	                    	銀行代號  <?php echo $_smarty_tpl->tpl_vars['bank_account']->value;?>

	                    	<Br>
	                    	銀行帳號  <?php echo $_smarty_tpl->tpl_vars['bank_code']->value;?>

	                    </legend>
	                </fieldset>
            	</div>
				<div style="display:inline-block; width: 100%">
						<div class="pull-left" >
								<form id="command-search" class="form-inline">
										<label for="exampleInputName2">搜尋</label>
										<select id="memsearch" name="memsearch" class="form-control">
												<option value="phone">會員手機</option>
												<option value="id">會員編號</option>
												<option value="name">會員名稱</option>
										</select>
										<input name="no" id="no" type="text" class="form-control" placeholder="請輸入編號 or 名稱 or 手機" />
										<div class="form-group">
				                        <select id="year" class="form-control" name="year">
				                          <?php  $_smarty_tpl->tpl_vars['vy'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vy']->_loop = false;
 $_smarty_tpl->tpl_vars['ky'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['year']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['vy']->key => $_smarty_tpl->tpl_vars['vy']->value){
$_smarty_tpl->tpl_vars['vy']->_loop = true;
 $_smarty_tpl->tpl_vars['ky']->value = $_smarty_tpl->tpl_vars['vy']->key;
?>
				                          <option value="<?php echo $_smarty_tpl->tpl_vars['vy']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['vy']->value;?>
</option>
				                          <?php } ?>
				                        </select>年
				                        <select id="month" class="form-control" name="month">
				                          <?php  $_smarty_tpl->tpl_vars['vm'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vm']->_loop = false;
 $_smarty_tpl->tpl_vars['km'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['month']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['vm']->key => $_smarty_tpl->tpl_vars['vm']->value){
$_smarty_tpl->tpl_vars['vm']->_loop = true;
 $_smarty_tpl->tpl_vars['km']->value = $_smarty_tpl->tpl_vars['vm']->key;
?>
				                          <option value="<?php echo $_smarty_tpl->tpl_vars['vm']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['right_now_month']->value==$_smarty_tpl->tpl_vars['vm']->value){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['vm']->value;?>
</option>
				                          <?php } ?>
				                        </select>月
                    					</div>
										<button type="submit" class="btn btn-default">查詢</button>
								</form>
						</div>
						<div id="option-bar" class="pull-right"></div>
				</div>
				<div id="option-main"></div>
				<!-- <iframe id="bottom-iframe" name="bottom-iframe" style="border: 0px;width: 100%;"></iframe> -->
				<div id="order-list"></div>
		</div>
		<script type="text/javascript" src="/js/page08_main.js?<?php echo time();?>
"></script>


</body>
</html>
<?php }} ?>