$(document).ready(function () {
	getData();
	getDataKelas("#id_kelas");
	getDataJurusan("#id_jurusan");
	getDataKelas("#id_kelas2");
	getDataJurusan("#id_jurusan2");

	$("#tambah_detail").on("submit", function (e) {
		e.preventDefault();
		var data = $("#tambah_detail").serialize();
		tambahData(data);
	});

	$("#tambahDetail").on("click", function () {
		var data = $("#tambah_detail").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		tambahData(data);
	});

	$(document).on("click", "#editDetailKelas", function () {
		var data = $(this).attr("data-id");
		editData(data);
	});

	$(document).on("submit", "#edit_detail", function (e) {
		e.preventDefault();
		var data = $("#edit_detail").serialize();
		saveEditData(data);
	});

	$(document).on("click", "#simpanEditDetail", function () {
		var data = $("#edit_detail").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		saveEditData(data);
	});

	$(document).on("click", "#deleteDetailKelas", function () {
		var data = $(this).attr("data-id");
		deleteData(data);
	});

	function getData() {
		$.ajax({
			type: "ajax",
			url: "datadetailkelas",
			async: false,
			dataType: "json",
			success: function (data) {
				$("#loadDetail").fadeOut();
				num = 1;
				var html = "";
				var i;
				for (i = 0; i < data.length; i++) {
					html +=
						"<tr id='detail_kelas" +
						data[i].id_detail_kelas +
						"'>" +
						"<td class='text-center'>" +
						num++ +
						"</td>" +
						"<td>" +
						data[i].nama_kategori_jurusan +
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
						"<td>" +
						"<button type='button' id='editDetailKelas'" +
						"data-id='" +
						data[i].id_detail_kelas +
						"'" +
						"class='btn btn-sm btn-default'>" +
						"EDIT" +
						"</button> " +
						"<button type='button' id='deleteDetailKelas'" +
						"data-id='" +
						data[i].id_detail_kelas +
						"'" +
						"class='btn btn-sm btn-danger'>" +
						"HAPUS" +
						"</button>" +
						"</td>" +
						"</tr>";
				}
				$("#getDataDetailKelas").html(html);
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

	function getDataJurusan(tempat) {
		$.ajax({
			type: "ajax",
			url: "datajurusan",
			async: false,
			dataType: "json",
			success: function (data) {
				var html = "";
				var i;
				html += "<option value=>-- Pilih Jurusan</option>";
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
			url: "tambahdetailkelas",
			data: data,
			success: function () {
				$("#loadDetail").fadeIn();
				getData();
				$("#modal-detail").modal("hide");
				Swal.fire({
					position: "center",
					icon: "success",
					title: "Your data has been saved",
					showConfirmButton: false,
					timer: 2000,
				});
				$("#tampilDdataKategoriJurusan3").val("");
				$("#id_kelas").val("");
				$("#id_jurusan").val("");
				$("#urut_kelas").val("");
			},
		});
	}

	function editData(data) {
		$.ajax({
			type: "POST",
			url: "dataeditdetailkelas",
			data: { id: data },
			dataType: "json",
			success: function (data) {
				var i;
				for (i = 0; i < data.length; i++) {
					$("select.edit-e-id-kategori-jurusan").val(
						data[i].id_kategori_jurusan
					);
					$("select.edit-e-id-kelas").val(data[i].id_kelas);
					$("select.edit-e-id-jurusan").val(data[i].id_jurusan);
					$("#id-detai-kelas").val(data[i].id_detail_kelas);
					$("#edit-urut-kelas").val(data[i].urut_kelas);
					$("#modal-edit-detail").modal("show");
				}
			},
		});
	}

	function saveEditData(data) {
		$.ajax({
			type: "POST",
			url: "simpaneditdetailkelas",
			data: data,
			success: function () {
				$("#loadDetail").fadeIn();
				getData();
				$("#modal-edit-detail").modal("hide");
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
					url: "deletedetailkelas",
					data: { id: data },
					success: function () {
						$("#loadDetail").fadeIn();
						getData();
					},
				});
				return false;
			}
		});
	}
});
