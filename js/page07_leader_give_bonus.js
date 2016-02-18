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
        /* 業務獎金核帳 */
        verification: function() {
            var data = $formSearch.serializeArray();
            var aid = $(this).data('aid');
            var oid = $(this).data('oid');

            data.push({'name': 'aid', 'value': aid});
            data.push({'name': 'oid', 'value': oid});

            Endold.post(712, data)
                .done(app.reloadGrid);
            app.stopEvent();

        },
        /* 列印 */
        printPage: function() {
            var searchKind = $('#searchKind').val();
            var search = $('#search').val();
            var date1 = $('#date1').val();
            var date2 = $('#date2').val();
            var url = Endold.linkTo('/page/page07/leader_give_print.php', {
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

    var grid = $('#leader-point-list').flexigrid({
        url: Endold.cmdTo(740),
        dataType: 'json',
        colModel: [
            {
               display: '專業經理人編號',
               name: 'ano',
               width: 200,
               align: 'center'
            },{
               display: '獎金統計',
               name: 'bonus',
               width: 200, 
               align: 'center'
            }, {
               display: '%',
               name: 'percent',
               width: 200, 
               align: 'center'
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
                        .bind('click', app.verification)
                        .appendTo($div);

               }
            }
        ],
        method: 'POST',
        idProperty: 'aid',
        sortname: "time",
        sortorder: "desc",
        usepager: true,
        title: '獎金發放-專業經理人',
        useRp: true,
        rp: 10,
        showTableToggleBtn: true,
        width: '100%',
        height: 300,
        onSubmit: app.addGridFormData
    });
    app.init();
    window.LeaderPointApp = app;
    window.LeaderPointGrid = grid;
    window.LeaderPointOption = option;
})(top.Endold, top.OptionBar);