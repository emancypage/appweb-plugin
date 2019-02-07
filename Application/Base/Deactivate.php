<?php
/**
 * @package  AppWebPlugin
 */
namespace AppWeb\Application\Base;

class Deactivate
{
	public static function deactivate() {
		flush_rewrite_rules();
	}
}