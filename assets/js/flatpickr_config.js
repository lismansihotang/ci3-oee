// assets/js/flatpickr_config.js

// Konfigurasi global Flatpickr
// Opsi ini akan diterapkan ke semua instance Flatpickr.
flatpickr.setDefaults({
	dateFormat: "Y-m-d", // Contoh format tanggal dan waktu
	enableTime: false, // Aktifkan pemilih waktu
	noCalendar: false, // Tampilkan kalender
	// Anda bisa menambahkan opsi lain di sini
});

// Anda juga bisa membuat fungsi inisialisasi untuk menginisialisasi Flatpickr pada elemen dengan kelas tertentu
function initializeFlatpickrInputs() {
	flatpickr(".flatpickr-input", {
		// Opsi khusus untuk elemen dengan kelas ini jika diperlukan
	});
}

// Inisialisasi saat DOM sudah siap
document.addEventListener("DOMContentLoaded", initializeFlatpickrInputs);
