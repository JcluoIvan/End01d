<?php /* Smarty version Smarty-3.1.8, created on 2015-12-23 10:58:54
         compiled from "/home/www//theme/default/page11_organize_member.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1056672730567a0dee9c6465-19090722%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7b3b77d67e89a7ad6740a7747731237c022891e4' => 
    array (
      0 => '/home/www//theme/default/page11_organize_member.tpl',
      1 => 1442369631,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1056672730567a0dee9c6465-19090722',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'lid' => 0,
    'title' => 0,
    'pid' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_567a0deea4dc44_80407729',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567a0deea4dc44_80407729')) {function content_567a0deea4dc44_80407729($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <link rel="stylesheet" type="text/css" href="/css/page01.css?<?php echo time();?>
" />
</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="organize.php?sid=<?php echo $_GET['sid'];?>
">專業經理人</a></li>
            <li><a href="organize.php?sid=<?php echo $_GET['sid'];?>
&lid=<?php echo $_smarty_tpl->tpl_vars['lid']->value;?>
">展示中心</a></li>
            <li class="active"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</li>
        </ol>
        <h3 class="title-bar"> 
            <label> 組織管理 - <?php echo $_smarty_tpl->tpl_vars['title']->value;?>
 </label>
        </h3>
        <div class="form-group">
            <form class="form-inline" id="form-search">
                <input type='hidden' name='lid' id='lid' value='<?php echo $_smarty_tpl->tpl_vars['lid']->value;?>
' />
                <input type='hidden' name='pid' id='pid' value='<?php echo $_smarty_tpl->tpl_vars['pid']->value;?>
' />

                <label>搜尋</label>
                <select class="form-control" name="searchKind">
                    <option value="phone">手機</option>
                    <option value="no">編號</option>
                    <option value="name">名稱</option>
                </select>
                <input type="text" name="search"  class="form-control">
                <button type="button" id="search-btn" class="btn btn-default">查詢</button>
                <div id="option-bar" class="pull-right"></div>
            </form>
        </div>

        <div id="option-main" ></div>
        <div id="organize_member-list">
        </div>
    </div>
    <div id="demo-modal" class="modal fade">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id='my-friends' src=''></iframe>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script type="text/javascript" src="/js/page11_organize_member.js?<?php echo time();?>
"></script>
</body>
</html><?php }} ?>