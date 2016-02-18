
        <div class='col-xs-12'>
            <h3 class='title-bar'>
                <label>業務獎金(專業經理人) - 明細</label>
            </h3>
            <table class='table'>
                <tr class='info'>
                    <th class='col-xs-1'>會員編號</th>
                    <th class='col-xs-2'>訂單編號</th>
                    <th>消費金額</th>
                </tr>
                <tr>
                    <td>{{$order->member->mem002}}</td>
                    <td>{{$order->odm002}}</td>
                    <td>{{$order->odm030-$order->odm032}}</td>
                </tr>
            </table>
        </div>