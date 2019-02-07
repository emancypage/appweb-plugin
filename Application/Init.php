<?php
/**
 * @package  AppWebPlugin
 */
namespace AppWeb\Application;

final class Init
{
	/**
	 * Store all the classes inside an array
	 * @return array Full list of classes
	 */
	public static function getServices()
	{
		return [
			Pages\Admin::class,
			Base\Enqueue::class,
			Base\SettingsLinks::class
		];
	}

	/**
	 * Loop through the classes, initialize them, 
	 * and call the register() method if it exists
	 */
	public static function registerServices()
	{
		foreach (self::getServices() as $class) {
			$service = self::getInstance($class);
			if ( method_exists($service, 'register')) {
				$service->register();
			}
		}
	}

	/**
	 * Initialize the class
	 * @param  object $class    class from the services array
	 * @return object instance  new instance of the class
	 */
	private static function getInstance($class)
	{
		return new $class();
	}
}