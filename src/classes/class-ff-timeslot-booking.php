<?php
class FF_Timeslot_Booking {

  const BOOKING_FORM_ID = 2 ;
  const SESSION_FIELD_ID_IN_BOOKING_FORM = 103 ;
  const EMAIL_FIELD_ID_IN_BOOKING_FORM = 13 ;
  const BOOKED_FIELD_ID_IN_SESSION_FORM = 44 ;
  const EMAIL_FIELD_ID_IN_SESSION_FORM = 102 ;

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

    $session_id = $_POST['item_meta'][self::SESSION_FIELD_ID_IN_BOOKING_FORM];
    $client_email = $_POST['item_meta'][self::EMAIL_FIELD_ID_IN_BOOKING_FORM];

    if ( self::BOOKING_FORM_ID == $form_id && $this->_wpdb && $this->_frmdb) {


      $this->_wpdb->update(
        $this->_frmdb->entry_metas,
        array ( 'meta_value' => 'Yes' ),
        array ( 'item_id' => $session_id, 'field_id' => self::BOOKED_FIELD_ID_IN_SESSION_FORM )
      );

      $this->_wpdb->update(
        $this->_frmdb->entry_metas,
        array ( 'meta_value' => $client_email ),
        array ( 'item_id' => $session_id, 'field_id' => self::EMAIL_FIELD_ID_IN_SESSION_FORM )
      );


      return true;
    }

  } //function


} //class

?>
