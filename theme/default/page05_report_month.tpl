<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include "head.tpl"}}
    <link rel="stylesheet" type="text/css" href="/css/page05.css" />
</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">統計報表 - 月報表</li>
        </ol>
        <h3 class="title-bar"> 
            <label> 月報表 </label>
        </h3>
        <div class="form-group">
            <form class="form-inline" id="form-search">
                <input type='hidden' name='kind' id='kind' value='month' />
                <label>交易日期</label>
                <div class="form-group">
                    {{html_options name=year id='year' class='form-control' options=$year_ary}}
                </div>
                <div class="form-group">
                    {{html_options name=month id='month' class='form-control' options=$month_ary selected=$month}}
                </div>
                <button type="button" id="search-btn" class="btn btn-default">查詢</button>
                <button class='btn btn-primary' href='#' id='print'>列印</button>

                <div id="option-bar" class="pull-right"></div>
            </form>
        </div>

        <div id="option-main" ></div>
        <div id="report-month-list">
        </div>
    </div>
    <script type="text/javascript" src="/js/page05_report_month.js?{{$smarty.now}}"></script>
</body>
</html>