// import external dependencies

// import local dependencies
import common from './routes/common';
import home from './routes/home';
import single from './routes/single';
import Router from './util/Router';

/** Populate Router instance with DOM routes */
const routes = new Router( {
	// All pages
	common,
	// Home page
	home,
	// Single reading view
	single,
} );

// Load Events
jQuery( document ).ready( () => routes.loadEvents() );
