<?php

	/**
	 * The member class represents a member of the dating site.
	 * 
	 * The member class represents a member of the dating site with a name,
	 * age, gender, phone number, email, state, seeking gender, and bio.
	 *
	 * @author Quentin Guenther <qguenther@mail.greenriver.edu>
	 * @copyright 2018
	 */
	class Member 
	{
		protected $fname;
		protected $lname;
		protected $age;
		protected $gender;
		protected $phone;
		protected $email;
		protected $state;
		protected $seeking;
		protected $bio;

		/**
		 * Function that instantiates a member.
		 * 
		 * @param string $fname The member's first name.
		 * @param string $lname The member's last name.
		 * @param int $age The member's age.
		 * @param string $gender The member's gender.
		 * @param string $phone The member's phone number.
		 * @return void
		 */
		public function __construct($fname, $lname, $age, $gender, $phone)
		{
			$this->fname = $fname;
			$this->lname = $lname;
			$this->age = $age;
			$this->gender = $gender;
			$this->phone = $phone;
		}

		/**
		 * Function that gets the member's first name.
		 *
		 * @return string Member's first name.
		 */
		public function getFname() 
		{
			return $this->fname;
		}

		/**
		 * Function that sets the member's first name.
		 *
		 * @param string $fname The member's first name.
		 * @return void
		 */
		public function setFname($fname) 
		{
			$this->fname = $fname;
		}

		/**
		 * Function that gets the member's last name.
		 *
		 * @return string Member's last name.
		 */
		public function getLname()
		{
			return $this->lname;
		}

		/**
		 * Function that sets the member's last name.
		 *
		 * @param string $lname The member's last name.
		 * @return void
		 */
		public function setLname($lname)
		{
			$this->lname = $lname;
		}

		/**
		 * Function that gets the member's age.
		 *
		 * @return int Member's age.
		 */
		public function getAge() 
		{
			return $this->age;
		}

		/**
		 * Function that sets the member's age.
		 *
		 * @param int $age The member's age.
		 * @return void
		 */
		public function setAge($age) 
		{
			$this->age = $age;
		}

		/**
		 * Function that gets the member's gender.
		 *
		 * @return string Member's gender.
		 */
		public function getGender() 
		{
			return $this->gender;
		}

		/**
		 * Function that sets the member's gender.
		 *
		 * @param string $gender The member's gender.
		 * @return void
		 */
		public function setGender($gender) 
		{
			$this->gender = $gender;
		}

		/**
		 * Function that gets the member's phone.
		 *
		 * @return string Member's phone.
		 */
		public function getPhone() 
		{
			return $this->phone;
		}

		/**
		 * Function that sets the member's phone number.
		 *
		 * @param string $phone The member's phone number.
		 * @return void
		 */
		public function setPhone($phone) 
		{
			$this->phone = $phone;
		}

		/**
		 * Function that gets the member's email.
		 *
		 * @return string Member's email.
		 */
		public function getEmail() 
		{
			return $this->email;
		}

		/**
		 * Function that sets the member's email.
		 *
		 * @param string $email The member's email.
		 * @return void
		 */
		public function setEmail($email) 
		{
			$this->email = $email;
		}

		/**
		 * Function that gets the member's state.
		 *
		 * @return string Member's state.
		 */
		public function getState() 
		{
			return $this->state;
		}

		/**
		 * Function that sets the member's state.
		 *
		 * @param string $state The member's state.
		 * @return void
		 */
		public function setState($state) 
		{
			$this->state = $state;
		}

		/**
		 * Function that gets the member's seeking gender.
		 *
		 * @return string Member's seeking gender.
		 */
		public function getSeeking() 
		{
			return $this->seeking;
		}

		/**
		 * Function that sets the member's seeking gender.
		 *
		 * @param string $seeking The member's seeking gender.
		 * @return void
		 */
		public function setSeeking($seeking) 
		{
			$this->seeking = $seeking;
		}

		/**
		 * Function that gets the member's bio.
		 *
		 * @return string Member's bio.
		 */
		public function getBio() 
		{
			return $this->bio;
		}

		/**
		 * Function that sets the member's bio.
		 *
		 * @param string $bio The member's bio.
		 * @return void
		 */
		public function setBio($bio) 
		{
			$this->bio = $bio;
		}
	}