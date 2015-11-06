<?php
namespace Casa\Front2Bundle\Services\Extension;

use \Twig_Filter_Function;
use \Twig_Filter_Method;


/**
 * Description of TwigExtension
 *
 * @author Willy
 */
class TwigExtension extends \Twig_Extension {
    //put your code here
     
    
    public function getFunctions(){
        return array(
            "file_exists" => new \Twig_Function_Function('file_exists'),
                );
        }
        public function getName(){
            return 'twig_extension';
        }
    
}
