// =============================================================
// Summary Helper Plugin
// -------------------------------------------------------------
// Fungsi:
// 1. Hitung total pass, reject, hold, downtime.
// 2. Update UI summary.
// 3. Simpan hasil ke hidden input untuk dikirim form.
// 4. Auto update saat input berubah / row berubah.
// -------------------------------------------------------------
// Dependensi: jQuery
// =============================================================
(function ($) {
	$.summaryHelper = {
		config: {},

		init: function (options) {
			this.config = $.extend(
				{
					prodTable: "#prodDetailTable",
					downTable: "#downtimeTable",
					targetEl: "#target-per-shift",
					shiftEl: "#shift",
					summaryEl: "#spk-summary",
					hiddenContainer: "#summary-hidden",
				},
				options
			);

			this.ensureHidden();
			this.update();

			// auto update ketika input berubah
			$(document).on(
				"input change",
				this.config.prodTable + " input," + this.config.downTable + " input",
				() => this.update()
			);

			// observer row add/delete
			let prodTarget = document.querySelector(this.config.prodTable + " tbody");
			let downTarget = document.querySelector(this.config.downTable + " tbody");
			if (prodTarget) {
				new MutationObserver(() => this.update()).observe(prodTarget, {
					childList: true,
					subtree: true,
				});
			}
			if (downTarget) {
				new MutationObserver(() => this.update()).observe(downTarget, {
					childList: true,
					subtree: true,
				});
			}
		},

		update: function () {
			let cfg = this.config;
			let totalPass = 0,
				totalReject = 0,
				totalHold = 0,
				totalDowntime = 0;

			// === Hitung Produksi ===
			$(cfg.prodTable + " tbody tr").each(function () {
				let pass = parseInt($(this).find("input[name*='pass']").val() || 0);
				let hold = parseInt($(this).find("input[name*='hold']").val() || 0);
				let rejects = $(this).data("reject") || [];
				let rejectSum = 0;
				rejects.forEach((r) => (rejectSum += parseInt(r.qty || 0)));

				totalPass += pass;
				totalReject += rejectSum;
				totalHold += hold;
			});

			// === Hitung Downtime ===
			$(cfg.downTable + " tbody tr").each(function () {
				let start = $(this).find("input[name*='jam_mulai']").val();
				let end = $(this).find("input[name*='jam_selesai']").val();
				if (start && end) {
					let startTime = new Date("1970-01-01T" + start + ":00");
					let endTime = new Date("1970-01-01T" + end + ":00");
					let diffMs = endTime - startTime;
					if (diffMs > 0) totalDowntime += diffMs / (1000 * 60);
				}
			});

			// === Persentase ===
			let targetShift = parseInt($(cfg.targetEl).text() || 0);
			let percent =
				targetShift > 0 ? ((totalPass / targetShift) * 100).toFixed(1) : 0;
			let rejectPercent =
				targetShift > 0 ? ((totalReject / targetShift) * 100).toFixed(1) : 0;

			let shiftVal = $(cfg.shiftEl).val();
			let shiftHours =
				shiftVal === "1" || shiftVal === "2" || shiftVal === "3" ? 8 : 0;
			let downtimePercent =
				shiftHours > 0
					? ((totalDowntime / (shiftHours * 60)) * 100).toFixed(1)
					: 0;

			// update UI
			$(cfg.summaryEl).show();
			$("#sum-pass").text(totalPass);
			$("#sum-reject").text(totalReject);
			$("#sum-hold").text(totalHold);
			$("#sum-percent").text(percent + "%");
			$("#sum-reject-percent").text(rejectPercent + "%");
			$("#sum-downtime-percent").text(downtimePercent + "%");

			// update hidden input
			this.updateHidden({
				jml_pass: totalPass,
				jml_reject: totalReject,
				jml_hold: totalHold,
				persen_pass: percent,
				persen_reject: rejectPercent,
				persen_down: downtimePercent,
			});
		},

		ensureHidden: function () {
			let container = $(this.config.hiddenContainer);
			if (container.length === 0) return;
			[
				"jml_pass",
				"jml_reject",
				"jml_hold",
				"persen_pass",
				"persen_reject",
				"persen_down",
			].forEach((name) => {
				if (container.find("input[name='" + name + "']").length === 0) {
					container.append(`<input type="hidden" name="${name}" value="0">`);
				}
			});
		},

		updateHidden: function (values) {
			let container = $(this.config.hiddenContainer);
			for (let key in values) {
				container.find("input[name='" + key + "']").val(values[key]);
			}
		},
	};
})(jQuery);
