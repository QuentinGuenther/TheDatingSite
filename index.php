<?php
    session_start();

    // Turn on error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    // Require autoload
    require_once('vendor/autoload.php');

    // Create fat-free instance
    $f3 = Base::instance();

    // Set debug level to dev
    $f3->set('DEBUG', 3);

    // Default route
    $f3->route('GET /',
        function(){
            $template = new Template();
            echo $template->render('pages/home.html');
        });

    // Sign up route
    $f3->route('GET /signup',
       function($f3){

            $f3->set('indoor', array('tv', 'puzzles', 'movies', 'reading', 'cooking', 'playing cards', 'board games', 'video games'));
            $f3->set('outdoor', array('hiking', 'walking', 'biking', 'climbing', 'swimming', 'collecting'));

            $template = new Template();
            echo $template->render('pages/interests.html');
       });

    $f3->route('GET /profile',
       function($f3){
           $template = new Template();
           echo $template->render('pages/profile_summary.html');
       });

    // Error page
    $f3->set('ONERROR', function($f3) {
        echo Template::instance()->render('pages/error.html');
    });


    // Run fat-free
    $f3->run();
?>