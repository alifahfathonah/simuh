$(document).ready(function () {
	var harga = $("#harga").attr("data-id");
	var bonus = $("#bonus").val();
	hitungTotal(harga, bonus);

	$("#bonus").on("keyup", function () {
		var harga = $("#harga").attr("data-id");
		var bonus = $("#bonus").val();
		hitungTotal(harga, bonus);
	});
	function hitungTotal(harga, bonus) {
		var total = harga - bonus;
		$("#total").html(total);
	}

	$("#btnTolak").on("click", function () {
        var id = $(this).attr("data-id");
        var bukti = $(this).attr("data-value");
        var harga = $("#harga").attr("data-id");
        var bayar = $("#bayar").val();
        var bonus = $("#bonus").val();
        // id_user adalah id penerima bonus
        var id_user = $("#id_head_user").attr("data-id");
        if(bayar < harga){
            var status = "belum";
        }else if(bayar == harga){
            var status = "lunas";
        }
        hitungTotal(id, bukti, bayar, status, id_user, bonus);
		// console.log(bayar);
    });
    
	function hitungTotal(id, bukti, bayar, status, id_user, bonus) {
		$.ajax({
			type: "POST",
			url: "../tambahdetailpaket",
			data: {
				id: id,
				bukti_pembayaran: bukti,
				jumlah_bayar: bayar,
                status: status,
                id_head_user: id_user,
				bonus: bonus
			},
			success: function () {
				getDataDetailPaket("#dataDetailPaket");
				Swal.fire({
					position: "center",
					icon: "success",
					title: "Your data has been saved",
					showConfirmButton: false,
					timer: 2000,
				});
				window.location;
			},
		});
	}
});
