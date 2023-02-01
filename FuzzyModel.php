<?php
namespace Models;

class Fuzzy {
    private $length;
    private $diameter;
    private $height;
    private $membership;

    // public function __construct($membership){
    //     $this->membership = $membership;
    // }

    public function membership($input,$a,$b,$c){
        $arr = [0,0,0];
        // length a = 0.2 , b = 0.4 , c = 0.6
        // diameter a = 0.2 , b = 0.4 , c = 0.5
        // 
        if($input < $a){
            $arr[0] = 1;
        }else if(($input >=$a) && ($input <= $b)){
            $arr[0] = ($b - $input) / ($b - $a); //itung rumus anu menurun
            $arr[1] = ($input - $a) / ($b - $a);// itung rumus anu triangular
        }else if (($input >= $b) && ($input <= $c)){
            $arr[1] = ($c - $input) / ($c - $b);// itung rumus anu triangular
            $arr[2] = ($input - $b) / ($c - $b);// itung rumus anu menaik
        }else if($input > $c){
            $arr[1] = 0;
            $arr[2] = 1;
        }
        return $arr;
    }

    public function fuzzyfyLength($input){
        $a = 0.2;
        $b = 0.4;
        $c = 0.6;
        // pendek
        // $pendek=0;
        // $sedang=0;
        // $panjang=0;

        // if($input <= 0.2){
        //     $pendek = 1;
        // }else if(($input >=0.2) && ($input <=0.4)){
        //     $pendek = (0.4 - $input) / (0.4 - 0.2); //itung rumus anu menurun
        //     $sedang = ($input - 0.2) / (0.4 - 0.2);// itung rumus anu triangular
        // }else if (($input >= 0.4) && ($input <= 0.6)){
        //     $sedang = (0.6 - $input) / (0.6 - 0.4);// itung rumus anu triangular
        //     $panjang = ($input - 0.4) / (0.6 - 0.4);// itung rumus anu menaik
        // }else if($input >= 0.4){
        //     $pendek = 0;
        //     $panjang = 1;
        // }

        $value = $this->membership($input,$a,$b,$c);
            // var_dump($value);
        $this->length = [];
        $this->length["pendek"]=$value[0];
        $this->length["sedang"]=$value[1];
        $this->length["panjang"]=$value[2];
        return $this->length;
    }

    public function fuzzyfyDiameter($input){
        // pendek
        $a = 0.2;$b = 0.4;$c = 0.5;
        $value = $this->membership($input,$a,$b,$c);

        $this->diameter = [
            "tipis"=> $value[0],
            "sedang"=>$value[1],
            "lebar"=> $value[2]];
        return $this->diameter;
    }

    public function fuzzyfyHeight($input){
        $a = 0.1; $b = 0.15; $c = 0.2;
        // $rendah=0;
        // $sedang=0;
        // $tinggi=0;

        // if($input < 0.1){
        //     $rendah = 1;
        // }else if(($input >= 0.1) && ($input <= 0.15)){
        //     $rendah = (0.1 - $input) / (0.15 - 0.1); //itung rumus anu menurun
        //     $sedang = ($input - 0.1) / (0.15 - 0.1);// itung rumus anu triangular
        // }
        // else if (($input > 0.15) && ($input <= 0.2)){
        //     $sedang = (0.6 - $input) / (0.6 - 0.4);// itung rumus anu triangular
        //     $tinggi = ($input - 0.4) / (0.6 - 0.4);// itung rumus anu menaik
        // }else if($input > 0.2){
        //     $rendah = 0;
        //     $tinggi = 1;
        // }
        $value = $this->membership($input,$a,$b,$c);
        $this->height = [
            "rendah"=>$value[0],
            "sedang"=>$value[1],
            "tinggi"=>$value[2]];
        return $this->height;
    }


