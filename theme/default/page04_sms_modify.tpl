<div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label>發送簡訊通知 (SMS)</label>
    </h3>
    <form id="option-form" action="?" class="form-horizontal">
        <input type="hidden" name="id" value="{{$row->new001}}" />
        <input type="hidden" name="type" value="sms" />
        <input type="hidden" name="users" id="users" value="{{$row->new006}}" />
        <div class="col-xs-6">
            <div class="form-group">
                <label class="control-label col-xs-3"> 通知對象 </label>
                <div class="col-xs-6">
                    <select id="notice-for" name="notice_for" class="form-control">
                        {{html_options options=$notice_for selected=$row->new005}}
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3 required-field"> 內文 </label>
                <div class="col-xs-8">
                    <textarea class="form-control" name="content" >{{$row->new004}}</textarea>
                </div>
            </div>
        </div>
        <div id="member-list-options" class="col-xs-6 hide">
            <div class="form-group">
                <div class="col-xs-4">
                    <select id="query-type" class="form-control">
                        <option value="phone">手機</option>
                        <option value="name">姓名</option>
                    </select>
                </div>
                <div class="col-xs-6">
                    <input type="text" id="query-text" class="form-control" placeholder="查詢"/>
                </div>
                <button type="button" id="query-button" class="btn btn-default">查詢</button>
            </div>
            <div id="member-grid"></div>
        </div>
    </form>
</div>

