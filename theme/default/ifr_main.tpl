<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include "head.tpl"}}

    {{* define function@iframeSrc >> 取得 iframe 的 src 路徑 *}}
    {{function name=mainIframe}}
        {{if $url}} 
           <iframe 
                name="ifr-right" 
                width="100%" 
                height="100%" 
                frameborder="false"
                src="{{$url}}?sid={{$smarty.get.sid}}">
            </iframe>
        {{/if}}
    {{/function}}
    <style>
        body { height: 100%; }
    </style>
</head>
    
    {{if isset($filepath)}}
        <div id="left-menu" class="col-xs-2">
            {{include $filepath}}
        </div>
        <div class="col-xs-10">
            {{call mainIframe url=$rightMain}}
        </div>
    {{else}}
        <div class="col-xs-12">
            {{call mainIframe url=$rightMain}}
        </div>
    {{/if}}
    <script type="text/javascript" src="/js/ifr_main.js?{{$smarty.now}}"></script>
</html>