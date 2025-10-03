// =============================================================
// Reject Helper Plugin (FINAL REFACTORED)
// -------------------------------------------------------------
// Dependensi: jQuery, Bootstrap 5 Modal, gridHelper (opsional), summaryHelper (opsional)
// Tujuan: manage reject per-row, support hidden inputs,
//         modal edit/create, update tombol, dan expose saveToHidden()
// Fix: modal backdrop cleanup setelah save
// =============================================================
(function ($) {
	"use strict";

	$.rejectHelper = {
		createRow: function (templateRow, data = { jenis: "", qty: "" }) {
			let row = templateRow.clone();
			const jenis = data.jenis ?? data.jenis_reject ?? "";
			const qty = data.qty ?? data.qty_reject ?? "";
			row.find("select[name='jenis_reject[]']").val(jenis);
			row.find("input[name='qty_reject[]']").val(qty);
			return row;
		},

		updateButton: function (row) {
			let rejects = row.data("reject") || [];
			let total = rejects.reduce(
				(sum, r) => sum + (parseInt(r.qty || 0) || 0),
				0
			);
			let btn = row.find(".btn-reject");

			if (!btn.data("emptyHtml"))
				btn.data("emptyHtml", btn.html() || "+ Tambah Reject");

			if (rejects.length > 0 && total > 0) {
				btn
					.removeClass("btn-primary")
					.addClass("btn-info")
					.html("Detail Reject (" + total + ")");
			} else {
				btn
					.removeClass("btn-info")
					.addClass("btn-primary")
					.html(btn.data("emptyHtml"));
			}
		},

		getRejectFromHidden: function (row) {
			const rowId =
				row.attr("data-row-id") ?? row.data("row-id") ?? row.index();
			let rejects = [];

			let $local = row.find("input.reject-hidden");
			let $global = $("#reject-hidden-container").find(
				`.reject-hidden[data-row='${rowId}']`
			);

			let $inputs = $local.add($global);
			if ($inputs.length === 0) return rejects;

			$inputs.each(function () {
				let name = $(this).attr("name") || "";
				let val = $(this).val();
				const m = name.match(
					/^rejects\[(.+?)\]\[(\d+)\]\[(jenis_reject|qty_reject)\]$/
				);
				if (!m) return;

				const idx = parseInt(m[2], 10);
				const key = m[3];
				if (!rejects[idx]) rejects[idx] = {};
				rejects[idx][key] = val;
			});

			rejects = rejects
				.filter(Boolean)
				.map((r) => ({
					jenis: r.jenis_reject ?? r.jenis ?? "",
					qty: parseInt(r.qty_reject ?? r.qty ?? 0) || 0,
				}))
				.filter((r) => r.jenis !== "" && r.qty > 0);

			return rejects;
		},

		openModal: function (row) {
			let rejects = row.data("reject");
			if (!Array.isArray(rejects) || rejects.length === 0) {
				rejects = this.getRejectFromHidden(row);
				row.data("reject", rejects);
			}

			let modal = $("#rejectModalTemplate").clone();
			modal
				.removeClass("d-none")
				.attr("id", "rejectModal-" + Date.now())
				.attr("data-bs-backdrop", "static")
				.attr("data-bs-keyboard", "false");
			$("body").append(modal);

			let templateRow = modal.find("tbody tr:first").clone();
			let tbody = modal.find("tbody");
			tbody.empty();
			if (rejects.length > 0) {
				rejects.forEach((r) =>
					tbody.append($.rejectHelper.createRow(templateRow, r))
				);
			} else {
				tbody.append(templateRow);
			}

			modal.find("table").removeAttr("id").addClass("reject-table");
			if ($.fn.gridHelper) {
				modal.find(".reject-table").gridHelper();
			}

			let bsModal = new bootstrap.Modal(modal[0]);
			bsModal.show();

			// cleanup jika modal close normal
			modal.on("hidden.bs.modal", function () {
				let inst = bootstrap.Modal.getInstance(modal[0]);
				if (inst) inst.dispose();
				modal.remove();
				// pastikan body reset
				$(".modal-backdrop").remove();
				$("body")
					.removeClass("modal-open")
					.css({ overflow: "", paddingRight: "" });
			});

			modal.find(".reject-form").on("submit", function (e) {
				e.preventDefault();
				$.rejectHelper.saveData(modal, row);
			});
		},

		saveData: function (modal, row) {
			let rejects = [];
			modal.find("tbody tr").each(function () {
				let jenis = $(this).find("select[name='jenis_reject[]']").val();
				let qty =
					parseInt($(this).find("input[name='qty_reject[]']").val() || 0) || 0;
				if (qty > 0 && jenis) rejects.push({ jenis: jenis, qty: qty });
			});

			row.data("reject", rejects);

			const rowId =
				row.attr("data-row-id") ?? row.data("row-id") ?? row.index();

			let cell = row.find("td:has(.btn-reject)");
			cell.find("input.reject-hidden").remove();
			$("#reject-hidden-container")
				.find(`.reject-hidden[data-row='${rowId}']`)
				.remove();

			rejects.forEach((r, i) => {
				const jenisEsc = $("<div>").text(r.jenis).html();
				const qtyEsc = $("<div>").text(r.qty).html();
				cell.append(
					`<input type="hidden" class="reject-hidden" data-row="${rowId}" name="rejects[${rowId}][${i}][jenis_reject]" value="${jenisEsc}">` +
						`<input type="hidden" class="reject-hidden" data-row="${rowId}" name="rejects[${rowId}][${i}][qty_reject]" value="${qtyEsc}">`
				);
			});

			this.updateButton(row);

			if ($.summaryHelper && typeof $.summaryHelper.update === "function") {
				$.summaryHelper.update();
			}

			// Tutup modal + cleanup
			let bsModal = bootstrap.Modal.getInstance(modal[0]);
			if (bsModal) {
				bsModal.hide();
			}
		},

		saveToHidden: function (rowId, rejects = [], opts = {}) {
			const cfg = Object.assign(
				{
					targetContainer: "#reject-hidden-container",
					setRowData: true,
					updateButton: true,
				},
				opts
			);

			const $container = $(cfg.targetContainer);
			if ($container.length === 0) {
				$("body").append(
					'<div id="reject-hidden-container" style="display:none"></div>'
				);
			}

			$(cfg.targetContainer)
				.find(`.reject-hidden[data-row='${rowId}']`)
				.remove();

			const normalized = (rejects || [])
				.map((r) => ({
					jenis: r.jenis ?? r.jenis_reject ?? "",
					qty: parseInt(r.qty ?? r.qty_reject ?? 0) || 0,
				}))
				.filter((r) => r.jenis !== "" && r.qty > 0);

			normalized.forEach((r, i) => {
				const jenisEsc = $("<div>").text(r.jenis).html();
				const qtyEsc = $("<div>").text(r.qty).html();
				$(cfg.targetContainer).append(
					`<input type="hidden" class="reject-hidden" data-row="${rowId}" name="rejects[${rowId}][${i}][jenis_reject]" value="${jenisEsc}">` +
						`<input type="hidden" class="reject-hidden" data-row="${rowId}" name="rejects[${rowId}][${i}][qty_reject]" value="${qtyEsc}">`
				);
			});

			if (cfg.setRowData) {
				let $row = $(`tr[data-row-id='${rowId}']`);
				if ($row.length) {
					$row.data("reject", normalized);
					if (cfg.updateButton) this.updateButton($row);
				}
			}

			return normalized;
		},

		bindEvents: function () {
			$(document).off("click.rejectHelper", ".btn-reject");
			$(document).on("click.rejectHelper", ".btn-reject", function () {
				let row = $(this).closest("tr");
				$.rejectHelper.openModal(row);
			});
		},

		init: function () {
			this.bindEvents();
			$(".btn-reject").each(function () {
				let row = $(this).closest("tr");
				if (!row.data("reject")) {
					let rejects = $.rejectHelper.getRejectFromHidden(row);
					row.data("reject", rejects);
				}
				$.rejectHelper.updateButton(row);
			});
		},
	};
})(jQuery);
