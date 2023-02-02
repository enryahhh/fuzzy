<?php
namespace Models;

class Fuzzy {
    private $length;
    private $diameter;
    private $height;
    private $membership;
    private $matchingRules;
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

    public function calculateZ($input,$a,$b){
        $z = $b-$input*($b-$a);
        return $z;
    }


    public function fuzzyfyLength($input){
        $a = 0.2;
        $b = 0.4;
        $c = 0.6;

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
                if($arrRules[$i]['output']=='female' || $arrRules[$i]['output']=='male'){
                    $z = $this->calculateZ($weights, 0.3,0.5);
                }else{
                    $z = $this->calculateZ($weights, 0.5,0.7);
                }
                $matching_rules[] = array(
                    'rule_index' => $i,
                    'matching_degree' => $weights,
                    'output' => $arrRules[$i]['output'],
                    'z' => $z
                );
            }
        }

        // $output_values = array();
        // var_dump($matching_rules);
        // $r1 = min($length,$diameter,$height);
        // Print the matching rules
        // var_dump($matching_rules);
        // echo "The matching rules are: \n <br>";
        // $rata2 = 0;
        // $rata = 0;
        // for ($i = 0; $i < count($matching_rules); $i++) {
        //     $index = $matching_rules[$i]['rule_index'];
        //     $degree = $matching_rules[$i]['matching_degree'];
        //     $output = $matching_rules[$i]['output'];
        //     $z = $matching_rules[$i]['z'];
        //     if (!isset($output_values[$output])) {
        //         $output_values[$output] = 0;
        //     }
        //     $rata2 += $degree*$z;
        //     $rata += $degree;
        //     $output_values[$output] += $degree;
        //     echo "Rule " . ($index + 1) . " with matching degree of " . $degree . "\n - Z ".$z." <br>";
        // }

        // $hasil = $rata2 / $rata;
        // $fuzzySex = $this->membership($hasil,0.3,0.5,0.7);
        // $hasil = ["female"=>$fuzzySex[0],"male"=>$fuzzySex[1],"inter"=>$fuzzySex[2]];
        // arsort($hasil);
        // var_dump(array_key_first($hasil));
        $this->matchingRules = $matching_rules;
        return $this->matchingRules;
    
    }

    public function deffuzy($matchingRules){
        $output_values = array();
        $rata2 = 0;
        $rata = 0;
        for ($i = 0; $i < count($matchingRules); $i++) {
            $index = $matchingRules[$i]['rule_index'];
            $degree = $matchingRules[$i]['matching_degree'];
            $output = $matchingRules[$i]['output'];
            $z = $matchingRules[$i]['z'];

            $rata2 += $degree*$z;
            $rata += $degree;
        }
        return $rata2 / $rata;
    }

    public function fuzzyfyResult($deffuzy){
        $fuzzySex = $this->membership($deffuzy,0.3,0.5,0.7);
        $hasil = ["female"=>$fuzzySex[0],"male"=>$fuzzySex[1],"inter"=>$fuzzySex[2]];
        arsort($hasil);
        return array_key_first($hasil);
    }




}

?>