/**
 * Front-end JavaScript
 *
 * The JavaScript code you place here will be processed by esbuild. The output
 * file will be created at `../theme/js/script.min.js` and enqueued in
 * `../theme/functions.php`.
 *
 * For esbuild documentation, please see:
 * https://esbuild.github.io/
 */
import Alpine from 'alpinejs';
// import Swiper from 'swiper/bundle';

document.addEventListener('DOMContentLoaded', function () {
	// Initialize Alpine.js
	window.Alpine = Alpine;
	Alpine.start();
	window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
		const isDarkMode = event.matches;
		document.documentElement.classList.toggle('dark', isDarkMode);
		localStorage.setItem('darkMode', isDarkMode);
		document.cookie = `darkMode=${isDarkMode}; path=/; max-age=31536000`;
	});
		// The GF form often has class "gform_wrapper" + <form> inside
	const gfForm = document.querySelector('.gform_wrapper form');
	if (gfForm) {
		gfForm.addEventListener('submit', function(e) {
			// 1) If form is NOT valid, let the browser show validation warnings; skip the delayed submission
			if (!gfForm.checkValidity()) {
				// This will trigger the browser to show errors for required fields
				// and block the submission
				e.preventDefault();
				gfForm.reportValidity();
				return;
			}
			if (gfForm.checkValidity()) {
				// 2) If the form *is* valid, do the delayed submission
				e.preventDefault(); // block immediate submit
				document.querySelector('.submition-text')?.style.setProperty("display", "block");
				document.querySelector('.form_subtitle')?.style.setProperty("display", "none");

				// Wait 3 seconds, then *actually* submit the form
				setTimeout(function () {
					gfForm.submit();
				}, 3000);
			}
		});
	}
});
