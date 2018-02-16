<?php
	function checkFileExists($targetFile)
	{
		if(file_exists($targetFile)) {
			return false;
		}

		return true;
	}

	function checkFileSize($targetFileSize, $maxFileSize)
	{
		if($targetFileSize > $maxFileSize) {
			return false;
		}

		return true;
	}

	function checkFileType($targetFile)
	{
		$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

		if($imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'jpg') {
			return false;
		}

		return true;
	}