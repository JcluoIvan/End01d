(function(Endold, OptionBar) {

    var $formSearch = null;
    var $searchBtn = null;
    var $noReturn = null;
    var $nameReturn = null;
    var $phoneReturn = null;


    var app = {
        init: function() {
            $formSearch = $('#form-search');
            $searchBtn = $('#search-btn');

            $noReturn = $('#no-return');
            $nameReturn = $('#name-return');
            $phoneReturn = $('#phone-return');

            app.bindEvents();
        },
        bindEvents: function() {
            $formSearch.bind('submit', app.stopEvent);
            $searchBtn.bind('click', app.gridReload);
        },
        stopEvent: function(event) {
            event && event.preventDefault();
        },
        gridReload: function() {
            grid.flexReload();
        },
        /* 加入 grid reload 時的參數 */
        addGridFormData: function() {
            var data = $formSearch.serializeArray();
            grid.flexOptions({params: data});
            return true;
        },
        addMemberData: function(r) {
            var member = r['memberInfo'];
            
            if (!member)
                return false;

            $noReturn.val(member['no']);
            $nameReturn.val(member['name']);
            $phoneReturn.val(member['phone']);

            return true;
        }
    };

    var option = new OptionBar({
        optionElement: $('#option-bar'),
        mainElement: $('#option-main'),
        formElement: '#option-form',
        height: 800,
        onModify: function() {
            var id = $(this).attr('id') || 0;
            $pid = $('#pid').val();
            return Endold.linkTo(
                '/page/page01/organize_modify.php', 
                {
                    pid: $pid, 
                    id: id
                }
            );
        },
        onSave: function() {
            return Endold.cmdTo(103);
        },
        onSaveRequest: function(r) {
            ReportBuyApp.gridReload();
        },
        insert: false,
        save: false,
        cancel: {
        }
    });

    var grid = $('#report-buy-list').flexigrid({
        url: Endold.cmdTo(530),
        dataType: 'json',
        colModel: [
            {
               display: '交易日期',
               name: 'trans_date', 
               width: 200, 
               align: 'center'
            }, {
               display: '核帳日期',
               name: 'verification_date', 
               width: 200, 
               align: 'center'
            }, {
               display: '訂單編號',
               name: 'ono',
               width: 200,
               align: 'center'
            }, {
               display: '訂單金額',
               name: 'money',
               width: 200, 
               align: 'center'
            }, {
               display: '',
               name: 'detail', 
               width: 200, 
               align: 'center',
               process: function(div, oid) {
                    var $div = $(div).html('');
                    var url = Endold.linkTo('page/page05/report_buy_detail.php', {oid: oid});
                    var $a = $('<a/>')
                        .html('明細')
                        .bind('click', option.view)
                        .attr({href: url})
                        .appendTo($div);
                }
            }
        ],
        method: 'POST',
        idProperty: 'oid',
        sortname: "time",
        sortorder: "desc",
        usepager: true,
        title: '購買紀錄',
        useRp: true,
        rp: 10,
        showTableToggleBtn: true,
        width: '100%',
        height: 300,
        onSubmit: app.addGridFormData,
        preProcess:function (response) {
            app.addMemberData(response);
            return response;
        }

    });
    app.init();
    window.ReportBuyApp = app;
    window.ReportBuyGrid = grid;
    window.ReportBuyOption = option;
})(top.Endold, top.OptionBar);