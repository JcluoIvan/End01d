<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include "head.tpl"}}
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
