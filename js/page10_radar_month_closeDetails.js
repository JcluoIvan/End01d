(function(Endold, OptionBar) {
    var $buttonNewProduct = null;
    var $iframeModify = null;
    var VIEW_URL = 'radar_month_closeDetails.php';
    var $searchForm = null;
    var app = {
        init: function() {
            $searchForm = $('#search-data');
            app.bindEvents();
        },
        bindEvents: function() {
            $searchForm.bind('submit', app.gridReload);
        },
        searchData: function() {
            var data = $searchForm.serializeArray();
            console.log(data);
            grid.flexOptions({params: data});
            return true;
        },
        gridReload: function(event) {
            console.log('run');
            event && event.preventDefault();
            grid.flexReload();
        }
    };

    

    var grid = $('#order-list').flexigrid({
        url: Endold.cmdTo(1032),
        dataType: 'json',
        colModel: [
        // {
        //         display: 'ID',
        //         name: 'id',
        //         hi


        //     }, 
            {
               display: '序號',
               name: 'sn', 
               width: 150, 
               align: 'center', 
            }, {
               display: '訂單編號',
               name: 'oid', 
               width: 100, 
               align: 'center'
            }, {
               display: '金額',
               name: 'total', 
               width: 100, 
               align: 'center'
            }, {
               display: '應收款項',
               name: 'money', 
               width: 300, 
               align: 'center'
            }, {
               display: '使用購物金',
               name: 'coupon', 
               width: 200, 
               align: 'center'
            }

        ],
        idProperty: 'sn',
        sortname: "sn",
        sortorder: "desc",
        usepager: true,
        title: '展示中心月結 - 明細',
        useRp: true,
        rp: 10,
        showTableToggleBtn: true,
        width: '100%',
        // onSubmit: addFormData,
        height: 400,
        onSubmit: app.searchData


    });
    window.ProductApp = app;
    window.OrderGrid = grid;
    app.init();
})(top.Endold, top.OptionBar);
