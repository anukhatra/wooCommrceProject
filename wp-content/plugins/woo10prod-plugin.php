<?php
/*

Plugin Name: woo10prod-plugin

*/


function add_products()
{
    $args = array(
        'post_type' => 'product',

    );

    $the_query = new WP_Query($args);

?>

    <ul>
        <?php
        // The Loop
        if ($the_query->have_posts()) {


            while ($the_query->have_posts()) {
                $the_query->the_post();
        ?>
                <li><?php echo the_title(); ?></li>
                <?php $price = get_post_meta(get_the_ID(), '_price', true);
                ?>
                <li><?php echo wc_price($price); ?></li>
                <li><?php echo the_content(); ?></li>

        <?php
            } // end while
        } // endif
        ?>
    </ul>
<?php
    // Reset Post Data
    wp_reset_postdata();
}


add_shortcode('my_shcode', 'add_products');
?>