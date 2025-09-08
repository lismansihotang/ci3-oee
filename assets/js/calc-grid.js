// assets/js/calc-grid.js
(function ($) {
	/**
	 * Hitung subtotal = qty * harga di setiap row
	 * @param {string} tableSelector - contoh: '#poDetailTable'
	 */
	$.fn.calcGrid = function () {
		return this.each(function () {
			var $table = $(this);

			// delegasi: dengarkan perubahan di qty/harga
			$table.on("input change", ".qty-input, .harga-input", function () {
				var $row = $(this).closest("tr");

				// parseFloat aman, NaN jadi 0
				var qty = parseFloat($row.find(".qty-input").val()) || 0;
				var harga = parseFloat($row.find(".harga-input").val()) || 0;
				var subtotal = qty * harga;

				// set ke field subtotal
				var $subtotal = $row.find(".subtotal-input");
				$subtotal.val(subtotal.toFixed(2)); // 2 desimal
				$subtotal.trigger("input").trigger("change");
			});
		});
	};
})(jQuery);
