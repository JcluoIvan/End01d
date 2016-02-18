<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include "head.tpl"}}
</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">購買紀錄</li>
        </ol>
        <h3 class="title-bar"> 
            <label> 購買紀錄 </label>
        </h3>
        <form class="form-horizontal" id="form-search">
            <div class="form-group">
                <label class="col-xs-1 control-label">搜尋</label>
                <div class="col-xs-2">
                    <select class="form-control" name="is_verification">
                        <option value="all">全部</option>
                        <option value="verification">核帳</option>
                        <option value="not_verification">未核帳</option>
                    </select>
                </div>
                <div class="col-xs-2">
                    <select class="form-control" name="searchKind">
                        <option value="phone">會員手機</option>
                        <option value="no">會員編號</option>
                    </select>
                </div>
                <div class="col-xs-2">
                    <input type="text" name="search"  class="form-control">
                </div>
                <div class="col-xs-2">
                    <button type="button" id="search-btn" class="btn btn-default">查詢</button>
                </div>
            </div>

            <div id="option-bar" class="pull-right"></div>

            <div class="form-group has-warning">
                <label class='col-xs-1 control-label'>會員編號:</label>
                <div class="col-xs-2">
                    <input type="text" id="no-return"  class="form-control" readonly />
                </div>
                <label class='col-xs-1 control-label'>會員名稱:</label>
                <div class="col-xs-2">
                    <input type="text" id="name-return"  class="form-control" readonly />
                </div>
                <label class='col-xs-1 control-label'>會員手機:</label>
                <div class="col-xs-2">
                    <input type="text" id="phone-return"  class="form-control" readonly />
                </div>
            </div>
        </form>

        <div id="option-main"></div>
        <div id="report-buy-list">
        </div>
    </div>
    <script type="text/javascript" src="/js/page05_report_buy.js?{{$smarty.now}}"></script>
</body>
</html>