<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include "head.tpl"}}
</head>
<body>
    <div class="col-xs-12">
        <div class="col-xs-8 col-xs-offset-2 well">
            <div> 
                您沒有此頁面的瀏覽權限！ 
                或是您的帳號已被登出，
                請 <a id="re-login" href="#">重新登入</a>。
            </div>
        </div>
    </div>
    <script>
        $('#re-login').bind('click', function() {
            window.top.location = '/';
        });
    </script>
</body>
</html>
