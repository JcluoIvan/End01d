<?php /* Smarty version Smarty-3.1.8, created on 2015-11-24 14:35:55
         compiled from "/home/www//theme/default/page10_leader.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8989346135654054bb08b70-58985826%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1b58f0f4cd48c009e30d498c11dc26207900a76e' => 
    array (
      0 => '/home/www//theme/default/page10_leader.tpl',
      1 => 1440987452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8989346135654054bb08b70-58985826',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5654054bb5b341_88754158',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5654054bb5b341_88754158')) {function content_5654054bb5b341_88754158($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
    <script type="text/javascript" src="/js/page10_leader.js?<?php echo time();?>
"></script>
</body>
</html><?php }} ?>