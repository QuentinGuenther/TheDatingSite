<?php
	
	class PremiumMember extends PremiumMember
	{
		private $_inDoorInterests;
		private $_outDoorInterests;

		/**
		 * Function that instantiates a premium member.
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
			parent::__construct($fname, $lname, $age, $gender, $phone);
		}
		
		/**
		 * Function that gets the member's indoor intrests.
		 *
		 * @return string[] Member's indoor intrests.
		 */
		public function getIndoorIntrests()
		{
			return $this->_inDoorInterests;
		}

		/**
		 * Function that sets the member's indoor intrests.
		 *
		 * @param string[] $intrests The member's indoor intrests.
		 * @return void
		 */
		public function setIndoorIntrests($intrests)
		{
			$this->_inDoorInterests = $intrests;
		}

		/**
		 * Function that gets the member's outdoor intrests.
		 *
		 * @return string[] Member's outdoor intrests.
		 */
		public function getOutdoorIntrests()
		{
			return $this->_outDoorInterests;
		}

		/**
		 * Function that sets the member's outdoor intrests.
		 *
		 * @param string[] $intrests The member's outdoor intrests.
		 * @return void
		 */
		public function setOutdoorIntrests($intrests)
		{
			$this->_outDoorInterests = $intrests;
		}
	}