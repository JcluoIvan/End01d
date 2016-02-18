<?php /* Smarty version Smarty-3.1.8, created on 2015-11-24 14:38:19
         compiled from "/home/www//theme/default/page10_member.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1350663299565405db05b568-76925411%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aab8d35a309bbb91e17af59bff3eb9ae4290cd33' => 
    array (
      0 => '/home/www//theme/default/page10_member.tpl',
      1 => 1440987452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1350663299565405db05b568-76925411',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_565405db0abdc8_35381401',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_565405db0abdc8_35381401')) {function content_565405db0abdc8_35381401($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <link rel="stylesheet" type="text/css" href="/css/page10.css?<?php echo time();?>
" />
</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">會員</li>
        </ol>
        <h3 class="title-bar"> 
            <label> 組織管理(非組織線) - 會員 </label>
        </h3>
        <div class="form-group">
            <form class="form-inline" id="form-search">
                <label>搜尋</label>
                <select class="form-control" name="lvKind" id='lv-kind'>
                    <option value="member">會員</option>
                    <option value="leader">專業經理人</option>
                    <option value="radar">展示中心</option>
                </select>
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
        <div id="member-list"></div>
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
    <script type="text/javascript" src="/js/page10_member.js?<?php echo time();?>
"></script>
</body>
</html><?php }} ?>