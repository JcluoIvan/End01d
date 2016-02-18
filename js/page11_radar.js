(function(Endold, OptionBar) {
    var $formSearch = null;
    var $searchBtn = null;
    var $lvKind = null;

    var app = {
        init: function() {
            $formSearch = $('#form-search');
            $searchBtn = $('#search-btn');
            $lvKind = $('#lv-kind');

            app.bindEvents();
        },
        bindEvents: function() {
            $formSearch.bind('submit', app.stopEvent);
            $searchBtn.bind('click', app.gridReload);
            $lvKind.bind('change', app.changePage);
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
        changePage: function() {
            var $this = $(this);
            var url = $this.val() + '.php';
            location.href = Endold.linkTo(url);
        },
    };

    var grid = $('#radar-list').flexigrid({
        url: Endold.cmdTo(1102),
        dataType: 'json',
        colModel: [
            {
               display: '編號',
               name: 'no', 
               width: 80, 
               align: 'center'
            }, {
               display: '名稱',
               name: 'name', 
               width: 100, 
               align: 'center'
            }, {
               display: '手機',
               name: 'phone', 
               width: 120, 
               align: 'center'
            }, {
               display: '銀行代號',
               name: 'bank_code', 
               width: 100, 
               align: 'center'
            }, {
               display: '銀行帳號',
               name: 'bank_account', 
               width: 100, 
               align: 'center'
            }, {
               display: '下層數',
               name: 'layers', 
               width: 80, 
               align: 'center'
            }, {
               display: '邀請碼',
               name: 'qrcodeId', 
               width: 120, 
               align: 'center', 
            }, {
               display: '',
               name: 'qrcode',
               width: 120, 
               align: 'center', 
               process: function (div) {
                    var url = $(div).text();
                    var $a = '-';
                    if (url !== 'false') {
                        $a = $('<a>顯示QRcode</a>')
                            .attr({href: url, target: '_blank'});
                    }
                    $(div).html($a);
               }
            }, {
               display: '專業經理人 (編號 - 名稱)',
               name: 'parent', 
               width: 150, 
               align: 'center', 
            },
        ],
        method: 'POST',
        idProperty: 'id',
        sortname: "time",
        sortorder: "desc",
        usepager: true,
        title: '通知',
        useRp: true,
        rp: 10,
        showTableToggleBtn: true,
        width: '100%',
        height: 300,
        onSubmit: app.addGridFormData

    });
    app.init();
    window.RadarApp = app;
    window.RadarGrid = grid;
})(top.Endold, top.OptionBar);