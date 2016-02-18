(function(Endold, OptionBar) {
    var $buttonNewProduct = null;
    var $iframeModify = null;
    var _MODIFY_URL = '/page/page03/order_detail.php';
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
        url: Endold.cmdTo(900),
        dataType: 'json',
        colModel: [ 
            {
               display: '展示中心編號',
               name: 'account', 
               width: 200, 
               align: 'center', 
            }, {
              
               display: '展示中心名稱',
               name: 'name', 
               width: 200, 
               align: 'center'
            }, {
               display: '本月累積總額',
               name: 'total', 
               width: 200, 
               align: 'center'
            }, {
               display: '獎金',
               name: 'total2', 
               width: 200, 
               align: 'center'
            // }, {
            //    display: '取貨日期(店取)',
            //    name: 'date2', 
            //    width: 150, 
            //    align: 'center'
            // }, {
            //    display: '收款日期',
            //    name: 'date3', 
            //    width: 150, 
            //    align: 'center'
            // }, {
            //    display: '核帳日期',
            //    name: 'check_date', 
            //    width: 150, 
            //    align: 'center'
            // }, {
            //    display: '使用付款方式',
            //    name: 'methods', 
            //    width: 100, 
            //    align: 'center'
            // }, {
            //    display: '取貨方式',
            //    name: 'getmode', 
            //    width: 100, 
            //    align: 'center'
            // }, {
            //    display: '指揮站編號',
            //    name: 'lv1id', 
            //    width: 100, 
            //    align: 'center'
            // }, {
            //    display: '展示中心編號',
            //    name: 'lv2id', 
            //    width: 100, 
            //    align: 'center'
            // }, {
            //    display: '取貨序號',
            //    name: 'getno', 
            //    width: 100, 
            //    align: 'center'
            // }, {
            //    display: '取貨店編號',
            //    name: 'lv2id', 
            //    width: 100, 
            //    align: 'center'
            // }, {
            //     display: ' ',
            //     name: 'swap', 
            //     width: 100, 
            //     align: 'center',
            //     process: function(div, sn) {
            //         var url = Endold.linkTo('page/page03/order_swap.php', {sn: sn });
            //         // var has = Number(div.innerHTML) !== 0;
            //         var $a = $('<a/>').html('換貨')

            //         // if (has) {
            //             // $a.css({color: '#aaa', cursor: 'not-allowed'});
            //         // } else {
            //             $a.bind('click', option.modify)
            //                 .attr('href', url);
            //         // }

            //         $(div).html($a);
            //         // return div;
            //     }

            // }, {
            //     display: ' ',
            //     name: 'reject', 
            //     width: 100, 
            //     align: 'center',
            //     process: function(div, sn) {
            //         var url = Endold.linkTo('page/page03/order_reject.php', {sn: sn });
            //         // var has = Number(div.innerHTML) !== 0;
            //         // var has = Number(div.innerHTML);
            //         var $a = $('<a/>').html('退貨')
            //         // alert(div.innerHTML);
            //         console.log(Number(div.innerHTML),Number(div.innerHTML) !== 0);
            //         // if (has) {
            //             // $a.css({color: '#aaa', cursor: 'not-allowed'});
            //         // } else {
            //             $a.bind('click', option.modify)
            //                 .attr('href', url);
            //         // }

            //         $(div).html($a);
            //         // return div;
            //     }

            // }, {
            //     display: ' ',
            //     name: 'modify', 
            //     width: 100, 
            //     align: 'center',
            //     process: function(div, sn) {
            //         var url = Endold.linkTo('page/page03/order_modify.php', {sn: sn});
            //         var $a = $('<a/>').html('修改')
            //             $a.bind('click', option.modify)
            //                 .attr('href', url);

            //         $(div).html($a);
            //         // return div;
            //     }
            // }, {
            //     display: ' ',
            //     name: 'detail', 
            //     width: 100, 
            //     align: 'center',
            //     process: function(div, sn) {
            //         var url = Endold.linkTo('page/page03/order_detail', {sn: sn});
            //         var $a = $('<a/>')
            //             .html('明細')
            //             .bind('click', option.view)
            //             .attr({href: Endold.linkTo('page/page03/order_detail.php', {sn: sn}) 
            //             });

            //         $(div).html($a);
            //         // return div;
            //     }
            }

        ],
        idProperty: 'sn',
        sortname: "date1",
        sortorder: "desc",
        usepager: true,
        title: '專業經理人',
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