$(document).ready(function () {
	getDataKelas("#id_detail_kelas");
	getDataMapel("#id_mapel");

	$("#data_siswa").hide();

	$("#filter_absen").on("submit", function (e) {
		e.preventDefault();
		var id_detail_kelas = $("#id_detail_kelas").val();
		var id_mapel = $("#id_mapel").val();
		var id_tahun_ajaran = $("#id_tahun_ajaran").val();
		loadData(id_detail_kelas, id_mapel, id_tahun_ajaran);
	});

	$("#filterAbsen").on("click", function () {
		var id_detail_kelas = $("#id_detail_kelas").val();
		var id_mapel = $("#id_mapel").val();
		var id_tahun_ajaran = $("#id_tahun_ajaran_val").val();
		id_detail_kelas = id_detail_kelas.replace(/&?[^=&]+=(&|$)/g, "");
		id_mapel = id_mapel.replace(/&?[^=&]+=(&|$)/g, "");
		id_tahun_ajaran = id_tahun_ajaran.replace(/&?[^=&]+=(&|$)/g, "");
		loadData(id_detail_kelas, id_mapel, id_tahun_ajaran);
	});

	$(document).on("click", "#simpanAbsen", function () {
		var data = $("#dataAbsen").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		saveAbsen(data);
	});

	// $(document).on("change", ".cekAbsen", function () {
	// 	var data = $(this).val();
	// 	var id_siswa = $(this).attr("data-id");

	// 	var hadir = id_siswa + "h";
	// 	var sakit = id_siswa + "s";
	// 	var ijin = id_siswa + "i";
	// 	var alfa = id_siswa + "a";

	// 	if (this.checked) {
	// 		if (data == "h") {
	// 			$('input[data-target="' + sakit + '"]').prop("disabled", true);
	// 			$('input[data-target="' + ijin + '"]').prop("disabled", true);
	// 			$('input[data-target="' + alfa + '"]').prop("disabled", true);
	// 			console.log(data);
	// 		} else if (data == "s") {
	// 			$('input[data-target="' + hadir + '"]').prop("disabled", true);
	// 			$('input[data-target="' + ijin + '"]').prop("disabled", true);
	// 			$('input[data-target="' + alfa + '"]').prop("disabled", true);
	// 			console.log(data);
	// 		} else if (data == "i") {
	// 			$('input[data-target="' + hadir + '"]').prop("disabled", true);
	// 			$('input[data-target="' + sakit + '"]').prop("disabled", true);
	// 			$('input[data-target="' + alfa + '"]').prop("disabled", true);
	// 			console.log(data);
	// 		} else if (data == "a") {
	// 			$('input[data-target="' + hadir + '"]').prop("disabled", true);
	// 			$('input[data-target="' + sakit + '"]').prop("disabled", true);
	// 			$('input[data-target="' + ijin + '"]').prop("disabled", true);
	// 			console.log(data);
	// 		}
	// 	} else {
	// 		if (data == "h") {
	// 			$('input[data-target="' + sakit + '"]').prop("disabled", false);
	// 			$('input[data-target="' + ijin + '"]').prop("disabled", false);
	// 			$('input[data-target="' + alfa + '"]').prop("disabled", false);
	// 			console.log(data);
	// 		} else if (data == "s") {
	// 			$('input[data-target="' + hadir + '"]').prop("disabled", false);
	// 			$('input[data-target="' + ijin + '"]').prop("disabled", false);
	// 			$('input[data-target="' + alfa + '"]').prop("disabled", false);
	// 			console.log(data);
	// 		} else if (data == "i") {
	// 			$('input[data-target="' + hadir + '"]').prop("disabled", false);
	// 			$('input[data-target="' + sakit + '"]').prop("disabled", false);
	// 			$('input[data-target="' + alfa + '"]').prop("disabled", false);
	// 			console.log(data);
	// 		} else if (data == "a") {
	// 			$('input[data-target="' + hadir + '"]').prop("disabled", false);
	// 			$('input[data-target="' + sakit + '"]').prop("disabled", false);
	// 			$('input[data-target="' + ijin + '"]').prop("disabled", false);
	// 			console.log(data);
	// 		}
	// 	}
	// });

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
					("</option>");
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

	function loadData(id_detail_kelas, id_mapel, id_tahun_ajaran) {	
		$("#id_detail_kelas_in").val(id_detail_kelas);
		$("#id_mapel_in").val(id_mapel);
		$("#id_tahun_ajaran_in").val(id_tahun_ajaran);
		$.ajax({
			type: "POST",
			url: "datasiswabyiddetailkelas",
			data: { id_detail_kelas: id_detail_kelas },
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
						"<input type='hidden' name='id_siswa[]' value='" +
						data[i].id_siswa +
						"'>" +
						"<label>" +
						data[i].nama +
						"</label>" +
						"<br>" +
						"<span class='btn btn-xs btn-default'>" +
						"<input type='checkbox' class='cekAbsen' data-id='" +
						data[i].id_siswa +
						"' data-target='" +
						data[i].id_siswa +
						"h' name='status[]' value='h' id='hadir' required>" +
						"<label class='control-label'> &nbsp;&nbsp;H</label>" +
						"</span> &nbsp;&nbsp;&nbsp;&nbsp;" +
						"<span class='btn btn-xs btn-default'>" +
						"<input type='checkbox' class='cekAbsen' data-id='" +
						data[i].id_siswa +
						"' data-target='" +
						data[i].id_siswa +
						"s' name='status[]' value='i' id='sakit' required>" +
						"<label class='control-label'> &nbsp;&nbsp;I</label>" +
						"</span> &nbsp;&nbsp;&nbsp;&nbsp;" +
						"<span class='btn btn-xs btn-default'>" +
						"<input type='checkbox' class='cekAbsen' data-id='" +
						data[i].id_siswa +
						"' data-target='" +
						data[i].id_siswa +
						"i' name='status[]' value='s' id='ijin' required>" +
						"<label class='control-label'> &nbsp;&nbsp;S</label>" +
						"</span> &nbsp;&nbsp;&nbsp;&nbsp;" +
						"<span class='btn btn-xs btn-default'>" +
						"<input type='checkbox' class='cekAbsen' data-id='" +
						data[i].id_siswa +
						"' data-target='" +
						data[i].id_siswa +
						"a' name='status[]' value='a' id='alfa' required>" +
						"<label class='control-label'> &nbsp;&nbsp;A</label>" +
						"</span>" +
						"</td>" +
						"</tr>";
				}
				$("#dataSiswa").html(html);
				$("#data_siswa").show();
			},
		});
	}

	function saveAbsen(data) {
		$.ajax({
			type: "POST",
			url: "tambahabsensi",
			data: data,
			success: function () {
				Swal.fire({
					position: "center",
					icon: "success",
					title: "Your data has been saved",
					showConfirmButton: false,
					timer: 2000,
				});
				$("select#id_detail_kelas").val("");
				$("select#id_mapel").val("");
				$("select#id_tahun_ajaran_val").val("");
				$("#simpanAbsen").hide();
			},
		});
	}
});
