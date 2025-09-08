// assets/js/form-autofill-helper.js

document.addEventListener("DOMContentLoaded", function () {
	// Fungsi generik untuk menangani auto-fill
	function handleAutoFill(selectElement) {
		const targetInputName = selectElement.dataset.targetInput;
		const fetchUrl = selectElement.dataset.fetchUrl;
		const sourceKey = selectElement.dataset.sourceKey;
		const selectedValue = selectElement.value;

		if (!targetInputName || !fetchUrl || !sourceKey || !selectedValue) {
			return;
		}

		const finalUrl = `${
			fetchUrl.endsWith("/") ? fetchUrl : fetchUrl + "/"
		}${selectedValue}`;

		fetch(finalUrl)
			.then((response) => response.json())
			.then((data) => {
				if (data.success && data.data) {
					const targetInput = document.querySelector(
						`input[name="${targetInputName}"]`
					);
					if (targetInput) {
						targetInput.value = data.data[sourceKey];
					}
				} else {
					console.error("Data not found for selected value:", selectedValue);
				}
			})
			.catch((error) => console.error("Error fetching data:", error));
	}

	// Mendengarkan perubahan pada semua elemen select yang memiliki atribut data-target-input
	document.body.addEventListener("change", function (event) {
		if (event.target.matches("select[data-target-input]")) {
			handleAutoFill(event.target);
		}
	});

	// Jalankan sekali saat halaman dimuat jika ada nilai yang sudah terpilih
	document.querySelectorAll("select[data-target-input]").forEach((select) => {
		if (select.value) {
			handleAutoFill(select);
		}
	});
});
