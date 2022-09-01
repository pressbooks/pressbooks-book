/* eslint import/no-anonymous-default-export: [2, {"allowArrowFunction": true}] */
/**
 * the most terrible camelizer on the internet, guaranteed!
 *
 * @param {string} str String that isn't camel-case, e.g., CAMeL_CaSEiS-harD
 * @returns {string} String converted to camel-case, e.g., camelCaseIsHard
 */
export default str => `${ str.charAt( 0 ).toLowerCase() }${ str.replace( /[\W_]/g, '|' ).split( '|' )
	.map( part => `${ part.charAt( 0 ).toUpperCase() }${ part.slice( 1 ) }` )
	.join( '' )
	.slice( 1 ) }`;
