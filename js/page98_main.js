(function(Endold) {

    var $form = $('#save-form');

    var $postal = {
        country: $('#country'),
        city: $('#city')
    };

    var $bank = {
        filter: $('#bank-code-filter'),
        codes: $('select[name=bank_code]'),
    };

    var app = {

        init: function() {
            app.bindEvents();
            app.renderCountry();

        },
        bindEvents: function() {
            $form.bind('submit', app.saveData);
            $postal.country.bind('change', app.renderCity);
            $bank.filter.bind('keyup', app.filterBankCode);
        },
        renderCountry: function() {
            var value = $postal.country.val()
            $postal.country.html('');
            $.each(Endold.Postal.data, function(key, country) {
                $('<option/>')
                    .data('city.data', country.children)
                    .val(country.id)
                    .text(country.name)
                    .appendTo($postal.country);
            });
            $postal.country
                .val(value)
                .trigger('change');
        },
        renderCity: function() {
            var option = $postal.country.find('option:selected');
            var city = option.data('city.data') || [];
            var value = $postal.city.val()
            $postal.city.html('');
            Endold.Postal.options($postal.city, city, value);
        },
        filterBankCode: function() {
            var query = this.value.toString().replace(/\s/g, '');
            var $opt = $bank.codes.find('#filter-codes');
            if ($opt.length === 0) {
                $opt = $('<optgroup id="filter-codes"/>')
                    .prependTo($bank.codes);
            }
            if (query.length === 0) return $opt.remove();
            $opt.html('');

            $bank.codes.find('> option').each(function() {
                if (
                    (this.innerHTML.toString().indexOf(query) >= 0) ||
                    (this.value.toString().indexOf(query) >= 0)
                ) {
                    $opt.append($(this).clone());
                }
            });

            $opt.attr('label', '查詢-' + query);
            if ($opt.find('option').length === 0) {
                $('<option value="">查無相關資料</option>')
                    .prop('selected', true)
                    .appendTo($opt);
            } else {
                $opt.find('option').eq(0).prop('selected', true);
            }

        },
        saveData: function(event) {

            event.preventDefault();

            $form.find('.validate')
               .tooltip('hide')
               .off('.tooltip')
               .removeData('bs.tooltip')
               .removeClass('validate');

            Endold.post(9800, $form.serialize())
                .done(app.requestSave);
        },
        validate: function(validates) {
            var tooltip_option = {placement: 'top', html: true};
            $.each(validates, function(selector, messages) {
                var text = [];
                $.each(messages, function(key, message) {
                    text.push(message);
                });
                $form.find(selector)
                    .addClass('validate')
                    .tooltip($.extend(tooltip_option, {title: text.join('')}))
                    .tooltip('show');
            });
        },
        requestSave: function(response) {
            if (! response.status) {
                return ('validates' in response)
                    ? app.validate(response.validates)
                    : alert(response.message);
            } else {
                alert(response.message);
                location.reload();
            }
        }


    };

    app.init();

})(top.Endold);