
<?php
function neve_theme_enqueue_scripts() {
    wp_enqueue_style( 'neve-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'lr-style', get_stylesheet_directory_uri() . '/css/obs.css');
    wp_enqueue_style( 'lr-font', 'https://fonts.googleapis.com/css?family=Raleway|Roboto+Condensed|Montserrat&display=swap');
    wp_enqueue_style('bootstrap-style','https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css');
    //wp_enqueue_script( 'lr-script', get_stylesheet_directory_uri() . '/assets/js/lr.js');
    wp_enqueue_script( 'lr-script', 'https://code.jquery.com/jquery-3.4.1.min.js');
    wp_enqueue_script('bootstrap-js','https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js');
    wp_enqueue_script('bootstrap-js','https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js');
    wp_enqueue_style('fontawesome-style','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css');
    //wp_enqueue_style('animate-style', get_stylesheet_directory_uri() . '/assets/css/animate.min.css');
    wp_enqueue_style('animate-css','https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css');
    //wp_enqueue_script('main-js', get_stylesheet_directory_uri() . '/assets/js/main.js');
    //wp_enqueue_script('jquery-js', get_stylesheet_directory_uri() . '/assets/js/jquery.js');
    wp_enqueue_script('scrollspy-js', 'https://gitcdn.xyz/repo/thesmart/jquery-scrollspy/0.1.3/scrollspy.js');

}
add_action('wp_enqueue_scripts','neve_theme_enqueue_scripts');