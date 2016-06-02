<?php

/**
 * An example test case.
 */
class FF_Timeslot_Booking_Test extends PHPUnit_Framework_TestCase {

    public function setUp() {
          \WP_Mock::setUp();
    }

    public function tearDown() {
          \WP_Mock::tearDown();
    }


    function test_booked_field_in_session_is_updated () {
      $wpdb = new \stdClass;
      $tsb = new FF_Timeslot_Booking ($wpdb) ;

      // return something true if right form
      $form_id = 2;
      $this->assertTrue($tsb->update_session_booked_field(null, $form_id));

      // return undef if not the right Formidable
      $form_id = 1000 ;
      $this->assertNull($tsb->update_session_booked_field(null, $form_id));


    }


}
