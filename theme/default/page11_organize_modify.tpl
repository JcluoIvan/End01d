<div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label> {{$title}} </label>
    </h3>

    <form id="option-form" acrion="?" method="post" class="form-horizontal" target="iframe-save" enctype="multipart/form-data">
        <input type='hidden' name='pid' value='{{$pid}}' />
        <input type='hidden' name='id' value='{{$agent->age001}}' />
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#base" aria-controls="base" role="tab" data-toggle="tab">基本資料</a>
            </li>
            {{if $pid > 0}}
                <li role="presentation">
                    <a href="#store" aria-controls="store" role="tab" data-toggle="tab">門市基本資料</a>
                </li>
                <li role="presentation">
                    <a href="#summary" aria-controls="summary" role="tab" data-toggle="tab">門市簡介</a>
                </li>
                <li role="presentation">
                    <a href="#spending" aria-controls="spending" role="tab" data-toggle="tab">消費</a>
                </li>
                <li role="presentation">
                    <a href="#cursor" aria-controls="cursor" role="tab" data-toggle="tab">課程</a>
                </li>
            {{/if}}
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="base">
                <div class="col-xs-6">
                    <div class="form-group">
                        <label class="control-label col-xs-2 required-field"> 帳號 </label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" name="account" value="{{$agent->age004}}" {{$modify_readonly}} />
                        </div>
                        <label class="control-label col-xs-2 required-field">姓名</label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" name="name" value="{{$agent->age006}}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-2 required-field"> 密碼 </label>
                        <div class="col-xs-4">
                            <input type="password" class="form-control" name="password" value="{{$agent->age005}}" />
                        </div>

                        <label class="control-label col-xs-2"> 確認密碼 </label>
                        <div class="col-xs-4">
                            <input type="password" class="form-control" name="password2" value="{{$agent->age005}}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-2 required-field">手機</label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" name="phone" value="{{$agent->age012}}" />
                        </div>

                        <label class="control-label col-xs-2">生日</label>
                        <div class="col-xs-4">
                            <div class="input-group">
                                <input type="text" name='born' id="date" class='form-control pointer' value="{{$agent->dateFormat('age008')}}" />
                                <a id="date.onclick" class="input-group-addon btn bt-default" href="#">
                                    <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-xs-2"> 銀行代號 </label>
                        <div class="col-xs-4">
                            <select class='form-control' name='bank_code' id="bank_code">
                                {{html_options options=$bank selected=$agent->age011}}
                            </select>
                        </div>

                        <label class="control-label col-xs-2">銀行帳號</label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" name="bank_account" value="{{$agent->age021}}" />
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <input type='hidden' id='country_def' value='{{$country}}'>
                    <input type='hidden' id='city_def' value='{{$city}}'>
                    <div class="form-group">
                        <label class="control-label col-xs-2"> 地址 </label>
                        <div class="col-xs-4">
                            <select class="form-control" name="country" id="country"></select>
                        </div>
                        <div class="col-xs-4">
                            <select class="form-control" name='city' id="city"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-8 col-xs-offset-2">
                            <input type="text" class="form-control" name="address" value="{{$agent->age010}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2"> email </label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="email" value="{{$agent->age013}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">回饋%</label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" name="rebate"  value="{{$agent->age017}}" />
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="store">
                <div class="col-xs-6">
                    <div class="form-group">
                        <label class="control-label col-xs-2">門市名稱</label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" name="shopname" value="{{$agent->age014}}" />
                        </div>
                        <label class="control-label col-xs-2">門市電話</label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" name="tel" value="{{$agent->age023}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2">圖片</label>
                        <div class="col-xs-8">
                            <input type="file" class="form-control" name="store_img" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-8 col-xs-offset-1">
                            {{if $store->imageUrl() }}
                                <img class="store-image" src="{{$store->imageUrl()}}" />
                            {{/if}}
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label class="control-label col-xs-2">位置查詢</label>
                        <div class="col-xs-6">
                            <input type="hidden" name="store_map" value="{{$store->sto003}}"/>
                            <div class="input-group">
                                <input type="text" class="form-control" id="store-map" placeholder="查詢地址、地名或店名" />
                                <a id="query-address" class="input-group-addon btn btn-default">
                                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <button type="button" id="copy-address" class="btn btn-default">與地址相同</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div id="map-panel"/>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="summary">
                <div class="col-xs-10">
                    <trix-editor input="store_summary"></trix-editor>
                    <input type="hidden" id="store_summary" name="store_summary" value="{{$store->sto004|escape:'html'}}"/>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="spending">
                <div class="col-xs-10">
                    <trix-editor input="store_spending"></trix-editor>
                    <input type="hidden" id="store_spending" name="store_spending" value="{{$store->sto005|escape:'html'}}"/>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="cursor">
                <div class="col-xs-10">
                    <trix-editor input="store_cursor"></trix-editor>
                    <input type="hidden" id="store_cursor" name="store_cursor" value="{{$store->sto006|escape:'html'}}"/>
                </div>
            </div>
        </div>
        
        <button class="fade"></button>
    </form>
    <iframe id="iframe-save" name="iframe-save" style='display:none;'></iframe>
</div>