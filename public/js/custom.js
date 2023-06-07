$(document).ready(function () {
    $("#mhs_provinsi").change(function () {
        var provinsiId = $(this).val();

        // Hapus opsi kota sebelumnya
        $("#mhs_kota").empty();

        // Kirim permintaan Ajax ke server
        // $.ajax({
        //     url: '{{ route("getKotaByProvinsi") }}',
        //     method: "GET",
        //     data: { provinsiId: provinsiId },
        //     success: function (response) {
        //         // Tambahkan opsi kota berdasarkan data yang diterima
        //         if (response.length > 0) {
        //             $.each(response, function (key, value) {
        //                 $("#mhs_kota").append(
        //                     '<option value="' +
        //                         value.id +
        //                         '">' +
        //                         value.name +
        //                         "</option>"
        //                 );
        //             });
        //         } else {
        //             $("#mhs_kota").append(
        //                 '<option value="">Tidak ada kota</option>'
        //             );
        //         }
        //     },
        // });
    });
});

function getKota(element, url) {
    let idProv = $(element).val();
    $.get(url + "/" + idProv, function (data) {
        $("#mhs_kota").append(data);
    });
}

// Inisialisasi date picker pada input
// var datePicker = document.querySelector(".date");
// var datepicker = new Datepicker(datePicker, {
//     format: "yyyy-mm-dd",
//     autoclose: true,
// });
