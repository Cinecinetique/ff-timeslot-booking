<?php

class Script_FF_Timeslot_Booking_Test extends PHPUnit_Framework_TestCase {

  public function setUp() {
        WP_Mock::setUp();
  }

  public function tearDown() {
        WP_Mock::tearDown();
  }

  function test_action_hook_is_created () {
    $wpdb = new stdClass;
    $frmdb = new stdClass;

    $main = new FF_Timeslot_Booking_Main () ;

    WP_Mock::expectActionAdded( 'frm_after_create_entry',
                                  array ($this->isInstanceOf ('FF_Timeslot_Booking'), 'update_session_booked_field') ,
                                  45, 2
                                );

    $main->register_ff_timeslot_booking($wpdb, $frmdb);
  }

}
