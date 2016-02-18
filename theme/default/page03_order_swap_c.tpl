
<div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label>修改換貨單</label>
    </h3>
    <form id="option-form" acrion="?" class="swapC form-horizontal">
        <input type="hidden" name="oid" value="{{$swap['oid']}}" />
        <input type="hidden" name="mname" value="{{$orderData->odm014}}" />
        <input type="hidden" name="mid" value="{{$swap['mid']}}" />
        <input type="hidden" name="lv2" value="{{$swap['aid']}}" />
        <input type="hidden" name="money" value="{{$swap['money']}}" />
        <input type="hidden" name="address" value="{{$swap['address']}}" />
        <input type="hidden" name="keyman" value="{{$swap['keyman']}}" />
        <input type="hidden" name="pid" value="{{$swap['pid']}}" />

        <div class="form-group">
            <label class="control-label col-xs-2"> 訂貨人名稱 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$orderData->odm014}}" />
            </div>

            <label class="control-label col-xs-2"> 會員編號 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$mno}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 訂單編號 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$oorder['oid']}}" />
            </div>

            <label class="control-label col-xs-2"> 換貨單編號 </label>
            <div class="col-xs-2">
                <input type="text" name="sNO" id="sNO" class="form-control" value="{{$swap['sNO']}}" readonly />
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
            <label class="control-label col-xs-2"> 換貨數量 </label>
            <div class="col-xs-2">
                <input name="amount" id="amount" type="number" class="form-control" value="{{$swap['amount']}}" />
            </div>

            <label class="control-label col-xs-2"> 建立日期 </label>
            <div class="col-xs-2">
                <div class="input-group">
                    <input class="form-control" name="signoff" type="text" id="signoff" onpropertychange="zzday();" value="{{$dRecord}}" />
                    <a id="signoff.onclick" class="input-group-addon btn bt-default" href="#">
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                    </a>
                    <!-- 
                    <a id="signoff.clear" class="input-group-addon btn bt-default clear-date" href="#" clear-target="input#signoff">
                        <span class="glyphicon glyphicon-remove" title="移除" aria-hidden="true"></span>
                    </a>
                     -->
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 換貨日期 </label>
            <div class="col-xs-2">
                <div class="input-group">
                    <input class="form-control" name="swapdate" type="text" id="swapdate" onpropertychange="zzday();" value="{{$sRecord}}" />
                    <a id="swapdate.onclick" class="input-group-addon btn bt-default" href="#">
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 換貨原因 </label>
            <div class="col-xs-6">
                <textarea class="form-control" name="reason" id="reason" cols="45" rows="5">{{$swap['reason']}}</textarea>
            </div>
        </div>
    <!-- <button class="btn btn-primary" onclick="history.back();">返回</button> -->
    </form>
</div>

