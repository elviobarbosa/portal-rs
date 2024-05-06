<?php
function cad_agenda() {
  
  if ( is_user_logged_in() ) {
    $userID = get_current_user_id();
    $agendaIDs = get_user_meta($userID, 'agenda_de_eventos');
    $metaID = $_GET['meta_id'];
    $metaID = str_replace("str,","", $metaID);

    if ( count($agendaIDs) == 0 ) :
      $results = true;
      add_user_meta( $userID, 'agenda_de_eventos',  $metaID);
    else:
      update_user_meta( $userID, 'agenda_de_eventos',  $metaID);
      $results = true;
    endif;

  } else {
    $results = false;
  }

  $data['success'] = $results;  
  echo json_encode($data);
  die();
}
  
  add_action('wp_ajax_cad_agenda', 'cad_agenda');
  add_action('wp_ajax_nopriv_cad_agenda', 'cad_agenda');