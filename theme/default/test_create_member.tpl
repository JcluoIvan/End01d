<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {{include 'head.tpl'}}
    </head>
<body>
    <form id="create-member-form" class="form-horizontal" action="/page/test/create_member.php?sid={{$smarty.get.sid}}" method="post">
        <fieldset>
            <legend>產生會員</legend>
            <div class="form-group">
                <label class="control-label col-xs-2">雷達站</label>
                <div class="col-xs-2">
                    <select class="form-control" name="rid">
                        {{html_options options=$agents selected=$smarty.get.rid}}
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-2">產生層級數</label>
                <div class="col-xs-2">
                    <select class="form-control" name="lv">
                        <option value="1">1 層</option>
                        <option value="2">2 層</option>
                        <option value="3">3 層</option>
                        <option value="4">4 層</option>
                        <option value="5">5 層</option>
                        <option value="6">6 層</option>
                        <option value="7">7 層</option>
                    </select>
                </div>
                <label class="control-label col-xs-2">各層級會員數</label>
                <div class="col-xs-2">
                    <select class="form-control" name="count">
                        <option value="1">1 名</option>
                        <option value="2">2 名</option>
                        <option value="3">3 名</option>
                    </select>
                </div>
            </div>   
        </fieldset>   
        <button id="create-btn" class="btn btn-primary col-xs-offset-4">Create </button>
    </form>
    <fieldset>
        <legend>下層會員結構</legend>
        <div cass="well">

            {{* define function@numberFormat , 數字格式的 function *}}
            {{function name=out}}
                <ul>
                    {{foreach from=$rows item=row}}
                        <li>
                            <label>{{$row.id}} - {{$row.name}} - {{$row.phone}} </label>
                            {{call out rows=$row.children}}
                        </li>
                    {{/foreach}}
                </ul>
            {{/function}}
        
            {{call out rows=$members}}

        </div>
    </fieldset>

    <script>
        (function(Endold) {

            $('#create-member-form').bind('submit', function(event) {
                event && event.preventDefault();
                var $this = $(this);
                var url = $this.attr('action');
                var data = $this.serialize();
                var total = $this.find('[name=lv]').val() * $this.find('[name=count]').val();
                var $btn = $('#create-btn');
                var strlen = 0;
                $.ajax(url, 
                    {
                        data: data, 
                        dataType: 'html', 
                        type: 'post',
                        xhrFields: {
                            onprogress: function(event) {
                                var msg = event.currentTarget.response.substr(strlen);
                                strlen += msg.length ;
                                $btn.html('執行 : ' + msg);
                            }
                        }
                    })
                    .done(function(response) {
                        // alert(response);
                        location.reload();
                    })
                    .fail(function(response) {
                        alert(response.responseText);
                    });
            });
            $('[name=rid]').bind('change', function() {
                location.href = Endold.linkTo('/page/test/create_member.php', {'rid': this.value});
            });
        })(parent.parent.Endold);
    </script>
</body>
</html>