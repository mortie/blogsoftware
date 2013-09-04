<?php
	function sort_by_array ($input, $order) {
		$result = array();
		foreach ($order as $item) {
			$result[] = $input[$item];
		}
		return $result;
	}
?>