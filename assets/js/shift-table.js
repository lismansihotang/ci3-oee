/**
 * shift-table.js
 * Plugin jQuery untuk generate row tabel berdasarkan shift
 * Depend on: cell-factory.js (opsional)
 *
 * Fitur:
 * - Generate row otomatis berdasarkan jam shift
 * - Bisa hapus semua row atau hanya auto-row (clearMode)
 * - Support tombol dengan text HTML (icon + teks)
 * - Bisa combine row awal dari PHP dengan row hasil JS
 */

(function ($) {
	"use strict";

	// Default konfigurasi shift (fallback)
	const defaultShiftConfig = {
		1: { start: 7, end: 15 }, // 07:00–15:00
		2: { start: 15, end: 23 }, // 15:00–23:00
		3: { start: 23, end: 7 }, // 23:00–07:00 (melewati midnight)
	};

	$.fn.generateShiftRows = function (options) {
		const settings = $.extend(
			{
				shift: null,
				columns: [],
				shiftConfig: defaultShiftConfig,
				refresh: false,
				clearMode: "auto", // "auto" (hapus hanya auto-row) | "all" (hapus semua row)
			},
			options
		);

		const cfg = settings.shiftConfig[settings.shift];
		if (!cfg) return this;

		return this.each(function () {
			let $tbody = $(this).find("tbody");
			if ($tbody.length === 0) {
				$tbody = $("<tbody>").appendTo($(this));
			}

			// === Bersihkan row lama sesuai mode ===
			if (settings.refresh) {
				if (settings.clearMode === "all") {
					$tbody.empty();
				} else {
					$tbody.find("tr.auto-row").remove();
				}
			}

			// === Tentukan jam shift ===
			let hours = [];
			if (cfg.start < cfg.end) {
				// normal shift
				for (let h = cfg.start; h < cfg.end; h++) hours.push(h);
			} else {
				// shift melewati midnight
				for (let h = cfg.start; h < 24; h++) hours.push(h);
				for (let h = 0; h < cfg.end; h++) hours.push(h);
			}

			// === Generate row per jam ===
			hours.forEach((h) => {
				const jam = String(h).padStart(2, "0") + ":00";

				// skip kalau sudah ada (biar tidak duplikat)
				if ($tbody.find(`tr[data-jam='${jam}']`).length > 0) return;

				let $tr = $("<tr>").addClass("auto-row").attr("data-jam", jam);

				settings.columns.forEach((col) => {
					let $td = $("<td>");

					switch (col.type) {
						case "time":
							$td.append(
								`<input type="text" readonly class="form-control-plaintext" value="${jam}">
                 <input type="hidden" name="jam[]" value="${jam}">`
							);
							break;

						case "number":
							$td.append(
								`<input type="number" name="${col.name}[]" class="form-control" value="0">`
							);
							break;

						case "button":
							let $btn = $("<button>")
								.attr("type", "button")
								.addClass(col.class || "btn btn-sm btn-secondary")
								.html(col.text || col.name || "Button"); // pakai html() biar bisa support <i>

							if (col.attrs) $btn.attr(col.attrs);
							$td.append($btn);
							break;

						default:
							$td.text(col.name);
					}

					$tr.append($td);
				});

				$tbody.append($tr);
			});
		});
	};
})(jQuery);
