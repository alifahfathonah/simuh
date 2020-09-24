$(document).ready(function () {
	getDataKamar("#tipe_kamar");

	$("#tambah_kamar").on("submit", function (e) {
		e.preventDefault();
		var data = $("#tambah_kamar").serialize();
		tambahDataKamar(data);
	});

	$("#tambahKamar").on("click", function () {
		var data = $("#tambah_kamar").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		tambahDataKamar(data);
	});

	function getDataKamar(tempat) {
		$.ajax({
			type: "ajax",
			url: "../datakamar",
			async: false,
			dataType: "json",
			success: function (data) {
				var html = "";
				var i;
				html += "<option value='-'>-- Pilih Tipe Kamar</option>";
				for (i = 0; i < data.length; i++) {
					html +=
						"<option value='" +
						data[i].id_kamar +
						"'>" +
						data[i].tipe_kamar +
						"</option>";
				}
				$(tempat).html(html);
			},
		});
	}

	function tambahDataKamar(data) {
		$.ajax({
			type: "POST",
			url: "../tambahkamar",
			data: data,
			success: function () {
				getDataKamar("#tipe_kamar");
				$("#modal-kamar").modal("hide");
				Swal.fire({
					position: "center",
					icon: "success",
					title: "Your data has been saved",
					showConfirmButton: false,
					timer: 2000,
				});
				$("#tipe_kamar_input").val("-");
			},
		});
	}
});
