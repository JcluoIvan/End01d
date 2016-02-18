<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {{include 'head.tpl'}}
        <link rel="stylesheet" type="text/css" href="/css/page04.css" />
    </head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="/page/page99/agent.php?sid={{$smarty.get.sid}}">部門、組織操作記錄</a></li>
            <li class="active">[ {{$agent->age006}} ] 資料修改歷程</li>
        </ol>
        <h3 class="title-bar"> 
            <div id="option-bar" class="pull-right"></div>
            <label>[ {{$agent->age006}} ] 資料修改歷程</label>
        </h3>
        <div id="option-main" ></div>
        <div id="news-list">
        </div>
    </div>
    <form id="agent-log" method="post">
        <input type="hidden" name="aid" value="{{$agent->age001}}" />
    </form>
    <script type="text/javascript" src="/js/page99_agent_list.js?{{$smarty.now}}"></script>

</body>
</html>