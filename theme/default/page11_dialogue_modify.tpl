
    <div class="col-xs-12">
        <h3 class="title-bar"> 
            <label>{{$title}}</label>
        </h3>
        <form id="option-form" action="?" method="post" class="form-horizontal" target="iframe-save" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{$id}}" />
            <input type="hidden" name="mid" value="{{$mid}}" />

            <div class="form-group">
                <label class="control-label col-xs-2"> 日期 </label>
                <div class="col-xs-8">
                    <input 
                        type="text" 
                        class="form-control" 
                        name="blacklistDate" 
                        value="{{$rows.dia005}}"
                        readonly 
                    />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-2"> 內容 </label>
                <div class="col-xs-8">
                    <textarea class="form-control" name="content" >{{$rows.dia004}}</textarea>
                </div>
            </div>
            <!-- <div class="form-group">
                <label class="control-label col-xs-2"> 操作人員 </label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" readonly value="{{$rows.dia003}}"/>
                </div>
            </div> -->

        </form>
        <iframe id="iframe-save" name="iframe-save" style="display:none;"></iframe>
    </div>