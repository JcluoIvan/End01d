<div class="col-xs-12">
    <h3 class="sub-title-bar"> 
        <label> {{$title}} </label>
    </h3>

    <form id="option-form" acrion="?" class="form-horizontal">
        <input type='hidden' name='pid' value='{{$pid}}' />
        <input type='hidden' name='id' value='{{$id}}' />

        <div class="form-group">
            <label class="control-label col-xs-1 required-field">姓名</label>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="name" value="{{$member.mem005}}" />
            </div>

            <label class="control-label col-xs-1 required-field">手機</label>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="phone" value="{{$member.mem011}}" />
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-xs-1 required-field"> 密碼 </label>
            <div class="col-xs-2">
                <input type="password" class="form-control" name="password" value="{{$member.mem004}}" />
            </div>

            <label class="control-label col-xs-1 required-field"> 確認密碼 </label>
            <div class="col-xs-2">
                <input type="password" class="form-control" name="password2" value="{{$member.mem004}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-1">生日</label>
            <div class="col-xs-2">
                <div class="input-group">
                    <input type="text" name='born' id="date" class='form-control pointer' value="{{$member.mem007}}" />
                    <a id="date.onclick" class="input-group-addon btn bt-default" href="#">
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                    </a>
                </div>
            </div>

            <label class="control-label col-xs-1"> email </label>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="email" value="{{$member.mem012}}" />
            </div>
        </div>
        <!-- <div class="form-group">
            <label class="control-label col-xs-1"> 銀行代號 </label>
            <div class="col-xs-2">
                <select class='form-control' name='bank_code' id="bank_code">
                    {{html_options options=$bank selected=$member.mem027}}
                </select>
            </div>

            <label class="control-label col-xs-1">銀行帳號</label>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="bank_account" value="{{$member.mem010}}" />
            </div>
        </div> -->

        <div class="form-group">
            <label class="control-label col-xs-1"> 地址 </label>
            <div class="col-xs-2">
                <select class="form-control" id="country">
                    {{foreach $post as $row}}
                        <option value="{{$row.id}}" {{if $row.id == $country}} selected {{/if}}>
                            {{$row.name}}
                        </option>
                    {{/foreach}}
                </select>
            </div>
            <div id='is_city'>{{$city}}</div>
            <div class="col-xs-2">
                <select class="form-control" name="city" id="city">
                    {{foreach $post as $country}}
                        {{foreach $country['children'] as $row}}
                            <option class="pid-{{$row.pid}}" value="{{$row['id']}}" {{if $row.id == $city}} id='city-{{$city}}' {{/if}}>
                                {{$row.name}}
                            </option>
                        {{/foreach}}
                    {{/foreach}}
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-4 col-xs-offset-1">
                <input type="text" class="form-control" name="address" value="{{$member.mem009}}" />
            </div>
        </div>
        <button class="fade"></button>
    </form>
</div>

