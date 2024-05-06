<?php
$controller_file = 'app/utils/communs.php';
require_once $controller_file;

$user = wp_get_current_user();

get_header();

?>
<main>
    <?php
        print_r( $user->user_email );
        the_title('<h1>','</h1><hr>');
        the_content();
    ?>
<main>
<script>
    const userData = {
        id: <?php echo( $user->ID ); ?>,
        email: '<?php echo( $user->user_email ); ?>'  
    }
    var emailField = document.querySelector( '[type="email"]' );
    if ( emailField ) {
        emailField.value = userData.email;
    }
    sessionStorage.setItem('userBeneficiario', JSON.stringify(userData));
</script>
<?php

    get_footer();
?>