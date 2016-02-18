<?php /* Smarty version Smarty-3.1.8, created on 2015-12-23 11:47:55
         compiled from "/home/www//theme/default/page05_report_print.tpl" */ ?>
<?php /*%%SmartyHeaderCode:591939772567a196b459ff2-67374617%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '31cdfed132f7583c37898252ba8566e16e5132f8' => 
    array (
      0 => '/home/www//theme/default/page05_report_print.tpl',
      1 => 1440987449,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '591939772567a196b459ff2-67374617',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_567a196b4f2829_58343213',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567a196b4f2829_58343213')) {function content_567a196b4f2829_58343213($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
    <?php echo $_smarty_tpl->getSubTemplate ('head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</head>
<body class='print-page landscape'>
    <page size='A4'>
        <table class='print-table'>
            <thead>
                <tr>
                    <th>展示中心編號</th>
                    <th>展示中心名稱</th>
                    <th>展示中心店名</th>
                    <th>商品金額</th>
                    <th>+ 運費</th>
                    <th>- 退貨金額</th>
                    <th>= 總金額</th>
                    <th>使用購物金</th>
                </tr>
            </thead>
            <tbody>
            <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['age_no'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['age_name'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['age_store'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['pay_amount'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['fare'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['reject_amount'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['amount'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['pay_point'];?>
</td>
                </tr>
            <?php } ?>
            </tbody>
    </page>
    <button id='print'>Print</button>
    <script src='/js/page05_print_page.js'> </script>
</body>
</html>
<?php }} ?>