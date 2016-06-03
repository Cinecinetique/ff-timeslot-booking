<?php

class FF_Timeslot_Booking_Test extends PHPUnit_Framework_TestCase {

    private $session_field_id_in_booking_form ;
    private $booked_field_id_in_session_form ;
    private $fake_session_id ;

    public function setUp() {
          \WP_Mock::setUp();
          $session_field_id_in_booking_form = 103 ;
          $booked_field_id_in_session_form = 44 ;
          $fake_session_id = 71 ;
          $_POST['item_meta'] = array ( $session_field_id_in_booking_form => $fake_session_id) ;
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
      $wpdb = $this->getMockBuilder('Wpdb')
              ->disableOriginalConstructor()
              ->setMethods(array ('update'))
              ->getMock();
      $frmdb = $this->getMockBuilder('Frmdb')
              ->disableOriginalConstructor()
              ->setMethods(array ('entry_metas'))
              ->getMock();

      $frmdb->method('entry_metas')
              ->willReturn(1);


      $tsb = new FF_Timeslot_Booking ($wpdb, $frmdb) ;

      // return something true if right form
      $form_id = 2;
      $this->assertTrue($tsb->update_session_booked_field(null, $form_id));

      // return undef if not the right form
      $form_id = 1000 ;
      $this->assertNull($tsb->update_session_booked_field(null, $form_id));

    }

    function test_booked_field_in_session_is_updated () {

      $fake_session_id = 71 ;
      $booked_field_id_in_session_form = 44 ;
      $item_metas = 1 ;
      $form_id = 2 ;

      $wpdb = $this ->getMockBuilder('Db')
                    ->disableOriginalConstructor()
                    ->setMethods(array ('update'))
                    ->getMock();

      $frmdb = $this->getMockBuilder('FrmDb')
                    ->disableOriginalConstructor()
                    ->setMethods(array ('entry_metas'))
                    ->getMock();

      $tsb = new FF_Timeslot_Booking ($wpdb, $frmdb) ;

      $frmdb->expects($this->once())
            ->method('entry_metas')
            ->willReturn($item_metas);

      $wpdb->expects($this->once())
            ->method('update')
            ->with(
            $item_metas,
            array ('meta_value' => 'Yes' ),
            array ('item_id' => $fake_session_id , 'field_id' => $booked_field_id_in_session_form )
            ) ;

      $tsb->update_session_booked_field(null, $form_id) ;


    }


}
