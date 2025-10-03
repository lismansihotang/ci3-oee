// Global fix untuk Bootstrap modal agar body tidak terkunci scroll
(function () {
	document.addEventListener("shown.bs.modal", function () {
		document.body.style.overflow = "auto"; // pulihkan scroll
		document.body.style.paddingRight = "0px"; // reset padding
	});

	document.addEventListener("hidden.bs.modal", function () {
		document.body.style.overflow = ""; // hapus override
		document.body.style.paddingRight = ""; // hapus override
	});
})();
