<?php
/**
 * Template Name: Recuperar Senha
 *
 * @package WordPress
 */

get_header();

// Verifica se o usuário já está logado
if ( is_user_logged_in() ) {
    echo '<p>Você já está logado!</p>';
} else {
    // Exibe o formulário de recuperação de senha
    ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <h1>Recuperar Senha</h1>
            <form method="post">
                <label for="user_login">Email</label>
                <p><input type="text" id="user_login" name="user_login" required></p>
                <input type="submit" name="submit" value="Recuperar Senha">
                <?php
                $error = '';
                if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
                    $user_input = trim($_POST['user_login']);

                    if ( empty($user_input) ) {
                        $error = 'Por favor, insira o email.';
                    } else {
                        $user = get_user_by('login', $user_input) ?: get_user_by('email', $user_input);

                        if ( $user ) {
                            retrieve_password($user->user_login);
                            echo '<p>Um link de redefinição de senha foi enviado para o seu email.</p>';
                        } else {
                            $error = 'Usuário não encontrado.';
                        }
                    }
                }

                if ( ! empty($error) ) {
                    echo '<p class="error">' . $error . '</p>';
                }
                ?>
            </form>
        </main>
    </div>
    <?php
}
get_footer();
?>
