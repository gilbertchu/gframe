<?php

class GilbertApp {
	protected $instance;
	protected $routes;
	protected $control;
	protected $filters;
	private $api;
	public $core;

	function __construct($api = false) {
		//check for api call first?
		$this->api = $api;
		$this->routes = array();
	}

	public function env($check = false) {
		return ($check) ? ($check === getenv('ENVIRONMENT_NAME')) : getenv('ENVIRONMENT_NAME');
	}

	public function run() {
		//removing /app prefix
		//$uri = substr($_SERVER['REQUEST_URI'],4);
		$uri = $_SERVER['REQUEST_URI'];
		$method = $_SERVER['REQUEST_METHOD'];
		$response = $this->handleRequest($uri, $method);
		return $response;
	}

	public function controller($ctrl, $filter=true) {
		$cl = $ctrl.'Controller';
		$this->control[$ctrl] = new $cl();
		$this->filters[$ctrl] = $filter;
	}

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
	public function get($uri, $ctrl, $action) {
		$this->route('get', $uri, $ctrl, $action);
	}

	protected function handleRequest($uri, $method){
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
		return $this->control[$ctrl]->callController($method, $action, $params);
	}

	private function missing() {
		if ($this->api) {
			require APP_PATH.'/views/404-api.php';
		} else {
			require APP_PATH.'/views/404-view.php';
		}
	}

	private function filter($type = true) {
		if ($type === 'token') return (isset($_GET['token']) && $_GET['token']==getenv('ADMIN_TOKEN'));
		return $type;
	}
}

?>