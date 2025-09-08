// assets/js/grid-helper.js

document.addEventListener("DOMContentLoaded", function () {
	const table = document.getElementById("poDetailTable");

	if (!table) return;

	// Fungsi untuk menambahkan baris baru ke tabel
	function addRow() {
		const tableBody = table.querySelector("tbody");
		const lastRow = tableBody.querySelector("tr:last-child");
		if (!lastRow) {
			return;
		}

		const newRow = lastRow.cloneNode(true);
		const inputs = newRow.querySelectorAll("input, select");

		inputs.forEach((input) => {
			if (input.type !== "hidden") {
				input.value = "";
			}
		});

		tableBody.appendChild(newRow);
	}

	// Fungsi untuk menghapus baris
	function removeRow(row) {
		if (table.querySelectorAll("tbody tr").length > 1) {
			row.remove();
		} else {
			alert("Minimal harus ada satu baris!");
		}
	}

	// Event listener untuk tombol tambah dan hapus baris
	table.addEventListener("click", function (event) {
		const target = event.target.closest("button");

		if (!target) return;

		if (target.matches(".add-row-btn")) {
			event.preventDefault();
			addRow();
		}

		if (target.matches(".remove-row-btn")) {
			event.preventDefault();
			const row = target.closest("tr");
			removeRow(row);
		}
	});
});
