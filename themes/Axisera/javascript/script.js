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
		gfForm.addEventListener('submit', function (e) {
			// Prevent form submission if invalid
			if (!gfForm.checkValidity()) {
				e.preventDefault();
				gfForm.reportValidity();
				return;
			}

			// Prevent default submission for 3 seconds
			e.preventDefault();
			document.querySelector('.submition-text')?.style.setProperty("display", "block");
			document.querySelector('.form_subtitle')?.style.setProperty("display", "none");

			setTimeout(function () {
				gfForm.submit();
			}, 3000);
		});

		// Hook into Gravity Forms after submission event
		document.addEventListener("gform_confirmation_loaded", function () {
			// Keep form visible
			gfForm.style.display = "block";

			// Clear form fields after submission
			gfForm.reset();

			// Hide the Gravity Forms success message
			const gfSuccessMessage = document.querySelector(".gform_confirmation_message");
			if (gfSuccessMessage) {
				gfSuccessMessage.style.display = "none";
			}
		});
	}
});
