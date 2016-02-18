<div class="col-xs-12">
    <h3 class="title-bar"> 
        <label> {{$title}} </label>
    </h3>

    <form id="option-form" acrion="?" class="form-horizontal">
        <input type='hidden' name='id' value='{{$id}}' />

        <div class="form-group">
            <label class="control-label col-xs-1"> 權限 </label>
            <div class="col-xs-2">
                <select class="form-control" name="utp">
                    {{html_options options=$types selected=$row.age002}}
                </select>
            </div>

            <label class="control-label col-xs-1"> 帳號 </label>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="account" value="{{$row.age004}}" {{$modifyreadonly}} />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-1"> 密碼 </label>
            <div class="col-xs-2">
                <input type="password" class="form-control" name="password" value="{{$row.age005}}" />
            </div>

            <label class="control-label col-xs-1"> 確認密碼 </label>
            <div class="col-xs-2">
                <input type="password" class="form-control" name="password2" value="{{$row.age005}}" />
            </div>
        </div>

        <div class="form-group" style="{{$modifyhidden}}">
            <label class="control-label col-xs-1"> 姓名 </label>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="name" value="{{$row.age006}}" />
            </div>

            <label class="control-label col-xs-1"> 手機 </label>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="phone" value="{{$row.age012}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-xs-1"> email </label>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="email" value="{{$row.age013}}"/>
            </div>
        </div>
        <button class="fade"></button>
    </form>
</div>

        <!-- <div class="form-group">
            <label class="control-label col-xs-1"> 生日 </label>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="born" value="1991-01-01" />
            </div>
        </div> -->
        <!-- <div class="form-group">
            <label class="control-label col-xs-1"> 地址 </label>
            <div class="col-xs-2">
                <select class="form-control" name="city">
                    {{html_options options=$city selected=$row.age009}}
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-xs-1">  </label>
            <div class="col-xs-2">
                <input type="text" class="form-control" name="address" value="{{$row.age010}}" />
            </div>
        </div> -->




