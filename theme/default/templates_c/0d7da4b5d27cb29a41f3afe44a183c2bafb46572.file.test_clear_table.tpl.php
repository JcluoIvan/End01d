<?php /* Smarty version Smarty-3.1.8, created on 2015-11-04 13:15:30
         compiled from "/home/www//theme/default/test_clear_table.tpl" */ ?>
<?php /*%%SmartyHeaderCode:252326396563994723d27e2-14413953%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0d7da4b5d27cb29a41f3afe44a183c2bafb46572' => 
    array (
      0 => '/home/www//theme/default/test_clear_table.tpl',
      1 => 1440987455,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '252326396563994723d27e2-14413953',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_563994724075d0_43608260',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_563994724075d0_43608260')) {function content_563994724075d0_43608260($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</head>
<body>
    <fieldset>
        <legend> 清空資料表 </legend>
        <button id="clear-table" class="btn btn-default">執行</button>
        <hr/>
        <pre id="response-message"></pre>
    </fieldset>
    <iframe id="execute-response" class="hide"></iframe>
    <script>
        (function(Endold) {

            var $clear = $('#clear-table');
            var $iframe = $('#execute-response');
            var $pre = $('#response-message');


            var app = {
                init: function() {

                    /* bind events */
                    $clear.bind('click', app.onload);
                },
                onload: function() {
                    $pre.html('');
                    $clear.prop('disabled', true)
                        .data('text-cache', $clear.text())
                        .text('執行...');
                    $iframe
                        .attr('src', Endold.linkTo('/page/test/do_clear_table.php'));
                },
                onresponse: function(text) {
                    $pre.append(' > ' + text + '\n');
                },
                onsuccess: function() {
                    app.onresponse('完成...')
                    $clear.prop('disabled', false)
                        .text($clear.data('text-cache'));
                }

            };

            app.init();
            window.ClearApp = app;
        })(top.Endold);

    </script>


</body>
</html>
<?php }} ?>