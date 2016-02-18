(function(Endold, OptionBar) {

    var app = {
        init: function() {
            app.bindEvents();
        },
        bindEvents: function() {
        },
        gridReload: function() {
            console.log('run');
            grid.flexReload();
        },
        disabled: function() {
            var $this = $(this);
            var $id = $this.data('id');
            var $is_disabled = $this.data('is_disabled');
            var text = $is_disabled === 1 ? '確認啟用?' : '確認停用?';

            if (!confirm(text))
                return false;

            Endold.post(109, {id: $id, is_disabled: $is_disabled})
                .done(app.gridReload);

            event && event.preventDefault();
        },
    };

    var option = new OptionBar({
        optionElement: $('#option-bar'),
        mainElement: $('#option-main'),
        formElement: '#option-form',
        height: 300,
        onModify: function() {
            var id = $(this).attr('id') || 0;
            return Endold.linkTo(
                '/page/page01/department_modify.php', {id: id}
            );
        },
        onSave: function() {
            return Endold.cmdTo(101);
        },
        onSaveRequest: function(r) {
            DepartmentApp.gridReload();
        },
        insert: {},
        save: {},
        cancel: {}
    });

    var grid = $('#department-list').flexigrid({
        url: Endold.cmdTo(100),
        dataType: 'json',
        colModel: [
            {
               display: '職務',
               name: 'type', 
               width: 100, 
               align: 'center'
            }, {
               display: '帳號',
               name: 'account', 
               width: 100, 
               align: 'center', 
            }, {
               display: '名稱',
               name: 'name', 
               width: 100, 
               align: 'center', 
            }, {
                display: '狀態',
                name: 'is_disabled',
                width: 100,
                align: 'center',
                process: function(div, id) {
                    var $div = $(div);
                    var is_disabled = parseInt($div.html());
                    var text = is_disabled === 1 ? '停用' : '啟用';
                    var color = is_disabled === 1 ? 'red' : null;

                    var $a = $('<a>')
                        .attr({href: '#'})
                        .html(text)
                        .css('color', color)
                        .data({id: id, is_disabled: is_disabled})
                        .bind('click', app.disabled);

                    $div.html('')
                        .html($a);
                }
            }, {
                display: ' ',
                name: 'options', 
                width: 100, 
                align: 'center',
                process: function(div, id) {
                    var url = Endold.linkTo('depart_modify.php', {id: id});
                    var $a = $('<a>修改</a>')
                        .attr({href: '#', id: id})
                        .bind('click', option.modify);

                    $(div).html($a);
                    // return div;
                }
            }, 
        ],
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
        height: 300

    });
    app.init();
    window.DepartmentApp = app;
    window.DepartmentGrid = grid;
})(top.Endold, top.OptionBar);