<?php
$tmp_path = realpath(__DIR__);
echo $tmp_path;

//require 'library/vendor/autoload.php';
//
////require_once 'library/phpword/Autoloader.php';
////
////\PhpOffice\PhpWord\Autoloader::register();
//$phpWord = new  \PhpOffice\PhpWord\PhpWord();
////
//$tmp_path = realpath(__DIR__.'/templates/f.docx');
//echo $tmp_path;
////
//$document=$phpWord->loadTemplate($tmp_path);
////
////
//$data['fio']= "ttttt";
//$data['created'] = date("d.m.Y");
//$data['id_document'] = uniqid();
////
////
//
//foreach ($data as $field=>$value) {
//    $document->setValue($field,$value);
//}
////
//$tmp_path = realpath(__DIR__.'/finish/'.$data['id_document'].'.docx');
////$document->saveAs($tmp_path);
//
//$document->saveAs($tmp_path);

//
//
////$section = $phpWord->addSection($sectionStyle);
////$text = "PHPWord is a library written in pure PHP that provides a set of classes to write to and read from different document file formats.";
////
////$section->addText(htmlspecialchars($text),
////    array('name'=>'Arial','size'=>36,'color'=>'075776','bold'=>TRUE,'italic'=>TRUE),
////    array('align'=>'right','spaceBefore'=>10)
////);
////
////$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord,'Word2007');
////$objWriter->save('doc.docx');