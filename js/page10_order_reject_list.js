(function(Endold, OptionBar) {
    var $buttonNewProduct = null;
    var $iframeModify = null;
    var $searchForm = null;
    var _MODIFY_URL = '/page/page10/order_detail.php';

    var app = {
        notice_for: null,
        rows: [],
        // total:[],
        $label: null,
        $all_checked: null,
        $count: null,
        $notice_for: null,
        $users: null,
        $list_panel: null,
        $form: null,
        $query_text: null,
        $query_button: null,
        $wrapper: null,
        $checkRader: null,
        $cancelRader: null,
        init: function() {
            $searchForm = $('#command-search');
            app.$form = $('#option-form');
            // app.$all_checked = $('.hDivBox .all-checked');
            app.$count = $('#selected-count');
            app.$label = $('#grid-label');
            app.$notice_for = $('#notice-for');
            app.$users = $('#users');
            app.$list_panel = $('#member-list-options');
            app.$query_text = $('#query-text');
            app.$query_button = $('#query-button');
            app.$wrapper = $('#list-wrapper');
            app.$checkRadar = $('#checkRadar');
            app.$cancelRadar = $('#cancelRadar');
            $printButton = $('#print');
            app.bindEvents();
        },
        bindEvents: function() {
            // console.log(app.$all_checked);
            app.$wrapper.on('change', '.hDivBox .all-checked', app.onClickAllChecked)
            app.$wrapper.on('click', '.item-checkbox', app.selectMember)
            // app.$all_checked.bind('click', app.onClickAllChecked);
            app.$notice_for.bind('change', app.onChangeNoticeFor);
            app.$query_button.bind('click', function() { 
                app.grid.flexReload(); 
            });
            app.$checkRadar.bind('click', function() {
                app.oncheckRadar();
                // grid.flexReload();
            });
            app.$cancelRadar.bind('click', function() {
                app.oncancelRadar();
                // grid.flexReload();
            });
            $searchForm.bind('submit', app.onSearch);
            $printButton.bind('click', app.onclickPrint);
        },
        onclickPrint: function() {
            var no = $('#no').val();
            var date1 = $('#date1').val();
            var date2 = $('#date2').val();
            var url = Endold.linkTo('/page/page03/order_reject_list_print.php', {
                no: no,
                date1: date1,
                date2: date2
            });
            window.open(url);
        },
        onSearch: function() {
            app.$all_checked = $('.all-checked');
            app.$all_checked.prop('checked', false);
            app.rows = [];
            event && event.preventDefault();
            app.gridReload();
        },
        oncancelRadar: function() {
            var date1 = $('#date1').val();
            var date2 = $('#date2').val();
            if(confirm("確定是否取消退貨？")){
                Endold
                    .post(321, {checkData:app.rows,date1:date1,date2:date2})
                    .done(app.requestRadar);   
            }
        },
        oncheckRadar: function() {
            var date1 = $('#date1').val();
            var date2 = $('#date2').val();
            if(confirm("確定是否核帳？")){
                Endold
                    .post(318, {checkData:app.rows,date1:date1,date2:date2})
                    .done(app.requestRadar);
            }
        },
        requestRadar: function(response) {
            if (! response.status) alert(response.message);
            grid.flexReload();
            app.rows = [];
        },
        onChangeNoticeFor: function() {
            var show = (this.value == 'none' || this.value == 'all');
            modify.$list_panel.toggleClass('hide', show);
            (! show) && modify.grid.flexReload();

        },
        onClickAllChecked: function() {
            var $this = $(this);
            var isChecked = $this.prop('checked');
            if (isChecked) {
                grid.find('input.item-checkbox')
                    .not(':checked')
                    // .prop('checked', isChecked)
                    .trigger('click');
            } else {
                grid.find('input.item-checkbox:checked')
                    // .prop('checked', isChecked)
                    .trigger('click');
            }
            // $this.prop('checked', isChecked);
        },
        selectMember: function() {
            var $this = $(this);
            var id = Number($this.data('member.id'));
            // var total = Number($this.data('member.total'));
            var idx = $.inArray(id, app.rows);
            // alert([id, total]);
            if (idx >= 0) {
                app.rows.splice(idx, 1);
                // app.$all_checked.prop('checked', false);
            } else {
                console.log($this.attr('class'));
                app.rows.push(id);
                // app.total.push(total);
            }
            $this.find('> input').prop('checked', idx < 0);
            app.$users.val(app.rows.join(','));
            app.$count.html(app.rows.length);
            // console.log(app.rows);
            // console.log(app.total);
        },
        searchData: function() {
            var data = $searchForm.serializeArray();
            grid.flexOptions({params: data});
            return true;
        },
        gridReload: function() {
            console.log('run');
            event && event.preventDefault();
            grid.flexReload();
        }
    };

    // var insert_option = $('#check-date').val() ? false : {};

    var option = new OptionBar({
        optionElement: $('#option-bar'),
        mainElement: $('#option-main'),
        formElement: '#option-form',
        height: 500,
        onModify: function() {
            console.log(this);
            return $(this).attr('href') || Endold.linkTo('/page/page03/order_detail.php', {id: id});
        },
        onSave: function() {
            return Endold.cmdTo(305);
        },
        onShow: function() {
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
            console.log(r);
            ProductApp.gridReload();
        },
        // insert: {
        // },
        insert: false,
        // save: {},
        cancel: {}
    });

    var grid = $('#order-list').flexigrid({
        url: Endold.cmdTo(1029),
        dataType: 'json',
        colModel: [
            // {
            //     display: '<input class="all-checked" type="checkbox"/>',
            //     name: 'checkDate',
            //     width: 80,
            //     align: 'center',
            //     process: function(div, id) {
            //         // var total = Number(div.innerHTML);
            //         var checkDate = div.innerHTML;
            //         console.log(checkDate);
            //         if(checkDate==='N'){
            //             var $input = $('<input type="checkbox" class="item-checkbox"/>');

            //             id = Number(id);
            //             $input
            //                 .data('member.id', id)
            //                 // .data('member.total', total)
            //                 .prop('checked', $.inArray(id, app.rows) >= 0);

            //             $(div).html($input)
            //                 .addClass('cursor-point');
            //         }else if(checkDate==='cancel'){
            //             div.innerHTML = "-";
            //         }else{
            //             div.innerHTML = "-";
            //         }

            //     }

            // }, {
            {
               display: '訂單編號',
               name: 'ono', 
               width: 100, 
               align: 'center',
            }, {
               display: '退貨單編號',
               name: 'rNO', 
               width: 100, 
               align: 'center'    
            }, {
               display: '展示中心',
               name: 'arno', 
               width: 60, 
               align: 'center'
            }, {
               display: '訂貨人',
               name: 'mname', 
               width: 60, 
               align: 'center'
            }, {
               display: '會員編號',
               name: 'mno', 
               width: 60, 
               align: 'center'
            }, {
               display: '退貨產品',
               name: 'pname', 
               width: 60, 
               align: 'center'
            }, {
               display: '退貨數量',
               name: 'amount', 
               width: 100, 
               align: 'center'
            }, {
               display: '退貨單狀態',
               name: 'statusName', 
               width: 80, 
               align: 'center'
            }, {
               display: '退貨日期',
               name: 'rejectdate', 
               width: 80, 
               align: 'center'
            }, {
               display: '核帳日期',
               name: 'checkDate2', 
               width: 80, 
               align: 'center'
            }, {
               display: '註銷日期',
               name: 'canceldate', 
               width: 80, 
               align: 'center'
            }, {
               display: '最後修改人員',
               name: 'keyman', 
               width: 80, 
               align: 'center'
            }, {
                display: ' ',
                name: 'reject', 
                name: 'status', 
                width: 80, 
                align: 'center',
                process: function(div, sn) {
                    var url = Endold.linkTo('order_reject_c.php', {sn: sn});
                    var $a = $('<a/>')
                        .html('明細')
                        .bind('click', option.modify)
                        .attr({href: Endold.linkTo('page/page10/order_reject_c.php', {sn: sn}) 
                        });

                    $(div).html($a);
                }
               }

        ],
        idProperty: 'sn',
        sortname: "dateRecord",
        sortorder: "desc",
        usepager: true,
        title: '退貨單',
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
