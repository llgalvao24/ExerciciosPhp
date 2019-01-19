<?php

namespace Galoa\ExerciciosPhp\TextWrap;

/**
 * Implemente sua resolução aqui.
 */
class Resolucao implements TextWrapInterface {
  /**
   * {@inheritdoc}
   */
  public function textWrap(string $text, int $length): array {
    $wrapped = array(); //sets the returning array
	  $auxText = explode(" ", $text); //creates an array of words from the given text
  	$auxWord = ""; //sets the cutting variable empty
  	$auxTextLen = count($auxText); //number of elements in the array
  	$j = 0; //controls wrapped array positons

  	/*this first if-else block sets the position 0 of the returning array, 
  	filling it with the very firts word of the given text. There are 
  	two paths: If it's equal or shorter than the given lenght, it goes to position 0 
  	of the retuning array. If it's longer, it's wrapped. */ 
  	
  	if(strlen($auxText[0]) <= $length){
  		array_push($wrapped, $auxText[0]); //puts the first word in a line
  	}
  	else{
  		for($i = 0; $i < strlen($auxText[0]); $i += $length){
  			$auxWord = mb_substr($auxText[0], $i, $length, 'utf-8'); //gets a substring $length longer
  			array_push($wrapped, $auxWord); //adds it in a new line
  		}
  		$auxWord = ""; //cleans the aux
  	}
  	/*this block is responsible for the rest of the words. It repeats the two
  	paths ideia of the first block */
  	for ($i = 1; $i < $auxTextLen; $i++) { 
 
  		if(strlen($auxText[$i]) <= $length){
 			/*Two more paths: if there is enough room in the current line,
  			the words are linked, else, it goes to the next line */
  			if($length - strlen($wrapped[$j]) - 1 >= strlen($auxText[$i])){
  				$wrapped[$j] .= " ".$auxText[$i]; //links words w/ a space
  			}
  			else{
  				array_push($wrapped, $auxText[$i]); //adds a new line
  				$j++;
  			}
  		}
  		else{
  			
  			/*These two paths deals with longer words 1 - that fit in the current position, wrapping
  			the rest in the next(s) line(s). 2 - that don't fit, therefore go to the next(s)
  			line(s). In both cases they need to be wrapped. */
  			if ($length - strlen($wrapped[$j]) < 2 ) {
  				
  				for($k = 0; $k < strlen($auxText[$i]); $k += $length){
  					$auxWord = mb_substr($auxText[$i], $k, $length, 'utf-8');
  					array_push($wrapped, $auxWord); //adds a new line
  					$j++;
  				}
  				$auxWord = "";
  			}
  			else{
  				$trim = $length - strlen($wrapped[$j]) - 1; //gets a portion of the current word that fits in line
  				$auxWord = mb_substr($auxText[$i], 0, $trim, 'utf-8');
  				$wrapped[$j] .= " ".$auxWord; //links the trimmed word w/ the previuos w/ a space
  				$auxWord = "";

  				for($k = $trim; $k < strlen($auxText[$i]); $k += $length){
  					$auxWord = mb_substr($auxText[$i], $k, $length, 'utf-8'); //gets the rest of the trimmed word.
  					array_push($wrapped, $auxWord); //add a new line
  					$j++;
  				}
  				$auxWord = ""; 
  			}
  		}
  	}
  	return $wrapped;
  }
}
