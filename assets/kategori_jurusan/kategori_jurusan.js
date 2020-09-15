$(document).ready(function () {
	getData();

	$("#tambah_kategori_jurusan").on("submit", function (e) {
		e.preventDefault();
		var data = $("#tambah_kategori_jurusan").serialize();
		tambahData(data);
	});

	$("#tambahKategoriJurusan").on("click", function () {
		var data = $("#tambah_kategori_jurusan").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		tambahData(data);
	});

	$(document).on("click", "#editKategoriJurusan", function () {
		var data = $(this).attr("data-id");
		editData(data);
	});

	$(document).on("submit", "#edit_kategori_jurusan", function (e) {
		e.preventDefault();
		var data = $("#edit_kategori_jurusan").serialize();
		saveEditData(data);
	});

	$(document).on("click", "#simpanEditKategoriJurusan", function () {
		var data = $("#edit_kategori_jurusan").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		saveEditData(data);
	});

	$(document).on("click", "#deleteKategoriJurusan", function () {
		var data = $(this).attr("data-id");
		deleteData(data);
	});

	function getData() {
		$.ajax({
			type: "ajax",
			url: "datakategorijurusan",
			async: false,
			dataType: "json",
			success: function (data) {
				$("#loadKategoriJurusan").fadeOut();
				var num = 1;
				var html = "";
				var i;
				for (i = 0; i < data.length; i++) {
					html +=
						"<tr id='kategori_jurusan" +
						data[i].id_kategori_jurusan +
						"'>" +
						"<td class='text-center'>" +
						num++ +
						"</td>" +
						"<td>" +
						data[i].nama +
						"</td>" +
						"<td>" +
						"<button type='button' id='editKategoriJurusan'" +
						"data-id='" +
						data[i].id_kategori_jurusan +
						"'" +
						"class='btn btn-sm btn-default'>" +
						"EDIT" +
						"</button> " +
						"<button type='button' id='deleteKategoriJurusan'" +
						"data-id='" +
						data[i].id_kategori_jurusan +
						"'" +
						"class='btn btn-sm btn-danger'>" +
						"HAPUS" +
						"</button>" +
						"</td>" +
						"</tr>";
				}
				$("#getDataKategoriJurusan").html(html);
			},
		});
	}

	function tambahData(data){
		$.ajax({
			type: "POST",
			url: "tambahkategorijurusan",
			data: data,
			success: function () {
				$("#loadKategoriJurusan").fadeIn();
				getData();
				$("#modal-kategori-jurusan").modal("hide");
				Swal.fire({
					position: "center",
					icon: "success",
					title: "Your data has been saved",
					showConfirmButton: false,
					timer: 2000,
				});
				$("#kategori_jurusan").val("");
			},
		});
	}

	function editData(data){
		$.ajax({
			type: "POST",
			url: "dataeditkategorijurusan",
			data: { id: data },
			dataType: "json",
			success: function (data) {
				var i;
				for (i = 0; i < data.length; i++) {
					$("#edit-id-kategori-jurusan").val(data[i].id_kategori_jurusan);
					$("#edit-kategori-jurusan").val(data[i].nama);
					$("#modal-edit-kategori-jurusan").modal("show");
				}
			},
		});
	}

	function saveEditData(data){
		$.ajax({
			type: "POST",
			url: "simpaneditkategorijurusan",
			data: data,
			success: function () {
				$("#loadKategoriJurusan").fadeIn();
				getData();
				$("#modal-edit-kategori-jurusan").modal("hide");
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

	function deleteData(data){
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
					url: "deletekategorijurusan",
					data: { id: data },
					success: function () {
						$("#loadKategoriJurusan").fadeIn();
						getData();
					},
				});
				return false;
			}
		});
	}
});
