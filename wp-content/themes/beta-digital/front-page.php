<?php 
$user = wp_get_current_user();
$user_role = $user->roles[0];

if ($user_role == 'beneficiario') {
   wp_redirect(site_URL('minhas-solicitacoes'));
   exit;   
}
wp_redirect(site_URL('login'));

?>


