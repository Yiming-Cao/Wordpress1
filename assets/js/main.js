/**
 * Klein script voor het menu op een telefoon.
 *
 * Zonder dit script staat het menu op mobiel dicht, dus het is niet meer dan
 * een beetje extra gemak.
 */
(function () {
	'use strict';

	var toggle = document.querySelector('.nav-toggle');
	var nav = document.getElementById('primary-nav');

	if (!toggle || !nav) {
		return;
	}

	toggle.addEventListener('click', function () {
		var isOpen = toggle.getAttribute('aria-expanded') === 'true';

		toggle.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
		nav.classList.toggle('is-open', !isOpen);
	});
})();
