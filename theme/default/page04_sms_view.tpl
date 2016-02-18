<div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label>檢視簡訊通知 (SMS)</label>
    </h3>
    <div class="form-horizontal">
        <div class="col-xs-6">
            <div class="form-group">
                <label class="control-label col-xs-3"> 通知對象 </label>
                <div class="col-xs-6">
                    <span class="form-control">{{$row->noticeFor()}}</span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3"> 內文 </label>
                <div class="col-xs-8">
                    <pre>{{$row->new004}}</pre>
                </div>
            </div>
        </div>
    </div>
</div>

