<?php

class View {
	public function make($view, $params = false, $cache = false) {
		if ($params) {
			foreach ($params as $k => $v) {
				$$k = $v;
			}
		}
		ob_start();
		require sprintf("%s/views/%s", APP_PATH, $view);
		return ob_get_flush();
	}
}

?>