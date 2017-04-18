<?php 
class Dog{
	private $dog_weight = 0;
	private $dog_breed = "no breed";
	private $dog_color = "no color";
	private $dog_name = "no name";
	private $error_messages = array();
	private $return_result = NULL;

	function __construct($properties_array){
		if(method_exists('dog_container', 'create_object')){
			$name_error = $this->set_dog_name($properties_array[0]) == TRUE ? 'TRUE, ' : 'FALSE, ';
			$breed_error = $this->set_dog_breed($properties_array[1]) == TRUE ? 'TRUE, ' : 'FALSE, ';
			$color_error = $this->set_dog_color($properties_array[2]) == TRUE ? 'TRUE, ' : 'FALSE, ';
			$weight_error = $this->set_dog_weight($properties_array[3]) == TRUE ? 'TRUE, ' : 'FALSE, ';
		}
	}

	function set_dog_weight($value){
		$error_message = TRUE;
		(ctype_digit($value) && ($value > 0 && $value <= 120)) ? $this->dog_weight = $value : $error_message = FALSE;
		return $error_message;
	}

	function set_dog_breed($value){
		$error_message = TRUE;
		(ctype_alpha($value) && ($this->validator_breed($value) == TRUE) && strlen($value) <= 35) ? $this->dog_breed = $value : $error_message = FALSE;
		return $error_message;
	}

	function set_dog_color($value){
		$error_message = TRUE;
		(ctype_alpha($value) && strlen($value) <= 15) ? $this->dog_color = $value : $error_message = FALSE;
		return $error_message;
	}

	function set_dog_name($value){
		$error_message = TRUE;
		(ctype_alpha($value) && strlen($value) <= 20) ? $this->dog_name = $value : $error_message = FALSE;
		return $error_message;
	}

	function get_dog_weight(){
		return $this->dog_weight;
	}

	function get_dog_breed(){
		return $this->dog_breed;
	}

	function get_dog_color(){
		return $this->dog_color;
	}

	function get_dog_name(){
		return $this->dog_name;
	}

	function get_error_messages(){
		return $this->error_messages;
	}
	function get_properties(){
		return "$this->dog_weight,$this->dog_breed,$this->dog_color, $this->dog_name";
	}

	function display_properties(){
		print "Dog weight is " . $this->dog_weight 
				. ". Dog breed is " . $this->dog_breed . ". Dog color is " . $this->dog_color
				. ". Dog name is " . $this->dog_name .".<br>";
	}

	private function validator_breed(){
		$breed_file= simplexml_load_file("breeds.xml");
		$xmlText=$breed_file->asXML();
		if(stristr($xmlText, $value) == FALSE){
			return FALSE;
		}else{
			return TRUE;
		}
	}
}
?>