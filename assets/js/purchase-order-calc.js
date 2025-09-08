// assets/js/purchase-order-calc.js

/**
 * Fungsi untuk menghitung subtotal pada sebuah baris grid.
 *
 * @param {HTMLElement} row Elemen baris tabel (<tr>).
 */
function calculateSubtotal(row) {
	const qtyInput = row.querySelector(".qty-input");
	const hargaInput = row.querySelector(".harga-input");
	const subtotalInput = row.querySelector(".subtotal-input");

	const qty = parseFloat(qtyInput.value) || 0;
	const harga = parseFloat(hargaInput.value) || 0;

	const subtotal = qty * harga;
	if (subtotalInput) {
		subtotalInput.value = subtotal.toFixed(2);
	}
}
