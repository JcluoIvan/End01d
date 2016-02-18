

<div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label>退貨單明細</label>
    </h3>
    <form id="option-form" acrion="?" class="rejectC form-horizontal">
        <input type="hidden" name="oid" value="{{$reject['oid']}}" />
        <input type="hidden" name="mname" value="{{$order['name']}}" />
        <input type="hidden" name="mid" value="{{$reject['mid']}}" />
        <input type="hidden" name="lv2" value="{{$reject['aid']}}" />
        <input type="hidden" name="money" value="{{$reject['money']}}" />
        <input type="hidden" name="address" value="{{$reject['address']}}" />
        <input type="hidden" name="keyman" value="{{$reject['keyman']}}" />
        <input type="hidden" name="pid" value="{{$reject['pid']}}" />
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

            <label class="control-label col-xs-2"> 退貨單編號 </label>
            <div class="col-xs-2">
                <input readonly type="text" name="rNO" id="rNO" class="form-control" value="{{$reject['rNO']}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 退款帳號 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$acc}}" />
            </div>

            <label class="control-label col-xs-2"> 退貨商品 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$pname}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 退貨數量 </label>
            <div class="col-xs-2">
                <input readonly name="amount" id="amount" type="text" class="form-control" value="{{$reject['amount']}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 退貨原因 </label>
            <div class="col-xs-6">
                <textarea class="form-control" name="reason" id="reason" cols="45" rows="5">{{$reject['reason']}}</textarea>
            </div>
        </div>
    <!-- <button class="btn btn-primary" onclick="history.back();">返回</button> -->
    </form>
</div>
