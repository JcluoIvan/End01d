<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include "head.tpl"}}
</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">黑名單</li>
        </ol>
        <h3 class="title-bar"> 
            <label> 黑名單 </label>
        </h3>
        <div class="form-group">
            <form class="form-inline" id="form-search">

                <label>搜尋</label>
                <select class="form-control" name="searchKind">
                    <option value="no">會員編號</option>
                    <option value="name">會員名稱</option>
                    <option value="phone">會員手機</option>
                </select>
                <input type="text" name="search"  class="form-control">
                <button type="button" id="search-btn" class="btn btn-default">查詢</button>

            </form>
        </div>
        <div id="blacklist-list">
        </div>
    </div>
    <script type="text/javascript" src="/js/page01_blacklist.js?{{$smarty.now}}"></script>
</body>
</html>