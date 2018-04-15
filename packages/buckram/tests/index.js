const puppeteer = require( 'puppeteer' );
const expect = require( 'chai' ).expect;
const { startServer } = require( 'polyserve' );
const testDir = '';

describe( '👀 screenshots are correct', function () {
	let polyserve, browser, page;

	// This is ran when the suite starts up.
	before( async function () {
		// This is where you would substitute your python or Express server or whatever.
		polyserve = await startServer( { port: 4000 } );

		// Create the test directory if needed. This and the goldenDir
		// variables are global somewhere.
		if ( ! fs.existsSync( testDir ) ) fs.mkdirSync( testDir );

		// And its wide screen/small screen subdirectories.
		if ( ! fs.existsSync( `${testDir}/wide` ) ) fs.mkdirSync( `${testDir}/wide` );
		if ( ! fs.existsSync( `${testDir}/narrow` ) ) fs.mkdirSync( `${testDir}/narrow` );
	} );

	// This is ran when the suite is done. Stop your server here.
	after( done => polyserve.close( done ) );

	// This is ran before every test. It's where you start a clean browser.
	beforeEach( async function () {
		browser = await puppeteer.launch();
		page = await browser.newPage();
	} );

	// This is ran after every test; clean up after your browser.
	afterEach( () => browser.close() );

	// Wide screen tests!
	describe( 'PDF output', function () {
		beforeEach( async function () {
			return page.setViewport( { width: 800, height: 600 } );
		} );
		it( '/', async function () {
			return takeAndCompareScreenshot( page, 'view1', 'wide' );
		} );
		// And your other routes, 404, etc.
	} );
} );

// - page is a reference to the Puppeteer page.
// - route is the path you're loading, which I'm using to name the file.
// - filePrefix is either "wide" or "narrow", since I'm automatically testing both.
async function takeAndCompareScreenshot( page, route, filePrefix ) {
	// If you didn't specify a file, use the name of the route.
	let fileName = filePrefix + '/' + ( route ? route : 'index' );

	// Start the browser, go to that page, and take a screenshot.
	await page.goto( `http://127.0.0.1:4000/${route}` );
	await page.screenshot( { path: `${testDir}/${fileName}.png` } );

	// Test to see if it's right.
	return compareScreenshots( fileName );
}

function compareScreenshots( fileName ) {
	return new Promise( ( resolve, reject ) => {
		const img1 = fs
			.createReadStream( `${testDir}/${fileName}.png` )
			.pipe( new PNG() )
			.on( 'parsed', doneReading );
		const img2 = fs
			.createReadStream( `${goldenDir}/${fileName}.png` )
			.pipe( new PNG() )
			.on( 'parsed', doneReading );

		let filesRead = 0;
		function doneReading() {
			// Wait until both files are read.
			if ( ++filesRead < 2 ) return;

			// The files should be the same size.
			expect( img1.width, 'image widths are the same' ).equal( img2.width );
			expect( img1.height, 'image heights are the same' ).equal( img2.height );

			// Do the visual diff.
			const diff = new PNG( { width: img1.width, height: img2.height } );
			const numDiffPixels = pixelmatch(
				img1.data,
				img2.data,
				diff.data,
				img1.width,
				img1.height,
				{ threshold: 0.1 }
			);

			// The files should look the same.
			expect( numDiffPixels, 'number of different pixels' ).equal( 0 );
			resolve();
		}
	} );
}
