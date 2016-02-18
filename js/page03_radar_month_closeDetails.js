(function(Endold, OptionBar) {
    var $buttonNewProduct = null;
    var $iframeModify = null;
    var VIEW_URL = 'radar_month_closeDetails.php';
    var $searchForm = null;
    var app = {
        rows: [],
        total:[],
        $all_checked: null,
        $count: null,
        $checkRader: null,
        init: function() {
            $searchForm = $('#search-data');
            $searchForm2 = $('#command-search');
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
            app.bindEvents();
        },
        bindEvents: function() {
            console.log(app.$all_checked);
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
            app.$cancelRadar.bind('click', function() {
                app.oncancelRadar();
                // grid.flexReload();
            });
            $searchForm.bind('submit', app.gridReload);
        },
        onSearch: function(event) {
            app.$all_checked = $('.all-checked');
            app.$all_checked.prop('checked', false);
            app.rows = [];
            event && event.preventDefault();
            app.gridReload();
        },
        oncancelRadar: function() {
            var date1 = $('#year').val();
            var date2 = $('#month').val();
            if(confirm("確定是否取消核帳？")){
                Endold
                    .post(326, {checkData:app.rows,date1:date1,date2:date2})
                    .done(app.requestRadar);    
            }
        },
        oncheckRadar: function() {
            var date1 = $('#year').val();
            var date2 = $('#month').val();
            // total = app.total;
            console.log(app.rows);
            // console.log(app.total);
            // return Endold.post(316, {money:total,checkData:app.rows,year:year,month:month});
            if(confirm("確定是否核帳？")){
                Endold
                    .post(316, {checkData:app.rows,date1:date1,date2:date2})
                    .done(app.requestRadar)
            }
            
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
            console.log(data);
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
        url: Endold.cmdTo(309),
        dataType: 'json',
        colModel: [ 
            {
                display: '<input class="all-checked" type="checkbox"/>',
                name: 'openaccount',
                width: 60,
                align: 'center',
                process: function(div, sn) {
                    var openaccount = Number(div.innerHTML);
                    console.info(sn);
                    // if(openaccount===0){
                        var $input = $('<input type="checkbox" class="item-checkbox"/>');

                        sn = Number(sn);
                        $input
                            .data('member.id', sn)
                            // .data('member.total', total)
                            .prop('checked', $.inArray(sn, app.rows) >= 0);

                        $(div).html($input)
                            .addClass('cursor-point');    
                    // }else{
                    //     div.innerHTML = "-";
                    // }
                    
                }
            // {
            //    display: '序號',
            //    name: 'sn', 
            //    width: 150, 
            //    align: 'center', 
            }, {
               display: '訂單編號',
               name: 'oid', 
               width: 150, 
               align: 'center'
            }, {
               display: '金額',
               name: 'total', 
               width: 100, 
               align: 'center'
            }, {
               display: '應收款項',
               name: 'money', 
               width: 100, 
               align: 'center'
            }, {
               display: '使用購物金',
               name: 'coupon', 
               width: 100, 
               align: 'center'
            }, {
               display: '月結狀態',
               name: 'openaccountStatus', 
               width: 100, 
               align: 'center'
            }

        ],
        idProperty: 'sn',
        sortname: "sn",
        sortorder: "desc",
        usepager: true,
        title: '展示中心月結 - 明細',
        useRp: true,
        rp: 10,
        showTableToggleBtn: true,
        width: '90%',
        // onSubmit: addFormData,
        height: 400,
        onSubmit: app.searchData


    });
    window.ProductApp = app;
    window.OrderGrid = grid;
    app.init();
})(top.Endold, top.OptionBar);
