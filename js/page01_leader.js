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

    var grid = $('#leader-list').flexigrid({
        url: Endold.cmdTo(140),
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
               display: '下層數',
               name: 'layers',
               width: 80,
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
        // onSubmit: addFormData,
        height: 300,
        onSubmit: app.addGridFormData

    });
    app.init();
    window.LeaderApp = app;
    window.LeaderGrid = grid;
})(top.Endold, top.OptionBar);