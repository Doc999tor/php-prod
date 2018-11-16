<?php

namespace Lib\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface		 as Response;
use \Slim\Container as Container;

class HomeCtrl {
	protected $container;
	protected $view;

	public function __construct(Container $container) {
	    $this->container = $container;
	    $this->view = $container->get('view');
	}
	public function __get($property) {
		if ($this->container->{$property}) {
			return $this->container->{$property};
		}
	}

	public function greetings (Request $request, Response $response, array $args):Response {
		// $params = $request->getQueryParams();
		$body = $request->getParsedBody();

		$name = filter_var($args['name'], FILTER_SANITIZE_STRING);
		// $date = $this->db
		// 	->query("SELECT getdate() as date")
		// 	->fetch()['date'];
		$date = (new \DateTime())->format('Y-m-d H:i');
		$path = 'home';

		return $this->view->render($response, 'home.html', [
		    'name' => $name,
		    'full_path' => $request->getUri()->getPath(),
		    'date' => $date,
		    'path' => $path,
		]);
	}
}