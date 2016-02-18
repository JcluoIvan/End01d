(function(Endold, OptionBar) {

    var $formSearch = null;

    var app = {
        init: function() {
            $formSearch = $('#form-search');
            app.bindEvents();
        },
        bindEvents: function() {
        },
        stopEvent: function(){
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
            var member = r['member'];

            $('#no-return').val(member['no']);
            $('#name-return').val(member['name']);
            $('#phone-return').val(member['phone']);

            return true;
        }
    };

    var option = new OptionBar({
        optionElement: $('#option-bar'),
        mainElement: $('#option-main'),
        formElement: '#option-form',
        height: 450,
        onModify: function() {
            var $this = $(this);
            var id = $this.attr('id') || 0;
            var mid = $('#mid').val();

            return Endold.linkTo(
                '/page/page10/dialogue_modify.php', {
                    id: id,
                    mid: mid
                }
            );
        },
        onSave: function() {
            return Endold.cmdTo(1023);
        },
        onSaveRequest: function(r) {
            DialogueApp.gridReload();
        },
        onShow: function() {
        },
        insert: {},
        save: {},
        cancel: {}
    });

    var grid = $('#dialogue-list').flexigrid({
        url: Endold.cmdTo(1022),
        dataType: 'json',
        colModel: [
            {
                display: '客服編號',
                name: 'ano', 
                width: 200, 
                align: 'center'
            }, {
                display: '時間',
                name: 'datetime',
                width: 200,
                align: 'center',
            }, {
                display: '內容',
                name: 'content', 
                width: 800, 
                align: 'center', 
            }, {
                display: '修改',
                name: '', 
                width: 200, 
                align: 'center',
                process: function(div, id) {
                    var $div = $(div);
                    $div.html('');
                    var $a = $('<a>修改</a>')
                        .attr({href: '#', id: id})
                        .bind('click', option.modify)
                        .appendTo($div);
                }
            }
        ],
        method: 'POST',
        idProperty: 'id',
        sortname: "time",
        sortorder: "desc",
        usepager: true,
        title: '客服記錄',
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
    window.DialogueApp = app;
    window.DialogueGrid = grid;
    window.DialogueOption = option;
})(top.Endold, top.OptionBar);