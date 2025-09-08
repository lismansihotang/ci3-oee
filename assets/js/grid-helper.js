// assets/js/grid-helper.js
(function ($) {
	$.fn.gridHelper = function (options) {
		var settings = $.extend(
			{
				select2Theme: "bootstrap-5",
				dateFormat: "Y-m-d",
			},
			options
		);

		return this.each(function () {
			var $table = $(this);

			// simpan options HTML untuk row baru
			var productOptions = $table
				.find("tbody tr:first-child .select2-init")
				.html();

			function initializeRowElements(row) {
				var $row = $(row);

				// bersihkan container Select2
				$row.find(".select2-container").remove();

				// init Select2 ulang
				$row.find(".select2-init").each(function () {
					$(this)
						.removeAttr("data-select2-id tabindex aria-hidden")
						.find("option")
						.removeAttr("data-select2-id");

					if (productOptions) {
						$(this).html(productOptions);
					}

					$(this).select2({
						theme: settings.select2Theme,
						width: "100%",
					});
				});

				// init Flatpickr
				$row.find(".flatpickr-input").each(function () {
					flatpickr(this, { dateFormat: settings.dateFormat });
				});
			}

			// init semua row awal
			$table.find("tbody tr").each(function () {
				initializeRowElements(this);
			});

			// tambah baris
			$table.on("click", ".add-row-btn", function (e) {
				e.preventDefault();
				var lastRow = $table.find("tbody tr:last");
				if (!lastRow.length) return;

				var newRow = lastRow.clone(false);
				newRow.find("input, select").val("");
				newRow.find("[id]").removeAttr("id");

				$table.find("tbody").append(newRow);
				initializeRowElements(newRow);
			});

			// hapus baris
			$table.on("click", ".remove-row-btn", function (e) {
				e.preventDefault();
				if ($table.find("tbody tr").length > 1) {
					$(this).closest("tr").remove();
				} else {
					alert("Minimal harus ada satu baris!");
				}
			});
		});
	};
})(jQuery);
