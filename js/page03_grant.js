(function(Endold, OptionBar) {
    var VIEW_URL = '/page/page03/grant_view.php';

    var app = {

        /* 核帳後幾天才能結算 */
        clearing_date: 0,

        init: function() {
            app.bindEvents();
        },
        bindEvents: function() {
        },
        run: function() {
            var $this = $(this);
            Endold.post(361, {days: $this.data('data.days')})
                .done(app.request);
        },
        request: function(response) {
            if (! response.status) return alert(response.message);
            
            app.gridReload();

        },
        viewPend: function() { 

        },
        viewFinish: function() {

        },
        gridReload: function() {
            grid.flexReload();
        }
    };

    var grid = $('#grant-list').flexigrid({
        url: Endold.cmdTo(360),
        dataType: 'json',
        colModel: [
            {
                display: '待處理筆數',
                name: 'pend',
                width: 80,
                align: 'center',
                process: function(div, days) {
                    var $link = $('<a href="#"/>');
                    $link.data({'data.days': (days || 0), 'data.type': 'pend'})
                        .bind('click', option.view)
                        .html(div.innerHTML);
                    $(div).html($link);
                }
            }, {
                display: '完成筆數',
                name: 'finish',
                width: 80,
                align: 'center',
                process: function(div, days) {
                    var $link = $('<a href="#"/>');
                    $link.data({'data.days': (days || 0), 'data.type': 'finish'})
                        .bind('click', option.view)
                        .html(div.innerHTML);
                    $(div).html($link);
                }
            }, {
                display: '交易金額',
                name: 'money', 
                width: 60,
                align: 'center'
            }, {
                display: '交易日期',
                name: 'completed_at', 
                width: 80,
                align: 'center'
            }, {
                display: '執行計算',
                name: 'do_clearing', 
                width: 120,
                align: 'center',
                process: function(div, days) {
                    var $a = $('<a class="link-option">執行</a>');
                    var days = parseInt(days, 10);
                    $a.data('data.days', days)
                        .bind('click', app.run);
                    if (days < app.clearing_date) {
                        div.innerHTML = '交易後未滿 ' + app.clearing_date + ' 天';
                    } else {
                        $(div).html($a);
                    }
                }
            }
        ],
        idProperty: 'days',
        sortname: "time",
        sortorder: "desc",
        usepager: true,
        title: '待計算交易',
        useRp: true,
        rp: 10,
        showTableToggleBtn: true,
        width: '100%',
        height: 250,
        preProcess: function(o) {
            app.clearing_date = Number(o.clearing_date) || 0;
            return o;

        }

    });

    var view = {
        days: null,
        type: null,
        grid: null,
        init: function() {
            view.days = $('#days').val();
            view.type = $('#type').val();
            var title = view.type === 'pend' ? '待處理交易' : '已處理交易';
            // var lid = $('#log-id').val();
            view.grid = $('#data-view').flexigrid({
                url: Endold.cmdTo(362),
                dataType: 'json',
                colModel: [
                    {
                        display: '訂單序號',
                        name: 'oid',
                        width: 100,
                        align: 'center'
                    }, {
                        display: '會員',
                        name: 'member',
                        width: 140,
                        align: 'center'
                    }, {
                        display: '交易日',
                        name: 'date1', 
                        width: 100,
                        align: 'center'
                    }, {
                        display: '核帳日',
                        name: 'date2', 
                        width: 100,
                        align: 'center'
                    }, {
                        display: '獎金、購物金計算日',
                        name: 'date3', 
                        width: 120,
                        align: 'center'
                    }, {
                        display: '總金額',
                        name: 'money', 
                        width: 160,
                        align: 'center'
                    }, {
                        display: '入帳購物金',
                        name: 'point',
                        width: 120,
                        align: 'center'
                    }
                ],
                idProperty: 'id',
                sortname: "time",
                sortorder: "desc",
                usepager: true,
                title: title,
                useRp: true,
                rp: 10,
                showTableToggleBtn: true,
                width: '100%',
                height: 250,
                params: [
                    {name: 'days', value: view.days},
                    {name: 'type', value: view.type}
                ]
            });
        }
    };
    var option = new OptionBar({
        optionElement: $('#option-bar'),
        mainElement: $('#option-main'),
        formElement: '#option-form',
        height: 360,
        onView: function() {
            var type = $(this).data('data.type');
            var days = $(this).data('data.days');
            return Endold.linkTo(VIEW_URL, {days: days, type: type});
        },
        onShow: view.init,
        insert: false,
        save: false,
        cancel: {}
    });
    app.init();
})(top.Endold, top.OptionBar);