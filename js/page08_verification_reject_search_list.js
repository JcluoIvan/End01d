(function(Endold, OptionBar) {
    var _MODIFY_URL = '/page/page03/order_detail.php';
    var Reject_LIST_URL = '/page/page03/reject_list.php';
    var Swap_LIST_URL = '/page/page03/swap_list.php'; 
    
    var $form = null;
    var $input = $('#no');
    var $message = $('#success');

    var app = {
        $checkDate: null,
        init: function() {
            $form = $('#command-search');
            app.$checkDate = $('#checkDate').prop('disabled', true);
            app.bindEvents();
        },
        bindEvents: function() {
            $form.bind('submit', app.sendData);
            app.$checkDate.bind('click', function() {
                app.oncheckDate();
            });
            // $form.bind('submit', app.gridReload);
        },
        oncheckDate: function() {
            // var no = $('#no').val();
            var no = $message.data('order.oid');
            if(confirm("確定是否退貨？")){
                Endold
                    .post(823, {no:no})
                    .done(app.requestSendData);    
            }
        },
        sendData: function(event) {
            var data = $form.serialize();
            event && event.preventDefault();
            Endold.post(822, data)
                .done(app.requestSendData2)
                .fail(function(response) { 
                        alert('伺服器錯誤: ' + response.responseText);
                    });

        },
        requestSendData2: function(response) {
            
            app.$checkDate.prop('disabled', ! response.status);

            $message.empty();

            if (response.status){
                $message.data('order.oid', response.oid);
                $message.append('訂單編號 : ' + response.oid + '\n');
                $message.append('會員姓名 : ' + response.member + '\n');
                $message.append('會員電話 : ' + response.phone + '\n');
                $message.append('=================================== \n' );
                $.each(response.rows, function(index, row) {
                    $message.append('訂單編號 : ' + row.oid +'\n');
                    $message.append('產品名稱 : ' + row.pname +'\n');
                    $message.append('退貨數量 : ' + row.amount +'\n');
                    $message.append('退貨金額 : ' + row.totalmoney +'\n');
                    $message.append('################################### \n' );
                });
            } else {
                $message
                    .data('order.oid', 0)
                    .html(response.message);
                $input.select().focus();
            }
        },
        requestSendData: function(response) {
            // $('<p/>')
            //     .html(response.message)
            //     .prependTo($messages);
            $message
                .data('order.oid', 0)
                .empty()
                .html(response.message);
            $input.select().focus();
        },
        searchData: function() {
            var data = $form.serializeArray();
            grid.flexOptions({params: data});
            return true;
        },
        gridReload: function(event) {
            console.log('run');
            event && event.preventDefault();
            grid.flexReload();
        }
    };

    window.ProductApp = app;
    // window.OrderGrid = grid;
    app.init();
})(top.Endold);