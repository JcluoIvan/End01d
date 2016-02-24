<div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label>取貨記錄</label>
    </h3>
    <form id="option-form" acrion="?" class="swapC form-horizontal">
        <input class="form-control" name="info" type="hidden" id="info" value="現金: {{$sum}} + 運費: {{$orderData->odm029}} - 使用購物金: {{$orderData->odm004}} - 退貨金: {{$orderData->odm032}} = 總金額: {{$correct_sum}} ，本次新增購物金: {{$shoppinggold}}" />
        <input class="form-control" name="oid" type="hidden" id="oid" value="{{$orderData->odm001}}" />

        <div class="form-group">
            <label class="control-label col-xs-1"> 會員編號 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$memberData->mem002}}" />
            </div>

            <label class="control-label col-xs-1"> 訂貨人 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$orderData->odm014}}" />
            </div>
            <label class="control-label col-xs-1"> 聯絡電話 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$orderData->odm015}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 發票類型 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$invoice}}" />
            </div>

            <label class="control-label col-xs-2"> 統一編號 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$orderData->odm019}}" />
            </div>
            <label class="control-label col-xs-2"> 發票抬頭 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$orderData->odm020}}" />
            </div>  
        </div>

        <div class="form-group">

            <label class="control-label col-xs-1"> 取貨方式 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$getMethods}}" />
            </div>
            <label class="control-label col-xs-1"> 送貨地址 </label>
            <div class="col-xs-5">
                <input readonly type="text" class="form-control" value="{{$address}}" />
            </div>
        </div>

        <div id="member-list-options" class="col-xs-12">
            <div id="member-grid"></div>
        </div>
    </form>
    <!-- <button class="btn btn-primary" onclick="history.back();">返回</button> -->
</div>
