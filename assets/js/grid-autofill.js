/* grid-autofill.js
   - plugin untuk tabel yang punya baris dinamis
   - trigger: selector untuk select (mis: '.produk-select')
   - otomatis parse data-mapping, fetch, isi field pada baris terkait
   - menangani re-init untuk select2 & flatpickr pada baris baru
*/
// assets/js/grid-autofill.js
(function ($) {
	$.fn.tableAutofill = function (opts) {
		var settings = $.extend(
			{
				trigger: ".produk-select", // default selector untuk kolom produk
			},
			opts
		);

		return this.each(function () {
			var $table = $(this);

			$table.on("change", settings.trigger, function () {
				var $select = $(this);
				var kode = $select.val();
				var baseUrl = $select.data("fetch-url");
				if (!kode || !baseUrl) return;

				var $row = $select.closest("tr");
				var raw = $select.data("mapping");
				var mapping = $.autofill.parseMapping(raw);

				$.autofill
					.fetchData(kode, baseUrl)
					.done(function (data) {
						$.autofill.fillContext($row, data, mapping);
					})
					.fail(function (err) {
						console.error("tableAutofill gagal:", err);
					});
			});
		});
	};
})(jQuery);
