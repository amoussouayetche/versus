$(document).ready(function () {
    $("#table_personnelle").DataTable({
        oLanguage: {
            sLengthMenu: "Afficher_MENU_Enregistrement",
            sSearch: "Rechercher:",
            sInfo: "Total de _TOTAL_ enregistrements(_END_/ _TOTAL_)",
            oPaginate: {
                sNext: "Suivant",
                sPrevious: "Précédent",
            },
        },
    });
});

$(".modal").on("hidden.bs.modal", function () {
    $(this).find("form").trigger("reset");
});

$(".cart_update").change(function (e) {
    e.preventDefault();
    let ele = $(this);

    $.ajax({
        url: '{{ route("update_cart") }}',
        method: "patch",
        data: {
            _token: "{{ csrf_token() }}",
            id: ele.parents("tr").attr("data-id"),
            quantity: ele.parents("tr").find(".quantity").val(),
        },
        success: function (response) {
            window.location.reload();
        },
    });
});
