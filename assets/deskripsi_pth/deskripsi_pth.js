$(document).ready(function () {
	getData();

	$("#tambah_mapel").on("submit", function (e) {
		e.preventDefault();
		var data = $("#tambah_mapel").serialize();
		tambahData(data);
	});

	$("#tambahMapel").on("click", function () {
		var data = $("#tambah_mapel").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		tambahData(data);
	});

	$(document).on("click", "#editMapel", function () {
		var data = $(this).attr("data-id");
		editData(data);
	});

	$(document).on("submit", "#edit_mapel", function (e) {
		e.preventDefault();
		var data = $("#edit_mapel").serialize();
		saveEditData(data);
	});

	$(document).on("click", "#simpanEditMapel", function () {
		var data = $("#edit_mapel").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		saveEditData(data);
	});

	$(document).on("click", "#deleteMapel", function () {
		var data = $(this).attr("data-id");
		deleteData(data);
	});

	function getData() {
		$.ajax({
			type: "ajax",
			url: "datadeskripsipth",
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
						"<td class='text-center'>" +
						data[i].kode +
						"</td>" +
						"<td>" +
						data[i].nama_mapel +
						"</td>" +
						"<td class='text-center'>" +
						data[i].nama_kelas +
						" ( ";
					if (data[i].nama_kategori != null) {
						html += data[i].nama_kategori;
					} else {
						html += "Semua Jurusan";
					}
					html +=
						" )" +
						"</td>" +
						"<td id='deskripsi'>" +
						"</td>";
						$.ajax({
							type: "post",
							url: "datadeskripsipthpredikat",
							async: false,
							data: { id: data[i].id_mapel },
							dataType: "json",
							success: function (data) {
								var html = "";
								var a;
								for (a = 0; a < data.length; a++) {
									html += "<td>" + data[a].deskripsi + "</td>";
								}
								$("#deskripsi").html(html);
							},
						});
					html +=
						"<td class='text-center'>" +
						"<button type='button' id='editMapel'" +
						"data-id='" +
						data[i].id_mapel +
						"'" +
						"class='btn btn-sm btn-default'>" +
						"EDIT" +
						"</button> " +
						"</td>" +
						"</tr>";
				}
				$("#getDataDeskripsi").html(html);
			},
		});
	}

	function getDataKategoriJurusan(tempat) {
		$.ajax({
			type: "ajax",
			url: "datakategorijurusan",
			async: false,
			dataType: "json",
			success: function (data) {
				var html = "";
				var i;
				html +=
					"<option value=''>-- Pilih Kategori Jurusan</option>" +
					"<option value='0'>Semua Kategori</option>";
				for (i = 0; i < data.length; i++) {
					html +=
						"<option value='" +
						data[i].id_kategori_jurusan +
						"'>" +
						data[i].nama +
						"</option>";
				}
				$(tempat).html(html);
			},
		});
	}

	function getDataKelas(tempat) {
		$.ajax({
			type: "ajax",
			url: "datakelas",
			async: false,
			dataType: "json",
			success: function (data) {
				var html = "";
				var i;
				html += "<option value=>-- Pilih Kelas</option>";
				for (i = 0; i < data.length; i++) {
					html +=
						"<option value='" +
						data[i].id_kelas +
						"'>" +
						data[i].nama +
						"</option>";
				}
				$(tempat).html(html);
			},
		});
	}

	function getDataKelompokMapel(tempat) {
		$.ajax({
			type: "ajax",
			url: "datakelompokmapel",
			async: false,
			dataType: "json",
			success: function (data) {
				var html = "";
				var i;
				html += "<option value=>-- Pilih Kelompok Mata Pelajaran</option>";
				for (i = 0; i < data.length; i++) {
					html +=
						"<option value='" +
						data[i].id_kelompok_mapel +
						"'>" +
						data[i].nama_kelompok +
						"</option>";
				}
				$(tempat).html(html);
			},
		});
	}

	function tambahData(data) {
		$.ajax({
			type: "POST",
			url: "tambahmapel",
			data: data,
			success: function () {
				$("#loadMapel").fadeIn();
				getData();
				$("#modal-mapel").modal("hide");
				Swal.fire({
					position: "center",
					icon: "success",
					title: "Your data has been saved",
					showConfirmButton: false,
					timer: 2000,
				});
				$("#nama-mapel").val("");
				$("#tampilDdataKategoriJurusan5").val("");
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
					$("#kodeEdit").val(data[i].kode);
					$("#edit-id-mapel").val(data[i].id_mapel);
					$("#edit-nama-mapel").val(data[i].nama_mapel);
					$("select.edit-e-id-kelas").val(data[i].id_kelas);
					$("select.edit-e-id-kelompok-mapel").val(data[i].id_kelompok_mapel);
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
