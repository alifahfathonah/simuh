$(document).ready(function () {
	$("#example1").DataTable();

	$(document).on("click", "#deletePaket", function () {
		var data = $(this).attr("data-id");
		deleteData(data);
	});

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
					url: "../deletepaket",
					data: { id: data },
					success: function () {
						location.reload();
						// console.log('berhasil');
					},
				});
				return false;
			}
		});
	}
});
