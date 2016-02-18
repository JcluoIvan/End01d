(function(Endold, OptionBar) {
    var $buttonNewProduct = null;
    var $iframeModify = null;
    var _MODIFY_URL = '/page/page03/order_detail.php';
    var $searchForm = null;
    var app = {
        notice_for: null,
        rows: [],
        total:[],
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
        init: function() {
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
            app.bindEvents();
        },
        bindEvents: function() {
            // console.log(app.$all_checked);
            app.$wrapper.on('change', '.hDivBox .all-checked', app.onClickAllChecked);
            app.$wrapper.on('click', '.item-checkbox', app.selectMember);
            // app.$all_checked.bind('click', app.onClickAllChecked);
            app.$notice_for.bind('change', app.onChangeNoticeFor);
            app.$query_button.bind('click', function() { 
                app.grid.flexReload(); 
            });
            app.$checkRadar.bind('click', function() {
                app.oncheckRadar();
                // grid.flexReload();
            });
            $searchForm.bind('submit', app.onSearch);
        },
        onSearch: function(event) {
            app.$all_checked = $('.all-checked');
            app.$all_checked.prop('checked', false);
            app.rows = [];
            event && event.preventDefault();
            app.gridReload();
        },
        oncheckRadar: function() {
            var date1 = $('#date1').val();
            var date2 = $('#date2').val();
            total = app.total;
            // console.log(app.rows);
            // console.log(app.total);
            // return Endold.post(316, {money:total,checkData:app.rows,year:year,month:month});
            Endold
                .post(316, {money:total,checkData:app.rows,date1:date1,date2:date2})
                .done(app.requestRadar)
        },
        requestRadar: function(response) {
            if (! response.status) alert(response.message);
            grid.flexReload();

        },
        onChangeNoticeFor: function() {
            var show = (this.value == 'none' || this.value == 'all');
            modify.$list_panel.toggleClass('hide', show);
            (! show) && app.grid.flexReload();

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
            var total = Number($this.data('member.total'));
            var idx = $.inArray(id, app.rows);
            // alert([id, total]);
            if (idx >= 0) {
                app.rows.splice(idx, 1);
                // app.$all_checked.prop('checked', false);
                // $('.hDivBox .all-checked').prop('checked', false)
            } else {
                // console.log($this.attr('class'));
                app.rows.push(id);
                app.total.push(total);
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
        gridReload: function(event) {
            console.log('run');
            event && event.preventDefault();
            grid.flexReload();
        }
    };

    var grid = $('#order-list').flexigrid({
        url: Endold.cmdTo(310),
        dataType: 'json',
        colModel: [ 
            // {
            //     display: '<input class="all-checked" type="checkbox"/>',
            //     name: 'total',
            //     width: 60,
            //     align: 'center',
            //     process: function(div, id) {
            //         var total = Number(div.innerHTML);
            //         var $input = $('<input type="checkbox" class="item-checkbox"/>');

            //         id = Number(id);
            //         $input
            //             .data('member.id', id)
            //             .data('member.total', total)
            //             .prop('checked', $.inArray(id, app.rows) >= 0);

            //         $(div).html($input)
            //             .addClass('cursor-point');
            //     }

            // }, {
            //    display: '序號',
            //    name: 'id', 
            //    width: 50, 
            //    align: 'center', 
            // }, {
            {
               display: '展示中心名稱',
               name: 'name', 
               width: 80, 
               align: 'center'
            }, {
               display: '應收款項',
               name: 'total', 
               width: 60, 
               align: 'center'
            }, {
               display: '運費',
               name: 'fare', 
               width: 40, 
               align: 'center'
            }, {
               display: '核帳金額',
               name: 'rtotal', 
               width: 60, 
               align: 'center'
            }, {
               display: '核帳日期',
               name: 'DateCheck', 
               width: 80, 
               align: 'center'
            }, {
               display: '操作人員',
               name: 'users', 
               width: 60, 
               align: 'center'
            }, {
                display: ' ',
                name: 'detail', 
                width: 60, 
                align: 'center',
                process: function(div, id) {
                    var url = Endold.linkTo('radar_month_closeDetails.php', {id: id});
                    var dyear = $('#date1').val();
                    var dmonth = $('#date2').val();
                    var $a = $('<a/>')
                        .html('明細')
                        .attr({href: Endold.linkTo('radar_month_closeDetails.php', {id: id, year: dyear, month: dmonth}) 
                        });

                    $(div).html($a);
                    // return div;
                }
            }

        ],
        idProperty: 'id',
        sortname: "id",
        sortorder: "desc",
        usepager: true,
        title: '展示中心月結',
        useRp: true,
        rp: 10,
        rpOptions: [10, 15, 20, 30, 50],
        showTableToggleBtn: true,
        width: '88%',
        // onSubmit: addFormData,
        height: 400,
        onSubmit: app.searchData


    });
    window.ProductApp = app;
    window.OrderGrid = grid;
    app.init();
})(top.Endold, top.OptionBar);