$(document).ready(function () {
	getDataHotelMakkah("#hotel_makkah");

	$("#tambah_hotel_makkah").on("submit", function (e) {
		e.preventDefault();
		var data = $("#tambah_hotel_makkah").serialize();
		tambahDataHotel(data);
	});

	$("#tambahHotelMakkah").on("click", function () {
		var data = $("#tambah_hotel_makkah").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		tambahDataHotel(data);
	});

	function getDataHotelMakkah(tempat) {
		$.ajax({
			type: "ajax",
			url: "../datahotelmakkah",
			async: false,
			dataType: "json",
			success: function (data) {
				var html = "";
				var i;
				html += "<option value='-'>-- Pilih Hotel</option>";
				for (i = 0; i < data.length; i++) {
					html +=
						"<option value='" +
						data[i].id_hotel +
						"'>" +
						data[i].nama +
						"</option>";
				}
				$(tempat).html(html);
			},
		});
	}

	function tambahDataHotel(data) {
		$.ajax({
			type: "POST",
			url: "../tambahhotel",
			data: data,
			success: function () {
                getDataHotelMakkah("#hotel_makkah");
                $("#modal-makkah").modal("hide");
				Swal.fire({
					position: "center",
					icon: "success",
					title: "Your data has been saved",
					showConfirmButton: false,
					timer: 2000,
				});
				$("#nama_hotel_makkah").val("-");
			},
		});
	}
});