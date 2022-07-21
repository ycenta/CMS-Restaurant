<?php
namespace App\Model;
/**
 * Singleton class Log
 */
class Log {

	private static $instance = null;
	private $users_file;
	private $checkouts_file;
	private $new_file;

	private function __construct(){
		if (!file_exists('logs')) {
            mkdir('logs', 0777, true);
        }
		$this->users_file = fopen("logs/users.log", "a");
		$this->checkouts_file = fopen("logs/checkouts.log", "a");
		$this->new_file = fopen("logs/new.log", "a");
	}

	public static function getInstance(){

		if(is_null(self::$instance)){
			self::$instance = new Log();
		}

		return self::$instance;
	}

	public function user($action, $who){
		date_default_timezone_set('UTC');
		if($action == 'new'){
			fwrite($this->users_file, "New user registered -> " . $who . " - " . date('D, d-m-Y H:i:s') . "\n");
		}else if($action == 'email'){
			fwrite($this->users_file, "Activation's email sent -> " . $who . " - " . date('D, d-m-Y H:i:s') . "\n");
		}else if($action == 'connect'){
			fwrite($this->users_file, "New user connexion -> " . $who . " - " . date('D, d-m-Y H:i:s') . "\n");
		}
	}

	public function checkout($action, $who, $what){
		date_default_timezone_set('UTC');
		if($action == 'new'){
			fwrite($this->checkouts_file, "New checkout '" . $what . "' registered -> " . $who . " - " . date('D, d-m-Y H:i:s') . "\n");
		}
	}

	public function create($subject, $who, $what){
		date_default_timezone_set('UTC');
		fwrite($this->new_file, "New " . $subject . " '" . $what . "' created -> " . $who . " - " . date('D, d-m-Y H:i:s') . "\n");
	}
}