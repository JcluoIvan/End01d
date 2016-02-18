<?php /* Smarty version Smarty-3.1.8, created on 2015-10-16 11:51:05
         compiled from "/home/www//theme/default/page02_item.tpl" */ ?>
<?php /*%%SmartyHeaderCode:39774389456207429a9b111-26376318%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bf2c2ce89e85ba7c8a873890080d55056ef7af0a' => 
    array (
      0 => '/home/www//theme/default/page02_item.tpl',
      1 => 1440987445,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '39774389456207429a9b111-26376318',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_56207429acf1f8_50839072',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56207429acf1f8_50839072')) {function content_56207429acf1f8_50839072($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $_smarty_tpl->getSubTemplate ('head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <style>
            #product-list div > a.enabled {color: blue; }
            #product-list div > a.disabled {color: red; }
            #product-list div.options > a {
                margin: 0 2px;
            }
        </style>
    </head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a class="active">產品類別管理</a></li>
        </ol>
        <h3 class="title-bar"> 
            <div id="option-bar" class="pull-right"></div>
            <label>產品類別管理</label>
        </h3>
        <div id="option-main"></div>
        <div id="product-list">
        </div>
    </div>
    <script type="text/javascript" src="/js/page02_item.js"></script>
</body>
</html><?php }} ?>