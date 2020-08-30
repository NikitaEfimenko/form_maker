<?php

namespace controllers;

use core\Controller;
use views\FormView;
use models\VControl;
use models\Store;
use Swift_Mailer;
use Swift_SmtpTransport;
use Swift_Message;

class FormController extends Controller
{
	public function bootstrap($view_args)
	{
		$action_name = (isset($view_args[1])) ? $view_args[1] : null;
		$view = new FormView();
		$this->doAction($action_name);
		$props = [
			"FORMS" => array_map(function ($el) {
				$args = explode(",", $el);
				$class = "models\\" . VControl::getClass($args[0]);
				$input = new $class(...$args);
				return $input->render();
			}, Store::get($view_args[0])),
			"UID" => $view_args[0]
		];
		print($view->index($props));
	}
	public function submit()
	{
		if (array_reduce($_POST, function ($acc, $el) {
			return !empty($el) && $acc;
		}, true)) {
			ob_start();
			var_dump($_POST);
			$result = ob_get_clean();
			try {
				$transport = (new Swift_SmtpTransport('smtp.mail.ru', 465, 'ssl'))
					->setUserName('former_mailer@mail.ru')
					->setPassword('jklol13qwe');
				$mailer = new Swift_Mailer($transport);
				
				$message = (new Swift_Message())
					->setFrom(array('former_mailer@mail.ru' => 'Sender'))
					->setSubject('Polling')
					->setTo(['mszx2000@gmail.com' => 'Nikita Efimenko'])
					->setBody($result);

				$result = $mailer->send($message);
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		} else {
			echo "<h2 style='color: red'> Fill all fields</h2>";
		}
	}
}
