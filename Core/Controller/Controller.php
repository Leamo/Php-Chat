<?php
namespace Core\Controller;

class Controller{
	protected function render($view, $variables = []){
		ob_start();
        extract($variables);
        require($this->viewPath . str_replace('.', '/', $view) . '.php');
        $content = ob_get_clean();
        require($this->viewPath . 'templates/' . $this->template . '.php');
	}
}