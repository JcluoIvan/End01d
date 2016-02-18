<?php /* Smarty version Smarty-3.1.8, created on 2015-10-16 11:50:58
         compiled from "/home/www//theme/default/ifr_main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:46909938456207422027662-22498823%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0768aaf00fe4dc6fa309d30911883b9c28d1a836' => 
    array (
      0 => '/home/www//theme/default/ifr_main.tpl',
      1 => 1440987444,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '46909938456207422027662-22498823',
  'function' => 
  array (
    'mainIframe' => 
    array (
      'parameter' => 
      array (
      ),
      'compiled' => '',
    ),
  ),
  'variables' => 
  array (
    'url' => 0,
    'filepath' => 0,
    'rightMain' => 0,
  ),
  'has_nocache_code' => 0,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_562074220c1b49_91076780',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_562074220c1b49_91076780')) {function content_562074220c1b49_91076780($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


    
    <?php if (!function_exists('smarty_template_function_mainIframe')) {
    function smarty_template_function_mainIframe($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['mainIframe']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
        <?php if ($_smarty_tpl->tpl_vars['url']->value){?> 
           <iframe 
                name="ifr-right" 
                width="100%" 
                height="100%" 
                frameborder="false"
                src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
?sid=<?php echo $_GET['sid'];?>
">
            </iframe>
        <?php }?>
    <?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;}}?>

    <style>
        body { height: 100%; }
    </style>
</head>
    
    <?php if (isset($_smarty_tpl->tpl_vars['filepath']->value)){?>
        <div id="left-menu" class="col-xs-2">
            <?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['filepath']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        </div>
        <div class="col-xs-10">
            <?php smarty_template_function_mainIframe($_smarty_tpl,array('url'=>$_smarty_tpl->tpl_vars['rightMain']->value));?>

        </div>
    <?php }else{ ?>
        <div class="col-xs-12">
            <?php smarty_template_function_mainIframe($_smarty_tpl,array('url'=>$_smarty_tpl->tpl_vars['rightMain']->value));?>

        </div>
    <?php }?>
    <script type="text/javascript" src="/js/ifr_main.js?<?php echo time();?>
"></script>
</html><?php }} ?>