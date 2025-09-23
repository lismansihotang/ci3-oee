/**
 * shift-table.js
 * Plugin jQuery untuk generate row tabel berdasarkan shift
 * Depend on: cell-factory.js
 */
/**
 * shift-table.js
 * Plugin jQuery untuk generate row tabel berdasarkan shift
 * Depend on: cell-factory.js
 */
(function ($) {
	"use strict";

	const defaultShiftConfig = {
		1: { start: 7, end: 15 }, // 07:00–15:00
		2: { start: 15, end: 23 }, // 15:00–23:00
		3: { start: 23, end: 7 }, // 23:00–07:00 (span midnight)
	};

	$.fn.generateShiftRows = function (options) {
		const shiftConfig = options.shiftConfig || defaultShiftConfig;
		const cfg = shiftConfig[options.shift];
		if (!cfg) return this;

		return this.each(function () {
			let $tbody = $(this).find("tbody");
			if ($tbody.length === 0) {
				$tbody = $("<tbody>").appendTo($(this));
			}
			$tbody.empty();

			let hours = [];
			if (cfg.start < cfg.end) {
				// shift normal
				for (let h = cfg.start; h < cfg.end; h++) hours.push(h);
			} else {
				// shift melewati tengah malam
				for (let h = cfg.start; h < 24; h++) hours.push(h);
				for (let h = 0; h < cfg.end; h++) hours.push(h);
			}

			hours.forEach((h) => {
				const jamStr = String(h).padStart(2, "0") + ":00";
				let row = "<tr>";
				options.columns.forEach((col) => {
					row += $.createCell(col, jamStr, { force24h: options.force24h });
				});
				row += "</tr>";
				$tbody.append(row);
			});
		});
	};
})(jQuery);
