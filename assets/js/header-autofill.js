// assets/js/header-autofill.js
(function ($) {
	$.fn.headerAutofill = function (opts) {
		var settings = $.extend(
			{
				trigger: ".select2-init", // default selector yang akan memicu autofill
			},
			opts
		);

		return this.each(function () {
			var $form = $(this);

			$form.on("change", settings.trigger, function () {
				var $select = $(this);
				var kode = $select.val();
				var baseUrl = $select.data("fetch-url");
				if (!kode || !baseUrl) return;

				// mapping dari attr atau target-input
				var raw = $select.data("mapping") || $select.data("target-input");
				var mapping = $.autofill.parseMapping(raw);

				// kalau hanya pakai data-target-input + data-source-key
				if ($.isEmptyObject(mapping) && $select.data("target-input")) {
					mapping = {};
					var sourceKey = $select.data("source-key") || "value";
					mapping[sourceKey] = "[name='" + $select.data("target-input") + "']";
				}

				$.autofill
					.fetchData(kode, baseUrl)
					.done(function (data) {
						$.autofill.fillContext($form, data, mapping);
					})
					.fail(function (err) {
						console.error("headerAutofill gagal:", err);
					});
			});
		});
	};
})(jQuery);
