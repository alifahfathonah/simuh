$(document).ready(function () {
	getData();
	getDataUser("#tapilDataUser");
	getDataMapel("#tampilDataMapel");
	getDataUser("#tapilDataUser2");
	getDataMapel("#tampilDataMapel2");

	$("#data_pengajar").DataTable();

	$("#tambah_pengajar").on("submit", function (e) {
		e.preventDefault();
		var data = $("#tapilDataUser").val();
		tambahData(data);
	});

	$("#tambahPengajar").on("click", function () {
		var data = $("#tapilDataUser").val();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		tambahData(data);
	});

	$("#tambah_detail_pengajar").on("submit", function (e) {
		e.preventDefault();
		var data = $("#tambah_detail_pengajar").serialize();
		simpanData(data);
	});

	$("#tambahDetailPengajar").on("click", function () {
		var data = $("#tambah_detail_pengajar").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		simpanData(data);
	});

	$("#simpanDetailPengajar").on("click", function () {
		simpanDataSukses();
	});

	$(document).on("click", "#deleteMapelPengajar", function () {
		var data = $(this).attr("data-id");
		var id_user = $(this).attr("user-id");
		deleteDataDetailMapel(data, id_user);
	});

	$(document).on("click", "#deletePengajar", function () {
		var data = $(this).attr("data-id");
		deleteData(data);
	});

	function getData() {
		$.ajax({
			type: "ajax",
			url: "datapengajar",
			async: false,
			dataType: "json",
			success: function (data) {
				$("#loadPengajar").fadeOut();
				num = 1;
				var html = "";
				var i;
				for (i = 0; i < data.length; i++) {
					if (data[i].id_pengajar != null) {
						html +=
							"<tr id='pengajar" +
							data[i].id_pengajar +
							"'>" +
							"<td class='text-center'>" +
							num++ +
							"</td>" +
							"<td>" +
							data[i].nama +
							"</td>" +
							"<td>" +
							data[i].nama_mapel +
							"</td>" +
							"<td class='text-center'>" +
							"<button type='button' id='deletePengajar'" +
							"data-id='" +
							data[i].id_user +
							"'" +
							"class='btn btn-sm btn-danger'>" +
							"HAPUS" +
							"</button>" +
							"</td>" +
							"</tr>";
					}
				}
				$("#getDataPengajar").html(html);
			},
		});
	}

	function getDataDetail(posdata) {
		$.ajax({
			type: "POST",
			url: "datadetailmapel",
			data: posdata,
			dataType: "json",
			success: function (data) {
				num = 1;
				var html = "";
				var i;
				for (i = 0; i < data.length; i++) {
					html +=
						"<tr id='siswa" +
						data[i].id_pengajar +
						"'>" +
						"<td class='text-center'>" +
						num++ +
						"</td>" +
						"<td>" +
						data[i].nama_mapel +
						"</td>" +
						"<td class='text-center'>" +
						"<button type='button' id='deleteMapelPengajar'" +
						"data-id='" +
						data[i].id_pengajar +
						"'" +
						"user-id='" +
						data[i].id_user +
						"'" +
						"class='btn btn-sm btn-danger'>" +
						"HAPUS" +
						"</button>" +
						"</td>" +
						"</tr>";
				}
				$("#dataMapel").html(html);
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
				html += "<option value=''>-- Pilih Guru</option>";
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

	function getDataMapel(tempat) {
		$.ajax({
			type: "ajax",
			url: "datamapel",
			async: false,
			dataType: "json",
			success: function (data) {
				var html = "";
				var i;
				html += "<option value=''>-- Pilih Mata Pelajaran</option>";
				for (i = 0; i < data.length; i++) {
					html +=
						"<option value='" +
						data[i].id_mapel +
						"'>" +
						data[i].nama_mapel +
						"</option>";
				}
				$(tempat).html(html);
			},
		});
	}

	function tambahData(data) {
		$.ajax({
			type: "post",
			url: "dataedituser",
			data: { id: data },
			async: false,
			dataType: "json",
			success: function (data) {
				var i;
				for (i = 0; i < data.length; i++) {
					$("#id_user").val(data[i].id_user);
					$("#nama_user").val(data[i].nama);
				}
				$("#modal-pengajar").modal("hide");
				$("#modal-detail-pengajar").modal("show");
			},
		});
	}

	function simpanData(data) {
		$.ajax({
			type: "POST",
			url: "tambahpengajar",
			data: data,
			success: function () {
				getDataDetail(data);
			},
		});
	}

	function deleteDataDetailMapel(data, id_user) {
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
					url: "deletedetailmapel",
					data: { id: data },
					success: function () {
						getDataDetail({ id_user: id_user });
					},
				});
				return false;
			}
		});
	}

	function simpanDataSukses() {
		getData();
		$("#modal-detail-pengajar").modal("hide");
		Swal.fire({
			position: "center",
			icon: "success",
			title: "Your data has been saved",
			showConfirmButton: false,
			timer: 2000,
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
					url: "deletepengajar",
					data: { id: data },
					success: function () {
						$("#loadPengajar").fadeIn();
						getData();
					},
				});
				return false;
			}
		});
	}
});
