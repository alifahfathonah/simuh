$(document).ready(function () {
	loadData();
	getData();

	$(document).on("click", "#detailJurnal", function () {
		var data = $(this).attr("data-id");
		detailData(data);
	});

	$(document).on("click", "#deleteJurnal", function () {
		var data = $(this).attr("data-id");
		deleteData(data);
	});

	//datatables
	function loadData() {
		$("#data_jurnal").DataTable();
	}

	function getData() {
		$.ajax({
			type: "ajax",
			url: "datajurnalpol",
			async: false,
			dataType: "json",
			success: function (data) {
				$("#loadJurnal").fadeOut();
				num = 1;
				var html = "";
				var i;
				for (i = 0; i < data.length; i++) {
					html +=
						"<tr id='jurnal" +
						data[i].id_jurnal +
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
						"<td>" +
						data[i].tgl +
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
						"<button type='button' id='detailJurnal'" +
						"data-id='" +
						data[i].id_jurnal +
						"'" +
						"class='btn btn-sm btn-default'>" +
						"<i class='fa fa-eye'></i>" +
						"</button> " +
						"<button type='button' id='deleteJurnal'" +
						"data-id='" +
						data[i].id_jurnal +
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

	function detailData(data) {
		$.ajax({
			type: "POST",
			url: "datadetailjurnal",
			data: { id: data },
			dataType: "json",
			success: function (data) {
				var i;
				for (i = 0; i < data.length; i++) {
					$("#nip").val(data[i].nip);
					$("#nama").val(data[i].nama);
					$("#nama_mapel").val(data[i].nama_mapel);
					$("#tgl").val(data[i].tgl);
					$("#jam_mulai").val(data[i].jam_mulai);
					$("#jam_akhir").val(data[i].jam_akhir);
					if (data[i].urut == 0) {
						$("#nama_kelas").val(
							data[i].nama_kelas + "-" + data[i].nama_jurusan
						);
					} else {
						$("#nama_kelas").val(
							data[i].nama_kelas +
								"-" +
								data[i].nama_jurusan +
								"-" +
								data[i].nama_jurusan
						);
					}
					$("#materi").val(data[i].judul);
					$("#flatform").val(data[i].flatform);
					$("#catatan").val(data[i].catatan);
					$("#bukti").attr(
						"src",
						"http://192.168.1.3/upload/" + data[i].bukti
					);

					$("#modal-detail").modal("show");
				}
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
					url: "deletejurnalpol",
					data: { id: data },
					success: function () {
						$("#loadJurnal").fadeIn();
						getData();
					},
				});
				return false;
			}
		});
	}
});
