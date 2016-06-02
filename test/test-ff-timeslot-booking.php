<?php

/**
 * An example test case.
 */
class Retreat_Registration_For_Formidable_Forms_Test extends PHPUnit_Framework_TestCase {

    public function setUp() {
          \WP_Mock::setUp();
    }

    public function tearDown() {
          \WP_Mock::tearDown();
    }

    /**
     * An example test.
     *
     * We just want to make sure that false is still false.
     */
    function test_false_is_false() {

        $this->assertFalse( false );
    }


    function test_update_session_booked_field () {
      $ff_tsb = new FF_Timeslot_Booking () ;

      // return something true if right form
      $form_id = 2;
      $this->assertTrue($ff_tsb->update_session_booked_field(null, $form_id));

      // return undef if not the right Formidable
      $form_id = 1000 ;
      $this->assertNull($ff_tsb->update_session_booked_field(null, $form_id));



    }


}
