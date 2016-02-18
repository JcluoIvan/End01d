<?php /* Smarty version Smarty-3.1.8, created on 2015-11-26 14:29:56
         compiled from "/home/www//theme/default/page08_order_search_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6891866505656a6e42cb063-20810800%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'df99f01a7fbf868f6dedd48503374a20bb9b9002' => 
    array (
      0 => '/home/www//theme/default/page08_order_search_list.tpl',
      1 => 1440987451,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6891866505656a6e42cb063-20810800',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'year' => 0,
    'vy' => 0,
    'month' => 0,
    'vm' => 0,
    'right_now_month' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5656a6e4377ff1_36807688',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5656a6e4377ff1_36807688')) {function content_5656a6e4377ff1_36807688($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
            <li class="active">取貨記錄</li>
        </ol>
        <h3 class="title-bar">
            <!-- <div id="option-bar" class="pull-right"></div> -->
            <label>展示中心專區 - 取貨記錄</label>
        </h3>
        <div style="display:inline-block; width: 100%">
            <div class="pull-left" >
                <form id="command-search" class="form-inline">
                    <label for="exampleInputName2">搜尋</label>
                    <select id="search" name="search" class="form-control">
                        <option value="phone">會員手機</option>
                        <option value="oid">訂單編號</option>
                        <option value="mid">會員編號</option>
                    </select>
                    <input name="rno" id="rno" type="text" class="form-control" placeholder="請輸入編號" />
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
" <?php if ($_smarty_tpl->tpl_vars['right_now_month']->value==$_smarty_tpl->tpl_vars['vm']->value){?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['vm']->value;?>
</option>
                          <?php } ?>
                        </select>月
                    </div>
                    <button type="submit" class="btn btn-default">查詢</button>
                </form>
            </div>
                        <div id="option-bar" class="pull-right"></div>
        </div>
        <div id="option-main" ></div>
        <!-- <iframe id="bottom-iframe" name="bottom-iframe" style="border: 0px;width: 100%;"></iframe> -->
        <div id="order-list">
        </div>
    </div>

        <div id="demo-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" >
                    <input type="hidden" id="orderID" name="orderID"/>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">輸入郵寄日期</h4>
                    </div>
                    <div class="modal-body">
                        <p>郵寄日期</p>
                        <div class="input-group col-xs-4">
                            <input class="form-control" name="date3" type="text" id="date3" onpropertychange="zzday();">
                            <a id="date3.onclick" class="input-group-addon" href="#">
                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                            </a>
                            <a id="date3.clear" class="input-group-addon btn bt-default clear-date" clear-target="input#date3" href="#">
                                <span class="glyphicon glyphicon-remove" title="移除" aria-hidden="true"></span>
                            </a> 
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary">存檔</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script type="text/javascript" src="/js/page08_order_search_list.js?<?php echo time();?>
"></script>


</body>
</html><?php }} ?>