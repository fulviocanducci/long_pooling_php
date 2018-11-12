<?php

	exec('git log', $result);
	$new_result = array();
	$j = -1;
	for($i = 0; $i < count($result); $i++)
	{
		if (strpos($result[$i],'commit') !== false)
		{
			$new_result[++$j]['commit'] = substr($result[$i], strlen('commit'));			
		}
		else if (strpos($result[$i],'Author:') !== false)
		{
			$new_result[$j]['author'] = substr($result[$i], strlen('Author:'));
		}
		else if (strpos($result[$i],'Date:') !== false)
		{
			$new_result[$j]['date'] = substr($result[$i], strlen('Date:'));
		}
		else if (!empty($result[$i]))
		{
			$new_result[$j]['message'] = trim($result[$i]);
		}
	}

	print_r($new_result);