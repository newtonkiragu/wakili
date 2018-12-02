<?php

namespace frontend\controllers;

use Yii;

class TestController extends \yii\web\Controller {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionTess() {
        $source = __DIR__ . "/Agreement_for_sale_of_a_Motor_Vehicle-v1.docx";
        $dest = __DIR__ . "/COPY2.docx";
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($source);
//        $templateProcessor->setValue('year', 'John Doe');
        $templateProcessor->setValue(array('City', 'Street'), array('Detroit', '12th Street'));
        $templateProcessor->saveAs($dest);
        
        
//        $name = basename(__FILE__, '.php');
//        $source = "C:\xampp\htdocs\wakili\frontend\web\DOCUMENTS\Products.pdf";
//        $source = __DIR__ . "/Agreement_for_sale_of_a_Motor_Vehicle-v1.docx";
//        $source = "../../web/DOCUMENTS/pdf.pdf";
//        $source ="../web/DOCUMENTS/pdf.pdf";

//        echo date('H:i:s'), " Reading contents from `{$source}`";

//        $str = $this->readmse($source);
//        die($str);


//        $phpWord = \PhpOffice\PhpWord\IOFactory::load($source);
//        var_dump($phpWord);
//        die();
// Save file
//        echo write($phpWord, basename(__FILE__, '.php'), $writers);
//        if (!CLI) {
//            include_once 'Sample_Footer.php';
//        }
    }

    function read_docx($filename) {

        $striped_content = '';
        $content = '';

        if (!$filename || !file_exists($filename))
            return false;

        $zip = zip_open($filename);
        if (!$zip || is_numeric($zip))
            return false;

        while ($zip_entry = zip_read($zip)) {

            if (zip_entry_open($zip, $zip_entry) == FALSE)
                continue;

            if (zip_entry_name($zip_entry) != "word/document.xml")
                continue;

            $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

            zip_entry_close($zip_entry);
        }
        zip_close($zip);
        $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
        $content = str_replace('</w:r></w:p>', "\r\n", $content);
        $striped_content = strip_tags($content);

        return $striped_content;
    }

    function read_docx2($filename) {

        $zip = new \ZipArchive;
        $fileToModify = $filename;
        if ($zip->open($filename) === TRUE) {
            //Read contents into memory
            $oldContents = $zip->getFromName($fileToModify);
            //   var_dump($oldContents);die();
            //Modify contents:
            $newContents = str_replace('title', 'hhhh', $oldContents);
            //Delete the old...
            $zip->deleteName($fileToModify);
            //Write the new...
            // $zip->addFromString($fileToModify, $newContents);
            //And write back to the filesystem.
            $zip->close();
            echo 'ok';
        } else {
            echo 'failed';
        }
    }

    function readmse($filename) {
        /**
         * Edit a Word 2007 and newer .docx file.
         * Utilizes the zip extension http://php.net/manual/en/book.zip.php
         * to access the document.xml file that holds the markup language for
         * contents and formatting of a Word document.
         *
         * In this example we're replacing some token strings.  Using
         * the Office Open XML standard ( https://en.wikipedia.org/wiki/Office_Open_XML )
         * you can add, modify, or remove content or structure of the document.
         */
// Create the Object.
        $zip = new \ZipArchive();
// Use same filename for "save" and different filename for "save as".
        $inputFilename = $filename;
//        $outputFilename = 'testfile.docx';
        $outputFilename = __DIR__ . "/MYFIREBASEAPI2.docx";
// Some new strings to put in the document.
        $token1 = 'Hello World!';
        $token2 = 'Your mother smelt of elderberries, and your father was a hamster!';
// Open the Microsoft Word .docx file as if it were a zip file... because it is.
        if ($zip->open($filename, \ZipArchive::CREATE) !== TRUE) {
            echo "Cannot open $filename :( ";
            die;
        }
// Fetch the document.xml file from the word subdirectory in the archive.
        $xml = $zip->getFromName('word/document.xml');
// Replace the tokens.
        $xml = str_replace('{TOKEN1}', $token1, $xml);
        $xml = str_replace('{TOKEN2}', $token2, $xml);
// Write back to the document and close the object
        if ($zip->addFromString('word/document.xml', $xml)) {
            echo 'File written!';
        } else {
            echo 'File not written.  Go back and add write permissions to this folder!l';
        }
        $zip->close();
    }

}
