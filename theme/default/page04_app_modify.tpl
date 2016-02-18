<div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label>新增通知</label>
    </h3>
    <form id="option-form" action="?" method="post" target="iframe-save" class="form-horizontal" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{$row->new001}}" />
        <input type="hidden" name="type" value="app" />
        <input type="hidden" name="users" id="users" value="{{$row->new006}}" />
            <!--             
                <div class="form-group">
                    <label class="control-label col-xs-2"> 通知對象 </label>
                    <div class="col-xs-6">
                        <select id="notice-for" name="notice_for" class="form-control">
                            {{html_options options=$notice_for selected=$row->new005}}
                        </select>
                    </div>
                </div> 
            -->
        <div class="col-xs-6">
            <div class="form-group">
                <label class="control-label col-xs-2 required-field"> 標題 </label>
                <div class="col-xs-7">
                    <input type="text" class="form-control title" name="title" value="{{$row->new003}}"/>
                </div>
                <div class="col-xs-3 checkbox">
                    <label>
                        <input type="checkbox" name="notice" value="1" />
                        推播通知
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-2"> 附加圖片 </label>
                {{if $row->new008}}
                    <div class="col-xs-8" id="image-wrapper" >
                        <div class="input-group">
                            <a id="image-link" class="form-control" href="{{$row->url()}}" target="_blank"> 
                                開啟圖片
                                <img id="receipt-image" src="{{$row->url()}}" />
                            </a>
                            <a id="remove-image" class="input-group-addon" href="#" news-id="{{$row->new001}}">
                                <span class="glyphicon glyphicon-remove" title="移除" aria-hidden="true"></span>
                            </a>
                        </div>
                    </div>
                {{else}}
                    <div class="col-xs-8">
                        <input type="file" name="image" class="form-control"/>
                    </div>
                {{/if}}
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <div class="col-xs-12">
                    <trix-editor input="content"></trix-editor>
                    <input type="hidden" id="content" name="content" value="{{$row->new004|escape:'html'}}"/>
                </div>
            </div>
        </div>

    </form>
    <iframe id="iframe-save" name="iframe-save" class="hide"></iframe>
</div>

