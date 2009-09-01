<?php

/*
	Phoronix Test Suite
	URLs: http://www.phoronix.com, http://www.phoronix-test-suite.com/
	Copyright (C) 2009, Phoronix Media
	Copyright (C) 2009, Michael Larabel

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

class remove_from_result_file implements pts_option_interface
{
	public static function required_function_sets()
	{
		return array("merge");
	}
	public static function run($r)
	{
		$result = pts_find_result_file($r[0]);

		if($result == false)
		{
			echo "\nNo result file was specified.\n";
			return false;
		}

		$result_file = new pts_result_file($result);
		$result_file_identifiers = $result_file->get_system_identifiers();

		if(count($result_file_identifiers) < 2)
		{
			echo "\nThere are not multiple test runs in this result file.\n";
			return false;
		}

		$remove_identifier = pts_text_select_menu("Select the test run to remove", $result_file_identifiers);
		$keep_identifiers = array();

		foreach($result_file_identifiers as $identifier)
		{
			if($identifier != $remove_identifier)
			{
				array_push($keep_identifiers, $identifier);
			}
		}

		$extract_select = new pts_result_merge_select($result, $keep_identifiers);
		$extract_result = pts_merge_test_results($extract_select);

		pts_save_result($r[0] . "/composite.xml", $extract_result);
		pts_set_assignment_next("PREV_SAVE_RESULTS_IDENTIFIER", $r[0]);
		pts_display_web_browser(SAVE_RESULTS_DIR . $r[0] . "/composite.xml");
	}
}

?>