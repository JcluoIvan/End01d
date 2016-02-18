(function(Endold) {
    var app = {
        $id: null,
        $name: null,
        $no: null,
        $phone: null,
        $point: null,
        $panel: null,
        $wrapper: null,
        offset: {x: 0, y: 0},
        center: {x: 0, y: 0},
        tree: null, 
        init: function() {
            app.$id = $('#id').val();
            app.$name = $('#name').val();
            app.$no = $('#no').val();
            app.$phone = $('#phone').val();
            app.$point = $('#point').val();
            app.$panel = $('#friends-panel');
            app.$wrapper = $('#friends-wrapper');
            app.update();
        },
        bindEvents: function() {
            app.$wrapper.on('click', '.member-wrapper', app.onClickMember);
        },
        update: function() {
            Endold.post('125', {id: app.$id})
                .done(app.request);
        },
        request: function(response) {
            app.tree = response.tree;
            app.render();
        },
        render: function() {

            app.$wrapper.html('');

            app.center.x = app.$wrapper.outerWidth() / 2 + 50;
            app.center.y = app.$wrapper.outerHeight() / 2;

            var data = {
                id: app.$id, 
                name: app.$name, 
                no: app.$no, 
                phone: app.$phone, 
                point: app.$point, 
                children: app.tree
            };

            var $my = app.createMemberElement(0, data);
            $my.appendTo(app.$wrapper);

            app.move($my, app.center.x, app.center.y);

            app.createChildrenMember(
                app.center.x, 
                app.center.y,     
                1,      /* 下一層的 Level */
                3,      /* 產生下一層的會員數 */
                120,    /* 半徑 */
                -90,    /* 起始角度 */
                120,     /* 夾角角度 */
                app.tree
            );
            app.bindEvents();

            $my.trigger('click');
        },
        createMemberElement: function(lv, row) {
            var $div = $('<div class="member-wrapper "/>');

            var tooltip_option = {placement: 'bottom', html:true};

            $div.addClass('level-' + lv)
                .append('<img />');

            if (row) {
                var tooltip_content = 
                    '編號: ' + row.no + '<br />' + 
                    '電話: ' + row.phone + '<br />' + 
                    '購物金: ' + row.point;
                $div.attr('id', 'member-' + row.id)
                    .data('data.row', row)
                    .tooltip($.extend(tooltip_option, {title: tooltip_content}));
                $('<label>').appendTo($div)
                    .html(row.name);
            } else {
                $div.addClass('no-member');
            }
            return $div
        },
        createChildrenMember: function(
            cx,
            cy,
            lv,
            count,
            radius,
            angle_start,
            angle_step,
            rows
        ) {
            if (lv > 3) return;
            for (var i = 0; i < count; i++) {
                var angle = i * angle_step + angle_start;
                var row = rows[i] || null;
                $element = app.createMemberElement(lv, row)
                    .appendTo(app.$wrapper);
                var p = app.moveRadius($element, cx, cy, angle, radius, lv);
                var next_step = (angle_step + (lv) * 10) / 2;
                var next_radius = radius - (lv) * 10;
                var temp = (1 - i) * 15 * (lv == 2 ? 1 : 0);
                app.createChildrenMember(
                    p.x, 
                    p.y, 
                    lv + 1, 
                    count, 
                    next_radius, 
                    angle - next_step + temp,
                    next_step,
                    row && row.children || []
                );

            }

        },
        moveRadius: function($element, sx ,sy, angle, radius, lv) {
            var x = radius * Math.cos(angle * Math.PI / 180) + sx ;
            var y = radius * Math.sin(angle * Math.PI / 180) + sy;
            app.move($element, x, y);

            /* 畫線 */
            var lx = radius / 2 * Math.cos(angle * Math.PI / 180) + sx;
            var ly = radius / 2 * Math.sin(angle * Math.PI / 180) + sy;
            var $line = $('<div class="link-line"><div/></div>')
                .addClass('level-' + lv)
                .css({
                    'transform': 'routate(' + (angle + 90) + 'deg)',
                    '-webkit-transform': 'rotate(' + (angle + 90) + 'deg)',
                    height: radius,
                    width: radius
                })
                .appendTo(app.$wrapper);
            ($element.hasClass('no-member')) && $line.addClass('no-member');
            app.move($line, lx , ly);

            /* 回傳此 $element 的座標 */
            return {x: x, y: y};
        },
        move: function($element, x, y) {
            x = (x - ($element.outerHeight() / 2) + app.offset.y) | 0;
            y = (y - ($element.outerWidth() / 2) + app.offset.x) | 0;
            $element.css({left: x, top: y });
        },
        focusOn: function($element) {
            var p_width = app.$panel.outerWidth() / 2;
            var p_height = app.$panel.outerHeight() / 2;
            var width = $element.outerWidth() / 2;
            var height = $element.outerHeight() / 2;
            var left = $element.position().left;
            var top = $element.position().top;
            app.$panel.animate(
                {
                    scrollTop: top + height - p_height,
                    scrollLeft: left + width - p_width
                }, 
                200,
                function() {
                    app.$wrapper.find('.on-focus').removeClass('on-focus');
                    var row = $element.data('data.row') || [];

                    if (row && row.children && row.children.length) {
                        row.children.map(function(o) {
                            var $member = $('#member-' + o.id);
                            if ($member.length) {
                                $member
                                    .addClass('on-focus')
                            }
                        });
                    } else {
                        $element
                            .addClass('on-focus');
                    }
                }
            );

        },

        onClickMember: function() {
            app.$panel.attr('class', 'focus-level-1');
            app.focusOn($(this));
        },
    };

    app.init();
    window.Friends = app;
})(top.Endold);