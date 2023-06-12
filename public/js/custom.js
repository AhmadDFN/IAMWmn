$(document).ready(function () {
    $("#provinsiup").change(function () {
        var provinsiId = $(this).val();

        // Hapus opsi kota sebelumnya
        $("#kotaup").empty();

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
