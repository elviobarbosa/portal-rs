<?php
$controller_file = 'app/utils/users.php';
require_once $controller_file;
$beneficiario = \Users\data::getBeneficiarioByEmail($_GET['email']);
$solicitacao = \Users\data::getSolicitacaoByID($_GET['id']);

$user_data = unserialize($beneficiario[0]->form_value);
get_header();

?>
<main>
<?php
the_title('<h1>','</h1>');
?>
    <div class="rounded-container rounded-container--green-light socilitacao__item">
            <div class="socilitacao__details">
                <h3><?php echo $user_data['nome'] ?></h3>
                Email: <strong><?php echo $user_data['email'] ?></strong><br>
                Telefone: <strong><?php echo $user_data['telefone'] ?></strong><br>
                Endereço: <strong><?php printf('%s, %s - %s', $user_data['logradouro'], $user_data['numero'], $user_data['complemento']); ?></strong>
                | CEP: <strong><?php echo $user_data['cep']; ?></strong>
                | Cidade: <strong><?php echo $user_data['cidade']; ?></strong>
                - <strong><?php echo $user_data['estado']; ?></strong><br>
                
            </div>
        </div>
<?php

    

        $user_data = unserialize($solicitacao);
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