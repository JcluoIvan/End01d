<?php /* Smarty version Smarty-3.1.8, created on 2015-11-24 15:37:55
         compiled from "/home/www//theme/default/page06_point_print.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1553780045564da031383984-58396731%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8931515099ce6c998d765489b6fbcc0d10afa136' => 
    array (
      0 => '/home/www//theme/default/page06_point_print.tpl',
      1 => 1448350672,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1553780045564da031383984-58396731',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_564da031424a61_41221564',
  'variables' => 
  array (
    'rows' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_564da031424a61_41221564')) {function content_564da031424a61_41221564($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
    <?php echo $_smarty_tpl->getSubTemplate ('head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</head>
<body class='print-page landscape'>
    <page size='A4'>
        <table class='print-table'>
            <thead>
                <tr>
                    <th>訂單編號</th>
                    <th>交易日</th>
                    <th>核帳日</th>
                    <th>入帳日</th>
                    <th>會員編號</th>
                    <th>實收金額</th>
                    <th>發放點數</th>
                    <th>展示中心編號</th>
                    <th>上一層名稱/發放點數</th>
                    <th>上二層名稱/發放點數</th>
                    <th>上三層名稱/發放點數</th>
                </tr>
            </thead>
            <tbody>
            <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['ono'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['trans_date'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['verification_date'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['give_date'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['mem_no'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['pay_amount'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['give_point'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['age_no'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['mlv1'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['mlv2'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['mlv3'];?>
</td>
                </tr>
            <?php } ?>
            </tbody>
    </page>
    <button id='print'>Print</button>
    <script src='/js/page06_print_page.js'> </script>
</body>
</html>
<?php }} ?>