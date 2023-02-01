<?php
namespace FuzzyMembership;


class Membership {
    private $a,$b,$c;
    private $hasil;

    public function __construct($a,$b,$c){
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }
    //a = 0.2 b = 0.4 c = 0.6
    public function menurun($x){
        if($x >= $this->b){
            $this->hasil = 0;
        } else if(($this->a <= $x)&&($x<= $this->b)) {
            $this->hasil = $this->b - $x / $this->b - $this->a;
        }else if($x <= a){
            $this->hasil = 1;
        }

        return $this->hasil;
    }

    public function triangular($x){
        if(($x <= $this->a) || ($x >= $this->c)){
            $this->hasil = 0;
        }else if(($this->a <= $x) && ($x <= $this->b)){
            $this->hasil = $x - $this->a / $this->b - $this->a;
        }else if(($this->b <= $x) && ($x <= $this->b)){
            $this->hasil = $this->c - $x / $this->c - $this->b;
        }

        return $this->hasil;
    }

    public function menaik($x){
        if($x <= $this->a){
            $this->hasil = 0;
        } else if(($this->a <= $x)&&($x<= $this->b)) {
            $this->hasil =  $x - $this->a / $this->b - $this->a;
        }else if($x >= $this->b){
            $this->hasil = 1;
        }

        return $this->hasil;
    }
}


?>