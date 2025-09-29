// =============================================================
// Reject Helper Plugin
// -------------------------------------------------------------
// Fungsi:
// 1. Menangani modal input reject per baris tabel.
// 2. Simpan data reject (jenis + qty) ke row (pakai row.data()).
// 3. Generate hidden input agar ikut terkirim via form.
// 4. Update tampilan tombol reject sesuai data.
// 5. Trigger summaryHelper setelah reject diubah.
// -------------------------------------------------------------
// Dependensi: jQuery, Bootstrap 5 Modal, gridHelper, summaryHelper
// =============================================================
(function ($) {
	$.rejectHelper = {
		/**
		 * Buat baris reject baru dari template
		 */
		createRow: function (templateRow, data = { jenis: "", qty: "" }) {
			let row = templateRow.clone();
			row.find("select[name='jenis_reject[]']").val(data.jenis);
			row.find("input[name='qty_reject[]']").val(data.qty);
			return row;
		},

		/**
		 * Update tampilan tombol reject pada baris utama
		 */
		updateButton: function (row) {
			let rejects = row.data("reject") || [];
			let total = rejects.reduce((sum, r) => sum + (parseInt(r.qty) || 0), 0);
			let btn = row.find(".btn-reject");

			if (rejects.length > 0) {
				btn
					.removeClass("btn-primary")
					.addClass("btn-info")
					.text("Detail Reject (" + total + ")");
			} else {
				btn
					.removeClass("btn-info")
					.addClass("btn-primary")
					.text("+ Tambah Reject");
			}
		},

		/**
		 * Buka modal reject untuk 1 baris
		 */
		openModal: function (row) {
			let modal = $("#rejectModalTemplate").clone();
			modal
				.removeClass("d-none")
				.attr("id", "rejectModal-" + Date.now())
				.attr("data-bs-backdrop", "static")
				.attr("data-bs-keyboard", "false");
			$("body").append(modal);

			// isi data lama
			let templateRow = modal.find("tbody tr:first").clone();
			let tbody = modal.find("tbody");
			tbody.empty();

			let rejects = row.data("reject") || [];
			if (rejects.length > 0) {
				rejects.forEach((r) => {
					tbody.append($.rejectHelper.createRow(templateRow, r));
				});
			} else {
				tbody.append(templateRow);
			}

			// aktifkan gridHelper (add/remove row)
			modal.find("table").removeAttr("id").addClass("reject-table");
			if ($.fn.gridHelper) {
				modal.find(".reject-table").gridHelper();
			}

			// show modal
			let bsModal = new bootstrap.Modal(modal[0]);
			bsModal.show();

			// cleanup saat close
			modal.on("hidden.bs.modal", function () {
				let inst = bootstrap.Modal.getInstance(modal[0]);
				if (inst) inst.dispose();
				modal.remove();
				$(".modal-backdrop").remove();
				$("body").removeClass("modal-open").css("padding-right", "");
			});

			// submit reject form
			modal.find(".reject-form").on("submit", function (e) {
				e.preventDefault();
				$.rejectHelper.saveData(modal, row);
			});
		},

		/**
		 * Simpan data reject ke row utama + update summary
		 */
		saveData: function (modal, row) {
			let rejects = [];
			modal.find("tbody tr").each(function () {
				let jenis = $(this).find("select[name='jenis_reject[]']").val();
				let qty = parseInt(
					$(this).find("input[name='qty_reject[]']").val() || 0
				);
				if (qty > 0) rejects.push({ jenis, qty });
			});

			row.data("reject", rejects);

			// hapus hidden input lama
			let cell = row.find("td:has(.btn-reject)");
			cell.find("input.reject-hidden").remove();

			// buat hidden input baru
			rejects.forEach((r, i) => {
				cell.append(
					`<input type="hidden" class="reject-hidden" name="rejects[${row.index()}][${i}][jenis_reject]" value="${
						r.jenis
					}">` +
						`<input type="hidden" class="reject-hidden" name="rejects[${row.index()}][${i}][qty_reject]" value="${
							r.qty
						}">`
				);
			});

			// update tombol
			$.rejectHelper.updateButton(row);

			// trigger summary update
			if ($.summaryHelper) {
				$.summaryHelper.update();
			}

			// close modal
			let bsModal = bootstrap.Modal.getInstance(modal[0]);
			if (bsModal) bsModal.hide();
		},

		// binding events
		bindEvents: function () {
			$(document).on("click.rejectHelper", ".btn-reject", function () {
				let row = $(this).closest("tr");
				$.rejectHelper.openModal(row);
			});
		},
		unbindEvents: function () {
			$(document).off("click.rejectHelper", ".btn-reject");
		},
		rebindEvents: function () {
			this.unbindEvents();
			this.bindEvents();
		},
	};
})(jQuery);
