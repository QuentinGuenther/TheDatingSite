<?php

	/*
		CREATE TABLE `Members` (
		  `member_id` int(11) NOT NULL,
		  `fname` varchar(50) NOT NULL,
		  `lname` varchar(50) NOT NULL,
		  `age` tinyint(4) NOT NULL,
		  `gender` varchar(6) DEFAULT NULL,
		  `phone` varchar(11) NOT NULL,
		  `email` varchar(255) DEFAULT NULL,
		  `state` varchar(75) DEFAULT NULL,
		  `seeking` varchar(6) DEFAULT NULL,
		  `bio` text,
		  `premium` tinyint(1) NOT NULL DEFAULT '0',
		  `image` varchar(255) DEFAULT NULL,
		  `interests` text
		) ENGINE=MyISAM DEFAULT CHARSET=latin1;

		ALTER TABLE `Members`
		  ADD PRIMARY KEY (`member_id`);

		ALTER TABLE `Members`
		  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT;
	*/

	require_once('/home/qguenthe/db_config/DatingWebsite_config.php');
	

	class Database
	{
		public function __construct(){
			try {
				global $dbh;
			    $dbh = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			    return $dbh;
			}
			catch(PDOException $e) {
	        	echo $e->getMessage();
	        	return;
	    	}
		}

		public static function getMembers()
		{
			global $dbh;

			// Define the query	
			$sql = "SELECT * FROM Members";

			// Prepare the statement
			$statement = $dbh->prepare($sql);

			// Execute the statement
			$success = $statement->execute();

			// Return the result
	    	$result = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Return the result
			return $result;
		}

		public static function getMember($id)
		{
			global $dbh;

			// Define the query	
			$sql = "SELECT * FROM Members WHERE member_id = :id";

			// Prepare the statement
			$statement = $dbh->prepare($sql);

			// Bind parameters
			$statement->bindParam(':id', $id, PDO::PARAM_STR);

			// Execute the statement
			$success = $statement->execute();

			// Return the result
	    	$result = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Return the result
			return $result;
		}

		public static function addMember($member)
		{
			global $dbh;

			// Define the query
			$sql = "INSERT INTO Members (fname, lname, age, gender, phone, email, state, seeking, bio, premium, image, interests) VALUES (:fname, :lname, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium, :image, :interests)";

			// Prepare the statement
			$statement = $dbh->prepare($sql);

			// Bind parameters
			$statement->bindParam(':fname', $member->getFname(), PDO::PARAM_STR);
			$statement->bindParam(':lname', $member->getLname(), PDO::PARAM_STR);
			$statement->bindParam(':age', $member->getAge(), PDO::PARAM_INT);
			$statement->bindParam(':gender', $member->getGender(), PDO::PARAM_STR);
			$statement->bindParam(':phone', $member->getPhone(), PDO::PARAM_STR);
			$statement->bindParam(':email', $member->getEmail(), PDO::PARAM_STR);
			$statement->bindParam(':state', $member->getState(), PDO::PARAM_STR);
			$statement->bindParam(':seeking', $member->getSeeking(), PDO::PARAM_STR);
			$statement->bindParam(':bio', $member->getBio(), PDO::PARAM_STR);
			$statement->bindParam(':image', $member->getProfileImageDir(), PDO::PARAM_STR);

			if($member instanceof PremiumMember) {
				$statement->bindParam(':premium', $premium = 1, PDO::PARAM_INT);
				$statement->bindParam(':interests', $member->getIntrests(), PDO::PARAM_STR);
			} else {
				$statement->bindParam(':premium', $premium = 0, PDO::PARAM_STR);
				$statement->bindParam(':interests', $intrests = null, PDO::PARAM_STR);
			}

			// Execute the statement
			$success = $statement->execute();

			// Return the result
			return $dbh->lastInsertId();
		}
	}
	