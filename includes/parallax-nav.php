<?php
if( tia_get_option('tia_reorder_enabled') ) {

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $perPage = get_option('posts_per_page');
    if (is_category()) {
        $args = array(
            'post_type' => 'post',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'cat' => get_query_var('cat'),
            'posts_per_page' => $perPage,
            'paged' => $paged
        );

    } else {

        $args = array(
            'post_type' => 'post',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'posts_per_page' => $perPage,
            'paged' => $paged,
            'cat' => tia_get_option('tia_theme_defaultCatId'),
        );
    }


    query_posts( $args );
}
?>
<ul id="nav" class="parallax-nav"> <!-- post nav -->
<?php
$i = 1; while ( have_posts() ) : the_post();

    echo '<li id="blockLink', $i;
    echo '"><a href="#block', $i;
    echo '" class="block-link" title="', the_title();
    echo '">';
    the_title();
    echo '</a></li>';
    $i++;

endwhile;
?>
</ul><!--end post nav -->