$(document).ready(function () {

	$(document).on("click", "#deleteMateri", function () {
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
					url: "deletemateri",
					data: { id: data },
					success: function () {
						location.reload();
					},
				});
				return false;
			}
		});
	}
});
