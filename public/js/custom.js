$(document).ready(function () {
    $("#provinsiup").change(function () {
        var provinsiId = $(this).val();

        // Hapus opsi kota sebelumnya
        $("#kotaup").empty();
    });

    // Foto click
    $("#photo-preview").click(function () {
        $("#photo-input").click();
    });

    // Ketika file input change
    $("#photo-input").change(function () {
        setImage(this, "#photo-preview");
    });
});

// Read Image
function setImage(input, target) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        // Mengganti src dari object img#avatar
        reader.onload = function (e) {
            $(target).attr("src", e.target.result);
            // $("#foto").val(e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

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
