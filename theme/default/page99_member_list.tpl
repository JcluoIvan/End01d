<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {{include 'head.tpl'}}
        <!-- <link rel="stylesheet" type="text/css" href="/css/page04.css" /> -->
    </head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="/page/page99/member.php?sid={{$smarty.get.sid}}">部門、組織操作記錄</a></li>
            <li class="active">[ {{$member->mem005}} ] 資料修改歷程</li>
        </ol>
        <h3 class="title-bar"> 
            <div id="option-bar" class="pull-right"></div>
            <label>[ {{$member->mem005}} ] 資料修改歷程</label>
        </h3>
        <div id="option-main" ></div>
        <div id="member-list">
        </div>
    </div>
    <form id="member-log" method="post">
        <input type="hidden" name="mid" value="{{$member->mem001}}" />
    </form>
    <script type="text/javascript" src="/js/page99_member_list.js?{{$smarty.now}}"></script>

</body>
</html>