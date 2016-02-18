(function(Endold, OptionBar) {

    var $formSearch = null;
    var $searchBtn = null;
    var $print = null;

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
            var url = Endold.linkTo('/page/page07/radar_print.php', {
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
        height: 200,
        onModify: function() {
            var $oid = $(this).attr('oid') || 0;
            var url = $(this).attr('url');

            return Endold.linkTo(
                url, {oid: $oid}
            );
        },
        onSave: function() {
        },
        onSaveRequest: function(r) {
        },
        insert: false,
        save: false,
        cancel: {}
    });

    var grid = $('#radar-bonus-list').flexigrid({
        url: Endold.cmdTo(710),
        dataType: 'json',
        colModel: [
            {
                display: '訂單編號',
                name: 'ono',
                width: 100,
                align: 'center'
            }, {
                display: '交易日',
                name: 'trans_date',
                width: 80,
                align: 'center',
            }, {
                display: '核帳日',
                name: 'verification_date',
                width: 80, 
                align: 'center', 
            }, {
                display: '展示中心編號',
                name: 'age_no',
                width: 100, 
                align: 'center', 
            }, {
                display: '店名',
                name: 'age_store',
                width: 140, 
                align: 'center', 
            }, {
                display: '使用購物金',
                name: 'pay_point',
                width: 100,
                align: 'center', 
            }, {
                display: '%',
                name: 'percent',
                width: 50, 
                align: 'center', 
            }, {
                display: '實付獎金',
                name: 'give_bonus',
                width: 100, 
                align: 'center', 
            }, {
                display: '獎金核帳日',
                name: 'bonus_verification',
                width: 120, 
                align: 'center', 
            }, {
                display: '',
                name: 'detail',
                width: 50, 
                align: 'center', 
                process: function(div, oid) {
                    var $div = $(div);
                    $div.html('');
                    var url = '/page/page07/radar_bonus_detail.php';
                    var $a = $('<a>明細</a>')
                        .attr({href: '#', url: url, oid: oid})
                        .bind('click', option.modify)
                        .appendTo($div);
                }
            },
        ],
        method: 'POST',
        idProperty: 'oid',
        sortname: "time",
        sortorder: "desc",
        usepager: true,
        title: '購物金統計表 - 展示中心',
        useRp: true,
        rp: 10,
        showTableToggleBtn: true,
        width: '100%',
        height: 300,
        onSubmit: app.addGridFormData
    });
    app.init();
    window.RadarBonusApp = app;
    window.RadarBonusGrid = grid;
    window.RadarBonusOption = option;
})(top.Endold, top.OptionBar);