(function(Endold, OptionBar) {

    $formSearch = null;
    $searchBtn = null;
    $print = null;

    var app = {
        init: function() {
            $formSearch = $('#form-search');
            $searchBtn = $('#search-btn');
            $print = $('#print');

            app.bindEvents();
        },
        bindEvents: function() {
            
            $formSearch.bind('submit', app.stopEvent);
            $searchBtn.bind('click', app.reloadGrid);
            $print.bind('click', app.printPage);

        },
        stopEvent: function(event) {
            event && event.preventDefault();
        },
        reloadGrid: function() {
            console.log('run');
            grid.flexReload();
        },
        /* 加入 grid reload 時的參數 */
        addGridFormData: function() {
            var data = $formSearch.serializeArray();
            grid.flexOptions({params: data});
            return true;
        },
        /* 列印 */
        printPage: function() {
            var kind = $('#kind').val();
            var date1 = $('#date1').val();
            var url = Endold.linkTo('/page/page05/report_print.php', {
                kind: kind,
                date1: date1,
            });
            window.open(url);
        },
    };

    var option = new OptionBar({
        optionElement: $('#option-bar'),
        mainElement: $('#option-main'),
        formElement: '#option-form',
        height: 650,
        onModify: function() {
        },
        onSave: function() {
            return Endold.cmdTo(510);
        },
        onSaveRequest: function(r) {
            console.log(r);
            ReportDayApp.gridReload();
        },
        insert: false,
        save: false,
        cancel: false
    });

    var grid = $('#report-day-list').flexigrid({
        url: Endold.cmdTo(510),
        dataType: 'json',
        colModel: [
            {
               display: '展示中心編號',
               name: 'age_no', 
               width: 100, 
               align: 'center'
            }, {
               display: '展示中心名稱',
               name: 'age_name',
               width: 100,
               align: 'center',
            }, {
               display: '展示中心店名',
               name: 'age_store',
               width: 150, 
               align: 'center', 
            },{
               display: '商品金額',
               name: 'pay_amount',
               width: 100, 
               align: 'center', 
            },{
               display: '+ 運費',
               name: 'fare',
               width: 100, 
               align: 'center', 
            },{
               display: '- 退貨金額',
               name: 'reject_amount',
               width: 100,
               align: 'center', 
            },{
               display: '= 總金額',
               name: 'amount',
               width: 140, 
               align: 'center', 
            },{
               display: '使用購物金',
               name: 'pay_point',
               width: 100, 
               align: 'center', 
            },
        ],
        method: 'POST',
        idProperty: 'oid',
        sortname: "time",
        sortorder: "desc",
        usepager: true,
        title: '購買紀錄',
        useRp: true,
        rp: 10,
        showTableToggleBtn: true,
        width: '100%',
        height: 300,
        onSubmit: app.addGridFormData
    });
    app.init();
    window.ReportDayApp = app;
    window.ReportDayGrid = grid;
    window.ReportDayOption = option;
})(top.Endold, top.OptionBar);