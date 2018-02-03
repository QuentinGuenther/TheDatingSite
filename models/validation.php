<?php
    /*
     * This file contains the validation functions and varuables used by the sign up form.
     * Quentin Guenther
     * 2/2/2018
     */
	$indoorIntrests = array('tv', 'puzzles', 'movies', 'reading', 'cooking', 'playing cards', 'board games', 'video games');
	$outdoorIntrests = array('hiking', 'walking', 'biking', 'climbing', 'swimming', 'collecting');
	$stateList = array(
        'ALABAMA',
        'ALASKA',
        'AMERICAN SAMOA',
        'ARIZONA',
        'ARKANSAS',
        'CALIFORNIA',
        'COLORADO',
        'CONNECTICUT',
        'DELAWARE',
        'DISTRICT OF COLUMBIA',
        'FEDERATED STATES OF MICRONESIA',
        'FLORIDA',
        'GEORGIA',
        'GUAM GU',
        'HAWAII',
        'IDAHO',
        'ILLINOIS',
        'INDIANA',
        'IOWA',
        'KANSAS',
        'KENTUCKY',
        'LOUISIANA',
        'MAINE',
        'MARSHALL ISLANDS',
        'MARYLAND',
        'MASSACHUSETTS',
        'MICHIGAN',
        'MINNESOTA',
        'MISSISSIPPI',
        'MISSOURI',
        'MONTANA',
        'NEBRASKA',
        'NEVADA',
        'NEW HAMPSHIRE',
        'NEW JERSEY',
        'NEW MEXICO',
        'NEW YORK',
        'NORTH CAROLINA',
        'NORTH DAKOTA',
        'NORTHERN MARIANA ISLANDS',
        'OHIO',
        'OKLAHOMA',
        'OREGON',
        'PALAU',
        'PENNSYLVANIA',
        'PUERTO RICO',
        'RHODE ISLAND',
        'SOUTH CAROLINA',
        'SOUTH DAKOTA',
        'TENNESSEE',
        'TEXAS',
        'UTAH',
        'VERMONT',
        'VIRGIN ISLANDS',
        'VIRGINIA',
        'WASHINGTON',
        'WEST VIRGINIA',
        'WISCONSIN',
        'WYOMING',
        'ARMED FORCES AFRICA \ CANADA \ EUROPE \ MIDDLE EAST',
        'ARMED FORCES AMERICA (EXCEPT CANADA)',
        'ARMED FORCES PACIFIC'
    );

    $f3->set('indoorIntrests', $indoorIntrests);
    $f3->set('outdoorIntrests', $outdoorIntrests);
    $f3->set('stateList', $stateList);
    
    /**
     * Validate name fields(s) by checking if only alpha chars are used.
     *
     * @param string $name The name field input
     * @return boolean
     */
	function validName($name)
	{
		return ctype_alpha($name);
	}

    /**
    * Validate age field(s) by checking if age > 18
    *
    * @param int $age The age to be checked
    * @return boolean
    */
	function validAge($age)
	{
		return (ctype_digit($age) && $age >= 18);
	}

    /**
    * Validate phone numbers by checking for the US pattern
    *
    * @param string $phone The phone number to be checked
    * @return boolean
    */
	function validPhone($phone)
	{
		$regex = "/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i";
		return preg_match($regex, $phone);
	}

    /**
     * Validate outdoor intrests to stored accepted values for outdoor intrests
     * 
     * @param string[] $intrests The outdoor intrests to validate
     * @return boolean
     */
	function validOutdoor($intrests)
	{
        $outdoorIntrests = array('hiking', 'walking', 'biking', 'climbing', 'swimming', 'collecting');
        if(isset($intrests)) {
            foreach ($intrests as $key => $value) {
                if(!in_array(trim($value), (array)$outdoorIntrests)) {
                    return false;
                }
            }
        }
		
		return true;
	}

    /**
     * Validate indoor intrests to stored accepted values for indoor intrests
     * 
     * @param string[] $intrests The indoor intrests to validate
     * @return boolean
     */
	function validIndoor($intrests)
	{
        $indoorIntrests = array('tv', 'puzzles', 'movies', 'reading', 'cooking', 'playing cards', 'board games', 'video games');
        if(isset($intrests)) {
            foreach ($intrests as $key => $value) {
                if(!in_array(trim($value), (array)$indoorIntrests)) {
                    return false;
                }
            }
        }

		return true;
	}
