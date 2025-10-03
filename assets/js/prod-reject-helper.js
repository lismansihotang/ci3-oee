// =============================================================
// Reject Helper Plugin (Final + saveToHidden)
// -------------------------------------------------------------
// Dependensi: jQuery, Bootstrap 5 Modal, gridHelper (opsional), summaryHelper (opsional)
// Tujuan:  manage reject per-row, support server-rendered hidden inputs,
//        modal edit/create, update tombol, dan expose saveToHidden()
// =============================================================
(function ($) {
	"use strict";

	$.rejectHelper = {
		/**
		 * Buat baris reject baru dari template (modal)
		 * @param {jQuery} templateRow - <tr> kosong dari modal template
		 * @param {Object} data - {jenis, qty} atau {jenis_reject, qty_reject}
		 * @returns {jQuery} cloned row
		 */
		createRow: function (templateRow, data = { jenis: "", qty: "" }) {
			let row = templateRow.clone();
			// support dua shape: {jenis, qty} atau {jenis_reject, qty_reject}
			const jenis = data.jenis ?? data.jenis_reject ?? "";
			const qty = data.qty ?? data.qty_reject ?? "";
			row.find("select[name='jenis_reject[]']").val(jenis);
			row.find("input[name='qty_reject[]']").val(qty);
			return row;
		},

		/**
		 * Update tampilan tombol .btn-reject pada sebuah row
		 * - menyimpan original HTML tombol di data('emptyHtml') untuk restore
		 * - menampilkan "Detail Reject (N)" jika ada, atau mengembalikan HTML semula
		 * @param {jQuery} row
		 */
		updateButton: function (row) {
			let rejects = row.data("reject") || [];
			let total = rejects.reduce(
				(sum, r) => sum + (parseInt(r.qty || 0) || 0),
				0
			);
			let btn = row.find(".btn-reject");

			// simpan html kosong (first time)
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

		/**
		 * Baca hidden inputs yang sudah ada (bisa di dalam row cell ataupun di global #reject-hidden-container)
		 * Mengembalikan array normalisasi: [{jenis, qty}, ...]
		 * @param {jQuery} row
		 * @returns {Array}
		 */
		getRejectFromHidden: function (row) {
			const rowId =
				row.attr("data-row-id") ?? row.data("row-id") ?? row.index();
			let rejects = [];

			// 1) cari input.reject-hidden di dalam row (biasanya kita menyimpan di cell)
			let $local = row.find("input.reject-hidden");

			// 2) juga cek global container (preload dari server)
			let $global = $("#reject-hidden-container").find(
				`.reject-hidden[data-row='${rowId}']`
			);

			let $inputs = $local.add($global);

			if ($inputs.length === 0) return rejects;

			// nama format: rejects[<rowId>][<i>][jenis_reject] atau rejects[<rowId>][<i>][qty_reject]
			$inputs.each(function () {
				let name = $(this).attr("name") || "";
				let val = $(this).val();
				const m = name.match(
					/^rejects\[(.+?)\]\[(\d+)\]\[(jenis_reject|qty_reject)\]$/
				);
				if (!m) return;

				const idx = parseInt(m[2], 10);
				const key = m[3]; // 'jenis_reject' or 'qty_reject'
				if (!rejects[idx]) rejects[idx] = {};
				rejects[idx][key] = val;
			});

			// normalisasi -> {jenis, qty} dan filter yang valid
			rejects = rejects
				.filter(Boolean)
				.map((r) => {
					return {
						jenis: r.jenis_reject ?? r.jenis ?? "",
						qty: parseInt(r.qty_reject ?? r.qty ?? 0) || 0,
					};
				})
				.filter((r) => r.jenis !== "" && r.qty > 0);

			return rejects;
		},

		/**
		 * Buka modal untuk 1 baris (mengisi modal dengan data dari row.data atau hidden input)
		 * @param {jQuery} row
		 */
		openModal: function (row) {
			// pastikan row.data("reject") terisi (ambil dari hidden jika perlu)
			let rejects = row.data("reject");
			if (!Array.isArray(rejects) || rejects.length === 0) {
				rejects = this.getRejectFromHidden(row);
				row.data("reject", rejects);
			}

			// clone modal template (modal_template di PHP harus ada id rejectModalTemplate)
			let modal = $("#rejectModalTemplate").clone();
			modal
				.removeClass("d-none")
				.attr("id", "rejectModal-" + Date.now())
				.attr("data-bs-backdrop", "static")
				.attr("data-bs-keyboard", "false");
			$("body").append(modal);

			// buat isi modal (tbody)
			let templateRow = modal.find("tbody tr:first").clone();
			let tbody = modal.find("tbody");
			tbody.empty();
			if (rejects.length > 0) {
				rejects.forEach((r) => {
					tbody.append($.rejectHelper.createRow(templateRow, r));
				});
			} else {
				tbody.append(templateRow);
			}

			// aktifkan gridHelper di modal jika ada (untuk add/remove row)
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
				setTimeout(function () {
					// Cari dan hapus semua backdrop yang masih tersisa
					$(".modal-backdrop").remove();

					// Pastikan kelas modal-open (dan padding) di body hilang
					$("body").removeClass("modal-open").css("padding-right", "");
				}, 10);
				// $(".modal-backdrop").remove();
				// $("body").removeClass("modal-open").css("padding-right", "");
			});

			// submit modal → save data
			modal.find(".reject-form").on("submit", function (e) {
				e.preventDefault();
				$.rejectHelper.saveData(modal, row);
			});
		},

		/**
		 * Simpan data dari modal ke row (data + hidden inputs di dalam row cell)
		 * NOTE: gunakan row.attr('data-row-id') sebagai key nama hidden input → konsisten dg saveToHidden
		 * @param {jQuery} modal
		 * @param {jQuery} row
		 */
		saveData: function (modal, row) {
			let rejects = [];
			modal.find("tbody tr").each(function () {
				let jenis = $(this).find("select[name='jenis_reject[]']").val();
				let qty =
					parseInt($(this).find("input[name='qty_reject[]']").val() || 0) || 0;
				if (qty > 0 && jenis) rejects.push({ jenis: jenis, qty: qty });
			});

			// set ke row.data
			row.data("reject", rejects);

			// compute rowId (utamakan data-row-id attribute)
			const rowId =
				row.attr("data-row-id") ?? row.data("row-id") ?? row.index();

			// hapus hidden input lama (di cell dan juga global container agar tidak duplikat)
			let cell = row.find("td:has(.btn-reject)");
			cell.find("input.reject-hidden").remove();
			$("#reject-hidden-container")
				.find(`.reject-hidden[data-row='${rowId}']`)
				.remove();

			// append ke dalam cell (agar ketika form submit, inputs ikut)
			rejects.forEach((r, i) => {
				const jenisEsc = $("<div>").text(r.jenis).html();
				const qtyEsc = $("<div>").text(r.qty).html();
				cell.append(
					`<input type="hidden" class="reject-hidden" data-row="${rowId}" name="rejects[${rowId}][${i}][jenis_reject]" value="${jenisEsc}">` +
						`<input type="hidden" class="reject-hidden" data-row="${rowId}" name="rejects[${rowId}][${i}][qty_reject]" value="${qtyEsc}">`
				);
			});

			// update tampilan tombol
			this.updateButton(row);

			// trigger summary update jika ada
			if ($.summaryHelper && typeof $.summaryHelper.update === "function") {
				$.summaryHelper.update();
			}

			// tutup modal
			let bsModal = bootstrap.Modal.getInstance(modal[0]);
			if (bsModal) bsModal.hide();
			$("body").css("overflow", "auto");
		},

		/**
		 * Inject hidden inputs (preload) dari data server ke #reject-hidden-container,
		 * lalu sinkronkan ke row.data() dan update tombol (jika row ditemukan di tabel)
		 *
		 * @param {String|Number} rowId - nilai identitas baris (mis: prod_detail id)
		 * @param {Array} rejects - array of {jenis_reject, qty_reject} atau {jenis, qty}
		 * @param {Object} opts - optional { targetContainer: '#reject-hidden-container', setRowData: true, updateButton: true }
		 * @returns {Array} normalized rejects
		 */
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
				// jika container tidak ada, buat satu di body (fallback)
				$("body").append(
					'<div id="reject-hidden-container" style="display:none"></div>'
				);
			}

			// bersihkan dulu hidden input lama untuk rowId ini
			$(cfg.targetContainer)
				.find(`.reject-hidden[data-row='${rowId}']`)
				.remove();

			// normalisasi array input (dukung banyak bentuk)
			const normalized = (rejects || [])
				.map((r) => {
					return {
						jenis: r.jenis ?? r.jenis_reject ?? "",
						qty: parseInt(r.qty ?? r.qty_reject ?? 0) || 0,
					};
				})
				.filter((r) => r.jenis !== "" && r.qty > 0);

			// append hidden inputs to container
			normalized.forEach((r, i) => {
				const jenisEsc = $("<div>").text(r.jenis).html();
				const qtyEsc = $("<div>").text(r.qty).html();
				$(cfg.targetContainer).append(
					`<input type="hidden" class="reject-hidden" data-row="${rowId}" name="rejects[${rowId}][${i}][jenis_reject]" value="${jenisEsc}">` +
						`<input type="hidden" class="reject-hidden" data-row="${rowId}" name="rejects[${rowId}][${i}][qty_reject]" value="${qtyEsc}">`
				);
			});

			// jika row di DOM ada, sinkronkan ke row.data() dan update tombol
			if (cfg.setRowData) {
				let $row = $(`tr[data-row-id='${rowId}']`);
				if ($row.length) {
					$row.data("reject", normalized);
					if (cfg.updateButton) this.updateButton($row);
				}
			}

			return normalized;
		},

		/**
		 * Bind click event untuk tombol .btn-reject
		 * (idempotent: selalu off lalu on)
		 */
		bindEvents: function () {
			$(document).off("click.rejectHelper", ".btn-reject");
			$(document).on("click.rejectHelper", ".btn-reject", function () {
				let row = $(this).closest("tr");
				$.rejectHelper.openModal(row);
			});
		},

		/**
		 * Init helper → bind events + scan semua rows untuk meng-update tombol
		 */
		init: function () {
			this.bindEvents();

			$(".btn-reject").each(function () {
				let row = $(this).closest("tr");

				// kalau row.data belum ada, ambil dari hidden inputs (local cell atau global container)
				if (!row.data("reject")) {
					let rejects = $.rejectHelper.getRejectFromHidden(row);
					row.data("reject", rejects);
				}

				$.rejectHelper.updateButton(row);
			});
		},
	};

	// expose globally (already at $.rejectHelper)
})(jQuery);
