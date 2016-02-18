        <div class="list-group">
            <a 
                class="list-group-item" 
                href="command_list.php?sid={{$smarty.get.sid}}" 
                target="ifr-right">業務獎金查詢
            </a>
            <a 
                class="list-group-item" 
                href="stock_search.php?sid={{$smarty.get.sid}}" 
                target="ifr-right">商品庫存
            </a>   
            <a class="list-group-item disabled"> > 產品操作 </a>
            <a 
                class="list-group-item" 
                href="verification_search.php?sid={{$smarty.get.sid}}" 
                target="ifr-right">取貨操作
            </a>
            <a 
                class="list-group-item" 
                href="verification_reject_search.php?sid={{$smarty.get.sid}}" 
                target="ifr-right">退貨操作
            </a>
            <a 
                class="list-group-item" 
                href="verification_swap_search.php?sid={{$smarty.get.sid}}" 
                target="ifr-right">換貨操作
            </a>
            <a class="list-group-item disabled"> > 訂單記錄 </a>
            <a 
                class="list-group-item" 
                href="getorder_search.php?sid={{$smarty.get.sid}}" 
                target="ifr-right">訂貨記錄
            </a>
            <a 
                class="list-group-item" 
                href="order_search.php?sid={{$smarty.get.sid}}" 
                target="ifr-right">取貨記錄
            </a>
            <a 
                class="list-group-item" 
                href="order_reject_list.php?sid={{$smarty.get.sid}}" 
                target="ifr-right">退貨記錄
            </a>
            <a 
                class="list-group-item" 
                href="order_swap_list.php?sid={{$smarty.get.sid}}" 
                target="ifr-right">換貨記錄
            </a>
            <!-- <a 
                class="list-group-item" 
                href="sales_analysis.php?sid={{$smarty.get.sid}}" 
                target="ifr-right">銷售分析表
            </a> -->
        </div>