<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

use Models\Fuzzy;
use FuzzyMembership\Membership;


include "FuzzyModel.php";
include "Membership.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$spreadsheet = IOFactory::load('abalone.csv');
$worksheet = $spreadsheet->getActiveSheet();
$highestRow = ($worksheet->getHighestRow() > 51) ? 51 : $worksheet->getHighestRow();

class FuzzyController {
    public $niuLength;
    public $niuHeight;
    public $niuDiameter;
    public $matchingRules;
    public $defuzzy;
    public $hasil;
    public function test($length,$diameter,$height){
        $fuzzy = new Fuzzy();
        $this->niuLength = $fuzzy->fuzzyfyLength($length);
        $this->niuDiameter = $fuzzy->fuzzyfyDiameter($diameter);
        $this->niuHeight = $fuzzy->fuzzyfyHeight($height);
        $this->matchingRules = $fuzzy->rules($this->niuLength,$this->niuDiameter,$this->niuHeight);
        $this->defuzzy = $fuzzy->deffuzy($this->matchingRules);
        $this->hasil = $fuzzy->fuzzyfyResult($this->defuzzy);
        // var_dump($tsukamoto);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Metode Tsukamoto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    
    <div class="container pt-5">
    <div class="card mt-5">
        <div class="card-header">Hasil Tsukamoto</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <td>NiuLength</td>
                        <td>NiuDiameter</td>
                        <td>NiuHeight</td>
                        <td>Matching Rules</td>
                        <td>Deffuzy</td>
                        <td>Hasil</td>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                    for ($row = 2; $row <= $highestRow; $row++) :
                        $length = $worksheet->getCell('A' . $row)->getValue();
                        $diameter = $worksheet->getCell('B' . $row)->getValue();
                        $height = $worksheet->getCell('C' . $row)->getValue();
                        $fzc = new FuzzyController();
                        $fzc->test($length,$diameter,$height);
                    ?>
                    <tr>
                        <td>
                        <?php
                            foreach($fzc->niuLength as $key => $valLength) {
                                echo $key.":".$valLength."</br>";
                            }
                        ?>
                        </td>
                        <!-- <td></td> -->
                        <td>
                        <?php
                            foreach($fzc->niuDiameter as $key => $valDiameter) {
                                echo $key.":".$valDiameter."</br>";
                            }
                        ?>
                        </td>
                        <td>
                        <?php
                            foreach($fzc->niuHeight as $key => $valHeight) {
                                echo $key.":".$valHeight."</br>";
                            }
                        ?>
                        </td>
                        <td>
                            <ul>
                            <?php
                                for ($i = 0; $i < count($fzc->matchingRules); $i++) {
                                    $index = $fzc->matchingRules[$i]['rule_index'];
                                    $degree = $fzc->matchingRules[$i]['matching_degree'];
                                    $output = $fzc->matchingRules[$i]['output'];
                                    $z = $fzc->matchingRules[$i]['z'];
                                    echo "<li>"."Rule Ke-" . ($index + 1) . "dengan hasil = ".$output." dengan alpha predikat = " . $degree . "\n dan Z = ".$z." <br>"."</li>";
                                }
                            ?>
                            </ul>
                        </td>
                        <td>
                            <?= $fzc->defuzzy; ?>
                        </td>
                        <td>
                            <?= $fzc->hasil; ?>
                        </td>
                    </tr>
                    <?php endfor;?>
                </tbody>
            </table>
            <a href="index.php" class="btn btn-primary">Kembali</a>
        </div>
    </div>
    </div>




</body>
</html>