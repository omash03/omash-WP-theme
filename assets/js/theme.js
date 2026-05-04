const cit351ThemeStorageKey = 'cit351-theme';
const cit351Root = document.documentElement;
const cit351SystemThemeMedia = window.matchMedia ? window.matchMedia('(prefers-color-scheme: dark)') : null;

const cit351GetStoredTheme = () => {
	try {
		const storedTheme = window.localStorage.getItem(cit351ThemeStorageKey);

		if (storedTheme === 'light' || storedTheme === 'dark') {
			return storedTheme;
		}
	} catch (error) {
		// Ignore storage access issues.
	}

	return '';
};

const cit351GetSystemTheme = () => {
	if (cit351SystemThemeMedia && cit351SystemThemeMedia.matches) {
		return 'dark';
	}

	return 'light';
};

const cit351ReadTheme = () => {
	const storedTheme = cit351GetStoredTheme();

	if (storedTheme) {
		return storedTheme;
	}

	return cit351GetSystemTheme();
};

const cit351WriteTheme = (theme, persist = false) => {
	cit351Root.setAttribute('data-theme', theme);
	cit351Root.style.colorScheme = theme;

	if (persist) {
		try {
			window.localStorage.setItem(cit351ThemeStorageKey, theme);
		} catch (error) {
			// Ignore storage access issues.
		}
	}
};

const cit351SyncThemeToggles = (theme) => {
	document.querySelectorAll('[data-theme-toggle]').forEach((toggle) => {
		const state = toggle.querySelector('[data-theme-toggle-state]');
		const nextTheme = theme === 'dark' ? 'light' : 'dark';

		toggle.setAttribute('aria-pressed', theme === 'light' ? 'true' : 'false');
		toggle.setAttribute('aria-label', `Switch to ${nextTheme} mode`);

		if (state) {
			state.textContent = theme.charAt(0).toUpperCase() + theme.slice(1);
		}
	});
};

const cit351ShortcutPulseStorageKey = 'cit351-shortcut-pulse';
const cit351ShortcutPulseExactTargetSelector = '[data-shortcut-pulse-target]';
const cit351ShortcutPulseSelector = '.copy-grid, .feature-grid, .credential-grid, .content-tools, .posts-tools-grid, .hero-panel';

const cit351ReadShortcutPulseTargetId = () => {
	try {
		return window.sessionStorage.getItem(cit351ShortcutPulseStorageKey) || '';
	} catch (error) {
		return '';
	}
};

const cit351StoreShortcutPulseTargetId = (targetId) => {
	if (!targetId) {
		return;
	}

	try {
		window.sessionStorage.setItem(cit351ShortcutPulseStorageKey, targetId);
	} catch (error) {
		// Ignore storage access issues.
	}
};

const cit351ClearStoredShortcutPulseTargetId = () => {
	try {
		window.sessionStorage.removeItem(cit351ShortcutPulseStorageKey);
	} catch (error) {
		// Ignore storage access issues.
	}
};

const cit351GetShortcutPulseTarget = (element) => {
	if (!element) {
		return null;
	}

	if (element.matches(cit351ShortcutPulseExactTargetSelector)) {
		return element;
	}

	const exactTarget = element.closest(cit351ShortcutPulseExactTargetSelector);

	if (exactTarget) {
		return exactTarget;
	}

	if (element.matches(cit351ShortcutPulseSelector)) {
		return element;
	}

	return element.closest(cit351ShortcutPulseSelector);
};

const cit351TriggerShortcutPulse = (element) => {
	const target = cit351GetShortcutPulseTarget(element);

	if (!target) {
		return;
	}

	target.classList.remove('shortcut-pulse');
	target.getBoundingClientRect();
	target.classList.add('shortcut-pulse');
	target.addEventListener(
		'animationend',
		() => {
			target.classList.remove('shortcut-pulse');
		},
		{ once: true }
	);
};

const cit351ScheduleShortcutPulse = (element, delay = 180) => {
	window.setTimeout(() => {
		window.requestAnimationFrame(() => {
			window.requestAnimationFrame(() => {
				cit351TriggerShortcutPulse(element);
			});
		});
	}, delay);
};

const cit351ScrollShortcutTargetIntoView = (element) => {
	if (!element) {
		return;
	}

	if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
		element.scrollIntoView({ block: 'start' });
		return;
	}

	element.scrollIntoView({ behavior: 'smooth', block: 'start' });
};

const cit351PulseShortcutTargetById = (targetId, delay = 180) => {
	if (!targetId) {
		return false;
	}

	const target = document.getElementById(targetId);

	if (!target) {
		return false;
	}

	cit351ScheduleShortcutPulse(target, delay);

	return true;
};

