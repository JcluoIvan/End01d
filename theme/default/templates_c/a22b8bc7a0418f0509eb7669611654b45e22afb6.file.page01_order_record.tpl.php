<?php /* Smarty version Smarty-3.1.8, created on 2015-11-05 18:08:46
         compiled from "/home/www//theme/default/page01_order_record.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1232804419563b2aae04f083-00182558%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a22b8bc7a0418f0509eb7669611654b45e22afb6' => 
    array (
      0 => '/home/www//theme/default/page01_order_record.tpl',
      1 => 1440987445,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1232804419563b2aae04f083-00182558',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'member' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_563b2aae0bd4f2_24914320',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_563b2aae0bd4f2_24914320')) {function content_563b2aae0bd4f2_24914320($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">會員購買紀錄</li>
        </ol>
        <h3 class="title-bar"> 
            <label> 會員購買紀錄 </label>
        </h3>
        <div class="form-group">
            <form class="form-inline" id="option-form-search">
                <div class = 'has-warning'>
                    <input type="hidden" name="id"  class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['member']->value->mem001;?>
" />
                    <label class='control-label'>會員編號:</label>
                    <input type="text" name="no"  class="form-control" readonly value="<?php echo $_smarty_tpl->tpl_vars['member']->value->mem002;?>
" />
                    <label class='control-label'>會員名稱:</label>
                    <input type="text" name="name"  class="form-control" readonly value="<?php echo $_smarty_tpl->tpl_vars['member']->value->mem005;?>
" />
                </div>
            </form>
        </div>
        <div id="order-record-list">
        </div>
    </div>
    <script type="text/javascript" src="/js/page01_order_record.js?<?php echo time();?>
"></script>
</body>
</html><?php }} ?>