<?php get_header(); ?>


<!-- start content container -->
<div class="row">
  <article class="col-md-<?php envo_storefront_main_content_width_columns(); ?>">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div <?php post_class(); ?>>
          <?php envo_storefront_thumb_img('envo-storefront-single', '', false, true); ?>
          <header class="single-head page-head <?php echo esc_attr(has_post_thumbnail() ? 'has-thumbnail' : 'no-thumbnail') ?>">
            <?php the_title('<h1 class="single-title">', '</h1>'); ?>
            <time class="posted-on published" datetime="<?php the_time('Y-m-d'); ?>"></time>
          </header>

          <div class="main-content-page single-content">
            <div class="single-entry-summary">
              <?php do_action('envo_storefront_before_content'); ?>
              <?php the_content(); ?>
              <?php do_action('envo_storefront_after_content'); ?>

              <div class="row">

                <?php
                $pabellones = get_terms(array(
                  'taxonomy'    => 'pabellon',
                  'hide_empty'  => false,
                  'parent'      => 0
                ));
                ?>

                <?php foreach ($pabellones as $pabellon) :  ?>
                  <div class="col-xs-12 col-md-8" style="padding: 4rem;">
                    <a href="<?php echo get_term_link($pabellon->slug, $pabellon->taxonomy); ?>">
                      <button type="button" class="btn btn-primary btn-lg btn-block">
                        <?php echo $pabellon->name; ?>
                      </button>
                    </a>
                  </div>

                  <?php
                  $wsubargs = array(
                    'hierarchical' => 1,
                    'show_option_none' => '',
                    'hide_empty' => 0,
                    'parent' => $pabellon->term_id,
                    'taxonomy' => 'pabellon'
                  );
                  $wsubcats = get_categories($wsubargs);
                  foreach ($wsubcats as $wsc) :
                  ?>
                    <div class="col-xs-12 col-md-8" style="padding-left: 10rem;">
                      <a href="<?php echo get_term_link($wsc->slug, $wsc->taxonomy); ?>">
                        <button type="button" class="btn btn-info btn-lg btn-block">
                          <?php echo $wsc->name; ?>
                        </button>
                      </a>
                    </div>
                  <?php endforeach; ?>


                <?php endforeach; ?>
              </div>
            </div>
            <?php wp_link_pages(); ?>
            <?php comments_template(); ?>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else : ?>
      <?php get_template_part('content', 'none'); ?>
    <?php endif; ?>
  </article>
  <?php get_sidebar('right'); ?>
</div>
<!-- end content container -->

<?php get_footer(); ?>