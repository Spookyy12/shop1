<?php get_header(); ?>

<main class="container page-wrapper">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <header class="page-header">
            <h1 class="page-title"><?php the_title(); ?></h1>
        </header>

        <div class="page-content">
            <?php the_content(); ?>
        </div>

    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
