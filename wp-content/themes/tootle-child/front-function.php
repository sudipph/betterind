<?php




//add_action( 'evolve_before_content_area', 'evolve_front_article_title', 10 );
function evolve_front_article_title(){
	echo '<div class="col-12 margi_put"><div class="title_background_border"></div><div class="top_story_article_title shadow">TOP STORIES</div></div>';
}

function humanTiming ($time)
{

    $time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }

}



function wpdocs_theme_name_scripts() {
    //wp_enqueue_style( 'style-name', get_stylesheet_uri() );
    wp_enqueue_script( 'child-custom-script', get_stylesheet_directory_uri() . '/js/custom_script.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );
?>