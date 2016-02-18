<div style="width: 90%; max-width: 400px;">
    <h4> 新增一筆訂單於 <?= date('Y/m/d H:i:s') ?></h4>
    <ul style="list-style: none">
        <li style="margin: 5px"> 
            <label style="margin-top: 5px; font-weight: bold; width: 100px; display: inline-block;"> 訂單編號 : </label> 
            <?= $order->odm002 ?>
        </li>
        <li style="margin: 5px">
            <label style="margin-top: 5px; font-weight: bold; width: 100px; display: inline-block;"> 交易金額 : </label> 
            <?= $order->odm003 ?>
        </li>
        <li style="margin: 5px">
            <label style="margin-top: 5px; font-weight: bold; width: 100px; display: inline-block;"> 經理人 : </label> 
            <?= $agent1->age006 ?>
        </li>
        <li style="margin: 5px">
            <label style="margin-top: 5px; font-weight: bold; width: 100px; display: inline-block;"> 展示中心 : </label> 
            <?= $agent2->age006 ?> ( <?= $agent2->age014 ?> )
        </li>
        <li style="margin: 5px">
            <label style="margin-top: 5px; font-weight: bold; width: 100px; display: inline-block;"> 購買會員 : </label> 
            <?= $member->mem005 ?>
        </li>
        <li style="margin: 5px">
            <label style="margin-top: 5px; font-weight: bold; width: 100px; display: inline-block;"> 結帳方式 : </label> 
            <?= $order->getPayType() ?>
        </li>
        <li style="margin: 5px">
            <label style="margin-top: 5px; font-weight: bold; width: 100px; display: inline-block;"> 取貨方式 : </label> 
            <?= $order->getModeLabel() ?>
        </li>
    </ul>
    <ul style="list-style: none; margin: 10px 0 10px 50px;">
        <?php foreach ($details as $dtl) : ?>
            <li style="border: 1px solid #aaa; padding: 10px;"> 
                <label style="display: block; font-weight: bold; ">
                    <?= $dtl->product ? $dtl->product->pdm004 : ' none ' ?> 
                </label>
                <span style="display: block; text-align: right">
                    購買數 : <?= $dtl->odd006 ?>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
