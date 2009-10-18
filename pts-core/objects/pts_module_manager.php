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

class pts_module_manager
{
	private static $modules = array();
	private static $var_storage = array();
	private static $current_module = null;

	//
	// Module Handling
	//

	public static function attach_module($module)
	{
		array_push(self::$modules, $module);
	}
	public static function detach_module($module)
	{
		if(self::is_module_attached($module))
		{
			unset(self::$modules[$module]);
		}
	}
	public static function attached_modules()
	{
		return self::$modules;
	}
	public static function is_module_attached($module)
	{
		return isset(self::$modules[$module]);
	}
	public static function clean_module_list()
	{
		array_unique(self::$modules);

		foreach(self::$modules as $i => $module)
		{
			if(!pts_is_module($module))
			{
				unset(self::$modules[$i]);
			}
		}
	}

	//
	// Variable Storage
	//

	public static function var_store_add($var, $value)
	{
		array_push(self::$var_storage, $var . "=" . $value);
	}
	public static function var_store_string()
	{
		return implode(";", self::$var_storage);
	}

	//
	// Current Module
	//

	public static function set_current_module($module = null)
	{
		self::$current_module = $module;
	}
	public static function get_current_module()
	{
		return self::$current_module;
	}
}

?>