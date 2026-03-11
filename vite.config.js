import { createWpViteConfig } from 'pressbooks-build-tools';
import { resolve } from 'path';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default createWpViteConfig({
	input: {
		// Main theme script (imports book.scss)
		'scripts/book': resolve(__dirname, 'assets/src/scripts/book.js'),
		// Pane script for Hypothesis integration
		'scripts/pane': resolve(__dirname, 'assets/src/scripts/pane.js'),
		// Collapse sections script
		'scripts/collapse-sections': resolve(__dirname, 'assets/src/scripts/collapse-sections.js'),
		// Lightbox script (imports lity CSS)
		'scripts/lightbox': resolve(__dirname, 'assets/src/scripts/lightbox.js'),
		// Legacy web-house-style (standalone CSS for older themes)
		'styles/web-house-style': resolve(__dirname, 'assets/legacy/styles/web-house-style.scss'),
	},
	outDir: 'assets/dist',
	css: {
		preprocessorOptions: {
			scss: {
				loadPaths: [resolve(__dirname, 'node_modules')],
			},
		},
	},
	plugins: [
		viteStaticCopy({
			targets: [
				{ src: 'assets/src/images/*', dest: 'images' },
			],
		}),
	],
});
