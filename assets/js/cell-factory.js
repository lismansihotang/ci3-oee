/**
 * cell-factory.js
 * Plugin jQuery untuk membuat cell tabel (input/button) generik
 *
 * Usage:
 * $.createCell({
 *   type: "button",
 *   name: "reject_btn",
 *   text: "Tambah Reject",
 *   class: "btn btn-primary",
 *   attrs: { "data-id": 1 }
 * });
 */
(function ($) {
	"use strict";

	$.createCell = function (col, jamStr = "", options = {}) {
		let cell = "<td>";
		const force24h = options.force24h || false;

		switch (col.type) {
			case "time":
				if (force24h) {
					cell += `
                        <input type="text" readonly class="form-control-plaintext" value="${jamStr}">
                        <input type="hidden" name="${col.name}[]" value="${jamStr}">
                    `;
				} else {
					cell += `<input type="time" name="${col.name}[]" value="${jamStr}" class="form-control">`;
				}
				break;

			case "number":
				cell += `<input type="number" name="${col.name}[]" class="form-control" value="0">`;
				break;

			case "text":
				cell += `<input type="text" name="${col.name}[]" class="form-control">`;
				break;

			case "select2":
				cell += `<select name="${col.name}[]" class="form-control select2-init"></select>`;
				break;

			case "button":
				let text = col.text || "Action";
				let cls = col.class || "btn btn-sm btn-secondary";
				let attrs = "";
				if (col.attrs) {
					Object.entries(col.attrs).forEach(([k, v]) => {
						attrs += ` ${k}="${v}"`;
					});
				}
				cell += `<button type="button" class="${cls}" ${attrs}>${text}</button>`;
				break;

			default:
				cell += "-";
		}

		cell += "</td>";
		return cell;
	};
})(jQuery);
