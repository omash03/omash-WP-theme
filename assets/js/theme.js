const cit351ThemeStorageKey = 'cit351-theme';
const cit351Root = document.documentElement;

const cit351ReadTheme = () => {
	const activeTheme = cit351Root.getAttribute('data-theme');

	if (activeTheme === 'light' || activeTheme === 'dark') {
		return activeTheme;
	}

	return 'dark';
};

const cit351WriteTheme = (theme) => {
	cit351Root.setAttribute('data-theme', theme);
	cit351Root.style.colorScheme = theme;

	try {
		window.localStorage.setItem(cit351ThemeStorageKey, theme);
	} catch (error) {
		// Ignore storage access issues.
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
			cit351WriteTheme(activeTheme);
			cit351SyncThemeToggles(activeTheme);
		});
	});

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
			link.addEventListener('click', closeMenu);
		});
	}

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