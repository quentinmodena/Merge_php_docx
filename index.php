<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once 'vendor/autoload.php';

$PHPWord = new \PhpOffice\PhpWord\PhpWord();
$section = $PHPWord->addSection();

getElements('doc1.docx', $section);

$section2 = $PHPWord->addSection();
getElements('doc2.docx', $section2);


$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($PHPWord, 'Word2007');
$objWriter->save('docFinal.docx');


function getElements($fileName, &$section){
    $docImport = \PhpOffice\PhpWord\IOFactory::load($fileName);
    
    $sectionsImport = $docImport->getSections();
    $sectionsCount = count($sectionsImport);

    for ($iSection = 0; $iSection < $sectionsCount; ++$iSection) {
        $curSection = $sectionsImport[$iSection];
        $elements = $curSection->getElements();
        $section->addElementsFromAnotherPhpWord($elements);
        $section->addImage('./jul.jpg');
    }
}