<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include "head.tpl"}}
    <link rel="stylesheet" type="text/css" href="/css/page10.css?{{$smarty.now}}" />
</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">會員</li>
        </ol>
        <h3 class="title-bar"> 
            <label> 組織管理(非組織線) - 會員 </label>
        </h3>
        <div class="form-group">
            <form class="form-inline" id="form-search">
                <label>搜尋</label>
                <select class="form-control" name="lvKind" id='lv-kind'>
                    <option value="member">會員</option>
                    <option value="leader">專業經理人</option>
                    <option value="radar">展示中心</option>
                </select>
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
        <div id="member-list"></div>
    </div>

    <div id="demo-modal" class="modal fade">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id='my-friends' src=''></iframe>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script type="text/javascript" src="/js/page10_member.js?{{$smarty.now}}"></script>
</body>
</html>