$(document).ready(function () {
	getData();
	getDataLevel("#id-level");	
	getDataLevel("#edit-id-level");
	$("#data_user").DataTable();

	$("#tambah_user").on("submit", function (e) {
		e.preventDefault();
		var data = $("#tambah_user").serialize();
		tambahData(data);
	});

	$("#tambahUser").on("click", function () {
		var data = $("#tambah_user").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		tambahData(data);
	});

	$(document).on("click", "#editUser", function () {
		var data = $(this).attr("data-id");
		editData(data);
	});

	$(document).on("submit", "#edit_user", function (e) {
		e.preventDefault();
		var data = $("#edit_user").serialize();
		saveEditData(data);
	});

	$(document).on("click", "#simpanEditUser", function () {
		var data = $("#edit_user").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		saveEditData(data);
	});

	$(document).on("click", "#deleteUser", function () {
		var data = $(this).attr("data-id");
		deleteData(data);
	});

	function getData() {
		$.ajax({
			type: "ajax",
			url: "datauser",
			async: false,
			dataType: "json",
			success: function (data) {
				var num = 1;
				var html = "";
				var i;
				for (i = 0; i < data.length; i++) {
					html +=
						"<tr id='siswa" +
						data[i].id_user +
						"'>" +
						"<td class='text-center'>" +
						num++ +
						"</td>" +
						"<td>" +
						data[i].nip +
						"</td>" +
						"<td>" +
						data[i].nama +
						"</td>" +
						"<td>" +
						data[i].nama_level +
						"</td>" +
						"<td class='text-center'>" +
						"<button type='button' id='editUser'" +
						"data-id='" +
						data[i].id_user +
						"'" +
						"class='btn btn-sm btn-default'>" +
						"EDIT" +
						"</button> " +
						"<button type='button' id='deleteUser'" +
						"data-id='" +
						data[i].id_user +
						"'" +
						"class='btn btn-sm btn-danger'>" +
						"HAPUS" +
						"</button>" +
						"</td>" +
						"</tr>";
				}
				$("#getDataUser").html(html);
			},
		});
	}

	function getDataLevel(tempat) {
		$.ajax({
			type: "ajax",
			url: "datamanajemenlevel",
			async: false,
			dataType: "json",
			success: function (data) {
				var html = "";
				var i;
				html += "<option value=>-- Pilih Level Hak Akses</option>";
				for (i = 0; i < data.length; i++) {
					html +=
						"<option value='" +
						data[i].id_level +
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
			url: "tambahuser",
			data: data,
			success: function () {
				getData();
				$("#modal-user").modal("hide");
				Swal.fire({
					position: "center",
					icon: "success",
					title: "Your data has been saved",
					showConfirmButton: false,
					timer: 2000,
				});
				$("#nip").val("");
				$("#nama").val("");
				$("#jk").val("");
				$("#no-hp").val("");
				$("select#id-level").val();
			},
		});
	}

	function editData(data) {
		$.ajax({
			type: "post",
			url: "dataedituser",
			data: { id: data },
			async: false,
			dataType: "json",
			success: function (data) {
				var i;
				for (i = 0; i < data.length; i++) {
					$("#edit-id-user").val(data[i].id_user);
					$("#edit-nip").val(data[i].nip);
					$("#edit-nama").val(data[i].nama);
					$("select#edit-jk").val(data[i].jk);
					$("#edit-no-hp").val(data[i].nip);
					$("select#edit-id-level").val(data[i].level);
				}
				$("#modal-edit-user").modal("show");
			},
		});
	}

	function saveEditData(data) {
		$.ajax({
			type: "POST",
			url: "simpanedituser",
			data: data,
			success: function () {
				getData();
				$("#modal-edit-user").modal("hide");
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
					url: "deleteuser",
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
