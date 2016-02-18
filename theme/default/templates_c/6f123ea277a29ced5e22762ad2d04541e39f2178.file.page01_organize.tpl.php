<?php /* Smarty version Smarty-3.1.8, created on 2015-10-28 15:25:49
         compiled from "/home/www//theme/default/page01_organize.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14795274835626110531d5d8-43561503%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6f123ea277a29ced5e22762ad2d04541e39f2178' => 
    array (
      0 => '/home/www//theme/default/page01_organize.tpl',
      1 => 1446016685,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14795274835626110531d5d8-43561503',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_562611053b4fe4_61295645',
  'variables' => 
  array (
    'backTitle' => 0,
    'title' => 0,
    'pid' => 0,
    'url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_562611053b4fe4_61295645')) {function content_562611053b4fe4_61295645($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <link rel="stylesheet" type="text/css" href="/css/page01.css?<?php echo time();?>
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
    <script type="text/javascript" src="/js/page01_organize.js?<?php echo time();?>
"></script>
    <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACyFjdFEpjuvl41hQ4biMXlOEeEPxUaXQ&callback=initMap"> </script>-->
    <script type="text/javascript" src="/js/googleMap.js"></script>
</body>
</html><?php }} ?>