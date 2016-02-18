<?php /* Smarty version Smarty-3.1.8, created on 2015-12-04 16:17:13
         compiled from "/home/www//theme/default/page12_order_detail_print.tpl" */ ?>
<?php /*%%SmartyHeaderCode:107694118856614c09adc700-73684079%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2f68abcb9a2aab4db5237d987d647a9a074a545b' => 
    array (
      0 => '/home/www//theme/default/page12_order_detail_print.tpl',
      1 => 1442485200,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '107694118856614c09adc700-73684079',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'memberData' => 0,
    'orderData' => 0,
    'detail' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_56614c09ba5a62_80197196',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56614c09ba5a62_80197196')) {function content_56614c09ba5a62_80197196($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</head>
<body class="print-page landscape">
    <page size="A4">
        <table width="100%" border="0">
          <tr>
            <td>會員編號： <?php echo $_smarty_tpl->tpl_vars['memberData']->value->mem002;?>
</td>
            <td>　訂貨人： <?php echo $_smarty_tpl->tpl_vars['orderData']->value['name'];?>
</td>
            <td>訂單編號： <?php echo $_smarty_tpl->tpl_vars['orderData']->value['oid'];?>
</td>
          </tr>
          <tr>
            <td>聯絡電話： <?php echo $_smarty_tpl->tpl_vars['orderData']->value['phone'];?>
</td>
            <td>訂貨方式： <?php echo $_smarty_tpl->tpl_vars['orderData']->value['getmode'];?>
</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3">送貨地址： <?php echo $_smarty_tpl->tpl_vars['orderData']->value['address'];?>
</td>
          </tr>
        </table>
        <table class="print-table">
            <thead>
                <tr>
                    <th>產品編號</th>
                    <th>品名</th>
                    <th>產品單價</th>
                    <th>購買數量</th>
                    <th>退貨數量</th>
                    <th>剩餘數量</th>
                    <th>購買金額</th>
                    <th>退貨金額</th>
                    <th>剩餘金額</th>
                </tr>
            </thead>
            <tbody>
            <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['detail']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['no'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['name'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['money'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['count'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['reject_count'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['totalcount'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['total'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['reject_money'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['row']->value['totalmoney'];?>
</td>
                </tr>
            <?php } ?>
            </tbody>
    </page>
    <button id="print">Print</button>
    <script src="/js/page12_print_page.js?<?php echo time();?>
"> </script>
</body>
</html>
<?php }} ?>