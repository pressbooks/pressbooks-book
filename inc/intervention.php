<?php
/**
 * Admin Interventions
 *
 * @see https://github.com/soberwp/intervention/
 */

use function \Sober\Intervention\intervention;

intervention( 'remove-emoji' );
intervention( 'remove-howdy', __( 'Hello,', 'pressbooks-book' ) );
