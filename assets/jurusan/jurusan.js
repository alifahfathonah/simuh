$(document).ready(function () {
	getData();
	getDataKategoriJurusan("#tampilDdataKategoriJurusan");
	getDataKategoriJurusan("#tampilDdataKategoriJurusan2");
	getDataKategoriJurusan("#tampilDdataKategoriJurusan3");
	getDataKategoriJurusan("#tampilDdataKategoriJurusan4");

	$("#tambah_jurusan").on("submit", function (e) {
		e.preventDefault();
		var data = $("#tambah_jurusan").serialize();
		tambahData(data);
	});

	$("#tambahJurusan").on("click", function () {
		var data = $("#tambah_jurusan").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		tambahData(data);
	});

	$(document).on("click", "#editJurusan", function () {
		var data = $(this).attr("data-id");
		editData(data);
	});

	$(document).on("submit", "#edit_jurusan", function (e) {
		e.preventDefault();
		var data = $("#edit_jurusan").serialize();
		saveEditData(data);
	});

	$(document).on("click", "#simpanEditJurusan", function () {
		var data = $("#edit_jurusan").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		saveEditData(data);
	});

	$(document).on("click", "#deleteJurusan", function () {
		var data = $(this).attr("data-id");
		deleteData(data);
	});

	function getData() {
		$.ajax({
			type: "ajax",
			url: "datajurusan",
			async: false,
			dataType: "json",
			success: function (data) {
				$("#loadJurusan").fadeOut();
				num = 1;
				var html = "";
				var i;
				for (i = 0; i < data.length; i++) {
					html +=
						"<tr id='jurusan" +
						data[i].id_jurusan +
						"'>" +
						"<td class='text-center'>" +
						num++ +
						"</td>" +
						"<td>" +
						data[i].nama +
						"</td>" +
						"<td>" +
						"<button type='button' id='editJurusan'" +
						"data-id='" +
						data[i].id_jurusan +
						"'" +
						"class='btn btn-sm btn-default'>" +
						"EDIT" +
						"</button> " +
						"<button type='button' id='deleteJurusan'" +
						"data-id='" +
						data[i].id_jurusan +
						"'" +
						"class='btn btn-sm btn-danger'>" +
						"HAPUS" +
						"</button>" +
						"</td>" +
						"</tr>";
				}
				$("#getDataJurusan").html(html);
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
				html += "<option value=>-- Pilih Kategori Jurusan</option>";
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

	function tambahData(data) {
		$.ajax({
			type: "POST",
			url: "tambahjurusan",
			data: data,
			success: function () {
				$("#loadJurusan").fadeIn();
				getData();
				$("#modal-jurusan").modal("hide");
				Swal.fire({
					position: "center",
					icon: "success",
					title: "Your data has been saved",
					showConfirmButton: false,
					timer: 2000,
				});
				$("select#tampilDdataKategoriJurusan").val("");
				$("#nama-jurusan").val("");
			},
		});
	}

	function editData(data) {
		$.ajax({
			type: "POST",
			url: "dataeditjurusan",
			data: { id: data },
			dataType: "json",
			success: function (data) {
				var i;
				for (i = 0; i < data.length; i++) {
					$("select.edit-e-id-kategori-jurusan").val(
						data[i].id_kategori_jurusan
					);
					$("#edit-id-jurusan").val(data[i].id_jurusan);
					$("#edit-nama-jurusan").val(data[i].nama);
					$("#modal-edit-jurusan").modal("show");
				}
			},
		});
	}

	function saveEditData(data) {
		$.ajax({
			type: "POST",
			url: "simpaneditjurusan",
			data: data,
			success: function () {
				$("#loadJurusan").fadeIn();
				getData();
				$("#modal-edit-jurusan").modal("hide");
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
					url: "deletejurusan",
					data: { id: data },
					success: function () {
						$("#loadJurusan").fadeIn();
						getData();
					},
				});
				return false;
			}
		});
	}
});
