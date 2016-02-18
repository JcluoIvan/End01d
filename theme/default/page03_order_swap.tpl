<div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label>新增換貨單</label>
    </h3>
    <form id="option-form" acrion="?" class="swap form-horizontal">
        <input type="hidden" name="oid" value="{{$orderData->odm001}}" />
        <input type="hidden" name="mname" value="{{$orderData->odm014}}" />
        <input type="hidden" name="mid" value="{{$orderData->odm013}}" />
        <input type="hidden" name="lv2" value="{{$orderData->odm022}}" />
        <input type="hidden" name="status" value="0" />
        <div class="form-group">
            <label class="control-label col-xs-2"> 訂貨人名稱 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$orderData->odm014}}" />
            </div>

            <label class="control-label col-xs-2"> 會員編號 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$member['no']}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 訂單編號 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$orderData->odm002}}" />
            </div>

            <label class="control-label col-xs-2"> 換貨編號 </label>
            <div class="col-xs-2">
                <input name="sNO" id="sNO" type="text" class="form-control" value="" readonly />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 換貨帳號 </label>
            <div class="col-xs-2">
                <input readonly type="text" class="form-control" value="{{$acc}}" />
            </div>

            <label class="control-label col-xs-2"> 換貨商品 </label>
            <div class="col-xs-2">
                <select name="pid" id="pid" class="form-control">
                    {{foreach from=$pdata item=row}}
                    <option value="{{$row.pid}}">{{$row.pname}}</option>
                    {{/foreach}}
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 換貨數量 </label>
            <div class="col-xs-2">
                <input class="form-control" type="number" name="amount" id="amount" value="" size="10"/>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-2"> 換貨原因 </label>
            <div class="col-xs-6">
                <textarea class="form-control" name="reason" id="reason" cols="45" rows="5"></textarea>
            </div>
        </div>
    <!-- <button class="btn btn-primary" onclick="history.back();">返回</button> -->
    </form>
</div>