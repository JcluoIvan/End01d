<?php /* Smarty version Smarty-3.1.8, created on 2015-10-16 11:50:52
         compiled from "/home/www//theme/default/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21361426965620741c4cf698-13316748%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '087ca20fff7ae6b08ddeda1b469c7c2c5b1822eb' => 
    array (
      0 => '/home/www//theme/default/header.tpl',
      1 => 1440987443,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21361426965620741c4cf698-13316748',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pages' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5620741c542206_75172128',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5620741c542206_75172128')) {function content_5620741c542206_75172128($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</head>
    <body id="header">
        <header class="navbar navbar-static-top bs-docs-nav" id="top" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/page/home/main.php" target="ifr-right">Endold</a>
                </div>
                <nav class="collapse navbar-collapse bs-navbar-collapse">
                    <ul class="nav navbar-nav">
                        <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['pages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                            <li>
                                <a class="list-group-item" href="<?php echo $_smarty_tpl->tpl_vars['row']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['label'];?>
</a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </header>
        <script type="text/javascript" src="/js/header.js?<?php echo time();?>
"></script>
    </body>
</html>
<?php }} ?>