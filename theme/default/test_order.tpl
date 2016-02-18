<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {{include 'head.tpl'}}
    </head>
<body>
    <form id="order-form" class="form-horizontal" action="/pub/gateway.php?cmd=105&site=1&sid={{$smarty.get.sid}}" method="post">
        <div class="col-xs-8">
            <div class="form-group">
                <label class="control-label col-xs-2">會員</label>
                <div class="col-xs-3">
                    <select class="form-control" name="mid">
                        {{foreach from=$members item=row}}
                            <option value="{{$row->mem001}}">{{$row->mem005}}</option>
                        {{/foreach}}
                    </select>
                </div>
            </div>        
            <div class="form-group">
                <label class="control-label col-xs-2">取貨方式</label>
                <div class="col-xs-3">
                    <select class="form-control" name="type" >
                        <option value="to_csv">到店取貨</option>
                        <option value="to_house">送貨到府</option>
                    </select>
                </div>
                <label class="control-label col-xs-2">購物金折抵</label>
                <div class="col-xs-3">
                    <input type="number" name="point" class="form-control" value="0"/>
                </div>
            </div> 
            <fieldset>
                <legend>收件者資訊</legend>
                <div class="form-group">
                    <label class="control-label col-xs-2">鄉鎮市區</label>
                    <div class="col-xs-3">
                        <select class="form-control" name="member_city">
                            <option value="10">台中市</option>
                        </select>
                    </div>
                    <label class="control-label col-xs-2">地址</label>
                    <div class="col-xs-3">
                        <input type="text" name="member_address" class="form-control" value="0912399999" />
                    </div>
                </div>   
                <div class="form-group">
                    <label class="control-label col-xs-2">姓名</label>
                    <div class="col-xs-3">
                        <input type="text" name="member_name" class="form-control" value="A 先生" />
                    </div>
                    <label class="control-label col-xs-2">電話</label>
                    <div class="col-xs-3">
                        <input type="text" name="member_phone" class="form-control" value="0912399999" />
                    </div>
                </div>
            </fieldset>   
            <fieldset>
                <legend>付款資訊</legend>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-xs-2">付款方式</label>
                        <div class="col-xs-3">
                            <select class="form-control" name="pay_type">
                                <option value="card">信用卡</option>
                                <option value="atm">ATM</option>
                                <option value="cash">現金</option>
                            </select>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label class="control-label col-xs-2">信用卡號碼</label>
                        <div class="col-xs-6">
                            <input type="text" name="card_pan" class="form-control" value="1010220000330404" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">檢查碼</label>
                        <div class="col-xs-3">
                            <input type="text" name="card_csi" class="form-control" value="0912399999" />
                        </div>
                        <label class="control-label col-xs-2">有效日期</label>
                        <div class="col-xs-3">
                            <input type="text" name="card_thru" class="form-control" value="04/20" />
                        </div>
                    </div>
                </div>
            </fieldset>  
            <fieldset>
                <legend>發票資訊</legend>
                <div class="form-group">
                    <label class="control-label col-xs-2">發票類型</label>
                    <div class="col-xs-3">
                        <select class="form-control" name="receipt_type">
                            {{html_options options=$receipt}}}}
                        </select>
                    </div>
                    <label class="control-label col-xs-2">統一編號</label>
                    <div class="col-xs-3">
                        <input type="text" name="receipt_ubn" class="form-control" value="5566885" />
                    </div>
                </div>   
                <div class="form-group">
                    <label class="control-label col-xs-2">發票抬頭</label>
                    <div class="col-xs-3">
                        <input type="text" name="receipt_title" class="form-control" value="A 先生" />
                    </div>
                </div>
            </fieldset> 
            <button class="btn btn-primary col-xs-offset-10">Buy </button>

        </div>
        <div class="col-xs-4">
            {{foreach from=$products item=row}}
                <div class="form-group">
                    <label class="control-label col-xs-4">{{$row->pdm004}}</label>
                    <div class="col-xs-6">
                        <input type="hidden" name="product_id[]" value="{{$row->pdm001}}" />
                        <input type="number" name="product_count[]" value="0" class="form-control"/>
                    </div>
                </div>
            {{/foreach}}
        </div>

    </form>

    <script>
        $('#order-form').bind('submit', function(event) {
            event && event.preventDefault();
            var $this = $(this);
            var url = $this.attr('action');
            var data = $this.serialize();
            $.ajax(url, {data: data, dataType: 'html', type: 'post'})
                .done(function(response) {
                    alert(response);
                })
                .fail(function(response) {
                    alert(response.responseText);
                });
        });
    </script>
</body>
</html>