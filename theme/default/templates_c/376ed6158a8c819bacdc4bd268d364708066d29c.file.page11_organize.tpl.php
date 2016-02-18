<?php /* Smarty version Smarty-3.1.8, created on 2015-12-02 14:35:24
         compiled from "/home/www//theme/default/page11_organize.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2932339345620b51a44b5d9-74258378%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '376ed6158a8c819bacdc4bd268d364708066d29c' => 
    array (
      0 => '/home/www//theme/default/page11_organize.tpl',
      1 => 1446088127,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2932339345620b51a44b5d9-74258378',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5620b51a4cefa0_15877061',
  'variables' => 
  array (
    'backTitle' => 0,
    'title' => 0,
    'pid' => 0,
    'url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5620b51a4cefa0_15877061')) {function content_5620b51a4cefa0_15877061($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <link rel="stylesheet" type="text/css" href="/css/page11.css?<?php echo time();?>
" />
</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <?php if ($_smarty_tpl->tpl_vars['backTitle']->value){?>
                <li><a href="organize.php?sid=<?php echo $_GET['sid'];?>
" ><?php echo $_smarty_tpl->tpl_vars['backTitle']->value;?>
</a></li>
            <?php }?>
            <li class="active"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</li>
        </ol>
        <h3 class="title-bar"> 
            <label> 組織管理 - <?php echo $_smarty_tpl->tpl_vars['title']->value;?>
 </label>
        </h3>
        <div class="form-group">
            <form class="form-inline" id="form-search">
                <input type='hidden' name='pid' id='pid' value='<?php echo $_smarty_tpl->tpl_vars['pid']->value;?>
' />
                <input type='hidden' name='url' id='url' value='<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
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
        <div id="organize-list">
        </div>
    </div>
    <script type="text/javascript" src="/js/page11_organize.js?<?php echo time();?>
"></script>
    <script type="text/javascript" src="/js/googleMap.js"></script>
</body>
</html><?php }} ?>