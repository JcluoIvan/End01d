<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="format-detection" content="telephone=no" />
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, target-densitydpi=device-dpi" />

        {{include 'head.tpl'}}
        <link rel="stylesheet" type="text/css" href="/css/reset.css" />

    </head>
    <body>
        <div class="reset">
            <form action="#" id='reset-form' method='post' class="form-horizontal">
                <input type='hidden' name='code' value='{{$code}}' />
                <div id="form-header"> 忘記密碼 - 確認生日 </div>
                <div class="form-group">
                    <label class="control-label col-xs-3">生日</label>
                    <input type="text" name="born" class="col-xs-8" value="" placeholder="請輸入生日格式:1990-01-01" tabindex="1" />
                </div>
                <button type="submit" class="btn btn-primary btn-block"  tabindex="4">送出</button>


                <!-- <div class="form-group">
                    <label class="control-label col-xs-2">生日</label>
                    <div class="col-xs-7">
                        <input type="text" name="born" class="form-control" value="" placeholder="生日格式:1990-01-01" tabindex="1" />
                    </div>
                    <div class="col-xs-3">
                        <button type="submit" class="btn btn-primary btn-block"  tabindex="4">送出</button>
                    </div>
                </div> -->
            </form>
        </div>
    </body>
</html>