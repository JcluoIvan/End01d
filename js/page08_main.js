(function(Endold, OptionBar) {
    var $buttonNewProduct = null;
    var $iframeModify = null;
    var _MODIFY_URL = '/page/page03/order_detail.php';
    var Reject_LIST_URL = '/page/page08/reject_record_list.php';
    var $searchForm = null;
    var app = {
        init: function() {
            $searchForm = $('#command-search');
            app.bindEvents();
        },
        bindEvents: function() {
            $searchForm.bind('submit', app.gridReload);
        },
        searchData: function() {
            var data = $searchForm.serializeArray();
            grid.flexOptions({params: data});
            return true;
        },
        gridReload: function(event) {
            console.log('run');
            event && event.preventDefault();
            grid.flexReload();
        }
    };

    var option = new OptionBar({
        optionElement: $('#option-bar'),
        mainElement: $('#option-main'),
        formElement: '#option-form',
        height: 400,
        onModify: function() {
            console.log(this);
            return $(this).attr('href') || Endold.linkTo('/page/page03/order_detail.php', {id: id});
        },
        onSave: function() {
            var $this = $(this);
            if ($this.hasClass('reject')) {
                return Endold.cmdTo(300);
            } else if ($this.hasClass('swap')) {
                return Endold.cmdTo(304);
            } else if ($this.hasClass('modify')) {
                return Endold.cmdTo(308);
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
            new Calendar({
                  inputField: "receivable",
                  dateFormat: "%Y-%m-%d",
                  trigger: "receivable.onclick",
                  bottomBar: true,
                  weekNumbers: true,
                  onSelect: function() {this.hide();}
                });
        },
        onSaveRequest: function(r) {
            console.log(r);
            ProductApp.gridReload();
        },
        // insert: {
        // },
        insert: false,
        save: false,
        cancel: false
    });

    var grid = $('#order-list').flexigrid({
        url: Endold.cmdTo(800),
        dataType: 'json',
        colModel: [
            {
               display: '會員編號',
               name: 'no', 
               width: 120, 
               align: 'center', 
            }, {
              
               display: '會員名稱',
               name: 'name', 
               width: 120, 
               align: 'center'
            }, {
               display: '消費金額',
               name: 'total2', 
               width: 120, 
               align: 'center'
            }, {
               display: '退貨金額',
               name: 'reject', 
               width: 120, 
               align: 'center'
            }, {
               display: '回饋%數',
               name: 'lv2percent', 
               width: 60, 
               align: 'center'
            }, {
               display: '獎金',
               name: 'total3', 
               width: 120, 
               align: 'center'
            }, {
                display: ' ',
                name: 'mid', 
                width: 80, 
                align: 'center',
                process: function(div, sn) {
                    var checkMid = div.innerHTML;
                    var date1 = $('#year').val();
                    var date2 = $('#month').val();
                    var url = Endold.linkTo(Reject_LIST_URL, {sn: Number(checkMid), date1: date1, date2: date2});
                    var $a = $('<a>退貨單記錄</a>')
                        .attr({href: url});
                    $(div).html($a);
                    // return div;
                }
            }

        ],
        idProperty: 'sn',
        sortname: "date1",
        sortorder: "desc",
        usepager: true,
        title: '展示中心專區',
        useRp: true,
        rp: 10,
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
