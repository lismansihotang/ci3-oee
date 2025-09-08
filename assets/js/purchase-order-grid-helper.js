// assets/js/purchase-order-grid-helper.js

// Asumsi 'purchase-order-calc.js' sudah dimuat sebelum file ini
// sehingga fungsi calculateSubtotal tersedia secara global.

document.addEventListener("DOMContentLoaded", function () {
	const table = document.getElementById("poDetailTable");

	if (!table) return;

	const fetchUrls = JSON.parse(table.dataset.fetchUrls);

	// Event listener untuk perubahan pada select produk
	table.addEventListener("change", function (event) {
		const target = event.target;

		if (target.matches(".produk-select")) {
			const selectedCode = target.value;
			const row = target.closest("tr");

			const fetchUrl = fetchUrls["kd_product"];

			if (selectedCode && fetchUrl) {
				const finalUrl = fetchUrl.endsWith("/")
					? fetchUrl + selectedCode
					: fetchUrl + "/" + selectedCode;

				fetch(finalUrl)
					.then((response) => {
						if (!response.ok) {
							throw new Error("Network response was not ok");
						}
						return response.json();
					})
					.then((data) => {
						if (data.success) {
							const productData = data.data;

							const namaProdukInput = row.querySelector(".nama-produk-input");
							const hargaInput = row.querySelector(".harga-input");

							if (namaProdukInput) {
								namaProdukInput.value = productData.nama_produk;
							}
							if (hargaInput) {
								hargaInput.value = productData.cost;
							}
							// Panggil fungsi dari file terpisah
							calculateSubtotal(row);
						} else {
							console.error("Product not found:", selectedCode);
						}
					})
					.catch((error) => {
						console.error("Error fetching product data:", error);
					});
			}
		}
	});

	// Event listener untuk perubahan pada qty dan harga
	table.addEventListener("input", function (event) {
		const target = event.target;
		if (target.matches(".qty-input") || target.matches(".harga-input")) {
			const row = target.closest("tr");
			// Panggil fungsi dari file terpisah
			calculateSubtotal(row);
		}
	});
});
