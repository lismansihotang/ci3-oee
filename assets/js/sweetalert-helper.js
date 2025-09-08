(function ($) {
	if (!$) return;

	window.SwalHelper = {
		success: function (msg, title = "Sukses") {
			if (typeof swal !== "undefined") swal(title, msg, "success");
		},
		error: function (msg, title = "Error") {
			if (typeof swal !== "undefined") swal(title, msg, "error");
		},
		confirm: function (msg, onYes, onNo, title = "Konfirmasi") {
			if (typeof swal !== "undefined") {
				swal({
					title: title,
					text: msg,
					icon: "warning",
					buttons: ["Batal", "Ya"],
					dangerMode: true,
				}).then((willConfirm) => {
					if (willConfirm && typeof onYes === "function") onYes();
					else if (!willConfirm && typeof onNo === "function") onNo();
				});
			}
		},
		flash: function (flash) {
			if (!flash) return;
			try {
				const obj = typeof flash === "string" ? JSON.parse(flash) : flash;
				if (obj.status === "success")
					SwalHelper.success(obj.message || "Berhasil!");
				else if (obj.status === "error")
					SwalHelper.error(obj.message || "Gagal!");
			} catch (e) {
				console.warn("Invalid flash data", flash, e);
			}
		},
	};

	// Auto flash saat DOM siap
	$(function () {
		const flash = $("body").data("flash");
		if (flash) SwalHelper.flash(flash);
	});
})(jQuery);