    public function rules($membershipLength,$membershipDiameter,$membershipHeight){


        // [R1] IF F1 Pendek AND F2 Tipis AND F3 Rendah THEN FEMALE
        $arrRules = [
            // R1 - R3
            [
                "length"=> "pendek" , "diameter" => "tipis" , "height" => "rendah", "output" => "female"
            ],
            [
                "length"=> "pendek" , "diameter" => "tipis" , "height" => "sedang", "output" => "female"
            ],
            [
                "length"=> "pendek" , "diameter" => "tipis" , "height" => "tinggi", "output" => "female"
            ],
            // R4 - R6
            [
                "length"=> "pendek" , "diameter" => "sedang" , "height" => "rendah", "output" => "female"
            ],
            [
                "length"=> "pendek" , "diameter" => "sedang" , "height" => "sedang", "output" => "male"
            ],
            [
                "length"=> "pendek" , "diameter" => "sedang" , "height" => "tinggi", "output" => "intersex"
            ],
            // R7 - R9
            [
                "length"=> "pendek" , "diameter" => "lebar" , "height" => "rendah", "output" => "female"
            ],
            [
                "length"=> "pendek" , "diameter" => "lebar" , "height" => "sedang", "output" => "male"
            ],
            [
                "length"=> "pendek" , "diameter" => "lebar" , "height" => "tinggi", "output" => "intersex"
            ],
            // R10 - R12
            [
                "length"=> "sedang" , "diameter" => "tipis" , "height" => "rendah", "output" => "female"
            ],
            [
                "length"=> "sedang" , "diameter" => "tipis" , "height" => "sedang", "output" => "male"
            ],
            [
                "length"=> "sedang" , "diameter" => "tipis" , "height" => "tinggi", "output" => "intersex"
            ],
            // R13 - R15
            [
                "length"=> "sedang" , "diameter" => "sedang" , "height" => "rendah", "output" => "male"
            ],
            [
                "length"=> "sedang" , "diameter" => "sedang" , "height" => "sedang", "output" => "male"
            ],
            [
                "length"=> "sedang" , "diameter" => "sedang" , "height" => "tinggi", "output" => "male"
            ],
            // R16 - R18
            [
                "length"=> "sedang" , "diameter" => "lebar" , "height" => "rendah", "output" => "male"
            ],
            [
                "length"=> "sedang" , "diameter" => "lebar" , "height" => "sedang", "output" => "male"
            ],
            [
                "length"=> "sedang" , "diameter" => "lebar" , "height" => "tinggi", "output" => "intersex"
            ],
            // R19 - R21
            [
                "length"=> "panjang" , "diameter" => "tipis" , "height" => "rendah", "output" => "female"
            ],
            [
                "length"=> "panjang" , "diameter" => "tipis" , "height" => "sedang", "output" => "male"
            ],
            [
                "length"=> "panjang" , "diameter" => "tipis" , "height" => "tinggi","output" => "intersex"
            ],
            // R22 - R24
            [
                "length"=> "panjang" , "diameter" => "sedang" , "height" => "rendah", "output" => "male"
            ],
            [
                "length"=> "panjang" , "diameter" => "sedang" , "height" => "sedang", "output" => "male"
            ],
            [
                "length"=> "panjang" , "diameter" => "sedang" , "height" => "tinggi", "output" => "intersex"
            ],
            // R25 - R27
            [
                "length"=> "panjang" , "diameter" => "lebar" , "height" => "rendah", "output" => "intersex"
            ],
            [
                "length"=> "panjang" , "diameter" => "lebar" , "height" => "sedang", "output" => "intersex"
            ],
            [
                "length"=> "panjang" , "diameter" => "lebar" , "height" => "tinggi", "output" => "intersex"
            ],
        ];

        $matching_rules = array();

        $weights = array();
        for ($i = 0; $i < count($arrRules); $i++) {
            $length_rule = $arrRules[$i]['length'];
            $diameter_rule = $arrRules[$i]['diameter'];
            $height_rule = $arrRules[$i]['height'];

            $weights = min(
                $membershipLength[$length_rule],
                $membershipDiameter[$diameter_rule],
                $membershipHeight[$height_rule]
            );

            if ($weights > 0) {
                $matching_rules[] = array(
                    'rule_index' => $i,
                    'matching_degree' => $weights
                );
            }
        }

        
        var_dump($matching_rules);
        // $r1 = min($length,$diameter,$height);
        // Print the matching rules
        echo "The matching rules are: \n";
        for ($i = 0; $i < count($matching_rules); $i++) {
            $index = $matching_rules[$i]['rule_index'];
            $degree = $matching_rules[$i]['matching_degree'];
            echo "Rule " . ($index + 1) . " with matching degree of " . $degree . "\n";
        }
    
    }




}

?>