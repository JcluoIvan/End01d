<!DOCTYPE html>
<html>
    <head>
        {{include 'head.tpl'}}
        <link rel="stylesheet" type="text/css" href="/css/page01_friends.css?{{$smarty.now}}" />
    </head>
<body>
    <input type='hidden' id='id' value='{{$row->mem001}}' />
    <input type='hidden' id='no' value='{{$row->mem002}}' />
    <input type='hidden' id='name' value='{{$row->mem005}}' />
    <input type='hidden' id='phone' value='{{$row->mem011}}' />
    <input type='hidden' id='point' value='{{$row->mem021}}' />
    <div id="friends-panel" >
        <div id="friends-wrapper">
            <div id="my-wrapper" class="user-wrapper">
                <img src="" />
            </div>
        </div>
    </div>
</body>
<script type='text/javascript' src='/js/page01_friends.js?{{$smarty.now}}'></script>
</html>