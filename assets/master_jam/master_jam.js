$(document).ready(function () {
	getData();
	$("#tableJamMengajar").hide();
	$("#tambahMasterJamMengajar").hide();

	$("#tambah_title_jam_mengajar").on("submit", function (e) {
		e.preventDefault();
		var data = $("#tambah_title_jam_mengajar").serialize();
		console.log(data);
		tambahData(data);
	});

	$("#tambahTitleJamMengajar").on("click", function () {
		var data = $("#tambah_title_jam_mengajar").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		console.log(data);
		tambahData(data);
	});

	// $(document).on("click", "#editMapel", function () {
	// 	var data = $(this).attr("data-id");
	// 	editData(data);
	// });

	// $(document).on("submit", "#edit_mapel", function (e) {
	// 	e.preventDefault();
	// 	var data = $("#edit_mapel").serialize();
	// 	saveEditData(data);
	// });

	// $(document).on("click", "#simpanEditMapel", function () {
	// 	var data = $("#edit_mapel").serialize();
	// 	data = data.replace(/&?[^=&]+=(&|$)/g, "");
	// 	saveEditData(data);
	// });

	// $(document).on("click", "#deleteMapel", function () {
	// 	var data = $(this).attr("data-id");
	// 	deleteData(data);
	// });

	function getData() {
		$.ajax({
			type: "ajax",
			url: "datamapel",
			async: false,
			dataType: "json",
			success: function (data) {
				$("#loadMapel").fadeOut();
				num = 1;
				var html = "";
				var i;
				for (i = 0; i < data.length; i++) {
					html +=
						"<tr id='mapel" +
						data[i].id_mapel +
						"'>" +
						"<td class='text-center'>" +
						num++ +
						"</td>" +
						"<td>" +
						data[i].nama_mapel +
						"</td>" +
						"<td>";
					if (data[i].nama != null) {
						html += data[i].nama;
					} else {
						html += "Semua Jurusan";
					}
					html +=
						"</td>" +
						"<td>" +
						"<button type='button' id='editMapel'" +
						"data-id='" +
						data[i].id_mapel +
						"'" +
						"class='btn btn-sm btn-default'>" +
						"EDIT" +
						"</button> " +
						"<button type='button' id='deleteMapel'" +
						"data-id='" +
						data[i].id_mapel +
						"'" +
						"class='btn btn-sm btn-danger'>" +
						"HAPUS" +
						"</button>" +
						"</td>" +
						"</tr>";
				}
				$("#getDataMapel").html(html);
			},
		});
	}

	

	function tambahData(data) {
		$.ajax({
			type: "POST",
			url: "tambahmasterjam",
			data: data,
			success: function () {
				$("#loadMasterJam").fadeIn();
				getData();
				$("#modal-master-jam").modal("hide");
				$("#title").val("");
				$("#tot_jam").val("");
				$("#modal-jam").modal("show");
			},
		});
	}

	function editData(data) {
		$.ajax({
			type: "POST",
			url: "dataeditmapel",
			data: { id: data },
			dataType: "json",
			success: function (data) {
				var i;
				for (i = 0; i < data.length; i++) {
					$("select.edit-e-id-kategori-jurusan").val(
						data[i].id_kategori_jurusan
					);
					$("#edit-id-mapel").val(data[i].id_mapel);
					$("#edit-nama-mapel").val(data[i].nama_mapel);
					$("#modal-edit-mapel").modal("show");
				}
			},
		});
	}

	function saveEditData(data) {
		$.ajax({
			type: "POST",
			url: "simpaneditmapel",
			data: data,
			success: function () {
				$("#loadMapel").fadeIn();
				getData();
				$("#modal-edit-mapel").modal("hide");
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
					url: "deletemapel",
					data: { id: data },
					success: function () {
						$("#loadMapel").fadeIn();
						getData();
					},
				});
				return false;
			}
		});
	}
});
