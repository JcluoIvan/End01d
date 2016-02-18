<?php /* Smarty version Smarty-3.1.8, created on 2015-10-20 14:18:24
         compiled from "/home/www//theme/default/page03_radar_month_closeDetails.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1818502475625dcb00af240-79387141%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '78b368bf8ac516524e3cb8e6461dff3d16ebd782' => 
    array (
      0 => '/home/www//theme/default/page03_radar_month_closeDetails.tpl',
      1 => 1442329769,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1818502475625dcb00af240-79387141',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5625dcb0117436_95711620',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5625dcb0117436_95711620')) {function content_5625dcb0117436_95711620($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
            <li><a class="active">展示中心月結 / 明細</a></li>
        </ol>
        <h3 class="title-bar">
            <!-- <div id="option-bar" class="pull-right"></div> -->
            <label>訂單管理 - 展示中心月結 / 明細</label>
        </h3>
        <div style="display:inline-block; width: 88%">
            <div class="pull-left" >
                <form id="command-search" class="form-inline">
                
                </form>

            </div>
            <div id="option-bar" class="pull-right"></div>
            <button type="button" id="checkRadar" class="btn btn-primary pull-right">核帳</button>
            <button type="button" id="cancelRadar" class="btn btn-primary pull-right">註銷</button>
        </div>
        <!-- <iframe id="bottom-iframe" name="bottom-iframe" style="border: 0px;width: 100%;"></iframe> -->
        <div id="list-wrapper">
            <div id="order-list"></div>
        </div>
    </div>
    <form id="search-data">
        <input name="agentid" id="agentid" type="hidden" value="<?php echo $_GET['id'];?>
" />
        <input name="year" id="year" type="hidden" value="<?php echo $_GET['year'];?>
" />
        <input name="month" id="month" type="hidden" value="<?php echo $_GET['month'];?>
" />
    </form>
    <script type="text/javascript" src="/js/page03_radar_month_closeDetails.js?<?php echo time();?>
"></script>


</body>
</html><?php }} ?>