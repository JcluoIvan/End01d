<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include "head.tpl"}}
</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="member.php?sid={{$smarty.get.sid}}">會員</a></li>
            <li class="active">客服記錄</li>
        </ol>
        <h3 class="title-bar"> 
            <label> 客服記錄 </label>
        </h3>
        <div class="form-group">
            <form class="form-inline" id="form-search">
                <input type='hidden' name='mid' id='mid' value='{{$mid}}' />
                <div id="option-bar" class="pull-right"></div>
                <div class = 'has-warning'>
                    <input type="hidden" name="id"  class="form-control" value="{{$member->mem001}}" />
                    <label class='control-label'>會員編號:</label>
                    <input type="text" id="no-return"  class="form-control" readonly />
                    <label class='control-label'>會員名稱:</label>
                    <input type="text" id="name-return"  class="form-control" readonly />
                    <label class='control-label'>會員手機:</label>
                    <input type="text" id="phone-return"  class="form-control" readonly />
                </div>
            </form>
        </div>
        <div id="option-main" ></div>
        <div id="dialogue-list">
        </div>
    </div>
    <script type="text/javascript" src="/js/page10_dialogue.js?{{$smarty.now}}"></script>
</body>
</html>