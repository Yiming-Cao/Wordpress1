/**
 * Night City Dispatch — small progressive enhancements.
 *
 * The site works without this file: the menu is a normal list of links and the
 * reading progress bar is decoration. Everything here is optional polish.
 */
(function () {
	'use strict';

	document.documentElement.classList.add('js');

	/* Mobile navigation -------------------------------------------------- */
	var toggle = document.querySelector('.nav-toggle');
	var nav = document.getElementById('primary-nav');

	if (toggle && nav) {
		var setOpen = function (open) {
			toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
			nav.classList.toggle('is-open', open);
			document.body.classList.toggle('nav-open', open);
		};

		toggle.addEventListener('click', function () {
			setOpen(toggle.getAttribute('aria-expanded') !== 'true');
		});

		document.addEventListener('keydown', function (event) {
			if (event.key === 'Escape') {
				setOpen(false);
				toggle.focus();
			}
		});

		document.addEventListener('click', function (event) {
			if (!nav.classList.contains('is-open')) {
				return;
			}
			if (!nav.contains(event.target) && !toggle.contains(event.target)) {
				setOpen(false);
			}
		});

		window.addEventListener('resize', function () {
			if (window.innerWidth > 1140) {
				setOpen(false);
			}
		});
	}

	/* Reading progress --------------------------------------------------- */
	var bar = document.querySelector('.progress__bar');

	if (bar) {
		var update = function () {
			var root = document.documentElement;
			var max = root.scrollHeight - root.clientHeight;
			var progress = max > 0 ? (root.scrollTop / max) * 100 : 0;
			bar.style.width = Math.min(100, Math.max(0, progress)) + '%';
		};

		window.addEventListener('scroll', update, { passive: true });
		window.addEventListener('resize', update);
		update();
	}
})();
