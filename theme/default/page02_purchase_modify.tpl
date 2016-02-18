<div class="col-xs-12">
  
    <h3 class="sub-title-bar"> 
        <label>{{$title}}</label>
    </h3>
    <form id="option-form" method="post" class="form-horizontal">
        <input type="hidden" name="id" value="{{$purchase->pdp001}}" />
        <input type="hidden" name="aid" value="{{$agent->age001}}" />
        <div class="form-group">
            <div class="col-xs-4">
                <div class="form-group">
                    <label class="control-label col-xs-4"> 展示中心 </label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" value="{{$agent->age006}}" readonly/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-4"> 進貨單號 </label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" value="{{$purchase->pdp002|default:'尚未建立'}}" readonly />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-4"> 郵寄編號 </label>
                    <div class="col-xs-8">
                        <input type="text" name="parcel_number" class="form-control" value="{{$purchase->pdp007}}" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-4"> 到貨日期 </label>
                    <div class="col-xs-8">
                        <div class="input-group">
                            <input id="purchase-date" type="text" name="date" class="form-control" value="{{$purchase->pdp004->format('Y-m-d')}}" />
                            <a id="purchase-date-active" class="input-group-addon" class="btn btn-default" href="#">
                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                            </a>
                        </div>
                        <!-- <input type="text" id="purchase_date" name="date" class="form-control" value="{{$purchase->pdp004->format('Y-m-d')}}" readonly /> -->
                    </div>
                </div>
                {{if $purchase->pdp001}}
                    <fieldset>
                        <legend> 建立進貨清單 </legend>
                        <div class="form-group">
                            <label class="control-label col-xs-4"> 產品類別 </label>
                            <div class="col-xs-8">
                                <select id="product-item" class="form-control">
                                    {{html_options options=$items}}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-4"> 產品名稱 </label>
                            <div class="col-xs-8">
                                <select id="product-name" name="product_id" class="form-control">
                                    {{html_options options=$products}}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-4"> 進貨數量 </label>
                            <div class="col-xs-5">
                                <input type="number" id="count" class="form-control" value="10" />
                            </div>
                            <div class="col-xs-3">
                                <button type="button" id="add-purchase" class="btn btn-primary pull-right">新增</button>
                            </div>
                        </div>
                    </fieldset>
                {{else}}
                    <div class="alert alert-warning" role="alert">
                        請點選下方按鈕，完成進貨單記錄建立，方可建立進貨清單。
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6 col-xs-offset-3">
                            <button type="button" id="save-purchase" class="btn btn-primary btn-block">
                                建立進貨記錄
                            </button>
                        </div>

                    </div>
                {{/if}}
            </div>
            <div class="col-xs-8">
                <div id="purchase-list"> </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <label class="col-xs-1 control-label">備註</label>
                <div class="col-xs-10">
                    <input type="text" class="form-control" name="remark" value="{{$purchase->pdp009|escape:'html'}}"/>
                </div>
            </div>
        </div>

        <button class="fade" type="submit"></button>
    </form>
</div>
