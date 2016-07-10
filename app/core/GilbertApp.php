<?php

class GilbertApp {
	//protected $instance;
	private $routes;
	private $control;
	private $filters;
	private $api;
	//public $core;

	function __construct($api = false) {
		//check for api call first?
		$this->api = $api;
		$this->routes = array();
	}

	//The request entry point
	public function run() {
		//removing /app prefix
		//$uri = substr($_SERVER['REQUEST_URI'],4);
		$uri = $_SERVER['REQUEST_URI'];
		$method = $_SERVER['REQUEST_METHOD'];
		$response = $this->handleRequest($uri, $method);
		return $response;
	}

	//Register controller (optional filter middleware) 
	public function controller($ctrl, $filter=true) {
		$cl = $ctrl.'Controller';
		$this->control[$ctrl] = new $cl();
		$this->filters[$ctrl] = $filter;
	}

	//Register a route
	public function route($method, $uri, $ctrl, $action) {
		$path = explode('/', trim($uri, '/'));
		$r = array();
		for ($i=0, $m=count($path); $i<$m; $i++) {
			$r[$i] = $path[$i];
		}
		$method = strtolower($method);
		$r[$method] = array($ctrl, $action);
		$this->routes[] = $r;
	}

	//Quick setter for get route
	public function get($uri, $ctrl, $action) {
		$this->route('get', $uri, $ctrl, $action);
	}

	//Quick setter for post route
	public function post($uri, $ctrl, $action) {
		$this->route('post', $uri, $ctrl, $action);
	}

	//Handle the request and generate a response
	private function handleRequest($uri, $method){
		$path = explode('/', trim(parse_url($uri, PHP_URL_PATH), '/'));
		if (strlen($path[0]) === 0) {
			if ($this->api) {
				require APP_PATH.'/views/404-api.php';
			} else {
				require APP_PATH.'/views/home.php';
			}
			return;
		}
		$method = strtolower($method);
		$action = false;
		foreach ($this->routes as $r) {
			$params = array();
			$rs = count($r) - 1;
			if (count($path) !== $rs) continue;
			for ($i=0; $i<$rs; $i++) {
				if (substr($r[$i],0,1) === '#') {
					$pk = substr($r[$i],1);
					$params[$pk] = $path[$i];
				} elseif ($path[$i] !== $r[$i]) {
					continue 2;
				}
			}
			if (isset($r[$method])) {
				$ctrl = $r[$method][0];
				$action = $method.'_'.$r[$method][1];
				break;
			}
		}
		if (!$action || !$this->filter($this->filters[$ctrl])) {
			return $this->missing();
		}
		if (!$this->api) {
			Session::init();
		}
		return $this->control[$ctrl]->callController($method, $action, $params);
	}

	//Return 404 when path not found
	private function missing() {
		if ($this->api) {
			require APP_PATH.'/views/404-api.php';
		} else {
			require APP_PATH.'/views/404-view.php';
		}
		return true;
	}

	//Filter middleware
	private function filter($type) {
		//Token in query string
		if ($type === 'token') return (isset($_GET['token']) && $_GET['token']==getenv('ADMIN_TOKEN'));

		//Basic auth
		if ($type === 'auth') {
			//TODO
		}

		//JWT
		if ($type === 'jwt') {
			//TODO
		}

		return $type;
	}
}

?>