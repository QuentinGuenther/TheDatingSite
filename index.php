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

    // Validation script
    include('models/validation.php');

    // Default route
    $f3->route('GET /', function(){
        echo Template::instance()->render('pages/home.html');
    });

    // Sign up route
    $f3->route('GET|POST /signup/personal_information', function($f3){
        if(isset($_POST['submit'])) {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $phoneNumber = $_POST['phoneNumber'];

            $errors = array();

            if(!validName($firstName)) { $errors['firstName'] = "First name must contain alphabetic charactors only."; }
            if(!validName($lastName)) { $errors['lastName'] = "Last name must contain alphabetic charactors only."; }
            if(!validAge($age)) { $errors['age'] = "You must be atleast 18 years old to join."; }
            if(!validPhone($phoneNumber)) { $errors['phoneNumber'] = "Must be a valid phone number."; }

            $errors = array_filter($errors);
            if(empty($errors)) { 
                $_SESSION['firstName'] = $firstName;
                $_SESSION['lastName'] = $lastName;
                $_SESSION['age'] = $age;
                $_SESSION['gender'] = $gender;
                $_SESSION['phoneNumber'] = $phoneNumber;
                $f3->reroute('/signup/profile'); 
            }

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
            $email = $_POST['email'];
            $state = $_POST['state'];
            $seekingGender = $_POST['seekingGender'];
            $biography = $_POST['biography'];

            $f3->set('email', $email);
            $f3->set('state', $state);
            $f3->set('seekingGender', $seekingGender);
            $f3->set('biography', $biography);
            
            $f3->reroute('/signup/interests');
        }
       
        
        echo Template::instance()->render('pages/profile.html');
        
    });

    $f3->route('GET|POST /signup/interests', function($f3){
        if(isset($_POST['submit'])) {
            $indoor = $_POST['indoor'];
            $outdoor = $_POST['outdoor'];

            $errors = array();

            if(!validIndoor($outdoor)) { $errors['indoor'] = 'All of your indoor intrests could not be found.'; }
            if(!validOutdoor($outdoor)) { $errors['outdoor'] = 'All of your outdoor intrests could not be found.'; }

            $errors = array_filter($errors);
            if(empty($errors)) { $f3->reroute('/profile'); }

            $f3->set('setIndoorIntrests', $indoor);
            $f3->set('setOutdoorIntrests', $outdoor);
        }

        echo Template::instance()->render('pages/interests.html');
    });

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