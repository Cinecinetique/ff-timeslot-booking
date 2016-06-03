<?php
/**
 * @package FF_Timeslot_Booking
 * @version 1.0
 */
/*
Plugin Name: Timeslot Booking For Formidable Forms
Plugin URI: https://cinecinetique.com
Description: Add functions to a Formidable form for booking time slots.
Author: Rija Ménagé
Version: 1.0
Author URI: https://cinecinetique.com
*/


global $wpdb, $frmdb;

require (__DIR__ . '/classes/FF_Timeslot_Booking.php') ;


$timeslot_booking = new FF_Timeslot_Booking($wpdb, $frmdb);

add_action('frm_after_create_entry', array ($timeslot_booking, 'update_session_booked_field'), 30, 2);
