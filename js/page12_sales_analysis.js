(function(Endold, OptionBar) {
    var $buttonNewProduct = null;
    var $iframeModify = null;
    var _MODIFY_URL = '/page/page12/order_detail.php';
    var $searchForm = null;
    var $search = {
        selectRAgent: null,
    };

    var $modify = {
        selectRAgent: null,
        inputAgent: null,
        selectItem: null,
        selectProduct: null,
        inputProduct: null
    };

    var app = {
        init: function() {
            $search.selectRAgent = $('#r-agent');
            $searchForm = $('#command-search');
            $printButton = $('#print');
            app.bindEvents();
        },
        bindEvents: function() {
            $searchForm.bind('submit', app.gridReload);
            $printButton.bind('click', app.onclickPrint);
            // $search.selectRAgent.bind('change', app.reloadGrid);
        },
        onclickPrint: function() {
            var rid = $('#rid').val();
            var no = $('#no').val();
            var date1 = $('#date1').val();
            var date2 = $('#date2').val();
            var url = Endold.linkTo('/page/page12/sales_analysis_print.php', {
                rid: rid,
                no: no,
                date1: date1,
                date2: date2
            });
            window.open(url);
        },
        searchData: function() {
            var data = $searchForm.serializeArray();
            grid.flexOptions({params: data});
            return true;
        },

        reloadGrid: function() {
            grid.flexReload();
        },

        gridReload: function(event) {
            event && event.preventDefault();
            grid.flexReload();
        }
    };

    var option = new OptionBar({
        optionElement: $('#option-bar'),
        mainElement: $('#option-main'),
        formElement: '#option-form',
        height: 600,
        onModify: function() {
            return $(this).attr('href') || Endold.linkTo('/page/page12/order_detail.php', {id: id});
        },
        onSave: function() {
            var $this = $(this);
            if ($this.hasClass('reject')) {
                return Endold.cmdTo(1200);
            } else if ($this.hasClass('swap')) {
                return Endold.cmdTo(1204);
            } else if ($this.hasClass('modify')) {
                return Endold.cmdTo(1208);
            }
        },
        onShow: function() {
            new Calendar({
                  inputField: "delivery",
                  dateFormat: "%Y-%m-%d",
                  trigger: "delivery.onclick",
                  bottomBar: true,
                  weekNumbers: true,
                  onSelect: function() {this.hide();}
                });
            new Calendar({
                  inputField: "signoff",
                  dateFormat: "%Y-%m-%d",
                  trigger: "signoff.onclick",
                  bottomBar: true,
                  weekNumbers: true,
                  onSelect: function() {this.hide();}
                });
        },
        onSaveRequest: function(r) {
            ProductApp.gridReload();
        },
        // insert: {
        // },
        insert: false,
        save: false,
        cancel: false
    });

    var grid = $('#order-list').flexigrid({
        url: Endold.cmdTo(1211),
        dataType: 'json',
        colModel: [
            {
               display: '產品編號',
               name: 'no', 
               width: 100, 
               align: 'center', 
            }, {
               display: '產品名稱',
               name: 'name', 
               width: 100, 
               align: 'center'
            }, {
               display: '訂貨數量',
               name: 'order_count', 
               width: 60, 
               align: 'center'
            }, {
               display: '退貨數量',
               name: 'reject_count', 
               width: 60, 
               align: 'center'
            }, {
               display: '換貨數量',
               name: 'swap_count', 
               width: 60, 
               align: 'center'
            }, {
               display: '合計',
               name: 'total_count', 
               width: 60, 
               align: 'center'
            }

        ],
        idProperty: 'id',
        sortname: "id",
        sortorder: "desc",
        usepager: true,
        title: '銷售分析表',
        useRp: true,
        rp: 10,
        rpOptions: [10, 15, 20, 30, 50],
        showTableToggleBtn: true,
        width: '100%',
        // onSubmit: addFormData,
        height: 400,
        onSubmit: app.searchData


    });
    window.ProductApp = app;
    window.OrderGrid = grid;
    app.init();
})(top.Endold, top.OptionBar);