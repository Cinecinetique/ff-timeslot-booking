<?php
class FF_Timeslot_Booking {

  const SESSION_BOOKED_FIELD_ID = 44 ;
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

    if ( 2 == $form_id && $this->_wpdb && $this->_frmdb) {

      $session_id = $_POST['item_meta'][103];
      $this->_wpdb->update(
        $this->_frmdb->entry_metas(),
        array ( 'meta_value' => "Yes" ),
        array ( 'item_id' => $session_id, 'field_id' => self::SESSION_BOOKED_FIELD_ID )
      );
      return true;
    }

  } //function


} //class

?>
