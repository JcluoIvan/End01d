<?php /* Smarty version Smarty-3.1.8, created on 2015-12-04 18:35:56
         compiled from "/home/www//theme/default/page03_order_print.tpl" */ ?>
<?php /*%%SmartyHeaderCode:78649786056616c8c92bea2-63364244%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4fd4d44bd689d1d021dc103427bdb973b013e1ae' => 
    array (
      0 => '/home/www//theme/default/page03_order_print.tpl',
      1 => 1442485188,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '78649786056616c8c92bea2-63364244',
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
  'unifunc' => 'content_56616c8c9d8839_80247448',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56616c8c9d8839_80247448')) {function content_56616c8c9d8839_80247448($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</head>
<body class="print-page landscape">
    <page size="A4">
        <table class="print-table">
            <thead>
                <tr>
                    <th>訂單編號</th>
                    <th>總金額</th>
                    <th>收款日期</th>
                    <th>出（取）貨日期</th>
                    <th>核帳日期</th>
                    <th>付款方式</th>
                    <th>取貨方式</th>
                    <th>專業經理人編號</th>
                    <th>展示中心編號</th>
                    <th>宅配單號（取貨序號）</th>
                </tr>
            </thead>
            <tbody>
            <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['oid'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['total'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['date3'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['date2'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['check_date'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['methods'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['getmode'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['lv1id'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['lv2id'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['getno'];?>
</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <div class="footer">
            <table class="print-table-footer">
                <thead>
                    <tr>
                        <th>印單人：</th>
                        <th>廠務部：</th>
                        <th>客服部：</th>
                        <th>會計部：</th>
                        <th>資訊部：</th>
                    </tr>
                </thead>
            </table>
        </div>
    </page>
    <button id="print">Print</button>
    <script src="/js/page03_print_page.js?<?php echo time();?>
"> </script>
</body>
</html>
<?php }} ?>