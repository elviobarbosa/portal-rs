<?php get_header();?>

<main <?php post_class() ?>>

  <?php
  the_title('<h1>', '</h1><hr>');
  the_content(); ?>
   
</main>


<?php get_footer(); ?>
