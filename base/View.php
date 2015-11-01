<?php
/**
 * Created by PhpStorm.
 * User: jokerwolf
 * Date: 31/10/15
 * Time: 23:16
 */

class View {
    protected $viewFile;

    public function __construct($viewFile){
        $this -> viewFile = $viewFile;
    }

    public function output($viewModel, $template = "maintemplate"){
        $templateFile = $_SERVER['DOCUMENT_ROOT']. "/views/" .$template. ".php";

        if (file_exists($this -> viewFile)) {
            if ($template) {
                //include the full template
                if (file_exists($templateFile)) {
                    require($templateFile);
                } else {
                    require($_SERVER['DOCUMENT_ROOT']. "/views/error/badtemplate.php");
                }
            } else {
                //we're not using a template view so just output the method's view directly
                require($this -> viewFile);
            }
        } else {
            require($_SERVER['DOCUMENT_ROOT']. "/views/Error/badview.php");
        }
    }

}