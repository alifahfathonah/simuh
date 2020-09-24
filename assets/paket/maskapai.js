$(document).ready(function () {
	getDataMaskapai("#maskapai");

	$("#tambah_maskapai").on("submit", function (e) {
		e.preventDefault();
		var data = $("#tambah_maskapai").serialize();
		tambahDataMaskapai(data);
	});

	$("#tambahMaskapai").on("click", function () {
		var data = $("#tambah_maskapai").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		tambahDataMaskapai(data);
	});

	function getDataMaskapai(tempat) {
		$.ajax({
			type: "ajax",
			url: "../datamaskapai",
			async: false,
			dataType: "json",
			success: function (data) {
				var html = "";
				var i;
				html += "<option value='-'>-- Pilih Maskapai</option>";
				for (i = 0; i < data.length; i++) {
					html +=
						"<option value='" +
						data[i].id_maskapai +
						"'>" +
						data[i].nama +
						"</option>";
				}
				$(tempat).html(html);
			},
		});
	}

	function tambahDataMaskapai(data) {
		$.ajax({
			type: "POST",
			url: "../tambahmaskapai",
			data: data,
			success: function () {
				getDataMaskapai("#maskapai");
				$("#modal-maskapai").modal("hide");
				Swal.fire({
					position: "center",
					icon: "success",
					title: "Your data has been saved",
					showConfirmButton: false,
					timer: 2000,
				});
				$("#nama_maskapai").val("-");
			},
		});
	}
});
