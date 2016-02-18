<?php /* Smarty version Smarty-3.1.8, created on 2015-10-20 18:01:48
         compiled from "/home/www//theme/default/page01_leader.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20479375285626110c8b98e8-83335286%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2bc2cf1b80232813869cd80aee20148d1d5702fd' => 
    array (
      0 => '/home/www//theme/default/page01_leader.tpl',
      1 => 1440987444,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20479375285626110c8b98e8-83335286',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5626110c9078b9_42311880',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5626110c9078b9_42311880')) {function content_5626110c9078b9_42311880($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">專業經理人</li>
        </ol>
        <h3 class="title-bar"> 
            <label> 組織管理(非組織線) - 專業經理人 </label>
        </h3>
        <div class="form-group">
            <form class="form-inline" id="form-search">
                <label>搜尋</label>
                <select class="form-control" name="lvKind" id='lv-kind'>
                    <option value="leader">專業經理人</option>
                    <option value="radar">展示中心</option>
                    <option value="member">會員</option>
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
        <div id="leader-list">
        </div>
    </div>
    <script type="text/javascript" src="/js/page01_leader.js?<?php echo time();?>
"></script>
</body>
</html><?php }} ?>