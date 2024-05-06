<?php 
$controller_file = 'app/controllers/forms.php';
require_once $controller_file;

if (isset($_GET['email']) && !isset($_GET['code'])):
    $createCode = \Forms\Controller::createCodeValidator($_GET['email'], 'beneficiario');
endif;

if (isset($_GET['email']) && isset($_GET['code'])):
    $createCode = \Forms\Controller::confirmUser($_GET['email'], $_GET['code']);
    if ($createCode['success'] == true):
        $createUser = \Forms\Controller::createWPUser($_GET['email'], 'beneficiario');
    endif;
endif;

get_header();
?>
 <?php if (isset($_GET['email']) || isset($_GET['code'])): 
    print_r($createUser);
    ?>
    <main <?php post_class('confirmar-beneficiario') ?>>
        <h1><?php echo $createCode['title'] ?></h1>
        <p><?php echo $createCode['message'] ?></p>

        <?php if (isset($_GET['email']) && !isset($_GET['code'])): ?>
            <hr>
            <p class="text--small">Não recebeu o email? <a href="<?php echo site_URL('confirmar-beneficiario?email='.$_GET['email'].''); ?>" title="Enviar novamento">Enviar novamente.</a></p>
        <?php endif; ?>
    </main>
<?php endif; ?>

<?php get_footer(); ?>