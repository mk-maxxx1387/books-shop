<?php

include_once('fpdf/fpdf.php');

class View 
{
    public function __construct($code, $data, $printType) {
        switch ($printType) {
            case null:
            case 'json':
                $this->printJson($code, $data);
                break;
            /*case 'pdf':
                $this->printPdf($data);
                break;*/
            case 'xml':
                $this->printXml($data);
                break;
            default:
                $this->printJson('404', array("message" => "Not found"));
                break;
        }
    }
    public function printJson($code, $data)
    {
        if(!is_string($data)){
            foreach ($data as $obj) {
                if(is_object($obj)){
                    foreach ($obj as $key) {
                        if(is_array($key)){
                            json_encode($key);
                        }
                    }
                }
                if(is_array($key)){
                    json_encode($key);
                }
            }
        }
        
        http_response_code($code);
        echo json_encode($data);
    }

    /*public function printPdf($data)
    {
        $pdf=new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',10);
        //$headers = array_keys($data[0]);
        for ($i=0; $i < count($headers); $i++) {
            if($i == count($headers)-1){
                $pdf->Cell(22, 7, $headers[$i], 0, 1);
                continue;
            } 
            $pdf->Cell(22, 7, $headers[$i], 0, 0);
            
        }
        $pdf->SetFont('Arial','I',10);
        foreach($data as $item){
            foreach($item as $key => $value){
                if($key == end($headers)){
                    $pdf->Cell(22, 7,$value, 0, 1);
                    continue;
                }
                $pdf->Cell(22, 7,$value, 0, 0);
            }
            $pdf->Cell(0, 0,'', 0, 1);
        }
        $pdf->Output();
        
    }*/

    public function printXml($data)
    {
        $xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
        $this->array_to_xml($data,$xml_data);
        header("Content-type: application/xml");
        echo $xml_data->asXml();
    }

    public function array_to_xml( $data, &$xml_data ) {

        foreach( $data as $key => $value ) {
            if( is_numeric($key) ){
                $key = 'item'.$key;
            }
            if( is_object($value) ) {
                //var_dump($value);
                $subnode = $xml_data->addChild($key);
                $this->array_to_xml($value, $subnode);
            }
            if( is_array($value) ){
                //var_dump($value);
                $subnode = $xml_data->addChild($key);
                $this->array_to_xml($value, $subnode);
            }
            else {
                //var_dump($value);
                if(is_string($value)){
                    $xml_data->addChild("$key",htmlspecialchars("$value"));
                }  
            }
         }
    }
}
