<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {{include 'head.tpl'}}
        <!-- <link rel="stylesheet" type="text/css" href="/css/page99.css" /> -->
    </head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">部門、組織操作記錄</li>
        </ol>
        <h3 class="title-bar"> 
            <label>部門、組織操作記錄</label>
        </h3>
        <form class="form-inline search-form">
            <div id="option-bar" class="pull-right"></div>
            <div class="form-group">
                <label> 帳號類型 </label>
                <select name="type" class="form-control">
                    {{html_options options=$type_options selected=$smarty.post.type|default:''}}
                </select>
            </div>
            <div class="form-group">
                <label> 帳號 / 姓名 </label>
                <div class="input-group">
                    <input type="text" name="query" class="form-control" value="{{$smarty.post.query|default:''}}" />
                    <a id="clear-query" class="input-group-addon" href="#">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
            <button type="submit" class="btn btn-default">查詢</button>
        </form>
        <div id="option-main" ></div>
        <div id="log-list">
        </div>
    </div>
    <script type="text/javascript" src="/js/page99_agent.js?{{$smarty.now}}"></script>
</body>
</html>