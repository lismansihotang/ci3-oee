// assets/js/flatpickr-helper.js

document.addEventListener("DOMContentLoaded", function () {
	const table = document.getElementById("poDetailTable");

	if (!table) return;

	// Fungsi untuk inisialisasi Flatpickr
	function initFlatpickr(container) {
		if (typeof flatpickr !== "undefined") {
			flatpickr(container.querySelectorAll(".flatpickr-input"), {
				dateFormat: "Y-m-d",
				allowInput: true,
			});
		}
	}

	// Inisialisasi Flatpickr pada baris awal
	initFlatpickr(table);

	// Menambahkan event listener pada tabel untuk mendeteksi penambahan baris baru
	table.addEventListener("DOMNodeInserted", function (event) {
		if (event.target.tagName === "TR") {
			initFlatpickr(event.target);
		}
	});
});
