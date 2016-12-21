(function(Endold, OptionBar) {
    var VIEW_URL = '/page/page07/radar_bonus_detail_list.php';
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
        /* 業務獎金核帳 */
        verification: function() {
            var data = $formSearch.serializeArray();
            var aid = $(this).data('aid');
            var oid = $(this).data('oid');

            data.push({'name': 'aid', 'value': aid});
            data.push({'name': 'oid', 'value': oid});
            if (confirm('確定核帳？')) {
                Endold.post(712, data)
                    .done(app.reloadGrid);
            }
            app.stopEvent();

        },
        /* 列印 */
        printPage: function() {
            var searchKind = $('#searchKind').val();
            var search = $('#search').val();
            var date1 = $('#date1').val();
            var date2 = $('#date2').val();
            var url = Endold.linkTo('/page/page07/radar_give_print.php', {
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
        height: 350,
        onModify: function() {
            var $oid = $(this).attr('oid') || 0;
            var url = $(this).attr('url');

            return Endold.linkTo(
                url, {oid: $oid}
            );
        },
        onView: function() {
            var $this = $(this);
            var oid = $this.data('oid');
            return Endold.linkTo(VIEW_URL, {oid: oid});
        },
        onSave: function() {
        },
        onShow: function() {
            RadarDetailList && RadarDetailList.init();
        },
        onSaveRequest: function(r) {
        },
        insert: false,
        save: false,
        cancel: {}
    });

    var grid = $('#radar-point-list').flexigrid({
        url: Endold.cmdTo(720),
        dataType: 'json',
        colModel: [
            {
                display: '展示中心編號',
                name: 'ano',
                width: 200,
                align: 'center'
            }, {
                display: '店名',
                name: 'store',
                width: 200,
                align: 'center',
            }, {
                display: '應付獎金統計',
                name: 'bonus',
                width: 200,
                align: 'center',
            }, {
                display: '%',
                name: 'percent',
                width: 200,
                align: 'center',
            }, {
                display: '詳細清單',
                name: 'oid',
                width: 100,
                align: 'center',
                process: function(div, aid) {
                    var $div = $(div);
                    var oid = $div.html();
                    $('<a href="#"/>')
                        .data('oid', oid)
                        .html('清單列表')
                        .bind('click', function(e) {
                            option.view.apply(this);
                            e.preventDefault();
                        })
                        .appendTo($div.empty());
                }
            }, {
                display: '核帳',
                name: 'oid',
                width: 200,
                align: 'center',
                process: function(div, aid) {
                    var $div = $(div);
                    var $oid = $div.html();
                    $div.html('');

                    var $a = $('<a/>')
                        .attr('href', '#')
                        .data('aid', aid)
                        .data('oid', $oid)
                        .html('核帳')
                        .bind('click', option.view)
                        .appendTo($div);

               }
            }
        ],
        method: 'POST',
        idProperty: 'aid',
        sortname: "time",
        sortorder: "desc",
        usepager: true,
        title: '獎金發放-展示中心',
        useRp: true,
        rp: 10,
        showTableToggleBtn: true,
        width: '100%',
        height: 300,
        onSubmit: app.addGridFormData
    });
    app.init();
    window.RadarPointApp = app;
    window.RadarPointGrid = grid;
    window.RadarPointOption = option;
})(top.Endold, top.OptionBar);