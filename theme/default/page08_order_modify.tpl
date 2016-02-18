

<div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label>修改訂貨記錄</label>
    </h3>
    <form id="option-form" acrion="?" class="modify form-horizontal">
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
            <label class="control-label col-xs-2"> 取貨序號 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$getNo}}" />
            </div>

            <label class="control-label col-xs-2"> 取貨日期 </label>
            <div class="col-xs-2">
                <span id='delivery.onclick'>
                    <input readonly class="form-control" name="delivery" type="text" id="delivery" onpropertychange="zzday();" value="{{$delivery}}" />
                </span>
            </div>
            <div class="col-xs-1">
                <button type="button" class="btn btn-primary" style="margin: 0px 2px;" onclick="cleanDelIvery();">清除</button>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2" col-xs-offset-1> 收款日期 </label>
            <div class="col-xs-2">
                <input readonly class="form-control" name="receivable" type="text" id="receivable" value="{{$receivable}}" />  
            </div>

            <label class="control-label col-xs-2"> 核帳日期 </label>
            <div class="col-xs-2">
                <input readonly class="form-control" name="signoff" type="text" id="signoff" value="{{$signoff}}" />
            </div>
            <!-- <input class="form-control" name="info" type="hidden" id="info" value="現金: {{$sum}} + 運費: {{$orderData->odm029}} - 使用購物金: {{$orderData->odm004}} - 退貨金: {{$orderData->odm032}} = 總金額: {{$correct_sum}} ，本次新增購物金: {{$shoppinggold}}" /> -->
            <input class="form-control" name="oid" type="hidden" id="oid" value="{{$orderData->odm001}}" />
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 送貨地址 </label>
            <div class="col-xs-8">
                <input readonly type="text" class="form-control" value="{{$address}}" />
            </div>
        </div>

        <div id="member-list-options" class="col-xs-12">
            <div id="member-grid"></div>
        </div>
    <!-- <button class="btn btn-primary" onclick="history.back();">返回</button> -->
    
    </form>
</div>
