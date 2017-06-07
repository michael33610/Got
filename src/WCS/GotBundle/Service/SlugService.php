<?php
namespace WCS\GotBundle\Service;

class SlugService
{
    private $value;

    public function slugify($value)
    {

        // Do my service stuffs        
        // ...
        //traitement de value

         
        //algo inernet
         // replace non letter or digits by -
        
          $value = preg_replace('~[^\pL\d]+~u', '-', $value);

          // transliterate
          $value = iconv('utf-8', 'us-ascii//TRANSLIT', $value);

          // remove unwanted characters
          $value = preg_replace('~[^-\w]+~', '', $value);

          // trim
          $value = trim($value, '-');

          // remove duplicate -
          $value = preg_replace('~-+~', '-', $value);

          // lowercase
          $value = strtolower($value);

          if (empty($value)) {
            return 'n-a';
          }

          //$value=$value."bidon";

        //$this->value     = value;

        $SlugServiceResult=$value;
        var_dump($value);
        return $SlugServiceResult;
    }
}
