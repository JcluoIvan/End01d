<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    {{include "head.tpl"}}
</head>
<body>
    <div class="col-xs-12">
        <ol class="breadcrumb">
            <li><a href="member.php?sid={{$smarty.get.sid}}">會員</a></li>
            <li class="active">購買紀錄</li>
        </ol>
        <h3 class="title-bar"> 
            <label> 購買紀錄 </label>
        </h3>

        <div class='col-xs-12'>
            <table class='table'>
                <label>購買日期: {{$date}}</label>
                <tr class='info'>
                    <th class='col-xs-1'>序號</th>
                    <th class='col-xs-2'>商品編號</th>
                    <th class='col-xs-2'>商品品名</th>
                    <th>數量</th>
                </tr>
                {{foreach from=$buyDetail item=row key=key}}
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$row['no']}}</td>
                        <td>{{$row['name']}}</td>
                        <td>{{$row['total']}}</td>
                    </tr>
                {{/foreach}}
            </table>

            <table class='table'>
                <label>退貨商品</label>
                <tr class='success'>
                    <th class='col-xs-1'>序號</th>
                    <th class='col-xs-2'>商品編號</th>
                    <th class='col-xs-2'>商品品名</th>
                    <th>數量</th>
                </tr>
                {{foreach from=$reject item=row key=key}}
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$row['no']}}</td>
                        <td>{{$row['name']}}</td>
                        <td>{{$row['total']}}</td>
                    </tr>
                {{/foreach}}
            </table>

            <table class='table'>
                <label>換貨商品</label>
                <tr class='warning'>
                    <th class='col-xs-1'>序號</th>
                    <th class='col-xs-2'>商品編號</th>
                    <th class='col-xs-2'>商品品名</th>
                    <th>數量</th>
                </tr>
                {{foreach from=$swap item=row key=key}}
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$row['no']}}</td>
                        <td>{{$row['name']}}</td>
                        <td>{{$row['total']}}</td>
                    </tr>
                {{/foreach}}
            </table>

            <table class='table'>
                <tr class='danger'>
                    <th class='col-xs-1'>總金額</th>
                    <th class='col-xs-1'>現金</th>
                    <th class='col-xs-1'>刷卡</th>
                    <th class='col-xs-1'>ATM 轉帳</th>
                    <th class='col-xs-1'>使用購物金</th>
                    <th class='col-xs-1'>運費</th>
                    <th class='col-xs-1'>退貨金額</th>
                    <th>退貨購物金</th>
                </tr>
                <tr>
                    <td>{{$total}}</td>
                    <td>{{$pay.cash}}</td>
                    <td>{{$pay.card}}</td>
                    <td>{{$pay.atm}}</td>
                    <td>{{$oder_point}}</td>
                    <td>{{$oder_fare}}</td>
                    <td>{{$reject_amount}}</td>
                    <td>{{$reject_point}}</td>
                </tr>
            </table>
        </div>
    </body>
</html>