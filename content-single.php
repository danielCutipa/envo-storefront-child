<!-- start content container -->
<div class="row">
    <article class="col-md-<?php envo_storefront_main_content_width_columns(); ?>">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php $taxonomy = get_the_terms(get_the_ID(), 'standtax'); ?>

                <div <?php post_class(); ?>>
                    <?php envo_storefront_thumb_img('envo-storefront-single', '', false, true); ?>
                    <div class="single-head <?php echo esc_attr(has_post_thumbnail() ? 'has-thumbnail' : 'no-thumbnail') ?>">
                        <?php the_title('<h1 class="single-title">', '</h1>'); ?>
                    </div>
                    <div class="single-content">
                        <div class="single-entry-summary">
                            <?php do_action('envo_storefront_before_content'); ?>
                            <?php the_content(); ?>

                            <?php
                            $args = array(
                                'post_type' => 'product',
                                'posts_per_page' => -1,
                                'order' => 'ASC',
                                'orderby' => 'title',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'standtax',
                                        'field' => 'slug',
                                        'terms' => $taxonomy[0]->slug
                                    )
                                )
                            );

                            $products = new WP_Query($args);
                            $product_ids = "";

                            if ($products->have_posts()) : while ($products->have_posts()) :
                                    $products->the_post();
                                    if (strlen($product_ids) == 0) :
                                        $product_ids .= $products->post->ID;
                                    else :
                                        $product_ids .= ", " . $products->post->ID;
                                    endif;
                                endwhile;
                            endif;

                            if (strlen($product_ids) == 0) :
                                echo '<h1 class="single-title" style="margin: 4rem auto;">¡La empresa no tiene productos y/o servicios!</h1>';

                            else :
                                echo '<h1 class="single-title" style="margin: 4rem auto;">Productos y servicios de la empresa</h1>';

                                echo do_shortcode('[products ids="' . $product_ids . '"]');
                            endif;
                            ?>

                            <?php do_action('envo_storefront_after_content'); ?>
                        </div><!-- .single-entry-summary -->
                        <?php wp_link_pages(); ?>
                        <?php envo_storefront_entry_footer(); ?>
                    </div>
                    <?php envo_storefront_prev_next_links(); ?>
                    <?php
                    $authordesc = get_the_author_meta('description');
                    if (!empty($authordesc)) {
                    ?>
                        <div class="single-footer row">
                            <div class="col-md-4">
                                <?php get_template_part('template-parts/template-part', 'postauthor'); ?>
                            </div>
                            <div class="col-md-8">
                                <?php comments_template(); ?>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="single-footer">
                            <?php comments_template(); ?>
                        </div>
                    <?php } ?>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <?php get_template_part('content', 'none'); ?>
        <?php endif; ?>
    </article>
    <?php get_sidebar('right'); ?>
</div>
<!-- end content container -->