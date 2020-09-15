$(document).ready(function () {
	loadData();
	//datatables
	function loadData() {
		$("#data_tahun_ajaran").DataTable({
			processing: true,
			serverSide: true,
			order: [],

			ajax: {
				url: "getdatatahunajaran",
				type: "POST",
			},

			columnDefs: [
				{
					targets: [0],
					orderable: false,
				},
			],
		});
	}

	$("#tambahTahunAjaran").on("click", function () {
		var data = $("#tambah_tahun_ajaran").serialize();

		$.ajax({
			type: "POST",
			url: "tambahtahunajaran",
			data: data,
			success: function () {
				$("#data_tahun_ajaran").DataTable().destroy();
				loadData();
				$("#modal-tahun-ajaran").modal("hide");
				Swal.fire({
					position: "center",
					icon: "success",
					title: "Your data has been saved",
					showConfirmButton: false,
					timer: 2000,
				});
				$("#tahun-ajaran").val("");
				$("#tgl_mulai_ganjil").val("");
				$("#tgl_akhir_ganjil").val("");
				$("#tgl_mulai_genap").val("");
				$("#tgl_akhir_genap").val("");
			},
		});
	});

	$(document).on("click", "#deleteTahunAjaran", function () {
		var data = $(this).attr("data-id");

		Swal.fire({
			title: "Are you sure?",
			text: "Data will be deleted!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes, delete it!",
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: "POST",
					url: "deletetahunajaran",
					data: { id: data },
					success: function () {
						$("#data_tahun_ajaran").DataTable().destroy();
						loadData();
						Swal.fire("Deleted!", "Your data has been deleted.", "success");
					},
				});
				return false;
			}
		});
	});
});
