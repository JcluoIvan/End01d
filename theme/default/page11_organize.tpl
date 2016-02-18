<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include "head.tpl"}}
    <link rel="stylesheet" type="text/css" href="/css/page11.css?{{$smarty.now}}" />
</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            {{if $backTitle}}
                <li><a href="organize.php?sid={{$smarty.get.sid}}" >{{$backTitle}}</a></li>
            {{/if}}
            <li class="active">{{$title}}</li>
        </ol>
        <h3 class="title-bar"> 
            <label> 組織管理 - {{$title}} </label>
        </h3>
        <div class="form-group">
            <form class="form-inline" id="form-search">
                <input type='hidden' name='pid' id='pid' value='{{$pid}}' />
                <input type='hidden' name='url' id='url' value='{{$url}}' />

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
    <script type="text/javascript" src="/js/page11_organize.js?{{$smarty.now}}"></script>
    <script type="text/javascript" src="/js/googleMap.js"></script>
</body>
</html>