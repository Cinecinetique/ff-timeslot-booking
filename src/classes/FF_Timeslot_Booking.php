<?php
class FF_Timeslot_Booking {

  private $_wpdb;

  public function __construct($wpdb) {
      $this->_wpdb = $wpdb;
  }

  public function update_session_booked_field ($entry_id, $form_id) {

    if ( 2 == $form_id && $this->_wpdb) {
      return true;
    }

  } //function


} //class

?>
