(function(Endold) {

    var $formSearch = null;
    var $searchBtn = null;

    var app = {
        init: function() {
            $formSearch = $('#form-search');
            $searchBtn = $('#search-btn');

            app.bindEvents();
        },
        bindEvents: function() {
            $formSearch.bind('submit', app.stopEvent);
            $searchBtn.bind('click', app.gridReload);
        },
        stopEvent: function(){
            event && event.preventDefault();
        },
        gridReload: function() {
            console.log('run');
            grid.flexReload();
        },
        /* 加入 grid reload 時的參數 */
        addGridFormData: function() {
            var data = $formSearch.serializeArray();
            grid.flexOptions({params: data});
            return true;
        }
    };

    var grid = $('#order-record-list').flexigrid({
        url: Endold.cmdTo(126),
        dataType: 'json',
        colModel: [
            {
               display: '日期',
               name: 'date', 
               width: 200, 
               align: 'center'
            }, {
               display: '訂單編號',
               name: 'oid',
               width: 200,
               align: 'center',
            }, {
               display: '金額',
               name: 'money', 
               width: 200, 
               align: 'center', 
            },
        ],
        method: 'POST',
        idProperty: 'id',
        sortname: "time",
        sortorder: "desc",
        usepager: true,
        title: '訂購紀錄',
        useRp: true,
        rp: 10,
        showTableToggleBtn: true,
        width: '100%',
        height: 400,
        onSubmit: app.addGridFormData

    });
    app.init();
    window.OrderRcordApp = app;
})(top.Endold);