const cit351PulseStoredShortcutTarget = () => {
	const targetId = cit351ReadShortcutPulseTargetId();

	if (targetId) {
		cit351ClearStoredShortcutPulseTargetId();
		cit351PulseShortcutTargetById(targetId, 250);
		return;
	}

	const currentHash = window.location.hash.replace(/^#/, '');

	if (currentHash) {
		cit351PulseShortcutTargetById(currentHash, 250);
	}
};

const cit351HandleSidebarShortcutClick = (event, closeMenu) => {
	const link = event.currentTarget;
	const href = link.getAttribute('href');

	if (!href) {
		closeMenu();
		return;
	}

	try {
		const url = new URL(href, window.location.href);
		const hasHash = Boolean(url.hash && url.hash !== '#');
		const isSamePage = url.origin === window.location.origin && url.pathname === window.location.pathname && url.search === window.location.search;

		if (hasHash) {
			const targetId = url.hash.slice(1);

			if (isSamePage) {
				const target = document.getElementById(targetId);

				if (target) {
					event.preventDefault();
					history.pushState(null, '', url.hash);
					closeMenu();
					cit351ScrollShortcutTargetIntoView(target);
					cit351ScheduleShortcutPulse(target, 250);
					return;
				}
			}

			cit351StoreShortcutPulseTargetId(targetId);
		}
	} catch (error) {
		if (href.charAt(0) === '#' && href.length > 1) {
			const targetId = href.slice(1);
			const target = document.getElementById(targetId);

			if (target) {
				event.preventDefault();
				history.pushState(null, '', href);
				closeMenu();
				cit351ScrollShortcutTargetIntoView(target);
				cit351ScheduleShortcutPulse(target, 250);
				return;
			}

			cit351StoreShortcutPulseTargetId(targetId);
		}
	}

	closeMenu();
};

document.addEventListener('DOMContentLoaded', () => {
	const body = document.body;
	const menuToggle = document.querySelector('.menu-toggle');
	const sidebarClose = document.querySelector('.sidebar-close');
	const overlay = document.querySelector('.site-overlay');
	const sidebar = document.querySelector('.site-sidebar-panel');
	const themeToggles = document.querySelectorAll('[data-theme-toggle]');
	const postsTools = document.querySelectorAll('[data-posts-tools]');
	let activeTheme = cit351ReadTheme();

	cit351WriteTheme(activeTheme);
	cit351SyncThemeToggles(activeTheme);

	themeToggles.forEach((toggle) => {
		toggle.addEventListener('click', () => {
			activeTheme = activeTheme === 'dark' ? 'light' : 'dark';
			cit351WriteTheme(activeTheme, true);
			cit351SyncThemeToggles(activeTheme);
		});
	});

	if (cit351SystemThemeMedia && typeof cit351SystemThemeMedia.addEventListener === 'function') {
		cit351SystemThemeMedia.addEventListener('change', () => {
			if (cit351GetStoredTheme()) {
				return;
			}

			activeTheme = cit351GetSystemTheme();
			cit351WriteTheme(activeTheme);
			cit351SyncThemeToggles(activeTheme);
		});
	}

	const closeMenu = () => {
		body.classList.remove('menu-open');
		if (overlay) {
			overlay.hidden = true;
		}
		if (menuToggle) {
			menuToggle.setAttribute('aria-expanded', 'false');
		}
	};

	const openMenu = () => {
		body.classList.add('menu-open');
		if (overlay) {
			overlay.hidden = false;
		}
		if (menuToggle) {
			menuToggle.setAttribute('aria-expanded', 'true');
		}
	};

	if (menuToggle && overlay && sidebar) {
		menuToggle.addEventListener('click', () => {
			if (body.classList.contains('menu-open')) {
				closeMenu();
			} else {
				openMenu();
			}
		});

		overlay.addEventListener('click', closeMenu);

		if (sidebarClose) {
			sidebarClose.addEventListener('click', closeMenu);
		}

		sidebar.querySelectorAll('a').forEach((link) => {
			link.addEventListener('click', (event) => cit351HandleSidebarShortcutClick(event, closeMenu));
		});
	}

	cit351PulseStoredShortcutTarget();

	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape' && body.classList.contains('menu-open')) {
			closeMenu();
		}
	});

	postsTools.forEach((tools) => {
		const toggle = tools.querySelector('[data-posts-tools-toggle]');
		const panel = tools.querySelector('[data-posts-tools-panel]');
		const categoryForm = tools.querySelector('[data-category-jump-form]');
		const categorySelect = categoryForm ? categoryForm.querySelector('select') : null;

		if (!toggle || !panel) {
			return;
		}

		const setOpenState = (isOpen) => {
			tools.classList.toggle('is-open', isOpen);
			panel.hidden = !isOpen;
			toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
		};

		setOpenState(false);

		toggle.addEventListener('click', () => {
			setOpenState(panel.hidden);
		});

		if (categoryForm && categorySelect) {
			categorySelect.addEventListener('change', () => {
				if (categorySelect.value) {
					categoryForm.submit();
				}
			});
		}
	});

	const tocShell = document.querySelector('[data-post-toc]');
	const content = document.querySelector('.entry-content');

	if (tocShell && content) {
		const tocToggle = tocShell.querySelector('.post-toc-toggle');
		const tocPanel = tocShell.querySelector('.post-toc-panel');
		const tocNav = tocShell.querySelector('.post-toc-nav');
		const tocWideScreenQuery = window.matchMedia('(min-width: 1800px)');
		const headings = [...content.querySelectorAll('h2, h3, h4')].filter((heading) => heading.textContent.trim().length > 0);

		if (headings.length < 2 || !tocToggle || !tocPanel || !tocNav) {
			tocShell.hidden = true;
			return;
		}

		const list = document.createElement('ol');

		headings.forEach((heading, index) => {
			if (!heading.id) {
				heading.id = `section-${index + 1}-${heading.textContent.trim().toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '')}`;
			}

			const item = document.createElement('li');
			item.className = `toc-level-${heading.tagName.toLowerCase()}`;

			const link = document.createElement('a');
			link.href = `#${heading.id}`;
			link.textContent = heading.textContent.trim();

			item.appendChild(link);
			list.appendChild(item);
		});

		tocNav.appendChild(list);

		const setTocOpenState = (isOpen) => {
			tocShell.classList.toggle('is-open', isOpen);
			tocPanel.hidden = !isOpen;
			tocToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
		};

		setTocOpenState(false);

		tocToggle.addEventListener('click', () => {
			setTocOpenState(tocPanel.hidden);
		});

		tocNav.querySelectorAll('a').forEach((link) => {
			link.addEventListener('click', () => {
				if (!tocWideScreenQuery.matches) {
					setTocOpenState(false);
				}
			});
		});
	}
});