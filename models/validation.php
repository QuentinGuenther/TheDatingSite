<?php

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

	function validName($name)
	{
		return ctype_alpha($name);
	}

	function validAge($age)
	{
		return (ctype_digit($age) && $age >= 18);
	}

	function validPhone($phone)
	{
		$regex = "/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i";
		return preg_match($regex, $phone);
	}

	function validOutdoor($intrests)
	{
        if(isset($intrests)) {
            foreach ($intrests as $key => $value) {
                if(!in_array($value, (array)$outdoorIntrests)) {
                    return false;
                }
            }
        }
		
		return true;
	}

	function validIndoor($intrests)
	{
        $indoorIntrests = array('tv', 'puzzles', 'movies', 'reading', 'cooking', 'playing cards', 'board games', 'video games');
        if(!empty($intrests)) {
            if(count(array_intersect((array)$indoorIntrests, (array)$indoorIntrests)) != count((array)$intrests)) {
                echo "<pre>".count((array)$indoorIntrests)."</pre>";
                return false;
            }
        }

		return true;
	}
