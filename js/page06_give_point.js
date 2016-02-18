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
            var searchKind = $('#searchKind').val();
            var search = $('#search').val();
            var date1 = $('#date1').val();
            var date2 = $('#date2').val();
            var url = Endold.linkTo('/page/page06/point_print.php', {
                searchKind: searchKind,
                search: search,
                date1: date1,
                date2: date2,
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
        },
        onSaveRequest: function(r) {
        },
        insert: false,
        save: false,
        cancel: false
    });

    var grid = $('#give-point-list').flexigrid({
        url: Endold.cmdTo(620),
        dataType: 'json',
        colModel: [
            {
               display: '訂單編號',
               name: 'ono',
               width: 100,
               align: 'center',
            }, {
               display: '交易日',
               name: 'trans_date',
               width: 100, 
               align: 'center', 
            }, {
               display: '核帳日',
               name: 'verification_date',
               width: 100, 
               align: 'center', 
            }, {
               display: '入帳日',
               name: 'give_date',
               width: 100, 
               align: 'center', 
            }, {
               display: '會員編號',
               name: 'mem_no',
               width: 100, 
               align: 'center', 
            },{
               display: '實收金額',
               name: 'pay_amount',
               width: 100,
               align: 'center',
            }, {
               display: '發放點數',
               name: 'give_point',
               width: 100,
               align: 'center', 
            },{
               display: '展示中心編號',
               name: 'age_no',
               width: 100, 
               align: 'center', 
            },{
               display: '上一層名稱/發放點數',
               name: 'mlv1',
               width: 130, 
               align: 'center', 
            },{
               display: '上二層名稱/發放點數',
               name: 'mlv2',
               width: 130, 
               align: 'center', 
            },{
               display: '上三層名稱/發放點數',
               name: 'mlv3',
               width: 130, 
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
    window.GivePointApp = app;
    window.GivePointGrid = grid;
    window.GivePointOption = option;
})(top.Endold, top.OptionBar);