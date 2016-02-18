
    <div class="col-xs-12">
        <h3 class="sub-title-bar"> 
            <label>換貨單明細</label>
        </h3>
        <div class="swapC form-horizontal">

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
                    <input readonly type="text" name="sNO" id="sNO" class="form-control" value="{{$swap['sNO']}}" readonly />
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
                    <input readonly name="amount" id="amount" type="number" class="form-control" value="{{$swap['amount']}}" />
                </div>

                <label class="control-label col-xs-2"> 建立日期 </label>
                <div class="col-xs-2">
                    <input readonly class="form-control" type="text"  value="{{$dRecord}}" />
                </div>

                
            </div>

            <div class="form-group">
                <label class="control-label col-xs-2"> 換貨原因 </label>
                <div class="col-xs-6">
                    <textarea readonly class="form-control" name="reason" id="reason" cols="45" rows="5">{{$swap['reason']}}</textarea>
                </div>
            </div>
        <!-- <button class="btn btn-primary" onclick="history.back();">返回</button> -->
        </div>
    </div>
