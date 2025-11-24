import '@hotwired/turbo';
import './stimulus_bootstrap.js';

/**
 * This is the _only_ piece of JavaScript I've had to write for this entire project.
 *
 * Grr.
 */
document.addEventListener('turbo:before-render', (event) => {
	if (document.startViewTransition && document.querySelector('meta[name="view-transition"]')) {
		event.preventDefault();

		document.startViewTransition(() => {
			event.detail.resume();
		});
	}
});
