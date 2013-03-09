<?php

function prep_key_value($key, $value, $array)
	{
		foreach($array as $item) {
			$output[$item[$key]] = $item[$value];
		}
		
		return $output;
	}

/*
*EOF common_helper.php
*Location: ./application/helpers/common_helper.php
*/