$(function () {

    var cache = [];

    $("#tags")
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
                    url: '/soc/api/get-companies',
                    data: {keyword: request.term},
                    success: function (data) {
                        cache = [];
                        if (data['code'] === 200) {
                            $.each(data['data'], function (index, element) {
                                list.push(element['c_name']);
                                cache[element['c_name']] = element['c_id']
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
                refresh_day();
                return false;
            },
        }).blur(function () {
        check_c_name();
    });

    function check_c_name() {
        $.ajax({
            type: 'GET',
            url: '/soc/api/check-c-name',
            data: {
                c_name: $("#tags").val()
            },
            success: function (data) {
                if (data['code'] === 200) {
                    if ($("#error_div").is(":visible")) {
                        $("#error_div").hide();
                    }
                } else {
                    if ($("#error_div").is(":hidden")) {
                        $("#error_div").show();
                    }
                    $("#error_info").html(data['data']);
                }
            }
        });
    }

    $("select[name='t_name']").change(function () {
        refresh_day();
    });

    $(window).on("load", function () {
        if ($("#tags").val() && $("select[name='t_name']")) {
            refresh_day();
        }
    });

    function refresh_day() {
        $("select[name='day']").children('option').remove();
        $.ajax({
            type: 'GET',
            url: '/soc/api/get-day',
            data: {
                c_name: $("#tags").val(),
                t_name: $("select[name='t_name']").val()
            },
            success: function (data) {
                if (data['code'] === 200) {
                    if ($("#error_div").is(":visible")) {
                        $("#error_div").hide();
                    }
                    $.each(data['data'], function (i, item) {
                        $("select[name='day']").append($('<option>', {
                            value: item,
                            text: item
                        }));
                    });
                } else {
                    if ($("#error_div").is(":hidden")) {
                        $("#error_div").show();
                    }
                    $("#error_info").html(data['data']);
                }
            }
        });
    }
});
