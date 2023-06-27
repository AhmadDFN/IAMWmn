$(document).ready(function () {
    $("#provinsiup").change(function () {
        var provinsiId = $(this).val();

        // Hapus opsi kota sebelumnya
        $("#kotaup").empty();
    });
});

function getKota(element, url) {
    const idProv = $(element).val();
    console.log(`${url}/${idProv}`);
    $.get(url + "/" + idProv, function (data) {
        $("#kotaup").append(data);
    });
}

// Inisialisasi date picker pada input
// var datePicker = document.querySelector(".date");
// var datepicker = new Datepicker(datePicker, {
//     format: "yyyy-mm-dd",
//     autoclose: true,
// });
