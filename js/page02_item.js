(function(Endold, OptionBar) {

    var _MODIFY_URL = '/page/page02/item_modify.php';

    var app = {
        init: function() {
            app.bindEvents();
        },
        bindEvents: function() { },
        changeState: function(event) {
            var change_to = $(this).hasClass('disabled') ? 0 : 1;
            var id = $(this).attr('data-id');
            Endold.post(232, {id: id, disabled: change_to})
                .done(app.changeRequest);
            event && event.preventDefault();

        },
        changeRequest: function(response) {
            if (! response.status) {
                alert(response.message);
            }
            app.reloadGrid();
        },
        reloadGrid: function() {
            grid.flexReload();
        }
    };

    var option = new OptionBar({
        optionElement: $('#option-bar'),
        mainElement: $('#option-main'),
        formElement: '#option-form',
        height: 170,
        onModify: function() {
            var id = $(this).attr('data-id') || 0;
            return Endold.linkTo(_MODIFY_URL, {id: id});
        },
        onSave: function() {
            return Endold.cmdTo(231);
        },
        onSaveRequest: function() {
            app.reloadGrid();
        },
        insert: {},
        save: {},
        cancel: {}
    })


    var grid = $('#product-list').flexigrid({
        url: Endold.cmdTo(230),
        dataType: 'json',
        colModel: [ {
               display: '排序',
               name: 'sort', 
               width: 140, 
               align: 'center',
               process: function(div, id) {
                    div.innerHTML = (Number(div.innerHTML) / 10) || 0;
               }
            }, {
               display: '類別名稱',
               name: 'name', 
               width: 200, 
               align: 'center'
            }, {
               display: '啟/停用',
               name: 'disabled', 
               width: 60, 
               align: 'center', 
               process: function(div, id) {
                    var disabled = Number(div.innerHTML) === 1;
                    var className = disabled ? 'disabled' : 'enabled';
                    var name = disabled ? '停用' : '啟用';
                    var $div = $(div).html('');
                    $('<a href="#"/>')
                        .attr('data-id', id)
                        .addClass(className)
                        .html(name)
                        .bind('click', app.changeState)
                        .appendTo($div);
                }
            }, {
                display: ' ',
                name: 'options', 
                width: 100, 
                align: 'center',
                process: function(div, id) {
                    var $div = $(div).addClass('options').html('');

                    $('<a href="#">修改</a>')
                        .attr('data-id', id)
                        .bind('click', option.modify)
                        .appendTo($div);

                }
            }
        ],
        perProcess: function() {
            console.log(arguments);
        },
        idProperty: 'id',
        sortname: "time",
        sortorder: "desc",
        usepager: true,
        title: '通知',
        useRp: true,
        rp: 10,
        showTableToggleBtn: true,
        width: '100%',
        height: 150

    });

    window.ItemApp = app;
    window.ItemGrid = grid;
    app.init();
})(top.Endold, top.OptionBar);

