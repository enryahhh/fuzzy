<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Models\Fuzzy;
use FuzzyMembership\Membership;


include "FuzzyModel.php";
include "Membership.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



class FuzzyController {
    public function test(){
        $fuzzy = new Fuzzy();
        $membershipLength = $fuzzy->fuzzyfyLength(0.455);
        $membershipDiameter = $fuzzy->fuzzyfyDiameter(0.365);
        $membershipHeight = $fuzzy->fuzzyfyHeight(0.095);
        $tsukamoto = $fuzzy->rules($membershipLength,$membershipDiameter,$membershipHeight);
        // var_dump($tsukamoto);
    }
}

if(isset($_POST['prediksi'])){
    $fzc = new FuzzyController();
    $fzc->test();
}

?>