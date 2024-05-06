<?php
$controller_file = 'app/utils/users.php';
require_once $controller_file;

$user = wp_get_current_user();
$solicitacoes = \Users\Data::getSolicitacoesByEmail($user->user_email);

get_header();

?>
<main>
<?php
    the_title('<h1>','</h1>');
    ?>
    <div class="btn btn--secondary">
        <a href="<?php echo site_URL('solicitar-ajuda'); ?>" title="Preciso de ajuda">Solicitar nova ajuda</a>
    </div><br>
    <?php
    foreach ($solicitacoes['data'] as $solicitacao) {
 
        $user_data = unserialize($solicitacao->form_value);
        
        ?>
        <div class="rounded-container rounded-container--red-light socilitacao__item">
            <div class="socilitacao__details">
                <h3><?php echo $user_data['titulo'] ?></h3>
                <p><?php echo $user_data['descricao'] ?></p>
            </div>
            <div class="socilitacao__info">
                <ul>
                    <?php foreach ( $user_data['categorias'] as $categoria): ?>
                        <li><?php echo $categoria ?></li>
                    <?php endforeach; ?>
                </ul>
                <p>Quantidade: <?php echo $user_data['quantidade'] ?></p>
                <p>Grau de urgência: 
                    <?php foreach ( $user_data['urgencia'] as $urgencia):
                        echo $urgencia;
                    endforeach; ?>
                </p>

                <p>Endereço: <?php printf('%s, %s, %s - CEP: %s - Cidade: %s', $user_data['logradouro_ajuda'], $user_data['numero_ajuda'], $user_data['complemento_ajuda'], $user_data['cep_ajuda'], $user_data['cidade_ajuda']); ?></p>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="btn btn--secondary">
        <a href="<?php echo site_URL('solicitar-ajuda'); ?>" title="Preciso de ajuda">Solicitar nova ajuda</a>
    </div><br>
    <?php
    $pagination_args = array(
        'base' => esc_url(add_query_arg('paged', '%#%')),
        'format' => '',
        'total' => ceil($solicitacoes['total'] / PER_PAGE),
        'current' => $solicitacoes['current_page'],
        'prev_text' => __('&laquo; Anterior'),
        'next_text' => __('Próximo &raquo;'),
    );
?>
    <div class="pagination"><?php echo paginate_links($pagination_args); ?></div>
    
<main>
<?php
get_footer();
?>