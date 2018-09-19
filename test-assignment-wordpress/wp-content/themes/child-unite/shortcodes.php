<?php

function shortcode_films_recent_posts( $atts = null, $content = null, $tag = null ) {
    $out = '';
    $args = array( 
        'numberposts' => '6', 
        'post_status' => 'publish', 
        'post_type' => 'films' ,
    );

    $recent = wp_get_recent_posts( $args );
    if ( $recent ) {
        $out .= '<section class="overview sidebar-movie">';
        $out .= '<h3>Recent Films</h3>';
        $out .= '<div class="overview">';
        $out .= '<ul>';
        
        foreach ($recent as $item) {
            $out .= '<li>';
            $out .= '<a href="' . get_permalink( $item['ID'] ) . '">';
            $out .= get_the_post_thumbnail( $item['ID'] , 'full', array('class' => 'img-thumbnail'));
            $out .= '<h4>' . get_the_title( $item['ID'] ) .'</h4>';
            $out .= '</a>';
            $out .= '</li>';
        }

        $out .= '</ul>';
        $out .= '</div></section>';
    }

    if ( $tag ) {
        return $out;
    } 
    
    echo $out;
}

add_shortcode('recentposts', 'shortcode_films_recent_posts');