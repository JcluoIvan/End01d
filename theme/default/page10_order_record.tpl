<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include "head.tpl"}}
</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">會員購買紀錄</li>
        </ol>
        <h3 class="title-bar"> 
            <label> 會員購買紀錄 </label>
        </h3>
        <div class="form-group">
            <form class="form-inline" id="option-form-search">
                <div class = 'has-warning'>
                    <input type="hidden" name="id"  class="form-control" value="{{$member->mem001}}" />
                    <label class='control-label'>會員編號:</label>
                    <input type="text" name="no"  class="form-control" readonly value="{{$member->mem002}}" />
                    <label class='control-label'>會員名稱:</label>
                    <input type="text" name="name"  class="form-control" readonly value="{{$member->mem005}}" />
                </div>
            </form>
        </div>
        <div id="order-record-list">
        </div>
    </div>
</body>
</html>