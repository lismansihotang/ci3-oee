/**
 * Ambil data produk dari server
 * @param {string} kode
 * @param {string} baseUrl
 * @returns {Promise<object>}
 */
function fetchProductData(kode, baseUrl) {
	return new Promise((resolve, reject) => {
		if (!kode || !baseUrl) {
			reject("kode atau baseUrl kosong");
			return;
		}
		let url = baseUrl;
		if (!url.endsWith("/")) url += "/";
		url += encodeURIComponent(kode);

		$.ajax({
			url: url,
			type: "GET",
			dataType: "json",
			success: function (resp) {
				if (resp && resp.success && resp.data) {
					resolve(resp.data);
				} else {
					resolve({});
				}
			},
			error: function (xhr) {
				reject(xhr.responseText);
			},
		});
	});
}

/**
 * Isi input di dalam row berdasarkan data & mapping
 * @param {jQuery} $row   - baris <tr>
 * @param {object} data   - hasil AJAX
 * @param {object} mapping- contoh: { nama_produk: ".nama-produk-input", cost: ".harga-input" }
 */
function fillRowWithData($row, data, mapping) {
	if (!data || !mapping) return;
	Object.keys(mapping).forEach((jsonKey) => {
		const selector = mapping[jsonKey];
		const $input = $row.find(selector);
		if ($input.length) {
			$input.val(data[jsonKey] || "");
		}
	});
}

/**
 * Listener utama: bisa punya mapping berbeda per select lewat data-mapping
 * @param {string} tableSelector  - selector tabel
 * @param {string} triggerClass   - class pada <select>, misal '.produk-select'
 */
function initProductAutofill(tableSelector, triggerClass) {
	const $table = $(tableSelector);

	$table.on("change", triggerClass, function () {
		const $select = $(this);
		const baseUrl = $select.data("fetch-url");
		const value = $select.val();
		const $row = $select.closest("tr");

		console.log("Row HTML:", $row.html());

		// ambil mapping; bisa object langsung, bisa string
		let mapping = $select.data("mapping");
		if (typeof mapping === "string") {
			try {
				mapping = JSON.parse(mapping);
			} catch (e) {
				console.error("Mapping JSON tidak valid:", e);
				mapping = {};
			}
		}

		// debugging optional:
		// console.log("Mapping:", mapping);

		fetchProductData(value, baseUrl)
			.then((data) => fillRowWithData($row, data, mapping))
			.catch((err) => console.error("Fetch gagal:", err));
	});
}
