$(document).ready(function () {
  $(".js-select-2").select2();

  $("#data-table").DataTable({
    paging: true,
    responsive: true,
    searching: true,
  });

  $(".btn-hapus").on("click", function (e) {
    event.preventDefault(); // prevent form submit

    Swal.fire({
      title: "Hapus Data",
      text: "Pilih ya, jika anda ingin menghapus data !",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, hapus data !",
      cancelButtonText: "Batal",
    }).then((result) => {
      if (result.isConfirmed) {
        var form = $(this).parents("form");
        form.submit();
      }
    });
  });

  $(".btn-logout").on("click", function (e) {
    event.preventDefault(); // prevent form submit

    Swal.fire({
      title: "Logout",
      text: "Apakah anda yakin ingin keluar dari aplikasi ?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya",
      cancelButtonText: "Tidak",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = $(".btn-logout").attr("href");
      }
    });
  });
});
