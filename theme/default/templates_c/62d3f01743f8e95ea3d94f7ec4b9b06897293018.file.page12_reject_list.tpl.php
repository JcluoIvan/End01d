<?php /* Smarty version Smarty-3.1.8, created on 2015-12-09 17:10:07
         compiled from "/home/www//theme/default/page12_reject_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13886511275667efefc4e8d2-90612013%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '62d3f01743f8e95ea3d94f7ec4b9b06897293018' => 
    array (
      0 => '/home/www//theme/default/page12_reject_list.tpl',
      1 => 1442485202,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13886511275667efefc4e8d2-90612013',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ooid' => 0,
    'oid' => 0,
    'date1' => 0,
    'date2' => 0,
    'datecheck' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5667efefcbb854_84707175',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5667efefcbb854_84707175')) {function content_5667efefcbb854_84707175($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
            <li><a href="/page/page12/command_list.php?sid=<?php echo $_GET['sid'];?>
">訂貨單</a></li>
            <li class="active">退貨單列表 [ 訂單編號：<?php echo $_smarty_tpl->tpl_vars['ooid']->value;?>
 ] </li>
        </ol>
        <h3 class="title-bar">
            <!-- <div id="option-bar" class="pull-right"></div> -->
            <label>訂單管理 - 退貨單列表</label>
        </h3>
        <div style="display:inline-block; width: 100%">
            <div class="pull-left" >
                <form id="command-search" class="form-inline">
                    <input name="oid" id="oid" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['oid']->value;?>
">
                    <input name="date1" id="date1" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['date1']->value;?>
">
                    <input name="date2" id="date2" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['date2']->value;?>
">
                    <input id="check-date" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['datecheck']->value;?>
">
                    
                    <button type="button" class="btn btn-primary"id="print" name="print">列印</button>
                    
                </form>

            </div>
            <div id="option-bar" class="pull-right"></div>
        </div>
        <div id="option-main" ></div>
        <!-- <iframe id="bottom-iframe" name="bottom-iframe" style="border: 0px;width: 100%;"></iframe> -->
        <div id="order-list">
        </div>
    </div>
    <script type="text/javascript" src="/js/page12_reject_list.js?<?php echo time();?>
"></script>


</body>
</html><?php }} ?>