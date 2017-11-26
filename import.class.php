<?php

class Import {
    function __construct() {
         $this->zeilenumbruch = "\n";
         $this->trenner = ';';
         $this->aufbau = '';
    }
    
    public function readImportData($file,$type = 'csv') {
        $this->file = $file;
        $this->setTypeForImport($type);        
    }
    
    private function setTypeForImport($type) {
        switch($type) {
            case 'csv':
                $this->readCSVData();
                break;
            default:
                die();
        }
    }
    
    private function readCSVData() {
        if (($handle = fopen($this->file, 'r')) !== FALSE) {
            $counter = 0;
             while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $this->import_data[$counter] = $data;
                $counter++;
            }
        }
        fclose($handle);
    }

    public function printImportData() {
        echo '<pre>';
        print_r($this->import_data);
        echo '</pre>';
    }
    
    public function generateStarMoneyFormat($file = 'import_ready.txt',$filename = 'unbekannt') {
		for($i=0;$i<count($this->import_data);$i++) {
	    	 if($i > 0) {
	         	if($i >= 1 && $this->import_data[$i][1] == $this->import_data[$i-1][1]) {
	         		if($temp == $i)	$temp--;
				} else {
	            	$temp = $i;
	                $this->aufbau .= "P".$this->trenner;
	                $this->aufbau .= "\"".$temp."\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->trenner;
	                $this->aufbau .= "\"".utf8_decode($this->import_data[$i][1])."\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->trenner;
	                $this->aufbau .= "\"Import aus Datei: ".$filename."<BR>Betrag: ".$this->import_data[$i][6]."\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->zeilenumbruch;
	                $this->aufbau .= "A".$this->trenner;
	                $this->aufbau .= "\"".$temp."\"".$this->trenner;;
	                $this->aufbau .= "\"".$this->import_data[$i][2]."\"".$this->trenner;;
	                $this->aufbau .= "\"".$this->import_data[$i][4]."\"".$this->trenner;
	                $this->aufbau .= "\"\"".$this->trenner;;
	                $this->aufbau .= "0".$this->zeilenumbruch;
	            }
	            $this->aufbau .= "E".$this->trenner;
	            $this->aufbau .= "\"".$temp."\"".$this->trenner;
	            $this->aufbau .= "\"".utf8_decode($this->import_data[$i][3])."\"".$this->trenner;
	            $this->aufbau .= "\"".utf8_decode($this->import_data[$i][5])."\"".$this->trenner;
	            $this->aufbau .= "\"".utf8_decode($this->import_data[$i][7])."\"".$this->trenner;
	            $this->aufbau .= 0;
	            $this->aufbau .= $this->zeilenumbruch;
	        }
		}
		
        $aufbau_anfang = '#StarMoney 9.0 Address Book Revision 1.0#'.$this->zeilenumbruch;
        /*$dateiname = $file;
        $handler = fopen($dateiname , "w+");
        fwrite($handler , $aufbau_anfang.$this->aufbau);
        fclose($handler);*/
		
		header('Content-disposition: attachment; filename=StarMoney9_Adr.txt');
		header('Content-type: text/plain');
		
		echo $aufbau_anfang;
		echo $this->aufbau;
    }
}