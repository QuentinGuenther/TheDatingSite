<?php
    /*
     * This file is used for routing logic of the website
     * 
     * Quentin Guenther
     * 2/2/2018
     */
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

    // Validation script
    include('models/validation.php');

    // Default route
    $f3->route('GET /', function(){
        echo Template::instance()->render('pages/home.html');
    });

    // Sign up route
    $f3->route('GET|POST /signup/personal_information', function($f3){
        if(isset($_POST['submit'])) {
            // set post data to varuables
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $phoneNumber = $_POST['phoneNumber'];

            // create array to store errors
            $errors = array();

            // validate form data
            if(!validName($firstName)) { $errors['firstName'] = "First name must contain alphabetic charactors only."; }
            if(!validName($lastName)) { $errors['lastName'] = "Last name must contain alphabetic charactors only."; }
            if(!validAge($age)) { $errors['age'] = "You must be atleast 18 years old to join."; }
            if(!validPhone($phoneNumber)) { $errors['phoneNumber'] = "Must be a valid phone number."; }

            // if no errors then set session varuables and re route to next form
            $errors = array_filter($errors);
            if(empty($errors)) { 
                if(isset($_POST['premium'])) {
                    $_SESSION['member'] = new PremiumMember($firstName, $lastName, $age, $gender, $phoneNumber);
                } else {
                    $_SESSION['member'] = new Member($firstName, $lastName, $age, $gender, $phoneNumber);
                }
                
                $f3->reroute('/signup/profile'); 
            }

            // set $f3 varuables to be used for sticky forms
            $f3->set('firstName', $firstName);
            $f3->set('lastName', $lastName);
            $f3->set('age', $age);
            $f3->set('gender', $gender);
            $f3->set('phoneNumber', $phoneNumber);
            $f3->set('errors', $errors);
        }

        echo Template::instance()->render('pages/personal_information.html');
    });

    $f3->route('GET|POST /signup/profile', function($f3){
        if(isset($_POST['submit'])) {
            // set post data to varuables
            $email = $_POST['email'];
            $state = $_POST['state'];
            $seekingGender = $_POST['seekingGender'];
            $biography = $_POST['biography'];

            // set $f3 varuables to be used for sticky forms
            $f3->set('email', $email);
            $f3->set('state', $state);
            $f3->set('seekingGender', $seekingGender);
            $f3->set('biography', $biography);

            // set session varuables
            $_SESSION['email'] = $email;
            $_SESSION['state'] = $state;
            $_SESSION['seekingGender'] = $seekingGender;
            $_SESSION['biography'] = $biography;

            $f3->reroute('/signup/interests');
        }
       
        print_r($_SESSION);
        echo Template::instance()->render('pages/profile.html');
        
    });

    $f3->route('GET|POST /signup/interests', function($f3){
        if(isset($_POST['submit'])) {
            // set post data to varuables
            $indoor = $_POST['indoor'];
            $outdoor = $_POST['outdoor'];

            // create array to store errors
            $errors = array();

            // validate form data
            if(!validIndoor($indoor)) { $errors['indoor'] = 'All of your indoor intrests could not be found.'; }
            if(!validOutdoor($outdoor)) { $errors['outdoor'] = 'All of your outdoor intrests could not be found.'; }

            // if no errors then set session varuables and re route to next form
            $errors = array_filter($errors);
            if(empty($errors)) { 
                $_SESSION['indoor'] = $indoor;
                $_SESSION['outdoor'] = $outdoor;

                $f3->reroute('/profile'); 
            }

            // set $f3 varuables to be used for sticky forms
            $f3->set('setIndoorIntrests', $indoor);
            $f3->set('setOutdoorIntrests', $outdoor);
            $f3->set('errors', $errors);
        }

        echo Template::instance()->render('pages/interests.html');
    });

    // The profile summary page that shows data entered from previous forms
    $f3->route('GET /profile', function($f3){
       echo Template::instance()->render('pages/profile_summary.html');
    });

    // Error page
    $f3->set('ONERROR', function($f3) {
        echo Template::instance()->render('pages/error.html');
    });


    // Run fat-free
    $f3->run();
?>