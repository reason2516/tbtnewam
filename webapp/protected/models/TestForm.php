<?php

class TestForm extends CFormModel {

    public $name;
    public $pdftest1;
    public $pdftest2;
    public $pdftest3;
    public $pdftest4;
    public $pdftest5;
    public $pdftest6;
    public $checkBoxTest;

    public function rules() {
        return array(
            array('name', 'required'),
            array('name,pdftest1,pdftest2,pdftest3,pdftest4,pdftest5,pdftest6', 'safe'),
            array(
                'pdftest1,pdftest2,pdftest3,pdftest4,pdftest5,pdftest6',
                'file',
                'allowEmpty' => true,
                'types' => 'pdf',
                'maxSize' => 1024 * 1024 * 20, //20MB
                'tooLarge' => '文件大于20M，上传失败！请上传小于20M的文件！'
            ),
        );
    }

    public function attributeLabels() {
        //parent::attributeLabels();
        return array(
            'name' => 'name',
            'pdftest1' => 'PDFFiles01',
            'pdftest2' => 'PDFFiles02',
            'pdftest3' => 'PDFFiles03',
            'pdftest4' => 'PDFFiles04',
            'pdftest5' => 'PDFFiles05',
            'pdftest6' => 'PDFFiles06',
        );
    }

}
