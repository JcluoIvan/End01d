<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include "head.tpl"}}
</head>
<body>

<div class="col-xs-12">
    <!-- 
    <ol class="breadcrumb">
        <li><a href="#page12/order_single">訂貨單</a></li>
        <li><a class="active">訂貨單明細</a></li>
    </ol>
    <h3 class="title-bar"> 
        <label> 訂單管理 - 訂貨單 - 訂貨單明細 </label>
    </h3> 
    -->
    <form id="option-form" acrion="?" class="status">
    <table class="table">
        <input type="hidden" name="oid" value="{{$orderData->odm002}}" />
        <input type="hidden" name="mname" value="{{$orderData->odm015}}" />
        <input type="hidden" name="mid" value="{{$orderData->odm016}}" />
        <tr><td class="col-xs-2">取貨編號:</td><td><input type="text" name="getsn" value="{{$orderData->odm013}}" /></td></tr>
        <tr><td class="col-xs-2">狀態:</td>
            <td>
            <select name="status" id="status">
                <option value="0" selected>請選擇</option>
                <option value="1" {{if $orderData->odm019 ==1}}selected{{/if}}>處理中</option>
                <option value="2" {{if $orderData->odm019 ==2}}selected{{/if}}>已取貨</option>
                <option value="3" {{if $orderData->odm019 ==3}}selected{{/if}}>已出貨</option>
                <option value="4" {{if $orderData->odm019 ==4}}selected{{/if}}>核帳</option>
            </select>
            </td>
        </tr>
    </table>
    <!-- <button class="btn btn-primary" onclick="history.back();">返回</button> -->
    </form>
</div>



</body>
</html>