<?php

use \Mockery as m;

class FF_Timeslot_Booking_Test extends PHPUnit_Framework_TestCase {

    private $session_field_id_in_booking_form ;
    private $email_field_id_in_booking_form ;
    private $booked_field_id_in_session_form ;
    private $email_field_id_in_session_form ;
    private $fake_session_id ;
    private $fake_email ;

    public function setUp() {
          $session_field_id_in_booking_form = 103 ;
          $booked_field_id_in_session_form = 44 ;
          $email_field_id_in_booking_form = 13 ;
          $fake_session_id = 71 ;
          $fake_email = "foo@bar.com" ;
          $_POST['item_meta'] = array (
            $session_field_id_in_booking_form => $fake_session_id,
            $email_field_id_in_booking_form => $fake_email
          ) ;
    }

    public function tearDown() {
      m::close() ;
    }


    function test_class_can_be_instantiated () {
      $wpdb = new stdClass;
      $frmdb = new stdClass;
      $tsb = new FF_Timeslot_Booking ($wpdb, $frmdb) ;

      $this->assertNotNull($tsb->get_wpdb()) ;
      $this->assertNotNull($tsb->get_frmdb()) ;
    }

    function test_action_verifies_form_parameter () {
      $wpdb = m::mock ('wpdb') ;
      $frmdb = new stdClass ;

      $wpdb->shouldReceive('replace') ;

      $frmdb->entry_metas = array (1,2) ;

      $tsb = new FF_Timeslot_Booking ($wpdb, $frmdb) ;

      // return something true if right form
      $form_id = 2;
      $this->assertTrue($tsb->update_session_booked_field(null, $form_id)) ;

      // return undef if not the right form
      $form_id = 1000 ;
      $this->assertNull($tsb->update_session_booked_field(null, $form_id)) ;

    }

    function test_booked_field_in_session_is_updated () {

      $fake_session_id = 71 ;
      $booked_field_id_in_session_form = 44 ;
      $email_field_id_in_session_form = 102 ;
      $entry_metas = 1 ;
      $client_email = "foo@bar.com";
      $form_id = 2 ;

      $wpdb = m::mock('wpdb') ;
      $frmdb = new stdClass ;

      $frmdb->entry_metas = $entry_metas ;

      $tsb = new FF_Timeslot_Booking ($wpdb, $frmdb) ;

      $wpdb->shouldReceive('replace')
            ->with(
              $entry_metas,
              array ('meta_value' => 'Yes' ),
              array ('item_id' => $fake_session_id , 'field_id' => $booked_field_id_in_session_form )
            )
            ->times(1)
            ->andReturn(1) ;

      $wpdb->shouldReceive('replace')
            ->with(
              $entry_metas,
              array ('meta_value' => $client_email ),
              array ('item_id' => $fake_session_id , 'field_id' => $email_field_id_in_session_form )
            )
            ->times(1)
            ->andReturn(1) ;

      $tsb->update_session_booked_field(null, $form_id) ;


    }


    /**
     * @expectedException Exception
     * @expectedExceptionMessage Error updating the booked flag field: db
     */
    function test_booked_flag_update_error_throws_exception () {

      $fake_session_id = 71 ;
      $booked_field_id_in_session_form = 44 ;
      $email_field_id_in_session_form = 102 ;
      $entry_metas = 1 ;
      $client_email = "foo@bar.com";
      $form_id = 2 ;

      $wpdb = m::mock('stdClass')->makePartial() ;
      $wpdb->last_error = 'db' ;
      $frmdb = new stdClass ;

      $frmdb->entry_metas = $entry_metas ;

      $tsb = new FF_Timeslot_Booking ($wpdb, $frmdb) ;

      $wpdb->shouldReceive('replace')
            ->with(
              $entry_metas,
              array ('meta_value' => 'Yes' ),
              array ('item_id' => $fake_session_id , 'field_id' => $booked_field_id_in_session_form )
            )
            ->once()
            ->andReturn(false) ;

      $wpdb->shouldReceive('replace')
            ->never() ;

      $tsb->update_session_booked_field(null, $form_id) ;


    }
    /**
     * @expectedException Exception
     * @expectedExceptionMessage Error updating the email field: db
     */
    function test_email_update_error_throws_exception () {

      $fake_session_id = 71 ;
      $booked_field_id_in_session_form = 44 ;
      $email_field_id_in_session_form = 102 ;
      $entry_metas = 1 ;
      $client_email = "foo@bar.com";
      $form_id = 2 ;

      $wpdb = m::mock('stdClass')->makePartial() ;
      $wpdb->last_error = 'db' ;
      $frmdb = new stdClass ;

      $frmdb->entry_metas = $entry_metas ;

      $tsb = new FF_Timeslot_Booking ($wpdb, $frmdb) ;

      $wpdb->shouldReceive('replace')
            ->with(
              $entry_metas,
              array ('meta_value' => 'Yes' ),
              array ('item_id' => $fake_session_id , 'field_id' => $booked_field_id_in_session_form )
            )
            ->once()
            ->andReturn(1) ;

      $wpdb->shouldReceive('replace')
            ->with(
              $entry_metas,
              array ('meta_value' => $client_email ),
              array ('item_id' => $fake_session_id , 'field_id' => $email_field_id_in_session_form )
            )
            ->once()
            ->andReturn(false) ;

      $tsb->update_session_booked_field(null, $form_id) ;


    }


}
