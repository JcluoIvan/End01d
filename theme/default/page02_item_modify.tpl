<div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label>{{$title}}</label>
    </h3>
    <form id="option-form" action="?" method="post" class="form-horizontal" >
        <input type="hidden" name="id" value="{{$row->pdi001}}" />
        <div class="form-group">
            <label class="control-label col-xs-2 required-field"> 類別名稱 </label>
            <div class="col-xs-3">
                <input type="text" class="form-control" name="name" value="{{$row->pdi002}}"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-2"> 排序 </label>
            <div class="col-xs-3">
                <input type="text" class="form-control" name="sort" value="{{$row->pdi003 / 10}}"/>
            </div>
        </div>
        <button class="fade"></button>
    </form>
</div>
