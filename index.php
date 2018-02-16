<?php
    /*
     * This file is used for routing logic of the website
     * 
     * Quentin Guenther
     * 2/2/2018
     */

    // Turn on error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    // Require autoload
    require_once('vendor/autoload.php');

    session_start();

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
            $member = null;

            // create array to store errors
            $errors = array();

            // validate form data
            if(!validName($_POST['firstName'])) { $errors['firstName'] = "First name must contain alphabetic charactors only."; }
            if(!validName($_POST['lastName'])) { $errors['lastName'] = "Last name must contain alphabetic charactors only."; }
            if(!validAge($_POST['age'])) { $errors['age'] = "You must be atleast 18 years old to join."; }
            if(!validPhone($_POST['phoneNumber'])) { $errors['phoneNumber'] = "Must be a valid phone number."; }

            // if no errors then set session varuables and re route to next form
            $errors = array_filter($errors);
            if(empty($errors)) { 
                if(isset($_POST['premium']))
                    $member = new PremiumMember($_POST['firstName'], 
                                                $_POST['lastName'],
                                                $_POST['age'],
                                                $_POST['gender'],
                                                $_POST['phoneNumber']);
                else 
                    $member = new Member($_POST['firstName'], 
                                         $_POST['lastName'],
                                         $_POST['age'],
                                         $_POST['gender'],
                                         $_POST['phoneNumber']);

                $_SESSION['member'] = $member;
                
                $f3->reroute('/signup/profile'); 
            }

            // set $f3 varuables to be used for sticky forms
            $f3->set('firstName', $_POST['firstName']);
            $f3->set('lastName', $_POST['lastName']);
            $f3->set('age', $_POST['age']);
            $f3->set('gender', $_POST['gender']);
            $f3->set('phoneNumber', $_POST['phoneNumber']);
            $f3->set('errors', $errors);
        }

        echo Template::instance()->render('pages/personal_information.html');
    });

    $f3->route('GET|POST /signup/profile', function($f3){
        if(isset($_POST['submit'])) {
            // set $f3 varuables to be used for sticky forms
            $f3->set('email', $_POST['email']);
            $f3->set('state', $_POST['state']);
            $f3->set('seekingGender', $_POST['seekingGender']);
            $f3->set('biography', $_POST['biography']);

            // get member from session, then update values
            $member = $_SESSION['member'];
            $member->setEmail($_POST['email']);
            $member->setState($_POST['state']);
            $member->setBio($_POST['biography']);
            $member->setSeeking($_POST['seekingGender']);

            // update session member
            $_SESSION['member'] = $member; 

            if($member instanceof PremiumMember) {
                $f3->reroute('/signup/interests');
            } else {
                $f3->reroute('/profile'); 
            }
        }

        echo Template::instance()->render('pages/profile.html');
    });

    $f3->route('GET|POST /signup/interests', function($f3){
        if(isset($_POST['submit'])) {
            // create array to store errors
            $errors = array();

            // validate form data
            if(!validIndoor($_POST['indoor'])) { $errors['indoor'] = 'All of your indoor intrests could not be found.'; }
            if(!validOutdoor($outdoor)) { $errors['outdoor'] = 'All of your outdoor intrests could not be found.'; }

            // if no errors then set session varuables and re route to next form
            $errors = array_filter($errors);
            if(empty($errors)) { 
                $member = $_SESSION['member'];
                if($member instanceof PremiumMember) {
                    $member->setIndoorIntrests($_POST['indoor']);
                    $member->setOutdoorIntrests($_POST['outdoor']);
                }

                $_SESSION['member'] = $member;

                $f3->reroute('/profile'); 
            }

            // set $f3 varuables to be used for sticky forms
            $f3->set('setIndoorIntrests', $_POST['indoor']);
            $f3->set('setOutdoorIntrests', $_POST['outdoor']);
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