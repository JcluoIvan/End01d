(function(Endold) {
    var $images_wrapper = $('#title-images-wrapper');
    var $update_wrapper = $('#update-images-wrapper');
    var $form = $('#update-form');
    var $iframe = $('#update-iframe');

    var $save_button = $('#save-button');
    var app = {

        init: function() {

            $form.attr('action', Endold.cmdTo(9700));
            app.bindEvents();
        },
        bindEvents: function() {

            $save_button.bind('click', app.onclickSvae);


            $images_wrapper.on('click', '.image-item', app.onclickImage);
            $images_wrapper.on('click', '.glyphicon-remove', app.onclickDelete);
            $images_wrapper.on('click', '.glyphicon-arrow-up', app.onclickMoveUp);
            $images_wrapper.on('click', '.glyphicon-arrow-down', app.onclickMoveDown);

            $update_wrapper.on('change', 'input', app.onchageFile);
            $iframe.on('load', app.requestUpdate);
        },
        onclickSvae: function() {
            var ids = $.map($images_wrapper.find('.image-item.active'), function(element) {
                return Number($(element).attr('data-id'));
            });
            Endold.post(9701, {ids: ids})
                .done(app.requestSave);
        },
        onclickDelete: function(event) {
            event.stopPropagation();
            if (! confirm('確定刪除此圖片？')) return;

            var $item = $(this).closest('.image-item');
            Endold.post(9702, {id: $item.attr('data-id')})
                .done(app.requestDelete);

        },
        onclickMoveUp: function(event) {
            event.stopPropagation();
            var $item = $(this).closest('.image-item');
            console.log($item.index());
            Endold.post(9703, {id: $item.attr('data-id'), sort: $item.index() * 10 - 1})
                .done(app.requestMove);
        },
        onclickMoveDown: function(event) {
            event.stopPropagation();
            var $item = $(this).closest('.image-item');
            console.log($item.index());
            Endold.post(9703, {id: $item.attr('data-id'), sort: $item.index() * 10 + 21})
                .done(app.requestMove);

        },
        onclickImage: function() {
            $(this).toggleClass('active');
            $save_button.prop('disabled', false);
        },
        onchageFile: function() {
            var $elems = $update_wrapper.find('input').filter(function() {
                return ! (this.value);
            });
            if ($elems.length === 0) {
                $item = $update_wrapper.find('.update-image:first').clone();
                $item.appendTo($update_wrapper)
                    .find('input').val('');
            }
        },
        onclickRemove: function() {
            if ($update_wrapper.find('input').length > 1) {
                $(this).closest('.update-image').remove();
            } else {
                $(this).closest('.update-image').find('input').val('');
            }
        },
        requestSave: function(o) {
            alert(o.message);
        },
        requestDelete: function(o) {
            if (! o.status) return alert(o.message);
            var $img = $images_wrapper.find('.image-item.img-id-' + o.id);
            $img.css('height', '0');
            setTimeout(function() {
                $img.remove();
            }, 200);
        },
        requestMove: function(o) {
            if (! o.status) return alert(o.message);
            var $img = $images_wrapper.find('.image-item.img-id-' + o.id);
            var sort = o.sort - 1;
            var idx = $img.index();
            if (sort > idx) {
                $images_wrapper.find('.image-item').eq(sort).after($img);
            } else if (sort < idx) {
                $images_wrapper.find('.image-item').eq(sort).before($img);
            }

        },
        requestUpdate: function() {
            var $body = $(this.contentDocument.body);

            var response = $body.find('*').length
                ? $body.find('*').html()
                : $body.html();
            response = $.parseJSON(response);
            if (response.status) {
                location.reload();
            } else {
                alert(response.message);
            }
        }
    };

    app.init();



})(top.Endold);