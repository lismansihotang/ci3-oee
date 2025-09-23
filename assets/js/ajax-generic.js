/**
 * Universal AJAX GET/POST wrapper
 * @param {string} url - endpoint
 * @param {object} options - konfigurasi {method, data, onSuccess, onError}
 */
function ajaxRequest(url, options = {}) {
	const method = options.method || "GET";
	const data = options.data || {};
	const onSuccess = options.onSuccess || function () {};
	const onError = options.onError || function () {};

	$.ajax({
		url: url,
		type: method,
		data: data,
		dataType: "json",
		success: function (response) {
			onSuccess(response);
		},
		error: function (xhr, status, error) {
			console.error("Ajax Error:", status, error);
			onError(xhr, status, error);
		},
	});
}
