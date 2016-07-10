<?php

class DB {
	private static $instance;

	public static function conn() {
        if (null === static::$instance) {
            static::$instance = new mysqli(
        		getenv('DATABASE_HOST'),
				getenv('DATABASE_USERNAME'),
				getenv('DATABASE_PASSWORD'),
				getenv('DATABASE_DATABASE')
			);
        }
        return static::$instance;
    }

    protected function __construct() {}
    private function __clone() {}
    private function __wakeup() {}
}

?>