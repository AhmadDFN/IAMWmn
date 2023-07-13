function confirmDeleteItem(formId) {
    Swal.fire({
        title: "Konfirmasi",
        text: "Apakah Anda yakin ingin menghapus item ini?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya",
        cancelButtonText: "Batal",
        customClass: {
            container: "dark-bg",
            popup: "dark-bg",
            content: "dark-bg",
            confirmButton: "btn btn-primary btn-white",
            cancelButton: "btn btn-secondary btn-white",
        },
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}

// LOGOUT CONFIRMATION
function confirmLogout() {
    Swal.fire({
        title: "Konfirmasi",
        text: "Apakah Anda yakin ingin keluar?",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya",
        cancelButtonText: "Batal",
        customClass: {
            container: "dark-bg",
            popup: "dark-bg",
            content: "dark-bg",
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-secondary",
        },
    }).then((result) => {
        if (result.isConfirmed) {
            // Lanjutkan dengan proses logout di sini
            window.location.href = "{{ url('auth/logout') }}";
        }
    });
    return false; // Hindari aksi logout langsung dari tautan
}

//Confirm Simpan
function confirmSave(formId) {
    Swal.fire({
        title: "Konfirmasi",
        text: "Apakah Anda ingin menyimpan?",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya",
        cancelButtonText: "Batal",
        customClass: {
            container: "dark-bg",
            popup: "dark-bg",
            content: "dark-bg",
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-secondary",
        },
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}
