<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include "head.tpl"}}
</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">業務獎金查詢</li>
        </ol>
        <h3 class="title-bar">
            <label>展示中心專區 - 業務獎金查詢</label>
        </h3>
        <form action="?sid={{$sid}}" class="form-horizontal well" method="post">
            <div class="form-group">
                <div class="col-xs-4">
                    <label>請輸入密碼</label>
                    <input type="password" name="password" class="form-control" />
                </div>
                <div class="col-xs-8">
                    <div><label>&nbsp;</label></div>
                    <button class="btn btn-default">確定</button>
                </div>
            </div>
        </form>
        {{if $message}}
            <div class="alert alert-danger" role="alert">{{$message}}</div>
        {{/if}}
    </div>
</body>
</html>
