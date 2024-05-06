<?php
$controller_file = 'app/utils/users.php';
require_once $controller_file;
$beneficiarios = \Users\data::getSolicitacoes();

get_header();

?>
<main>
<?php
    the_title('<h1>','</h1>');
    foreach ($beneficiarios['data'] as $beneficiario) {

        $user_data = unserialize($beneficiario->form_value);
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

                <div class="btn btn--primary">
                    <a href="<?php echo add_query_arg(
                        array(
                            'email' => $user_data['email'],
                            'id' => $beneficiario->form_id
                        ),
                        site_URL('detalhes-ajuda')); ?>" title="Ver mais">Ver mais</a>
                </div>
            </div>
        </div>
       
        <?php
    }

    $pagination_args = array(
        'base' => esc_url(add_query_arg('paged', '%#%')),
        'format' => '',
        'total' => ceil($beneficiarios['total'] / PER_PAGE),
        'current' => $beneficiarios['current_page'],
        'prev_text' => __('&laquo; Anterior'),
        'next_text' => __('Próximo &raquo;'),
    );
?>
    <div class="pagination"><?php echo paginate_links($pagination_args); ?></div>
<main>
<?php
get_footer();
?>