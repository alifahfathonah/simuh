$(document).ready(function () {
	getData();

	$("#tambah_kelompok_mapel").on("submit", function (e) {
		e.preventDefault();
		var data = $("#tambah_kelompok_mapel").serialize();
		tambahData(data);
	});

	$("#tambahKelompokMapel").on("click", function () {
		var data = $("#tambah_kelompok_mapel").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		tambahData(data);
	});

	$(document).on("click", "#editKelompokMapel", function () {
		var data = $(this).attr("data-id");
		editData(data);
	});

	$(document).on("submit", "#edit_kelompok_mapel", function (e) {
		e.preventDefault();
		var data = $("#edit_kelompok_mapel").serialize();
		saveEditData(data);
	});

	$(document).on("click", "#simpanEditKelompokMapel", function () {
		var data = $("#edit_kelompok_mapel").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		saveEditData(data);
	});

	$(document).on("click", "#deleteKelompokMapel", function () {
		var data = $(this).attr("data-id");
		deleteData(data);
	});

	function getData() {
		$.ajax({
			type: "ajax",
			url: "datakelompokmapel",
			async: false,
			dataType: "json",
			success: function (data) {
				$("#loadKelompokMapel").fadeOut();
				num = 1;
				var html = "";
				var i;
				for (i = 0; i < data.length; i++) {
					html +=
						"<tr id='kelompokkelas" +
						data[i].id_kelompok_mapel +
						"'>" +
						"<td class='text-center'>" +
						num++ +
						"</td>" +
						"<td>" +
						data[i].nama_kelompok +
						"</td>" +
						"<td>" +
						data[i].kelompok +
						"</td>" +
						"<td>" +
						data[i].keterangan +
						"</td>" +
						"<td class='text-center'>" +
						"<button type='button' id='editKelompokMapel'" +
						"data-id='" +
						data[i].id_kelompok_mapel +
						"'" +
						"class='btn btn-sm btn-default'>" +
						"EDIT" +
						"</button> " +
						"<button type='button' id='deleteKelompokMapel'" +
						"data-id='" +
						data[i].id_kelompok_mapel +
						"'" +
						"class='btn btn-sm btn-danger'>" +
						"HAPUS" +
						"</button>" +
						"</td>" +
						"</tr>";
				}
				$("#getData").html(html);
			},
		});
	}

	function tambahData(data) {
		$.ajax({
			type: "POST",
			url: "tambahkelompokmapel",
			data: data,
			success: function () {
				$("#loadKelompokMapel").fadeIn();
				getData();
				$("#modal-kelompok-mapel").modal("hide");
				Swal.fire({
					position: "center",
					icon: "success",
					title: "Your data has been saved",
					showConfirmButton: false,
					timer: 2000,
				});
				$("#nama_kelompok").val("");
				$("#kelompok").val("");
				$("#keterangan").val("");
			},
		});
	}

	function editData(data) {
		$.ajax({
			type: "POST",
			url: "dataeditkelompokmapel",
			data: { id: data },
			dataType: "json",
			success: function (data) {
				var i;
				for (i = 0; i < data.length; i++) {
                    $("#id_kelompok_mapel").val(data[i].id_kelompok_mapel);
                    $("#nama_kelompok_edit").val(data[i].nama_kelompok);
                    $("#kelompok_edit").val(data[i].kelompok);
                    $("#keterangan_edit").val(data[i].keterangan);
					$("#modal-kelompok-mapel-edit").modal("show");
				}
			},
		});
	}

	function saveEditData(data) {
		$.ajax({
			type: "POST",
			url: "simpaneditkelompokmapel",
			data: data,
			success: function () {
				$("#loadKelompokMapel").fadeIn();
				getData();
				$("#modal-kelompok-mapel-edit").modal("hide");
				Swal.fire({
					position: "center",
					icon: "success",
					title: "Your data has been edited",
					showConfirmButton: false,
					timer: 2000,
				});
			},
		});
	}

	function deleteData(data) {
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
					url: "deletekelompokmapel",
					data: { id: data },
					success: function () {
						$("#loadKelompokMapel").fadeIn();
						getData();
					},
				});
				return false;
			}
		});
	}
});
