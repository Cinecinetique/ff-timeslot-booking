<?php

class FF_Timeslot_Booking_Test extends PHPUnit_Framework_TestCase {

    public function setUp() {
          \WP_Mock::setUp();
    }

    public function tearDown() {
          \WP_Mock::tearDown();
    }


    function test_class_can_be_instantiated () {
      $wpdb = new \stdClass;
      $frmdb = new \stdClass;
      $tsb = new FF_Timeslot_Booking ($wpdb, $frmdb) ;

      $this->assertNotNull($tsb->get_wpdb());
      $this->assertNotNull($tsb->get_frmdb());
    }

    function test_action_verifies_form_parameter () {
      $wpdb = new \stdClass;
      $frmdb = new \stdClass;
      $tsb = new FF_Timeslot_Booking ($wpdb, $frmdb) ;

      // return something true if right form
      $form_id = 2;
      $this->assertTrue($tsb->update_session_booked_field(null, $form_id));

      // return undef if not the right form
      $form_id = 1000 ;
      $this->assertNull($tsb->update_session_booked_field(null, $form_id));

    }

    function test_booked_field_in_session_is_updated () {

      $session_id_in_booking_form = 103 ;
      $fake_session_id = 71 ;
      $_POST['item_meta'] = array( $session_id_in_booking_form => $fake_session_id) ;

      $wpdb = $this->getMockBuilder('Db')
                 ->setMethods(array('update'))
                 ->getMock();

      $frmdb = $this->getMockBuilder('FrmDb')
                 ->setMethods(array('item_metas'))
                 ->getMock();

      $tsb = new FF_Timeslot_Booking ($wpdb, $frmdb) ;

      $item_metas = [] ;
      $frmdb->expects($this->once())
            ->method('item_metas')
            ->willReturn($item_metas);

      $wpdb->expects($this->once())
            ->method('update')
            ->with(
            $item_metas,
            array($this->equalTo('meta_value'), "Yes" ),
            array($this->equalTo('item_id'), $fake_session_id )
            ) ;
    }


}
