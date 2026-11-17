/**
 * Klein script voor het menu op een telefoon.
 *
 * 中文：手机版菜单按钮：点一下给导航加 .is-open，同时改 aria-expanded。
 * 没有这个脚本，手机上菜单打不开，所以它是必要的（不只是装饰）。
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

	// 中文：点击 Menu 按钮时切换开关；aria-expanded 让读屏软件知道菜单是开还是关。
	toggle.addEventListener('click', function () {
		var isOpen = toggle.getAttribute('aria-expanded') === 'true';

		// aria-expanded vertelt aan een schermlezer of het menu open of dicht is.
		toggle.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
		nav.classList.toggle('is-open', !isOpen);
	});
})();
