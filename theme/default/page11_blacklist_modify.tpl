
    <div class="col-xs-12">
        <h3 class="title-bar"> 
            <label>加入黑名單</label>
        </h3>
        <form id="option-form" action="?" method="post" class="form-horizontal" target="iframe-save" enctype="multipart/form-data">
            <input type="hidden" name="mid" value="{{$mid}}" />
            <input type="hidden" name="is_blacklist" value="1" />
            <!-- <input type="hidden" class="form-control" name="operate" value="{{$userId}}"/> -->
            <div class="form-group">
                <label class="control-label col-xs-2"> 日期 </label>
                <div class="col-xs-8">
                    <input 
                        type="text" 
                        class="form-control" 
                        name="blacklistDate" 
                        value="{{$date}}"
                        readonly 
                    />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-2"> 原因 </label>
                <div class="col-xs-8">
                    <textarea class="form-control" name="blacklistReason" ></textarea>
                </div>
            </div>
            <!-- <div class="form-group">
                <label class="control-label col-xs-2"> 操作人員 </label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" readonly value="{{$userName}}"/>
                </div>
            </div> -->

        </form>
        <iframe id="iframe-save" name="iframe-save" style="display:none;"></iframe>
    </div>