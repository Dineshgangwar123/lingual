<?php
class Replacestring {
  public $string;

  function transformstring($string,$replacer) {
    
    return preg_replace( '{([?!])\1++(?!\S)(?!.*(?:!!|\?\?)(?!\S))}', $replacer , $string );
  }
  
}

?>