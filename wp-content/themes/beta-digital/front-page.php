<?php get_header();?>

<main <?php post_class('front-page') ?>>

   <div class="front-page__intro">
      <h1>Ajude as vítimas dos temporais no Rio Grande do Sul</h1>
      <p>Neste momento de crise, estamos unidos para oferecer apoio às comunidades afetadas pelos devastadores temporais que assolam o Rio Grande do Sul.</p>
      <p>Nosso site é um ponto de encontro para todos que precisam de ajuda e os que desejam contribuir.</p>
      <p>Junte-se a nós nesta missão de esperança e ajuda mútua.</p>

   </div>

   <div class="rounded-container  rounded-container--green-light">
      <h2>Como você quer ajudar?</h2>
      <div class="btn btn--primary">
         <a href="<?php echo site_URL('seja-voluntario'); ?>" title="Ser voluntário">Ser voluntário</a>
      </div>

      <!-- <div class="btn btn--primary">
         <a href="<?php echo site_URL('seja-voluntario'); ?>" title="Doar">Apadrinhar</a>
      </div> -->
   </div>

   <div class="rounded-container rounded-container--red-light">
      <h2 class="secondary-color">Precisa de ajuda?</h2>

      <div>
         <div class="btn btn--secondary">
            <a href="<?php echo site_URL('preciso-de-ajuda'); ?>" title="Preciso de ajuda">Preciso de ajuda</a>
         </div>
      </div>
   
</main>


<?php get_footer(); ?>
