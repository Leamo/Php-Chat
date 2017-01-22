<?php
namespace Core\Controller;

class Controller{
	protected function render($view, $variables = []){
		extract($variables);
        require($this->viewPath . str_replace('.', '/', $view) . '.php');
	}
}