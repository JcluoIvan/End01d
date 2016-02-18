
<div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label>換貨單明細</label>
    </h3>
    <form id="option-form" acrion="?" class="swapC form-horizontal">
        <input type="hidden" name="oid" value="{{$swap['oid']}}" />
        <input type="hidden" name="mname" value="{{$order['name']}}" />
        <input type="hidden" name="mid" value="{{$swap['mid']}}" />
        <input type="hidden" name="lv2" value="{{$swap['aid']}}" />
        <input type="hidden" name="money" value="{{$swap['money']}}" />
        <input type="hidden" name="address" value="{{$swap['address']}}" />
        <input type="hidden" name="keyman" value="{{$swap['keyman']}}" />
        <input type="hidden" name="pid" value="{{$swap['pid']}}" />
        <div class="form-group">
            <label class="control-label col-xs-2"> 訂貨人名稱 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$order['name']}}" />
            </div>

            <label class="control-label col-xs-2"> 會員編號 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$mem['no']}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 訂單編號 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$order['oid']}}" />
            </div>

            <label class="control-label col-xs-2"> 換貨單編號 </label>
            <div class="col-xs-2">
                <input readonly type="text" name="sNO" id="sNO" class="form-control" value="{{$swap['sNO']}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 換款帳號 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$acc}}" />
            </div>

            <label class="control-label col-xs-2"> 換貨商品 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$pname}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 退貨數量 </label>
            <div class="col-xs-2">
                <input readonly name="amount" id="amount" type="text" class="form-control" value="{{$swap['amount']}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 退貨原因 </label>
            <div class="col-xs-6">
                <textarea class="form-control" name="reason" id="reason" cols="45" rows="5">{{$swap['reason']}}</textarea>
            </div>
        </div>
    <!-- <button class="btn btn-primary" onclick="history.back();">返回</button> -->
    </form>
</div>
