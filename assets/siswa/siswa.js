$(document).ready(function () {
	getData();
	getDataAngkatan(".id-angkatan");
	getDataKelas(".id-kelas");
	getDataJurusan(".id-jurusan");
	getDataAngkatan(".edit-id-angkatan");
	getDataKelas(".edit-id-kelas");
	getDataJurusan(".edit-id-jurusan");

	$("#tambah_siswa").on("submit", function (e) {
		e.preventDefault();
		var data = $("#tambah_siswa").serialize();
		tambahData(data);
	});

	$("#tambahSiswa").on("click", function () {
		var data = $("#tambah_siswa").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		tambahData(data);
	});

	$(document).on("click", "#editSiswa", function () {
		var data = $(this).attr("data-id");
		editData(data);
	});

	$(document).on("submit", "#edit_siswa", function (e) {
		e.preventDefault();
		var data = $("#edit_siswa").serialize();
		saveEditData(data);
	});

	$(document).on("click", "#simpanEditSiswa", function () {
		var data = $("#edit_siswa").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		saveEditData(data);
	});

	$(document).on("click", "#deleteSiswa", function () {
		var data = $(this).attr("data-id");
		deleteData(data);
	});

	function getData() {
		$.ajax({
			type: "ajax",
			url: "datasiswa",
			async: false,
			dataType: "json",
			success: function (data) {
				var num = 1;
				var html = "";
				var i;
				for (i = 0; i < data.length; i++) {
					html +=
						"<tr id='siswa" +
						data[i].id_siswa +
						"'>" +
						"<td>" +
						num++ +
						"</td>" +
						"<td>" +
						data[i].no_induk +
						"</td>" +
						"<td>" +
						data[i].nama +
						"</td>" +
						"<td>" +
						data[i].nama_kelas +
						"-" +
						data[i].nama_jurusan;
						if (data[i].urut_kelas != 0) {
							html += "-" + data[i].urut_kelas;
						}
						html +=
							"</td>" +
							"<td class='text-center'>" +
							"<button type='button' id='detailSiswa'" +
							"data-id='" +
							data[i].id_siswa +
							"'" +
							"class='btn btn-sm btn-default'>" +
							"<i class='fa fa-eye'></i>" +
							"</button> " +
							"<button type='button' id='editSiswa'" +
							"data-id='" +
							data[i].id_siswa +
							"'" +
							"class='btn btn-sm btn-default'>" +
							"EDIT" +
							"</button> " +
							"<button type='button' id='deleteSiswa'" +
							"data-id='" +
							data[i].id_siswa +
							"'" +
							"class='btn btn-sm btn-danger'>" +
							"HAPUS" +
							"</button>" +
							"</td>" +
							"</tr>";
				}
				$("#getDataSiswa").html(html);
			},
		});
	}

	function getDataAngkatan(tempat) {
		$.ajax({
			type: "ajax",
			url: "tampildatatahunajaran",
			async: false,
			dataType: "json",
			success: function (data) {
				var html = "";
				var i;
				html += "<option value=''>-- Pilih Tahun Ajaran</option>";
				for (i = 0; i < data.length; i++) {
					html +=
						"<option value='" +
						data[i].id_tahun_ajaran +
						"'>" +
						data[i].tahun_ajaran +
						"</option>";
				}
				$(tempat).html(html);
			},
		});
	}

	function getDataKelas(tempat) {
		$.ajax({
			type: "ajax",
			url: "datadetailkelas",
			async: false,
			dataType: "json",
			success: function (data) {
				var html = "";
				var i;
				html += "<option value=''>-- Pilih Kelas</option>";
				for (i = 0; i < data.length; i++) {
					html +=
						"<option value='" +
						data[i].id_detail_kelas +
						"'>" +
						data[i].nama_kelas +
						"-" +
						data[i].nama_jurusan;
						if (data[i].urut_kelas != 0) {
							html += "-" + data[i].urut_kelas;
						}
						"</option>";
				}
				$(tempat).html(html);
			},
		});
	}

	function getDataJurusan(tempat) {
		$.ajax({
			type: "ajax",
			url: "datajurusan",
			async: false,
			dataType: "json",
			success: function (data) {
				var html = "";
				var i;
				html += "<option value=''>-- Pilih Kategori Jurusan</option>";
				for (i = 0; i < data.length; i++) {
					html +=
						"<option value='" +
						data[i].id_jurusan +
						"'>" +
						data[i].nama +
						"</option>";
				}
				$(tempat).html(html);
			},
		});
	}

	function tambahData(data) {
		$.ajax({
			type: "POST",
			url: "tambahsiswa",
			data: data,
			success: function () {
				getData();
				$("#modal-siswa").modal("hide");
				Swal.fire({
					position: "center",
					icon: "success",
					title: "Your data has been saved",
					showConfirmButton: false,
					timer: 2000,
				});
				$("#no-induk").val("");
				$("#nama-siswa").val("");
				$("#tempat-lahir").val("");
				$("#tgl-lahir").val("");
				$("select.jk").val("");
				$("#alamat").val("");
				$("#no-hp").val("");
				$("select.id-angkatan").val("");
				$("select.id-kelas").val("");
				$("select.id-jurusan").val("");
				$("#no-absen").val("");
			},
		});
	}

	function editData(data) {
		$.ajax({
			type: "POST",
			url: "dataeditsiswa",
			data: { id: data },
			dataType: "json",
			success: function (data) {
				var i;
				for (i = 0; i < data.length; i++) {
					$("#edit-id-siswa").val(data[i].id_siswa);
					$("#edit-no-induk").val(data[i].no_induk);
					$("#edit-nama-siswa").val(data[i].nama);
					$("#edit-tempat-lahir").val(data[i].tempat_lahir);
					$("#edit-tgl-lahir2").val(data[i].tgl_lahir);
					$("select.edit-jk").val(data[i].jk);
					$("#edit-alamat").val(data[i].alamat);
					$("#edit-no-hp").val(data[i].no_hp);
					$("select.edit-id-angkatan").val(data[i].id_angkatan);
					$("select.edit-id-kelas").val(data[i].id_detail_kelas);
					$("#edit-no-absen").val(data[i].no_absen);

					$("#modal-edit-siswa").modal("show");
				}
			},
		});
	}

	function saveEditData(data) {
		$.ajax({
			type: "POST",
			url: "simpaneditsiswa",
			data: data,
			success: function () {
				getData();
				$("#modal-edit-siswa").modal("hide");
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

	$(document).on("click", "#detailSiswa", function () {
		var data = $(this).attr("data-id");

		$.ajax({
			type: "POST",
			url: "datasiswa",
			data: { id: data },
			dataType: "json",
			success: function (data) {
				var i;
				for (i = 0; i < data.length; i++) {
					$("#detail-id-siswa").val(data[i].id_siswa);
					$("#detail-no-induk").val(data[i].no_induk);
					$("#detail-nama-siswa").val(data[i].nama);
					$("#detail-tempat-lahir").val(data[i].tempat_lahir);
					$("#detail-tgl-lahir2").val(data[i].tgl_lahir);
					if (data[i].jk != "L") {
						$("#detail-jk").val("Perempuan");
					} else {
						$("#detail-jk").val("Laki-Laki");
					}
					$("#detail-alamat").val(data[i].alamat);
					$("#detail-no-hp").val(data[i].no_hp);
					$("#detail-id-angkatan").val(data[i].angkatan);
					if (data[i].urut_kelas != 0) {
						$("#detail-id-kelas").val(
							data[i].nama_kelas +
							"-" +
							data[i].nama_jurusan +
							"-" + 
							data[i].urut_kelas
						);
					}else{
						$("#detail-id-kelas").val(
							data[i].nama_kelas +
							"-" +
							data[i].nama_jurusan
						);
					}
					$("#detail-no-absen").val(data[i].no_absen);

					$("#modal-detail-siswa").modal("show");
				}
			},
		});
	});

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
					url: "deletesiswa",
					data: { id: data },
					success: function () {
						getData();
					},
				});
				return false;
			}
		});
	}
});
