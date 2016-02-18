<div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label> 資料變更記錄 </label>
    </h3>
    <input type="hidden" id="log-id" value="{{$smarty.get.id}}" />
    <input 
        type="hidden" 
        id="sub-title" 
        value="{{$log->action()}} [ {{$user_name}} ] 資料" 
        />
    <div id="log-view"></div>

</div>

