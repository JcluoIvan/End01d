<div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label> 參數設定 </label>
    </h3>
    <form id="option-form" acrion="?" method="post" target="update-iframe" class="form-horizontal" enctype="multipart/form-data">
        <input type='hidden' name='id' value='{{$setting->set001}}' />
        {{if $setting->set002 == 'BankAccount'}}
            <input type="hidden" id="setting-key" value="{{$setting->set002}}" />
            <div class="form-group">
                <label class="control-label col-xs-1">
                    銀行編號
                </label>
                <div class="col-xs-3">
                    <select name="bank_code" class="form-control">
                        {{html_options options=$codes selected=$bank.code}}
                    </select>
                </div>
                <div class="col-xs-2">
                    <input type="text" id="bank-code-filter" class="form-control" value="" placeholder="查詢銀行"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-1">
                    銀行帳號
                </label>
                <div class="col-xs-3">
                    <input type="text" name="bank_account" class="form-control" value="{{$bank.account}}"/>
                </div>
            </div>
        {{elseif $setting->set002 == 'EmailNotice'}}
            <input type="hidden" id="setting-key" value="{{$setting->set002}}" />
            <div class="form-group">
                <label class="control-label col-xs-1"> 寄送對象 </label>
                <div class="col-xs-7">
                    <input type="text" class="form-control" name="emails" value="{{$emails}}"/>
                </div>
                <div class="col-xs-4">
                    請用 ; 多個 email 的分隔符號
                </div>
            </div>
            <div class="form-group">
                <div class="checkbox col-xs-4 col-xs-offset-1">
                    <label>
                        <input type="checkbox" name="disabled" value="1" {{$disabled}}/> 停用此功能 
                    </label>
                </div>
            </div>
        {{else}}
            {{$setting->set002}}
        {{/if}}
        <button class="fade"></button>
    </form>
    <iframe id="update-iframe" name="update-iframe" class="hide"></iframe>
</div>