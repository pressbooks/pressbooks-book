const puppeteer = require( 'puppeteer' );
const expect = require( 'chai' ).expect;
const { before, after } = require( 'mocha' );
const { startServer } = require( 'polyserve' );
const fs = require( 'fs' );
const PNG = require( 'pngjs' ).PNG;
const pixelmatch = require( 'pixelmatch' );
const testDir = './tests/output/images';
const goldenDir = './tests/source/images/golden';

describe( 'Compare screenshots.', function () {
	let polyserve, browser, page;
	before( async function () {
		polyserve = await startServer( {
 root: 'tests/',
port: 4000 
} );
		if ( ! fs.existsSync( testDir ) ) fs.mkdirSync( testDir );
	} );

	after( done => polyserve.close( done ) );

	beforeEach( async function () {
		browser = await puppeteer.launch();
		page = await browser.newPage();
	} );

	afterEach( () => browser.close() );

	describe( 'Image layouts.', function () {
		this.timeout( 5000 );

		beforeEach( async function () {
			this.timeout( 2500 );
			return page.setViewport( {
 width: 600,
height: 6000 
} );
		} );
		it( 'Images (small).', async function () {
			return takeAndCompareScreenshot( page, 'small', 'images' );
		} );
		it( 'Images (large).', async function () {
			return takeAndCompareScreenshot( page, 'large', 'images' );
		} );
		it( 'Images (small, with captions.).', async function () {
			return takeAndCompareScreenshot( page, 'small-captioned', 'images' );
		} );
		it( 'Images (large, with captions).', async function () {
			return takeAndCompareScreenshot( page, 'large-captioned', 'images' );
		} );
		it( 'Textboxes (shaded).', async function () {
			return takeAndCompareScreenshot( page, 'shaded', 'textboxes' );
		} );
	} );
} );

async function takeAndCompareScreenshot( page, route, feature ) {
	let fileName = feature + '/' + ( route ? route : 'index' );
	if ( ! fs.existsSync( `${testDir}/${feature}` ) )
		fs.mkdirSync( `${testDir}/${feature}` );
	await page.goto( `http://127.0.0.1:4000/features/${feature}/${route}` );
	await page.screenshot( { path: `${testDir}/${fileName}.png` } );
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
			if ( ++filesRead < 2 ) return;

			// The files should be the same size.
			expect( img1.width, 'Image widths are the same' ).equal( img2.width );
			expect( img1.height, 'Image heights are the same' ).equal( img2.height );

			// Do the visual diff.
			const diff = new PNG( {
 width: img1.width,
height: img2.height 
} );
			const numDiffPixels = pixelmatch(
				img1.data,
				img2.data,
				diff.data,
				img1.width,
				img1.height,
				{ threshold: 0.1 }
			);

			// The files should look the same.
			expect( numDiffPixels, 'Number of different pixels' ).equal( 0 );
			resolve();
		}
	} );
}
