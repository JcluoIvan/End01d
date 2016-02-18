<div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label>修改訂貨單 [{{$orderData->odm002}}] </label>
    </h3>
    <form id="option-form" method="post" class="modify form-horizontal" target="iframe-save" enctype="multipart/form-data">
        <input name="sn" type="hidden" id="sn" value="{{$orderData->odm001}}" />
        <div class="form-group">
            <label class="control-label col-xs-2"> 會員編號 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$memberData->mem002}}" />
            </div>

            <label class="control-label col-xs-2"> 訂貨人 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$orderData->odm014}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 聯絡電話 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$orderData->odm015}}" />
            </div>

            <label class="control-label col-xs-2"> 取貨方式 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$getMethods}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> {{$get_No}} </label>
            <div class="col-xs-2">
                <input type="text" name="getno" class="form-control" value="{{$getNo}}" />
            </div>

            <label class="control-label col-xs-2 "> {{$get_Date}} </label>
            <div class="col-xs-3">
                <div class="input-group">
                    <input class="form-control" name="delivery" type="text" id="delivery" onpropertychange="zzday();" value="{{$delivery}}" />
                    <a id="delivery.onclick" class="input-group-addon" class="btn bt-default" href="#">
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                    </a>
                    <a id="delivery.clear" class="input-group-addon btn bt-default clear-date" clear-target="input#delivery" href="#">
                        <span class="glyphicon glyphicon-remove" title="移除" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2" > 收款日期 </label>
            <div class="col-xs-3">
                <div class="input-group">
                    <input class="form-control" name="receivable" type="text" id="receivable" onpropertychange="zzday();" value="{{$receivable}}" />
                    <a id="receivable.onclick" class="input-group-addon" class="btn bt-default" href="#">
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                    </a>
                    <a id="receivable.clear" class="input-group-addon btn bt-default clear-date" href="#" clear-target="input#receivable">
                        <span class="glyphicon glyphicon-remove" title="移除" aria-hidden="true"></span>
                    </a>
                </div>
            </div>

            <label class="control-label col-xs-1" col-xs-offset-1> 核帳日期 </label>
            <div class="col-xs-3">
                <div class="input-group">
                    <input class="form-control" name="signoff" type="text" id="signoff" onpropertychange="zzday();" value="{{$signoff}}" />
                    <a id="signoff.onclick" class="input-group-addon btn bt-default" href="#">
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                    </a>
                    <a id="signoff.clear" class="input-group-addon btn bt-default clear-date" href="#" clear-target="input#signoff">
                        <span class="glyphicon glyphicon-remove" title="移除" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
            <input class="form-control" name="info" type="hidden" id="info" value="現金: {{$sum}} + 運費: {{$orderData->odm029}} - 使用購物金: {{$orderData->odm004}} - 退貨金: {{$orderData->odm032}} = 總金額: {{$correct_sum}} ，本次新增購物金: {{$shoppinggold}}" />
            <input class="form-control" name="oid" type="hidden" id="oid" value="{{$orderData->odm001}}" />
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 送貨地址 </label>
            <div class="col-xs-8">
                <input readonly type="text" class="form-control" value="{{$address}}" />
            </div>
        </div>

        <!-- 產品圖片 -->
        <div class="form-group">
            <label class="control-label col-xs-2"> 電子發票 </label>
            <div class="col-xs-2">
                <div class="input-group">
                    {{if $photo->rec001}} 
                        <a id="receipt-wrapper" class="form-control" href="{{$photo->getImageUrl()}}" target="_blank"> 
                            發票 
                            <img id="receipt-image" src="{{$photo->getMinImageUrl()}}" />
                        </a>
                        <a id="remove-receipt-image" class="input-group-addon" href="#" rid="{{$photo->rec001}}">
                            <span class="glyphicon glyphicon-remove" title="移除" aria-hidden="true"></span>
                        </a>
                    {{else}}
                        <label class="form-control"> 未上傳發票 </label>
                    {{/if}}
                </div>
            </div>
            <div class="col-xs-3">
                <input type="file" name="files[receipt][]" class="form-control"/>
            </div>
        </div>

        <div id="member-list-options" class="col-xs-12">
            <div id="member-grid"></div>
        </div>
    <!-- <button class="btn btn-primary" onclick="history.back();">返回</button> -->
    
    </form>
    <iframe id="iframe-save" name="iframe-save" style='display:none;'></iframe>
</div>

