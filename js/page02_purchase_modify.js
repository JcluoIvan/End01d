(function(Endold) {
    var PURCHASE_MODIFY_URL = '/page/page02/purchase_modify.php';

    var gridInit = function($element) {
        return $element.flexigrid({
            url: Endold.cmdTo(213),
            dataType: 'json',
            colModel: [ 
                {
                    display: '產品序號',
                    name: 'product_no', 
                    width: 100, 
                    align: 'center'
                }, {
                    display: '產品名稱',
                    name: 'product_name', 
                    width: 200, 
                    align: 'center'
                }, {
                    display: '產品類型',
                    name: 'product_item', 
                    width: 200, 
                    align: 'center'
                }, {
                    display: '進貨數量',
                    name: 'count', 
                    width: 140, 
                    align: 'center',
                    process: function(div, id) {
                        var count = Number(div.innerHTML);
                        var $div = $(div).html('');
                        var $link = $('<a href="#"/>');

                        $link
                            .html(count)
                            .data('row.id', id)
                            .attr('title', '修改進貨數量')
                            .bind('click', app.updatePurchaseCount)
                            .appendTo($div);
                    }
                }, {
                    display: '操作',
                    name: 'modify', 
                    width: 100, 
                    align: 'center',
                    process: function(div, id) {
                        var $link = $('<a href="#" />');
                        var $div = $(div).html('');

                        $link.html('刪除')
                            .data('row.id', id)
                            .bind('click', app.deletePurchase)
                            .appendTo($div);
                    }
                }
            ],
            idProperty: 'id',
            sortname: "time",
            sortorder: "desc",
            usepager: true,
            title: '進貨清單',
            useRp: true,
            rp: 10,
            width: '100%',
            height: 280,
            onSubmit: app.addGridFormData

        });
    }

    var app = {
        grid: {},
        option: null,
        mainApp: null,
        $agent: null,
        $detail: {
            parent: null,
            save: null,
            agent: null,
            item: null,
            name: null,
            add: null,
            count: null
        },
        init: function(option, mainApp) {
            app.option = option;
            app.mainApp = mainApp;
            app.$detail.parent = $('#option-form input[name=id]');
            app.$detail.agent = $('#option-form input[name=aid]');
            app.$detail.save = $('#option-form #save-purchase');
            app.$detail.item = $('#option-form #product-item');
            app.$detail.name = $('#option-form #product-name');
            app.$detail.count = $('#option-form #count');
            app.$detail.add = $('#add-purchase');
            app.grid = gridInit($('#purchase-list'));
            app.bindEvents();
            return app;
        },
        bindEvents: function() {
            app.$detail.save.bind('click', app.savePurchase);
            app.$detail.item.bind('change', app.onChangeProductItem);
            app.$detail.name.bind('change', app.onChangeProductName);
            app.$detail.count.bind('keydown', app.onKeyDownCount);
            app.$detail.add.bind('click', app.onClickAddPurchase);

        },
        savePurchase: function() {
            var data = $('#option-form').serialize();
            var $this = $(this);
            $this.prop('disabled', true);
            Endold.post(216, data)
                .done(app.requestSaveSuccess)
                .fail(function() { $this.prop('disabled', false); });

        },
        requestSaveSuccess: function(response) {
            if (! response.status) return;
            app.mainApp.reload();
            app.option.modify(Endold.linkTo(PURCHASE_MODIFY_URL, {id: response.id}));
        },
        onChangeProductItem: function() {
            var iid = app.$detail.item.val();
            Endold.post(212, {iid: iid})
                .done(app.renderProducts);
        },
        onChangeProductName: function() {
            app.$detail.count.select();
        },
        onKeyDownCount: function(event) {
            if (event.keyCode == 13) {
                app.onClickAddPurchase();
                event && event.preventDefault();
            }
        },
        onClickAddPurchase: function() {
            var data = {
                parent: app.$detail.parent.val(),
                pid: app.$detail.name.val(),
                aid: app.$detail.agent.val(),
                count: app.$detail.count.val()
            };
            Endold.post(214, data)
                .done(app.requestAddPurchase);
        },
        requestAddPurchase: function(response) {
            if (! response.status) alert(response.message);
            app.reload();
        },
        renderProducts: function(response) {
            if (! response.status) return;
            app.$detail.name.html('');
            $.each(response.rows, function(i, o) {
                $('<option/>')
                    .html(o.name)
                    .val(o.id)
                    .appendTo(app.$detail.name);
            });

        },
        updatePurchaseCount: function() {
            var $this = $(this);
            var id = $this.data('row.id');

            var value = prompt("更新商品進貨數量", $this.val());

            if (value !== null) {
                Endold.post(214, {id: id, count: value})
                    .done(app.reload);
            }
        },
        deletePurchase: function() {
            var $this = $(this);
            var id = $this.data('row.id');
            if (confirm('確定刪除此資料？')) {
                Endold.post(215, {id: id})
                    .done(app.reload);
            }
        },
        reload: function() {
            app.grid.flexReload();
        },
        addGridFormData: function() {
            var data = [
                {
                    name: 'parent',
                    value: app.$detail.parent.val()
                }
            ];
            app.grid.flexOptions({params: data});
            return true;
        }
    };

    window.PurchaseModify = app;
})(top.Endold);