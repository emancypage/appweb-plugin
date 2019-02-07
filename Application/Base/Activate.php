<?php
/**
 * @package  AppWebPlugin
 */
namespace AppWeb\Application\Base;

class Activate
{
	public static function activate() {
		flush_rewrite_rules();
	}
}