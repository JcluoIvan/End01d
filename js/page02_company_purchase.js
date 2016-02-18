(function(Endold, OptionBar) {
    var MODIFY_URL = '/page/page02/company_purchase_modify.php';
    var $search = {
        form: null,
        item: null
    };


    var app = {
        init: function() {
            $search.form = $('#form-search');
            $search.item = $('#product-item');
            app.bindEvents();
        },
        bindEvents: function() {
            $search.item.bind('change', function() { app.reload(1); });
        },
        deletePurchase: function() {
            var $this = $(this);
            var id = $this.data('row.id');
            if (confirm('確定刪除此資料？')) {
                Endold.post(256, {id: id})
                    .done(app.requestDeletePurchase);
            }
        },
        requestDeletePurchase: function(response) {
            if (! response.status) alert(response.message);
            option.cancel();
            app.reload();
        },
        reload: function(page) {
            
            /* 設定頁數為第一頁 */
            page && grid.flexOptions({newp: page});
            grid.flexReload();
        },
        /* 加入 grid reload 時的參數 */
        addGridFormData: function() {
            var data = $search.form.serializeArray();
            grid.flexOptions({params: data});
            return true;
        }
    };

    var option = new OptionBar({
        optionElement: $('#option-bar'),
        mainElement: $('#option-main'),
        formElement: '#option-form',
        height: 520,
        onModify: function(url) {
            if (typeof url === 'string') {
                return url;
            } else {
                var id = $(this).data('row.id') || 0;
                return Endold.linkTo(MODIFY_URL, {id: id, aid: 0});
            }
        },
        onSave: function() {
            return Endold.cmdTo(253);
        },
        onSaveRequest: function(request) {
            if (! request.status) {
                alert(request.message);
                return false;
            }
            app.reload();
        },
        onShow: function() {
            $('#purchase-date').length && 
                new Calendar({
                    inputField: 'purchase-date',
                    dateFormat: '%Y-%m-%d',
                    trigger: 'purchase-date-active',
                    bottomBar: true,
                    weekNumbers: true,
                    onSelect: function() {this.hide(); }
                });
            modify.init();
        },
        insert: {},
        save: {},
        cancel: {}
    });

    var grid = $('#purchase-list').flexigrid({
        url: Endold.cmdTo(250),
        dataType: 'json',
        colModel: [ 
            {
               display: '進貨單號',
               name: 'no', 
               width: 140, 
               align: 'center'
            }, {
               display: '日期',
               name: 'date', 
               width: 140, 
               align: 'center'
            }, {
               display: '最後編輯',
               name: 'editor', 
               width: 140, 
               align: 'center'
            }, {
                display: ' ',
                name: 'modify', 
                width: 100, 
                align: 'center',
                process: function(div, id) {
                    var aid = div.innerHTML;
                    var $div = $(div).html('');
                    $('<a href="#">修改</a>')
                        .data('row.id', id)
                        .data('row.aid', aid)
                        .bind('click', option.modify)
                        .appendTo($div);
                }
            }, {
                display: ' ',
                name: 'delete', 
                width: 100, 
                align: 'center',
                process: function(div, id) {
                    var $div = $(div).html('');
                    $('<a href="#">刪除</a>')
                        .data('row.id', id)
                        .bind('click', app.deletePurchase)
                        .appendTo($div);
                }
            }, {
                display: '備住',
                name: 'remark', 
                width: 400, 
                align: 'center',
                process: function(div, id) {
                    // div.innerHTML = 
                    div.setAttribute('title', div.innerHTML);
                    div.style.textAlign = 'left';
                    return div;
    
                }

            }
        ],
        perProcess: function() {
            console.log(arguments);
        },
        idProperty: 'id',
        sortname: "time",
        sortorder: "desc",
        usepager: true,
        title: '通知',
        useRp: true,
        rp: 10,
        showTableToggleBtn: true,
        width: '100%',
        height: 150,
        onSubmit: app.addGridFormData

    });

    var modify = {
        grid: {},
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
        init: function() {
            modify.$detail.parent = $('#option-form input[name=id]');
            modify.$detail.agent = $('#option-form input[name=aid]');
            modify.$detail.save = $('#option-form #save-purchase');
            modify.$detail.item = $('#option-form #product-item');
            modify.$detail.name = $('#option-form #product-name');
            modify.$detail.count = $('#option-form #count');
            modify.$detail.add = $('#add-purchase');
            modify.grid = $('#purchase-list').flexigrid({
                url: Endold.cmdTo(251),
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
                                .bind('click', modify.updatePurchaseCount)
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
                                .bind('click', modify.deletePurchase)
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
                onSubmit: modify.addGridFormData

            });
            modify.bindEvents();
        },
        bindEvents: function() {
            modify.$detail.save.bind('click', modify.savePurchase);
            modify.$detail.item.bind('change', modify.onChangeProductItem);
            modify.$detail.name.bind('change', modify.onChangeProductName);
            modify.$detail.count.bind('keydown', modify.onKeyDownCount);
            modify.$detail.add.bind('click', modify.onClickAddPurchase);

        },
        savePurchase: function() {
            var data = $('#option-form').serialize();
            var $this = $(this);
            $this.prop('disabled', true);
            Endold.post(253, data)
                .done(modify.requestSaveSuccess)
                .fail(function() { $this.prop('disabled', false); });

        },
        requestSaveSuccess: function(response) {
            if (! response.status) return;
            app.reload();
            option.modify(Endold.linkTo(MODIFY_URL, {id: response.id}));
        },
        onChangeProductItem: function() {
            var iid = modify.$detail.item.val();
            Endold.post(252, {iid: iid})
                .done(modify.renderProducts);
        },
        onChangeProductName: function() {
            modify.$detail.count.select();
        },
        onKeyDownCount: function(event) {
            if (event.keyCode == 13) {
                modify.onClickAddPurchase();
                event && event.preventDefault();
            }
        },
        onClickAddPurchase: function() {
            var data = {
                parent: modify.$detail.parent.val(),
                pid: modify.$detail.name.val(),
                aid: modify.$detail.agent.val(),
                count: modify.$detail.count.val()
            };
            Endold.post(254, data)
                .done(modify.reload);
        },
        renderProducts: function(response) {
            if (! response.status) return;
            modify.$detail.name.html('');
            $.each(response.rows, function(i, o) {
                $('<option/>')
                    .html(o.name)
                    .val(o.id)
                    .appendTo(modify.$detail.name);
            });

        },
        updatePurchaseCount: function() {
            var $this = $(this);
            var id = $this.data('row.id');

            var value = prompt("更新商品進貨數量", $this.val());

            if (value !== null) {
                Endold.post(254, {id: id, count: value})
                    .done(modify.reload);
            }
        },
        deletePurchase: function() {
            var $this = $(this);
            var id = $this.data('row.id');
            if (confirm('確定刪除此資料？')) {
                Endold.post(255, {id: id})
                    .done(modify.reload);
            }
        },
        reload: function() {
            modify.grid.flexReload();
        },
        addGridFormData: function() {
            var data = [
                {
                    name: 'parent',
                    value: modify.$detail.parent.val()
                }
            ];
            modify.grid.flexOptions({params: data});
            return true;
        }
    };

    app.init();
    window.PurchaseApp = app;
    window.PurchaseGrid = grid;
    window.PurchaseOption = option;
})(top.Endold, top.OptionBar);