<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {{include 'head.tpl'}}
        <link rel="stylesheet" type="text/css" href="/css/page97.css" />
    </head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li class="active">首頁上橫幅圖片</li>
        </ol>
        <h3 class="title-bar"> 
            <div id="option-bar" class="pull-right"></div>
            <label>首頁上橫幅圖片</label>
        </h3>
    </div>
    <div class="row">
        <div class="col-xs-2 col-xs-offset-4">
            <button id="save-button" class="btn btn-primary" disabled> Setting </button>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <div id="title-images-wrapper">
                {{foreach from=$images item=img}}
                    <div class="image-item {{$img->activeClass()}} img-id-{{$img->mbt001}}" data-id="{{$img->mbt001}}">
                        <img src="{{$img->url()}}" />
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>
                    </div>
                {{/foreach}}
            </div>
        </div>
        <div class="col-xs-6">
            <form id="update-form" action="#" method="post" target="update-iframe" class="form-horizontal" enctype="multipart/form-data">
                <div id="update-images-wrapper">
                    <div class="form-group update-image"> 
                        <label class="control-label col-xs-2">上傳圖片</label>
                        <div class="col-xs-6">
                            <div class="input-group">
                                <input type="file" name="images[]" class="form-control" />
                                <a class="input-group-addon remove-button">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"> </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div clas="form-group">
                    <div class="col-xs-4 col-xs-offset-6">
                        <button class="btn btn-primary">上傳</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <iframe id="update-iframe" name="update-iframe" class="hide"></iframe>

    <script type="text/javascript" src="/js/page97_title_image.js?{{$smarty.now}}"></script>
</body>
</html>