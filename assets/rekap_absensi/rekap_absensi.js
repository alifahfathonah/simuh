$(document).ready(function () {
	$("#tanggal").daterangepicker({
		locale: { format: "YYYY-MM-DD" },
	});
	getDataKelas("#id_detail_kelas");
	getDataMapel("#id_mapel");
	getDataTahunAjaran("#id_tahun_ajaran");

	// $("#data_siswa").hide();

	$("#filter_absen").on("submit", function (e) {
		e.preventDefault();
		var data = $("#filter_absen").serialize();
		loadData(data);
	});

	$("#filterAbsen").on("click", function () {
		var data = $("#filter_absen").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		loadData(data);
	});

	$(document).on("click", "#simpanAbsen", function () {
		var data = $("#dataAbsen").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		saveAbsen(data);
	});

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

	function getDataTahunAjaran(tempat) {
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

	function loadData(data) {
		$.ajax({
			type: "POST",
			url: "rekapAbsensiSiswa",
			data: data,
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
						"<td class='text-center'>" +
						num++ +
						"</td>" +
						"<td>" +
						"<label>" +
						"<small>" +
						data[i].nama +
						"</small>" +
						"</label>" +
						"</td>" +
						"<td class='text-center'>" +
						"<label>" +
						"<small>" +
						data[i].no_induk +
						"</small>" +
						"</label>" +
						"</td>" +
						"<td class='text-center'>" +
						"<label>" +
						"<small>" +
						data[i].jk +
						"</small>" +
						"</label>" +
						"</td>" +
						"<td class='text-center'>" +
						"<label>" +
						"<small>" +
						"H: " +
						" S: " +
						" I: " +
						" A: " +
						"</small>" +
						"</label>" +
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
				$("sele").val("");
				$("#simpanAbsen").hide();
			},
		});
	}
});
