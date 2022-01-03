$(function () {
    $('.basic-repeater').repeater({
        show: function () {
            $(this).slideDown();
        }
    });

    $('.alert-repeater').repeater({
        show: function () {
            $(this).slideDown();
        },
        hide: function (deleteElement) {
            swal({
                title: "Satır Siliniyor",
                text: "Silmek istediğinize emin misiniz ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $(this).slideUp(deleteElement);
                    }
                })
        }
    });
});
