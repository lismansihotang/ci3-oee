/**
 * ==========================================================
 * calc-spk.js
 * ----------------------------------------------------------
 * Plugin jQuery untuk menghitung target produksi SPK
 * (Produksi, Printing, Stamping) + estimasi tanggal selesai.
 * ----------------------------------------------------------
 * Reusable & Universal → tinggal set config di view.
 * ==========================================================
 */

(function ($) {
	"use strict";

	/**
	 * Hitung target produksi per jam/shift/day
	 * @param {number} cavity - jumlah cavity
	 * @param {number} cycleTime - cycle time (detik)
	 * @param {string} prefix - prefix id input (contoh: 't', 'print', 'stamp')
	 * @param {Object} config - konfigurasi shift/hari
	 */
	function hitungTargetGeneric(cavity, cycleTime, prefix, config) {
		if (cavity > 0 && cycleTime > 0) {
			let perJam = (3600 / cycleTime) * cavity;
			let perShift = perJam * config.jamPerShift;
			let perDay = perShift * config.shiftPerHari;

			$(`#${prefix}_jam`).val(Math.floor(perJam));
			$(`#${prefix}_shift`).val(Math.floor(perShift));
			$(`#${prefix}_day`).val(Math.floor(perDay));
		}
	}

	/**
	 * Hitung tanggal selesai produksi berdasarkan order & kapasitas
	 * @param {number} orderQty - jumlah order
	 * @param {number} targetDay - kapasitas per hari
	 * @param {string} startDate - selector input tanggal mulai
	 * @param {string} endDate - selector input tanggal selesai
	 */
	function hitungTanggalSelesai(orderQty, targetDay, startDate, endDate) {
		if (orderQty > 0 && targetDay > 0) {
			let start = new Date($(startDate).val());
			let daysNeeded = Math.ceil(orderQty / targetDay);

			if (!isNaN(start.getTime())) {
				start.setDate(start.getDate() + daysNeeded);
				$(endDate).val(start.toISOString().split("T")[0]);
			}
		}
	}

	/**
	 * Plugin utama untuk menghitung semua target SPK
	 * @param {Object} config - konfigurasi
	 */
	$.fn.hitungSemua = function (config) {
		let cavity = parseFloat($(config.cavity).val()) || 0;
		let orderQty = parseFloat($(config.order).val()) || 0;

		// hitung per proses
		config.processes.forEach((proc) => {
			let cycleTime = parseFloat($(proc.cycle).val()) || 0;
			hitungTargetGeneric(cavity, cycleTime, proc.prefix, config);
		});

		// pakai produksi utama sebagai acuan tanggal selesai
		let targetDay = parseFloat($("#tday").val()) || 0;
		hitungTanggalSelesai(orderQty, targetDay, config.startDate, config.endDate);
	};

	/**
	 * Inisialisasi form SPK lengkap dengan ajax & event listener
	 * @param {Object} options
	 * @param {string} options.urlPoDetail - URL endpoint get_po_detail
	 * @param {Object} options.config - konfigurasi plugin hitungSemua
	 */
	$.fn.initSpkForm = function (options) {
		const { urlPoDetail, config } = options;

		// Event: pilih PO → load detail via Ajax
		$("#no_po").on("change", function () {
			const id_po = $(this).val();
			if (!id_po) return;

			ajaxRequest(urlPoDetail + id_po, {
				onSuccess: function (data) {
					if (data) {
						$("#kd_product").val(data.kd_product);
						$("#kd_product_display").val(
							data.kd_product + " - " + data.nama_produk
						);
						$("#cavity").val(data.cavity);
						$("#ct").val(data.ct);
						$("#ct_print").val(data.ct_print);
						$("#ct_stamp").val(data.ct_stamp);
						$("#no_mould").val(data.no_mould);

						// trigger perhitungan pertama kali
						$(document).hitungSemua(config);
					}
				},
			});
		});

		// Event: input berubah → hitung ulang
		$(
			config.cavity +
				", " +
				config.processes.map((p) => p.cycle).join(", ") +
				", " +
				config.order +
				", " +
				config.startDate
		).on("input change", function () {
			$(document).hitungSemua(config);
		});

		// Init Select2 (jika ada)
		$(".select2-init").select2({
			theme: "bootstrap-5",
			width: "100%",
		});
	};
})(jQuery);
