$(document).ready(function () {
	getPaket("#paket");
	$(".select2").select2();
	$("#id_mitra_input").hide();
	$("#status").on("change", function () {
		var data = $(this).val();
		if (data == "mitra") {
			// getMitra("#id_mitra");
            $("#id_mitra_input").show();
            // $("#foto").prop('readonly', true);
            // $("#foto_ktp").prop("readonly", true);
		} else {
			$("#id_mitra_input").hide();
			$("#id_mitra").val("");
		}
	});

	$("#foto").on("change", function () {
		if (this.files[0].size > 1307200) {
			alert("File is too big!");
			this.value = "";
		}
	});

	$("#foto_ktp").on("change", function () {
		if (this.files[0].size > 1307200) {
			alert("File is too big!");
			this.value = "";
		}
	});

	$("#bukti").on("change", function () {
		if (this.files[0].size > 1307200) {
			alert("File is too big!");
			this.value = "";
		}
	});

	// $("#id_mitra").on("change", function () {
	// 	var data = $(this).val();
	// 	getDataMitra(data);
    // });
    
    $("#paket").on("change", function () {
        var data = $(this).val();
        getDataPaket(data);
    });

	// function getMitra(tempat) {
	// 	$.ajax({
	// 		type: "ajax",
	// 		url: "../datamitra",
	// 		async: false,
	// 		dataType: "json",
	// 		success: function (data) {
	// 			var html = "";
	// 			var i;
	// 			html += "<option value='-'>-- Pilih Mitra</option>";
	// 			for (i = 0; i < data.length; i++) {
	// 				html +=
	// 					"<option value='" +
	// 					data[i].id_user +
	// 					"'>" +
	// 					data[i].id_user +
	// 					"-" +
	// 					data[i].nama +
	// 					"</option>";
	// 			}
	// 			$(tempat).html(html);
	// 		},
	// 	});
	// }

	// function getDataMitra(data) {
	// 	$.ajax({
	// 		type: "POST",
	// 		url: "../datamitrabyid",
	// 		dataType: "json",
	// 		data: { id: data },
	// 		success: function (data) {
	// 			var i;
	// 			for (i = 0; i < data.length; i++) {
	// 				$("#nama").val(data[i].nama);
	// 				$("#ktp").val(data[i].no_ktp);
	// 				$("select#jk").val(data[i].jk);
	// 				$("#no_tlp").val(data[i].no_tlp);
	// 				$("#email").val(data[i].email);
	// 			}
	// 		},
	// 	});
	// }

	function getPaket(tempat) {
		$.ajax({
			type: "ajax",
			url: "../pakettampildata",
			async: false,
			dataType: "json",
			success: function (data) {
				var html = "";
				var i;
				html += "<option value='-'>-- Pilih Paket</option>";
				for (i = 0; i < data.length; i++) {
					html +=
						"<option value='" +
						data[i].id_paket +
						"'>" +
						data[i].nama +
						"</option>";
				}
				$(tempat).html(html);
			},
		});
	}

	function getDataPaket(data) {
		$.ajax({
			type: "POST",
			url: "../pakettampildatadetail",
			dataType: "json",
			data: { id: data },
			success: function (data) {
				var i;
				for (i = 0; i < data.length; i++) {
					$("#harga").val(data[i].harga_umum);
					$("#tipe_kamar").val(data[i].tipe_kamar);
					$("#maskapai").val(data[i].nama_maskapai);
				}
			},
		});
	}
});
