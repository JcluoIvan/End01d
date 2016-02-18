(function(Endold, OptionBar) {
    var $buttonNewProduct = null;
    var $iframeModify = null;
    var $searchForm = null;
    var _MODIFY_URL = '/page/page08/order_detail.php';
    var $search = {
        form: null,
        itemL: null,
        itemR: null
    };

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
            $search.form = $('#command-search');
            $search.itemL = $('#item');
            $search.itemR = $('#itemdate');
            app.bindEvents();
        },
        bindEvents: function() {
            $search.itemL.bind('change', app.changeLitem);
            // console.log(app.$all_checked);
            app.$wrapper.on('change', '.hDivBox .all-checked', app.onClickAllChecked);
            app.$wrapper.on('click', '.item-checkbox', app.selectMember);
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
            $searchForm.bind('submit', app.gridReload);
            $printButton.bind('click', app.onclickPrint);
            new Calendar({
                inputField: "date1",
                dateFormat: "%Y-%m-%d",
                trigger: "trigger1",
                bottomBar: true,
                weekNumbers: true,
                onSelect: function() {this.hide();}
            });
            new Calendar({
                inputField: "date2",
                dateFormat: "%Y-%m-%d",
                trigger: "trigger2",
                bottomBar: true,
                weekNumbers: true,
                onSelect: function() {this.hide();}
            });
        },
        changeLitem: function() {
            var item = $search.itemL.val();
            Endold.post(818, {item: item})
                .done(app.reloadRitem);
        },
        reloadRitem: function(request) {
            if (request.status) {
                $search.itemR.html('');
                $.each(request.rows, function(value, label) {
                    $('<option/>')
                        .val(value)
                        .html(label)
                        .appendTo($search.itemR);
                });
                // app.reloadGrid();
            } else {
                alert(request.message);
            }
        },
        onclickPrint: function() {
            var $print = $searchForm;
            $print.attr('target', '_blank');
            $print.attr('method', 'post');
            $print.attr('action', Endold.linkTo('/page/page08/order_swap_list_print.php'));
            $print.trigger('submit');
        },
        onSearch: function(event) {
            app.$all_checked = $('.all-checked');
            app.$all_checked.prop('checked', false);
            app.rows = [];
            event && event.preventDefault();
            app.gridReload();
        },
        oncancelRadar: function() {
            var date1 = $('#date1').val();
            var date2 = $('#date2').val();
            if(confirm("確定是否取消換貨？")){
                Endold
                    .post(323, {checkData:app.rows,date1:date1,date2:date2})
                    .done(app.requestRadar);    
            }
        },
        oncheckRadar: function() {
            var date1 = $('#date1').val();
            var date2 = $('#date2').val();
            // total = app.total;
            console.log(app.rows);
            console.log(app.total);
            Endold
                .post(319, {checkData:app.rows,date1:date1,date2:date2})
                .done(app.requestRadar);
        },
        requestRadar: function(response) {

            if (! response.status) alert(response.message);
            grid.flexReload();

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
            // alert([id]);
            if (idx >= 0) {
                app.rows.splice(idx, 1);
                // app.$all_checked.prop('checked', false);
                // $('.hDivBox .all-checked').prop('checked', false)
            } else {
                console.log($this.attr('class'));
                app.rows.push(id);
                // app.total.push(total);
            }
            $this.find('> input').prop('checked', idx < 0);
            app.$users.val(app.rows.join(','));
            app.$count.html(app.rows.length);
            console.log(app.rows);
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

    var option = new OptionBar({
        optionElement: $('#option-bar'),
        mainElement: $('#option-main'),
        formElement: '#option-form',
        height: 500,
        onModify: function() {
            console.log(this);
            return $(this).attr('href') || Endold.linkTo('/page/page08/order_detail.php', {id: id});
        },
        onSave: function() {
            return Endold.cmdTo(814);
        },
        onShow: function() {
            /*
            new Calendar({
                  inputField: "signoff",
                  dateFormat: "%Y-%m-%d",
                  trigger: "signoff.onclick",
                  bottomBar: true,
                  weekNumbers: true,
                  onSelect: function() {this.hide();}
                });
            */
            new Calendar({
                  inputField: "swapdate",
                  dateFormat: "%Y-%m-%d",
                  trigger: "swapdate.onclick",
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
        save: {},
        cancel: {}
    });

    var grid = $('#order-list').flexigrid({
        url: Endold.cmdTo(813),
        dataType: 'json',
        colModel: [
            {
               display: '訂單編號',
               name: 'ono', 
               width: 100, 
               align: 'center', 
            }, {
               display: '換貨編號',
               name: 'sNO', 
               width: 100, 
               align: 'center'
            }, {
               display: '展示中心',
               name: 'arno', 
               width: 60, 
               align: 'center'
            }, {
               display: '會員編號',
               name: 'mno', 
               width: 60, 
               align: 'center'
            }, {
               display: '換貨項目',
               name: 'pname', 
               width: 60, 
               align: 'center'
            }, {
               display: '換貨數量',
               name: 'amount', 
               width: 60, 
               align: 'center'
            }, {
               display: '換貨單狀態',
               name: 'statusName', 
               width: 80, 
               align: 'center'
            }, {
               display: '換貨日期',
               name: 'swapdate', 
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
                name: 'status', 
                width: 60, 
                align: 'center',
                process: function(div, sn) {
                    var status = Number(div.innerHTML);
                    if(status > 0) {
                        div.innerHTML = '-';
                    }else{
                        var url = Endold.linkTo('order_swap_c.php', {sn: sn});
                        var $a = $('<a/>')
                            .html('修改')
                            .bind('click', option.modify)
                            .attr({href: Endold.linkTo('page/page08/order_swap_c.php', {sn: sn}) 
                            });

                        $(div).html($a);
                        // return div;
                    }
                }
               }

        ],
        idProperty: 'sn',
        sortname: "date1",
        sortorder: "desc",
        usepager: true,
        title: '換貨單',
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