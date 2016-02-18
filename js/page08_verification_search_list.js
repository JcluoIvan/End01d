(function(Endold, OptionBar) {
    var _MODIFY_URL = '/page/page03/order_detail.php';
    var Reject_LIST_URL = '/page/page03/reject_list.php';
    var Swap_LIST_URL = '/page/page03/swap_list.php'; 
    
    var $form = null;
    var $input = $('#no');
    var $messages = $('#success');

    var app = {
        $checkDate: null,
        init: function() {
            $form = $('#command-search');
            app.$checkDate = $('#checkDate');
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
            var no = $('#no').val();
            if(confirm("確定是否核帳？")){
                Endold
                    .post(819, {no:no})
                    .done(app.requestSendData);    
            }
        },
        sendData: function(event) {
            var data = $form.serialize();
            event && event.preventDefault();
            Endold.post(803, data)
                .done(app.requestSendData2)
                .fail(function(response) { 
                        alert('伺服器錯誤: ' + response.responseText);
                    });

        },
        requestSendData2: function(response) {
            var pre = $('#success').empty();
            if(response.status == false){
                $('<p/>')
                    .html(response.message)
                    .prependTo($messages);
                $input.select().focus();
            }
            if(response.status == true){

                pre.append('　　　總計 : ' + response.total + '\n');
                pre.append('使用購物金 : ' + response.point + '\n');
                pre.append('　應收金額 : ' + response.pay + '\n');
                pre.append('　是否收款 : ' + (response.ispay ? '已收款' : '未收款') + '\n');
                pre.append('################################### \n' );
                $.each(response.rows, function(index, row) {
                    pre.append('產品名稱 : ' + row.pname +'\n');
                    pre.append('購買金額 : ' + row.totalmoney +'\n');
                    pre.append('購買數量 : ' + row.count +'\n');
                    pre.append('----------------------------------- \n' );
                });
            }
        },
        requestSendData: function(response) {
            $('<p/>')
                .html(response.message)
                .prependTo($messages);
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