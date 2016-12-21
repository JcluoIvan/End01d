(function(Endold, OptionBar) {
    var VIEW_URL = '/page/page07/radar_bonus_detail_list.php';
    var $form = null;
    var $grid = null;

    var app = {
        init: function() {
            $form = $('#form');
            $grid = $('#detail-list');
            app.bindEvents();
        },
        bindEvents: function() {
            $form.bind('submit', function(e) {
                app.reloadGrid();
                e.preventDefault();
            });
            $grid.flexigrid({
                url: Endold.cmdTo(721),
                dataType: 'json',
                colModel: [
                    {
                        display: '訂單編號',
                        name: 'sn',
                        width: 100,
                        align: 'center'
                    }, {
                        display: '總金額',
                        name: 'total',
                        width: 80,
                        align: 'center',
                        process: function(div) {
                            div.style.textAlign = 'right';
                        }
                    }, {
                        display: '使用購物金',
                        name: 'coupon',
                        width: 80,
                        align: 'center',
                        process: function(div) {
                            div.style.textAlign = 'right';
                        }
                    }, {
                        display: '實收金額',
                        name: 'money',
                        width: 80,
                        align: 'center',
                        process: function(div) {
                            div.style.textAlign = 'right';
                        }
                    }, {
                        display: '獎金成數 (百分比 %)',
                        name: 'percent',
                        width: 120,
                        align: 'center'
                    }, {
                        display: '獎金額度',
                        name: 'bonus',
                        width: 80,
                        align: 'center',
                        process: function(div) {
                            div.style.textAlign = 'right';
                        }
                    }
                ],
                method: 'POST',
                idProperty: 'sn',
                sortname: "time",
                sortorder: "desc",
                usepager: true,
                title: '獎金明細',
                useRp: true,
                rp: 10,
                showTableToggleBtn: true,
                width: '100%',
                height: 250,
                onSubmit: app.addGridFormData
            });
        },
        addGridFormData: function() {
            var data = $form.serializeArray();
            $grid.flexOptions({params: data});
            return true;
        },
        reloadGrid: function() {
            $grid.flexReload();
        },
    };

    app.init();
    window.RadarDetailList = app;
})(top.Endold, top.OptionBar);