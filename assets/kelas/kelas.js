$(document).ready(function () {
	getData();
	
	$("#tambah_kelas").on("submit", function (e) {
		e.preventDefault();
		var data = $("#tambah_kelas").serialize();
		tambahData(data);
	});

	$("#tambahKelas").on("click", function () {
		var data = $("#tambah_kelas").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		tambahData(data);
	});

	$(document).on("click", "#editKelas", function () {
		var data = $(this).attr("data-id");
		editData(data);
	});

	$(document).on("submit", "#edit_kelas", function (e) {
		e.preventDefault();
		var data = $("#edit_kelas").serialize();
		saveEditData(data);
	});

	$(document).on("click", "#simpanEditKelas", function () {
		var data = $("#edit_kelas").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		saveEditData(data);
	});

	$(document).on("click", "#deleteKelas", function () {
		var data = $(this).attr("data-id");
		deleteData(data);
	});

	function getData() {
		$.ajax({
			type: "ajax",
			url: "datakelas",
			async: false,
			dataType: "json",
			success: function (data) {
				$("#loadKelas").fadeOut();
				num = 1;
				var html = "";
				var i;
				for (i = 0; i < data.length; i++) {
					html +=
						"<tr id='kelas" +
						data[i].id_kelas +
						"'>" +
						"<td class='text-center'>" +
						num++ +
						"</td>" +
						"<td>" +
						data[i].nama +
						"</td>" +
						"<td>" +
						"<button type='button' id='editKelas'" +
						"data-id='" +
						data[i].id_kelas +
						"'" +
						"class='btn btn-sm btn-default'>" +
						"EDIT" +
						"</button> " +
						"<button type='button' id='deleteKelas'" +
						"data-id='" +
						data[i].id_kelas +
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
	
	function tambahData(data) {
		$.ajax({
			type: "POST",
			url: "tambahkelas",
			data: data,
			success: function () {
				$("#loadKelas").fadeIn();
				getData();
				$("#modal-kelas").modal("hide");
				Swal.fire({
					position: "center",
					icon: "success",
					title: "Your data has been saved",
					showConfirmButton: false,
					timer: 2000,
				});
				$("#kelas").val("");
			},
		});
	}

	function editData(data){
		$.ajax({
			type: "POST",
			url: "dataeditkelas",
			data: { id: data },
			dataType: "json",
			success: function (data) {
				var i;
				for (i = 0; i < data.length; i++) {
					$("#edit-kelas-id").val(data[i].id_kelas);
					$("#edit-kelas-form").val(data[i].nama);
					$("#modal-edit-kelas").modal("show");
				}
			},
		});
	}

	function saveEditData(data){
		$.ajax({
			type: "POST",
			url: "simpaneditkelas",
			data: data,
			success: function () {
				$("#loadKelas").fadeIn();
				getData();
				$("#modal-edit-kelas").modal("hide");
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
					url: "deletekelas",
					data: { id: data },
					success: function () {
						$("#loadKelas").fadeIn();
						getData();
					},
				});
				return false;
			}
		});
	}
});
