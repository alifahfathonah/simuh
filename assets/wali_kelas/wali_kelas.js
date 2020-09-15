$(document).ready(function () {
	getData();
	getDataUser("#tapilDataUser");
	getDataDetailKelas("#tampilDataDetailKelas");
	getDataUser("#tapilDataUser2");
	getDataDetailKelas("#tampilDataDetailKelas2");

	$("#tambah_wali").on("submit", function (e) {
		e.preventDefault();
		var data = $("#tambah_wali").serialize();
		tambahData(data);
	});

	$("#tambahWaliKelas").on("click", function () {
		var data = $("#tambah_wali").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		tambahData(data);
	});

	$(document).on("click", "#editWaliKelas", function () {
		var data = $(this).attr("data-id");
		editData(data);
	});

	$(document).on("submit", "#edit_wali", function (e) {
		e.preventDefault();
		var data = $("#edit_wali").serialize();
		saveEditData(data);
	});

	$(document).on("click", "#simpanEditWaliKelas", function () {
		var data = $("#edit_wali").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		saveEditData(data);
	});

	$(document).on("click", "#deleteWaliKelas", function () {
		var data = $(this).attr("data-id");
		deleteData(data);
	});

	function getData() {
		$.ajax({
			type: "ajax",
			url: "datawalikelas",
			async: false,
			dataType: "json",
			success: function (data) {
				$("#loadWali").fadeOut();
				num = 1;
				var html = "";
				var i;
				for (i = 0; i < data.length; i++) {
					html +=
						"<tr id='wali_kelas" +
						data[i].id_wali_kelas +
						"'>" +
						"<td class='text-center'>" +
						num++ +
						"</td>" +
						"<td>" +
						data[i].nama_user +
						"</td>" +
						"<td>" +
						data[i].nama_kelas +
						"-" +
						data[i].nama_jurusan;
					if (data[i].urut != 0) {
						html += "-" + data[i].urut;
					}
					html +=
						"</td>" +
						"<td class='text-center'>" +
						"<button type='button' id='editWaliKelas'" +
						"data-id='" +
						data[i].id_wali_kelas +
						"'" +
						"class='btn btn-sm btn-default'>" +
						"EDIT" +
						"</button> " +
						"<button type='button' id='deleteWaliKelas'" +
						"data-id='" +
						data[i].id_wali_kelas +
						"'" +
						"class='btn btn-sm btn-danger'>" +
						"HAPUS" +
						"</button>" +
						"</td>" +
						"</tr>";
				}
				$("#getDataWali").html(html);
			},
		});
	}

	function getDataUser(tempat) {
		$.ajax({
			type: "ajax",
			url: "datauser",
			async: false,
			dataType: "json",
			success: function (data) {
				var html = "";
				var i;
				html += "<option value=''>-- Pilih Guru Wali</option>";
				for (i = 0; i < data.length; i++) {
					html +=
						"<option value='" +
						data[i].id_user +
						"'>" +
						data[i].nama +
						"</option>";
				}
				$(tempat).html(html);
			},
		});
	}

	function getDataDetailKelas(tempat) {
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
					html += "</option>";
				}
				$(tempat).html(html);
			},
		});
	}

	function tambahData(data) {
		$.ajax({
			type: "POST",
			url: "tambahwalikelas",
			data: data,
			success: function () {
				$("#loadWali").fadeIn();
				getData();
				$("#modal-wali").modal("hide");
				Swal.fire({
					position: "center",
					icon: "success",
					title: "Your data has been saved",
					showConfirmButton: false,
					timer: 2000,
				});
				$("select#tapilDataUser").val("");
				$("select#tampilDataDetailKelas").val("");
			},
		});
	}

	function editData(data) {
		$.ajax({
			type: "POST",
			url: "dataeditwalikelas",
			data: { id: data },
			dataType: "json",
			success: function (data) {
				var i;
				for (i = 0; i < data.length; i++) {
					$("#edit_id_wali").val(data[i].id_wali_kelas);
                    $("select.edit_e_id_user").val(data[i].id_user);
                    $("select.edit_e_id_detail_mapel").val(data[i].id_detail_kelas);
					$("#modal-edit-wali").modal("show");
				}
			},
		});
	}

	function saveEditData(data) {
		$.ajax({
			type: "POST",
			url: "simpaneditwalikelas",
			data: data,
			success: function () {
				$("#loadWali").fadeIn();
				getData();
				$("#modal-edit-wali").modal("hide");
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
					url: "deletewalikelas",
					data: { id: data },
					success: function () {
						$("#loadWali").fadeIn();
						getData();
					},
				});
				return false;
			}
		});
	}
});
