<div id="product-modify-panel" class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label>{{$title}}</label>
    </h3>
    <form id="option-form" action="?" method="post" class="form-horizontal" target="iframe-save" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{$row->pdm001}}" />
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#home" aria-controls="home" role="tab" data-toggle="tab">產品基本資料</a>
            </li>
            <li role="presentation">
                <a href="#content" aria-controls="content" role="tab" data-toggle="tab">詳細介紹 & 使用方法</a>
            </li>
            <li role="presentation">
                <a href="#images" aria-controls="images" role="tab" data-toggle="tab">產品圖片 & SGS圖片</a>
            </li>
            <li role="presentation">
                <a href="#edm" aria-controls="edm" role="tab" data-toggle="tab">E-DM 圖片</a>
            </li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <div class="col-xs-6">
                    <div class="form-group">
                        <label class="control-label col-xs-2 required-field"> 產品名稱 </label>
                        <div class="col-xs-10">
                            <input type="text" class="form-control" name="name" value="{{$row->pdm004}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2"> 類別 </label>
                        <div class="col-xs-4">
                            <select class="form-control" name="type">
                                {{html_options options=$items selected=$row->pdm003}}
                            </select>
                        </div>
                        <label class="control-label col-xs-2 required-field"> 產品序號 </label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" name="no" value="{{$row->pdm002}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2 required-field"> 售價 </label>
                        <div class="col-xs-4">
                            <input type="number" class="form-control" name="price" value="{{$row->pdm005}}"/>
                        </div>
                        <label class="control-label col-xs-2 required-field"> 會員價 </label>
                        <div class="col-xs-4">
                            <input type="number" class="form-control" name="member_price" value="{{$row->pdm006}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2"> 排序 </label>
                        <div class="col-xs-4">
                            <input type="number" class="form-control" name="sort" value="{{$row->pdm014 / 10}}"/>
                        </div>
                        <div class="col-xs-3 checkbox">
                            <label > 
                                <input 
                                    type="checkbox" 
                                    name="selling" 
                                    value="1"
                                    {{if $row->pdm007}} checked {{/if}}
                                    />
                                是否上架 
                            </label>
                        </div>
                        <div class="col-xs-3 checkbox">
                            <label > 
                                <input 
                                    type="checkbox" 
                                    name="main" 
                                    value="1"
                                    {{if $row->pdm013}} checked {{/if}}
                                    />
                                主力產品 
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2"> 容量 </label>
                        <div class="col-xs-4">
                            <input type="text" name="capacity" class="form-control" value="{{$row->pdm010}}"/>
                        </div>
                        <div class="col-xs-3 radio">
                            <label>
                                <input type="radio" name="sell_type" value="0" {{if $row->pdm019 == 0}} checked {{/if}} />
                                現金商品
                                <span class="glyphicon glyphicon-usd"></span>
                            </label>
                        </div>
                        <div class="col-xs-3 radio">
                            <label>
                                <input type="radio" name="sell_type" value="1" {{if $row->pdm019 == 1}} checked {{/if}} />
                                購物金商品
                                <span class="glyphicon glyphicon-asterisk"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2"> 備註 </label>
                        <div class="col-xs-10">
                            <textarea class="form-control" name="remark">{{$row->pdm018}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <fieldset>
                        {{if $row->pdm001}}
                            <legend>
                                Youtube 影片管理
                                <button id="add-video" type="button" class="btn btn-primary pull-right">
                                    新增
                                </button>
                            </legend>
                            <div id="video-list"></div>
                        {{else}}
                            <legend>Youtube 影片管理</legend>
                            <div class="alert alert-warning" role="alert">
                                請先儲存商品資料後, 再建立影片清單
                            </div>
                        {{/if}}
                    </fieldset>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="content">
                <div class="form-group">
                    <label class="control-label col-xs-1 col-xs-offset-5"> 簡介 </label>
                    <label class="control-label col-xs-1"> 使用方法 </label>
                </div>
                <div class="form-group">
                    <div class="col-xs-6">
                        <trix-editor input="introduce"></trix-editor>
                        <input type="hidden" id="introduce" name="introduce" value="{{$row->pdm015|escape:'html'}}"/>
                    </div>
                    <div class="col-xs-6">
                        <trix-editor input="how_use"></trix-editor>
                        <input type="hidden" id="how_use" name="how_use" value="{{$row->pdm009|escape:'html'}}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-1 col-xs-offset-5"> 成份 </label>
                    <label class="control-label col-xs-1"> 推薦對象 </label>
                </div>
                <div class="form-group">
                    <div class="col-xs-6">
                        <trix-editor input="element"></trix-editor>
                        <input type="hidden" id="element" name="element" value="{{$row->pdm016|escape:'html'}}"/>
                    </div>
                    <div class="col-xs-6">
                        <trix-editor input="object"></trix-editor>
                        <input type="hidden" id="object" name="object" value="{{$row->pdm017|escape:'html'}}"/>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane col-xs-10" id="images">
                <!-- 產品圖片 -->
                <fieldset>
                    <legend>
                        產品圖片 
                        <button type="button" class="btn btn-danger remove-image"> 刪除圖片 </button>
                    </legend>
                    <div class="image-list">
                        {{for $i=0 to 2}}
                            {{assign "img" $photo[$i]}}
                            <div class="image-item" image-id="{{$img->pdo001|default:0}}">
                                <div class="remove-active-background">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </div>
                                <img src="{{$img->url()|default:null}}" />
                                <input type="file" name="photo[]" class="form-control"/>
                            </div>
                        {{/for}}
                    </div>
                </fieldset>
                <fieldset>
                    <legend>SGS 圖片</legend>
                    <div class="image-list">
                        {{for $i=0 to 2}}
                            {{assign "img" $sgs[$i]}}
                            <div class="image-item" image-id="{{$img->pdo001|default:0}}">
                                <div class="remove-active-background">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </div>
                                <img src="{{$img->url()}}" />
                                <input type="file" name="sgs[]" class="form-control"/>
                            </div>
                        {{/for}}
                    </div>
                </fieldset>
            </div>
            <div role="tabpanel" class="tab-pane col-xs-10" id="edm">
                <fieldset>
                    <legend> 
                        E-DM 圖片 
                        <button type="button" class="btn btn-danger remove-image"> 刪除圖片 </button>
                    </legend>
                    <div class="image-list">
                        {{for $i=0 to 0}}
                            {{assign "img" $edm[$i]}}
                            <div class="image-item" image-id="{{$img->pdo001|default:0}}">
                                <div class="remove-active-background">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </div>
                                <img src="{{$img->url()}}" />
                                <input type="file" name="edm[]" class="form-control"/>
                            </div>
                        {{/for}}
                    </div>
                </fieldset>
            </div>
        </div>
        <button class="fade"></button>
    </form>
    <iframe id="iframe-save" name="iframe-save" style='display:none;'></iframe>
</div>

<div class="modal fade" id="video-wrapper">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="?" method="post" class="form-horizontal" target="iframe-save">
                <input type="hidden" class="form-control" name="pid" value="{{$row->pdm001}}"/>
                <input type="hidden" class="form-control" name="video_id" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Youtube 影片</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-xs-2 control-label"> 影片標題 </label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="video_title" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label"> 影片網址 </label>
                        <div class="col-xs-8">
                            <input id="video-url" type="text" class="form-control" />
                            <input type="hidden" class="form-control" name="video_no" />
                        </div>
                    </div>
                    <fieldset>
                        <iframe id="youtube-iframe"></iframe>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary" >存檔</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
