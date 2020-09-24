$(document).ready(function () {
	getDataDetailPaket("#dataDetailPaket");

	$("#form_detail_paket").on("submit", function (e) {
		e.preventDefault();
		var data = $("#form_detail_paket").serialize();
		tambahDataDetailPaket(data);
	});

	$("#simpanDetailPaket").on("click", function () {
		var data = $("#form_detail_paket").serialize();
		data = data.replace(/&?[^=&]+=(&|$)/g, "");
		tambahDataDetailPaket(data);
	});

	$(document).on("click", "#deleteDataDetailPaket", function () {
		var data = $(this).attr("data-id");
		deleteData(data);
	});

	function getDataDetailPaket(tempat) {
		var id = $("#id_paket").val();
		$.ajax({
			type: "ajax",
			url: "../datadetailpaket/" + id,
			async: false,
			dataType: "json",
			success: function (data) {
				$("#loadDetailPaket").fadeOut();
				var html = "";
				var i;
				for (i = 0; i < data.length; i++) {
					html += "<tr id='" + data[i].id_detail_paket + "'>" + "<td>";
					if (data[i].lokasi == null) {
						html += "";
					} else {
						html += data[i].lokasi;
					}
					html += "</td>" + "<td>";
					if (data[i].nama_hotel == null) {
						html += "";
					} else {
						html += data[i].nama_hotel;
					}
					html += "</td>" + "<td>";
					if (data[i].tipe_kamar == null) {
						html += "";
					} else {
						html += data[i].tipe_kamar;
					}
					html += "</td>" + "<td>";
					if (data[i].nama_maskapai == null) {
						html += "";
					} else {
						html += data[i].nama_maskapai;
					}
					html +=
						"</td>" +
						"</tr>";
				}
				$(tempat).html(html);
			},
		});
	}

	function tambahDataDetailPaket(data) {
		$.ajax({
			type: "POST",
			url: "../tambahdetailpaket",
			data: data,
			success: function () {
				getDataDetailPaket("#dataDetailPaket");
				Swal.fire({
					position: "center",
					icon: "success",
					title: "Your data has been saved",
					showConfirmButton: false,
					timer: 2000,
				});
				$("#hotel_makkah").val("-");
				$("#hotel_madina").val("-");
				$("#tipe_kamar").val("-");
				$("#maskapai").val("-");
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
					url: "../deletedetailpaket",
					data: { id: data },
					success: function () {
						$("#loadDetailPaket").fadeOut();
						getDataDetailPaket("#dataDetailPaket");
					},
				});
				return false;
			}
		});
	}
});
