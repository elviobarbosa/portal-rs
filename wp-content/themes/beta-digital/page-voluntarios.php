<?php
$controller_file = 'app/utils/users.php';
require_once $controller_file;
$voluntarios = \Users\data::getVoluntarios();

get_header();

?>
<main>
<?php
the_title('<h1>','</h1>');
    foreach ($voluntarios['data'] as $voluntario) {
        $user_data = Array();

        if ($voluntario->form_value !== null && is_string($voluntario->form_value)) {
            $user_data = unserialize($voluntario->form_value);
            
        }
       
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
                Onde deseja atuar: <strong><?php echo $user_data['cidade_atuacao']; ?></strong><br>
                Resumo: <br>
                <strong><?php echo $user_data['resumo_atuacao']; ?></strong><br>
            </div>
        </div>
       
        <?php
    }

    $pagination_args = array(
        'base' => esc_url(add_query_arg('paged', '%#%')),
        'format' => '',
        'total' => ceil($voluntarios['total'] / PER_PAGE),
        'current' => $voluntarios['current_page'],
        'prev_text' => __('&laquo; Anterior'),
        'next_text' => __('Próximo &raquo;'),
    );
?>
    <div class="pagination"><?php echo paginate_links($pagination_args); ?></div>
    
<main>
<?php
get_footer();
?>