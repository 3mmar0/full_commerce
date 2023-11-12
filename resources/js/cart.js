(function ($) {
    $(".item-quantity").on("change", function (e) {
        $.ajax({
            url: "/cart/" + $(this).data("id"),
            method: "put",
            data: {
                quantity: $(this).val(),
                _token: csrf_token,
            },
        });
    });
    $(".item-del").on("click", function (e) {
        const id = $(this).data("id");
        $.ajax({
            url: "/cart/" + id,
            method: "delete",
            data: {
                _token: csrf_token,
            },
            success: (res) => {
                $(`#${id}`).remove();
            },
        });
    });
})(jQuery);
