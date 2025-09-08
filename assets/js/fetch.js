/* fetch.js
   - menyediakan $.autofill.fetchData(baseUrl,id)
   - menyediakan $.autofill.fillContext($ctx, data, mapping)
*/
(function ($) {
	// decode HTML entities (jika attr ter-escape)
	function decodeEntities(str) {
		if (!str) return str;
		var ta = document.createElement("textarea");
		ta.innerHTML = str;
		return ta.value;
	}

	function parseMapping(raw) {
		if (!raw) return {};
		try {
			// jika sudah object (jQuery .data parsed it), return
			if (typeof raw === "object") return raw;
			// kalau string: decode entities then parse
			return JSON.parse(decodeEntities(raw));
		} catch (err) {
			console.warn("autofill: mapping parse failed", raw, err);
			return {};
		}
	}

	function fetchData(kode, baseUrl) {
		return $.Deferred(function (def) {
			if (!kode || !baseUrl) {
				def.reject("kode/baseUrl kosong");
				return;
			}
			var url = baseUrl;
			if (!url.endsWith("/")) url += "/";
			url += encodeURIComponent(kode);

			$.ajax({
				url: url,
				type: "GET",
				dataType: "json",
			})
				.done(function (resp) {
					if (resp && resp.success && resp.data) def.resolve(resp.data);
					else def.resolve({});
				})
				.fail(function (xhr) {
					def.reject(xhr.responseText || xhr.statusText);
				});
		}).promise();
	}

	function fillContext($ctx, data, mapping) {
		if (!data || !mapping) return;
		// mapping: { jsonKey: selector }
		$.each(mapping, function (jsonKey, selector) {
			if (!selector) return;
			var $target = $ctx.find(selector);
			if (!$target.length) return;
			// jika multiple elements, apply to each
			$target.each(function () {
				var $el = $(this);
				if ($el.is("input,textarea,select")) {
					$el.val(typeof data[jsonKey] !== "undefined" ? data[jsonKey] : "");
					// trigger events so other logic can react
					$el.trigger("input").trigger("change");
				} else {
					$el.text(typeof data[jsonKey] !== "undefined" ? data[jsonKey] : "");
				}
			});
		});
	}

	// expose
	$.autofill = $.autofill || {};
	$.autofill.parseMapping = parseMapping;
	$.autofill.fetchData = fetchData;
	$.autofill.fillContext = fillContext;
})(jQuery);
