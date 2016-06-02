<?php
class FF_Timeslot_Booking {

  private $_wpdb;
  private $_frmdb;

  public function __construct($wpdb,$frmdb) {
      $this->_wpdb = $wpdb;
      $this->_frmdb = $frmdb;
  }

  public function get_wpdb () {
    return $this->_wpdb;
  }

  public function get_frmdb () {
    return $this->_frmdb;
  }

  public function update_session_booked_field ($entry_id, $form_id) {

    if ( 2 == $form_id && $this->_wpdb) {
      return true;
    }

  } //function


} //class

?>
