(function(Endold, OptionBar) {
    var PURCHASE_MODIFY_URL = '/page/page02/purchase_modify.php';
    var RETURN_MODIFY_URL = '/page/page02/return_modify.php';
    var $search = {
        form: null,
        agentL: null,
        agentR: null,
        item: null,
    };

    var modify = null;

    var $returnBtn = null;
    var app = {
        init: function() {
            $search.form = $('#form-search');
            $search.agentL = $('#l-agent');
            $search.agentR = $('#r-agent');
            $search.item = $('#product-item');

            $returnBtn = $('#return-button');
            app.bindEvents();
        },
        bindEvents: function() {
            $search.agentL.bind('change', app.changeLAgent);
            $search.agentR.bind('change', app.changeRAgent);
            $search.item.bind('change', function() { app.reload(1); });
            $returnBtn.bind('click', option.modify);
        },
        changeLAgent: function() {
            var lid = $search.agentL.val();
            Endold.post(211, {lid: lid})
                .done(app.reloadRAgent);
        },
        changeRAgent: function() {
            option.cancel();
            app.reload(1);
        },
        reloadRAgent: function(request) {
            if (! request.status) alert(request.message);
            $search.agentR.html('');
            $.each(request.rows, function(value, label) {
                $('<option/>')
                    .val(value)
                    .html(label)
                    .appendTo($search.agentR);
            });
            app.changeRAgent();
        },
        deletePurchase: function() {
            var $this = $(this);
            var id = $this.data('row.id');
            if (confirm('確定刪除此資料？')) {
                Endold.post(217, {id: id})
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
        height: 540,
        onModify: function(url) {
            if (!$search.agentR.val()) {
                alert('請選擇「展示中心」');
                return false;
            } else if (typeof url === 'string') {
                return url;
            } else {
                var url = $(this).hasClass('type-return') ?
                    RETURN_MODIFY_URL : 
                    PURCHASE_MODIFY_URL;
                var id = $(this).data('row.id') || 0;
                var aid = $search.agentR.val();
                return Endold.linkTo(url, {id: id, aid: aid});
            }
        },
        onSave: function() {
            return $('#option-form').hasClass('type-return') ?
                Endold.cmdTo(266) : 
                Endold.cmdTo(216);
        },
        onSaveRequest: function(request) {
            if (! request.status) {
                alert(request.message);
                return false;
            }
            app.reload();
        },
        onShow: function($main) {
            $('#purchase-date').length && 
                new Calendar({
                    inputField: 'purchase-date',
                    dateFormat: '%Y-%m-%d',
                    trigger: 'purchase-date-active',
                    bottomBar: true,
                    weekNumbers: true,
                    onSelect: function() {this.hide(); }
                });
            modify = $main.find('#option-form').hasClass('type-return') ? 
                ReturnModify.init(option, app) :
                PurchaseModify.init(option, app);
        },
        insert: {label: '新增進貨'},
        save: {},
        cancel: {}
    });

    var grid = $('#purchase-list').flexigrid({
        url: Endold.cmdTo(210),
        dataType: 'json',
        colModel: [ 
            {
               display: '單號',
               name: 'no', 
               width: 140, 
               align: 'center'
            }, {
                display: '進 / 退貨',
                name: 'type',
                width: 80,
                align: 'center',
                process: function(div, id) {
                    var isPurchase = div.innerHTML === 'purchase';
                    div.innerHTML = isPurchase ? '進貨' : '退貨';
                    div.style.color = isPurchase ? 'blue' : 'orange';
                }
            }, {
               display: '郵寄編號',
               name: 'pn', 
               width: 140, 
               align: 'center'
            }, {
               display: '到貨日期',
               name: 'date', 
               width: 100, 
               align: 'center'
            }, {
               display: '最後編輯',
               name: 'editor', 
               width: 140, 
               align: 'center'
            }, {
                display: ' ',
                name: 'type', 
                width: 120, 
                align: 'center',
                process: function(div, id) {
                    var isPurchase = div.innerHTML === 'purchase';
                    var $div = $(div).html('');
                    $('<a href="#">修改</a>')
                        .data('row.id', id)
                        .toggleClass('type-return', ! isPurchase)
                        .bind('click', option.modify)
                        .appendTo($div);
                    $div.append(' / ');
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

    app.init();
    window.PurchaseApp = app;
    window.PurchaseGrid = grid;
    window.PurchaseOption = option;
})(top.Endold, top.OptionBar);