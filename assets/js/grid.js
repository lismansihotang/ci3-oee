// assets/js/grid.js

/**
 * Menambahkan baris baru ke tabel detail secara dinamis.
 * Fungsi ini menyalin semua atribut (seperti ID dan kelas)
 * dari baris pertama ke baris baru, memastikan helper benar-benar generik.
 * @param {string} tableId ID dari tabel target.
 */
function addTableRow(tableId) {
	const table = document.getElementById(tableId);
	if (!table) return;

	const tableBody = table.querySelector("tbody");
	const firstRow = tableBody.rows[0];
	if (!firstRow) return;

	// Klon baris pertama
	const newRow = firstRow.cloneNode(true);
	const newRowIndex = tableBody.rows.length;

	// Iterasi melalui setiap elemen input/select di baris baru
	newRow.querySelectorAll("input, select").forEach((element) => {
		const name = element.getAttribute("name");
		const simpleName = name ? name.replace("[]", "") : "";
		const originalId = element.getAttribute("id");

		// Reset nilai input
		if (element.tagName === "INPUT") {
			element.value = "";
		} else if (element.tagName === "SELECT") {
			element.selectedIndex = 0; // Reset ke opsi pertama (default)
		}

		// Perbarui ID jika ada
		if (originalId) {
			// Asumsi ID diakhiri dengan nomor (misal: qty_0)
			const newId = originalId.replace(/_\d+$/, "_" + newRowIndex);
			element.setAttribute("id", newId);
		}

		// Hapus atribut yang tidak perlu (misalnya data-select-options)
		if (element.hasAttribute("data-select-options")) {
			element.removeAttribute("data-select-options");
		}
	});

	tableBody.appendChild(newRow);

	// Re-inisialisasi flatpickr pada baris baru
	newRow.querySelectorAll(".flatpickr-input").forEach((input) => {
		flatpickr(input, {
			dateFormat: "Y-m-d",
		});
	});
}

/**
 * Menghapus baris dari tabel detail.
 * @param {HTMLElement} button Tombol yang diklik untuk menghapus baris.
 */
function removeTableRow(button) {
	const row = button.closest("tr");
	const tableBody = row.parentNode;
	if (tableBody.rows.length > 1) {
		row.remove();
	} else {
		alert("Setidaknya harus ada satu baris detail.");
	}
}

// Inisialisasi flatpickr saat DOM sudah siap
document.addEventListener("DOMContentLoaded", function () {
	flatpickr(".flatpickr-input", {
		dateFormat: "Y-m-d",
	});
});
