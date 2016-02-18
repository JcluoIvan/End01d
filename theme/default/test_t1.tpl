
{{include 'head.tpl'}}
<button id="reload" type="btn btn-defualt"> Reload</button>
<pre id="response"></pre>

<script>

    var cmd = 107;
    var data = {
        id: 3
    };




    var $pre = $('pre#response');
    var Endold = parent.parent.Endold;
    function ajax() {
        Endold.post(cmd, data, {site: 1})
            .done(function(response) {
                try {
                    $pre.html(JSON.stringify(response));
                } catch (e) {
                    $pre.html(response.toString());
                }
            });
    }
    $('button#reload').bind('click', ajax);
</script>