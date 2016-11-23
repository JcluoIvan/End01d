<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include 'head.tpl'}}
    <link rel="stylesheet" type="text/css" href="/css/page98.css" />
</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">個人資料修改</li>
        </ol>
        <h3 class="title-bar">
            <label>個人資料修改</label>
        </h3>
        <form id="save-form" method="post" class="form-horizontal">
            <div class="col-xs-8">
                <fieldset>
                    <legend>基本資料</legend>
                    <div class="form-group">
                        <label class="control-label col-xs-2">帳號</label>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" value="{{$agent->age004}}" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">姓名</label>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" value="{{$agent->age006}}" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">生日</label>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" value="{{$agent->dateFormat('age008')}}" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">手機</label>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" value="{{$agent->age012}}" readonly/>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>詳細資料</legend>
                    <div class="form-group">
                        <label class="control-label col-xs-2">地址</label>
                        <div class="col-xs-2">
                            <select class="form-control" id="country" name="country">
                                <option value="{{$country->pos001}}" selected>{{$country->pos004}}</option>
                            </select>
                        </div>
                        <div class="col-xs-2">
                            <select class="form-control" id="city" name="city">
                                <option value="{{$city->pos001}}" selected>{{$city->pos004}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-4 col-xs-offset-2">
                            <input type="text" class="form-control" name="address" value="{{$agent->age010}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">銀行代碼</label>
                        <div class="col-xs-3">
                            <select name="bank_code" class="form-control">
                                {{html_options options=$codes selected=$agent->age021}}
                            </select>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" id="bank-code-filter" class="form-control" value="" placeholder="查詢銀行"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">銀行帳號</label>
                        <div class="col-xs-3">
                            <input type="text" name="bank_account" class="form-control" value="{{$agent->age011}}" />
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>會員密碼修改</legend>
                    <div class="form-group">
                        <label class="control-label col-xs-2">原密碼</label>
                        <div class="col-xs-3">
                            <input type="password" class="form-control" name="source_password"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">新密碼</label>
                        <div class="col-xs-3">
                            <input type="password" class="form-control" name="new_password" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">密碼確認</label>
                        <div class="col-xs-3">
                            <input type="password" class="form-control" name="confirm_password" />
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>業務獎金密碼</legend>
                    <div class="form-group">
                        <label class="control-label col-xs-2">原密碼</label>
                        <div class="col-xs-3">
                            <input type="password" class="form-control" name="m_source_password"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">新密碼</label>
                        <div class="col-xs-3">
                            <input type="password" class="form-control" name="m_new_password" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">密碼確認</label>
                        <div class="col-xs-3">
                            <input type="password" class="form-control" name="m_confirm_password" />
                        </div>
                    </div>
                </fieldset>
                <div class="form-group">
                    <div class="col-xs-2 col-xs-offset-5">
                        <button type="submit" class="btn btn-primary btn-block"> 儲存 </button>
                    </div>
                </div>
            </div>
        </form>
        <script type="text/javascript" src="/js/page98_main.js?{{$smarty.now}}"></script>
    </div>
</body>
</html>