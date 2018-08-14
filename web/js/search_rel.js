$(function () {

    var cache = [];

    $("#rel")
    // don't navigate away from the field on tab when selecting an item
        .on("keydown", function (event) {
            if (event.keyCode === $.ui.keyCode.TAB &&
                $(this).autocomplete("instance").menu.active) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 0,
            source: function (request, response) {
                // delegate back to autocomplete, but extract the last term
                var list = [];
                $.ajax({
                    type: 'GET',
                    url: '/api/get-rel',
                    data: {
                        keyword: request.term,
                        c_name: $('#c_name').val()
                    },
                    success: function (data) {
                        cache = [];
                        if (data['code'] === 200) {
                            $.each(data['data'], function (index, element) {
                                list.push(element);
                                cache[element] = element
                            });
                        }
                        response(list);
                    }
                });


            },
            focus: function () {
                // prevent value inserted on focus
                return false;
            },
            select: function (event, ui) {
                this.value = ui.item.value;
                // window.location.href = "/site/main?c_id="+cache[ui.item.value];
                return false;
            }
        });

});
