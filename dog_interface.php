<?php
require_once("dog.php");
function clean_input($value){
  $bad_chars = array("{", "}", "(", ")", ";", ":", "<", ">", "/", "$");
  $value = str_ireplace($bad_chars,"",$value);
  $value = htmlentities($value); // Removes any html from the string and turns it into &lt; format
  $value = strip_tags($value); // Strips html and PHP tags
  if (get_magic_quotes_gpc()){
    $value = stripslashes($value); // Gets rid of unwanted quotes
  }
return $value;
}

function error_check_dog_app($lab) {
  list($name_error, $breed_error, $color_error, $weight_error) = explode(',', $lab);
  print $name_error == 'TRUE' ? 'Name update successful<br/>' : 'Name update not successful<br/>';
  print $breed_error == 'TRUE' ? 'Breed update successful<br/>' : 'Breed update not successful<br/>';
  print $color_error == 'TRUE' ? 'Color update successful<br/>' : 'Color update not successful<br/>';
  print $weight_error == 'TRUE' ? 'Weight update successful<br/>' : 'Weight update not successful<br/>';
}

function get_dog_app_properties($lab) {
  print "Your dog's name is " . $lab->get_dog_name() . "<br/>";
  print "Your dog weights " . $lab->get_dog_weight() . " lbs. <br />";
  print "Your dog's breed is " . $lab->get_dog_breed() . "<br />";
  print "Your dog's color is " . $lab->get_dog_color() . "<br />";
}

if(file_exists("dog_container.php")){
  require_once("dog_container.php");
}else{
  print "System Error #1"; exit;
}

if(isset($_POST['dog_app'])){
  if((isset($_POST['dog_name'])) && (isset($_POST['dog_weight'])) && (isset($_POST['dog_breed'])) && (isset($_POST['dog_color']))){ 
    $container = new Dog_container(clean_input($_POST['dog_app']));
    $dog_name=clean_input($_POST['dog_name']);
    $dog_weight=clean_input($_POST['dog_weight']);
    $dog_breed=clean_input($_POST['dog_breed']);
    $dog_color=clean_input($_POST['dog_color']);
    $properties_array = array($dog_name, $dog_breed, $dog_color, $dog_weight);
    $lab = $container->create_object($properties_array);
    if($lab != FALSE){
      error_check_dog_app($lab);
      get_dog_app_properties($lab);
    }else{
      print "System Error #2";
    }
  }else{
    print "<p>Missing or invalid parameterss. Please go back to dog.html page to enter valid information.</p><br />";
    print "<a href='dog.html'>Dog Creation Page</a>";
  }
}else{
  $container = new Dog_container("selectbox");
  $properties_array=array("selectbox");
  $lab = $container->create_object($properties_array);   
    if($lab != FALSE){
      $container->set_app("breeds");
      $dog_app = $container->get_dog_application("breeds");
      $method_array=get_class_methods($lab);
      $last_position = count($method_array) - 1;
      $method_name = $method_array[$last_position];
      $result = $lab->$method_name($dog_app);
      if($result == FALSE){
        print "System Error #3";
      }else{
        print $result;
      }
    }else{
      print "System Error #4";
    }
  
}


?>