(function(Endold) {

    var $formSearch = null;
    var $searchBtn = null;

    var app = {
        init: function() {
            $formSearch = $('#form-search');
            $searchBtn = $('#search-btn');

            app.bindEvents();
        },
        bindEvents: function() {
            $formSearch.bind('submit', app.stopEvent);
            $searchBtn.bind('click', app.gridReload);
        },
        stopEvent: function(){
            event && event.preventDefault();
        },
        gridReload: function() {
            console.log('run');
            grid.flexReload();
        },
        /* 加入 grid reload 時的參數 */
        addGridFormData: function() {
            // console.log($formSearch);
            var data = $formSearch.serializeArray();
            grid.flexOptions({params: data});
            return true;
        }
    };

    var grid = $('#blacklist-list').flexigrid({
        url: Endold.cmdTo(130),
        dataType: 'json',
        colModel: [
            {
               display: '展示中心編號',
               name: 'ano', 
               width: 200, 
               align: 'center'
            }, {
               display: '會員名稱',
               name: 'name',
               width: 200,
               align: 'center',
            }, {
               display: '編號',
               name: 'no', 
               width: 200, 
               align: 'center', 
            },{
               display: '手機',
               name: 'phone',
               width: 200,
               align: 'center', 
            }, {
                display: '加入黑名單日期',
                name: 'blacklistDate', 
                width: 200,
                align: 'center',
            }, {
                display: '原因',
                name: 'blacklistReason', 
                width: 200, 
                align: 'center',
            }
        ],
        method: 'POST',
        idProperty: 'id',
        sortname: "time",
        sortorder: "desc",
        usepager: true,
        title: '黑名單',
        useRp: true,
        rp: 10,
        showTableToggleBtn: true,
        width: '100%',
        height: 300,
        onSubmit: app.addGridFormData

    });
    app.init();
    window.OrganizeMemberApp = app;
})(top.Endold);