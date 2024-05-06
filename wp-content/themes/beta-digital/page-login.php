<?php
get_header();
?>
<main>
    <div>
        <h1>Entrar</h1>
        <form name="loginform" id="loginform" action="<?php echo site_url( '/wp-login.php' ); ?>" method="post">
            <p>Email: <input id="user_login" type="text" size="20" value="" name="log"></p>
            <p>Senha: <input id="user_pass" type="password" size="20" value="" name="pwd"></p>
            <p style="display: flex; justify-content: space-between;">
                <span><input id="rememberme" type="checkbox" value="forever" name="rememberme">Lembrar meus dados</span>
                <a href="<?php echo site_URL('recuperar-senha'); ?>" title="Esqueceu sua senha?">Esqueceu sua senha?</a>
            </p>

            <p>
                <input id="wp-submit" type="submit" value="Login" name="wp-submit">
                
            </p> 

            <input type="hidden" value="<?php echo esc_attr( $redirect_to ); ?>" name="redirect_to">
            <input type="hidden" value="1" name="testcookie">
        </form>
    </div>
    <div>
        <h2>Não tenho cadastro</h2>
        <div class="rounded-container  rounded-container--green-light">
            <h2>Como você quer ajudar?</h2>
            <div class="btn btn--primary">
                <a href="<?php echo site_URL('seja-voluntario'); ?>" title="Ser voluntário">Ser voluntário</a>
            </div>
        </div>

        <div class="rounded-container rounded-container--red-light">
            <h2 class="secondary-color">Precisa de ajuda?</h2>
            <div>
                <div class="btn btn--secondary">
                    <a href="<?php echo site_URL('cadastro-de-beneficiario'); ?>" title="Cadastre-se para pedir ajuda">Cadastre-se para pedir ajuda</a>
                </div>
            </div>
        </div>

    </div>
</main>
<?php
get_footer();