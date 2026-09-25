// Asian Dreams : scripts du site (menu mobile, galerie, plan de page).
// Le site reste utilisable sans JavaScript : ces scripts ne font qu'améliorer l'existant.

document.addEventListener('DOMContentLoaded', () => {
	initMobileMenu();
	initGallery();
	initTableOfContents();
});

// Menu mobile : bouton burger accessible (aria-expanded), fermeture avec Échap
function initMobileMenu() {
	const toggle = document.querySelector('.nav-toggle');
	const nav = document.getElementById('site-nav');
	if (!toggle || !nav) return;

	const setOpen = (open) => {
		toggle.setAttribute('aria-expanded', String(open));
		nav.classList.toggle('is-open', open);
	};

	toggle.addEventListener('click', () => {
		setOpen(toggle.getAttribute('aria-expanded') !== 'true');
	});

	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
			setOpen(false);
			toggle.focus();
		}
	});

	nav.addEventListener('click', (event) => {
		if (event.target.closest('a')) setOpen(false);
	});
}

// Galerie : défilement horizontal avec boutons, lecture automatique mise en pause
// au survol, au focus, ou si l'utilisateur préfère réduire les animations.
function initGallery() {
	const gallery = document.querySelector('.gallery');
	if (!gallery) return;

	const track = gallery.querySelector('.gallery__track');
	const toggleBtn = gallery.querySelector('[data-gallery="toggle"]');
	const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	const delay = 4500;

	let timer = null;
	let userPaused = reduceMotion;

	const step = () => {
		const slide = track.querySelector('.gallery__slide');
		return slide ? slide.getBoundingClientRect().width + 16 : track.clientWidth;
	};

	const move = (direction) => {
		const atEnd = track.scrollLeft + track.clientWidth >= track.scrollWidth - 4;
		const atStart = track.scrollLeft <= 4;
		if (direction > 0 && atEnd) {
			track.scrollTo({ left: 0, behavior: reduceMotion ? 'auto' : 'smooth' });
		} else if (direction < 0 && atStart) {
			track.scrollTo({ left: track.scrollWidth, behavior: reduceMotion ? 'auto' : 'smooth' });
		} else {
			track.scrollBy({ left: direction * step(), behavior: reduceMotion ? 'auto' : 'smooth' });
		}
	};

	const stop = () => {
		clearInterval(timer);
		timer = null;
	};

	const start = () => {
		if (userPaused || timer) return;
		timer = setInterval(() => move(1), delay);
	};

	const syncToggle = () => {
		if (!toggleBtn) return;
		toggleBtn.setAttribute('aria-pressed', String(userPaused));
		toggleBtn.setAttribute('aria-label', userPaused ? gallery.dataset.labelPlay : gallery.dataset.labelPause);
		toggleBtn.textContent = userPaused ? '▶' : '❚❚';
	};

	gallery.querySelector('[data-gallery="prev"]')?.addEventListener('click', () => move(-1));
	gallery.querySelector('[data-gallery="next"]')?.addEventListener('click', () => move(1));
	toggleBtn?.addEventListener('click', () => {
		userPaused = !userPaused;
		userPaused ? stop() : start();
		syncToggle();
	});

	gallery.addEventListener('mouseenter', stop);
	gallery.addEventListener('mouseleave', start);
	gallery.addEventListener('focusin', stop);
	gallery.addEventListener('focusout', start);
	document.addEventListener('visibilitychange', () => (document.hidden ? stop() : start()));

	syncToggle();
	start();
}

// Plan de page : met en évidence la section visible
function initTableOfContents() {
	const links = document.querySelectorAll('.toc a[href^="#"]');
	if (!links.length || !('IntersectionObserver' in window)) return;

	const byId = new Map();
	links.forEach((link) => byId.set(link.getAttribute('href').slice(1), link));

	const observer = new IntersectionObserver(
		(entries) => {
			entries.forEach((entry) => {
				if (!entry.isIntersecting) return;
				links.forEach((link) => link.classList.remove('is-active'));
				byId.get(entry.target.id)?.classList.add('is-active');
			});
		},
		{ rootMargin: '-20% 0px -65% 0px' }
	);

	byId.forEach((_, id) => {
		const section = document.getElementById(id);
		if (section) observer.observe(section);
	});
}
