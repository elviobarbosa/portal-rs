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
    foreach ($solicitacoes as $solicitacao) {
   // echo $solicitacao->form_id;
        $user_data = unserialize($solicitacao->form_value);
        //print_r($user_data);
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

    $pagination_args = array(
        'base' => esc_url(add_query_arg('paged', '%#%')),
        'format' => '',
        'total' => ceil(5 / 1),
        'current' => 1,
        'prev_text' => __('&laquo; Anterior'),
        'next_text' => __('Próximo &raquo;'),
    );
    
    echo paginate_links($pagination_args);
?>
    
<main>
<?php
get_footer();
?>