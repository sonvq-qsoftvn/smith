<?php

/*
 * Developed by Gwen :-)
 * imported at the cms by Kurt
 */

class ExporttmxController extends Zend_Controller_Action
{

	public function indexAction() {
		$lngs = array(
			'nl',
			'fr',
			'en',
			'de'
		);
		$xmlfiles = array(
			APPLICATION_ROOT . '/application/var/locale/global.tmx',
			APPLICATION_ROOT . '/application/var/locale/errors.tmx',
			APPLICATION_ROOT . '/application/var/locale/contact.tmx'
		);
		$masterarray = array();

		foreach($xmlfiles as $xmlfile) {
			$superarray = array();
			$xml = simplexml_load_file($xmlfile);
			$filename = end(explode('/', $xmlfile));

			//get key names
			foreach($xml->children() as $child) {
				if($child->getName() == 'body') {
					//Zend_Debug::dump($child);
					$i = 0;
					foreach($child as $item) {
						//Zend_Debug::dump($item);
						$wordname = $item->attributes();
						$superarray[$i]['label'] = (string)$wordname;
						$i++;
					}
				}
			}

			foreach($lngs as $lng) {
				$i = 0;
				foreach($xml->xpath('//tu/tuv[@xml:lang="' . $lng . '"]') as $code) {
					//echo $code->seg."<br />";
					$superarray[$i][$lng] = (string)$code->seg;
					$i++;
				}
			}

			$masterarray[$filename] = $superarray;
		}

		$this->toExcel($masterarray, $lngs);
		die();
	}

	public function importAction() {
		include APPLICATION_ROOT . '/library/PHPExcel/IOFactory.php';
		$inputFileName = APPLICATION_ROOT . '/public_html/excel/vertaling.xls';

		//  Read your Excel workbook
		try {
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader = PHPExcel_IOFactory::createReaderForFile($inputFileName);
			$objPHPExcel = $objReader->load($inputFileName);
		} catch (Exception $e) {
			die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
		}

		$sheetamount = $objPHPExcel->getSheetCount();

		//start voor elk werkblad
		for($sheetnumber = 0; $sheetnumber < $sheetamount; $sheetnumber++) {
			//  Get worksheet dimensions
			$sheet = $objPHPExcel->getSheet($sheetnumber);
			$highestRow = $sheet->getHighestRow();
			$highestColumn = PHPExcel_Cell::columnIndexFromString($sheet->getHighestColumn());

			$arrColumns = array(
				0 => 'A',1 => 'B',2 => 'C',3 => 'D',4 => 'E',5 => 'F',6 => 'G',7 => 'H',
				8 => 'I',9 => 'J',10 => 'K',11 => 'L',12 => 'M',13 => 'N',14 => 'O',
				15 => 'P',16 => 'Q',17 => 'R',18 => 'S',19 => 'T',20 => 'U',21 => 'V',
				22 => 'W',23 => 'X',24 => 'Y',25 => 'Z',26 => 'AA',27 => 'AB',28 => 'AC',
				29 => 'AD',30 => 'AE',31 => 'AF',32 => 'AG',33 => 'AH',34 => 'AI',35 => 'AJ',
				36 => 'AK',37 => 'AL',38 => 'AM',39 => 'AN',40 => 'AO',41 => 'AP',42 => 'AQ',
				43 => 'AR',44 => 'AS',45 => 'AT',46 => 'AU',47 => 'AV',48 => 'AW',49 => 'AX',
				50 => 'AY',51 => 'AZ',52 => 'BA',53 => 'BB',54 => 'BC',55 => 'BD',56 => 'BE',
				57 => 'BF',58 => 'BG',59 => 'BH',60 => 'BI',61 => 'BJ',62 => 'BK',63 => 'BL',
				64 => 'BM',65 => 'BN',66 => 'BO',67 => 'BP',68 => 'BQ',69 => 'BR',70 => 'BS',
				71 => 'BT',72 => 'BU',73 => 'BV',74 => 'BW',75 => 'BX',76 => 'BY',77 => 'BZ'
			);

			//  Loop through each row of the worksheet in turn
			$tmxdata = array();
			for($row = 1; $row <= $highestRow; $row++) {
				//  Read a row of data into an array
				$rowData = $sheet->rangeToArray('A' . $row . ':' . $arrColumns[$highestColumn] . $row, NULL, TRUE, FALSE);
				$tmxdata[$row] = $rowData;
			}

			//tmx name
			$tmxname = $tmxdata[1][0][0];
			if($tmxname != '' && $tmxname != "NULL" && $tmxname != NULL) {
				//get languages
				$languages = array();
				$ti = 1;
				foreach($tmxdata[3][0] as $key => $label) {
					if($label != '' && $label != 'LABEL' && $label != 'NULL') {
						$languages[$ti] = $label;
						$ti++;
					}
				}

				$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
				$xml .= "<!DOCTYPE tmx SYSTEM \"tmx14.dtd\">\n";
				$xml .= "<tmx version=\"1.4\">\n";
				$xml .= "<header creationtoolversion=\"1.0.0\" datatype=\"winres\" segtype=\"sentence\" adminlang=\"en-us\" srclang=\"en-us\" o-tmf=\"abc\"></header>\n";
				$xml .= "<body>\n";

				//get content
				for($row = 4; $row <= $highestRow; $row++) {
					$key = $tmxdata[$row][0][0];
					$xml .= "<tu tuid=\'" . $key . "\'>\n";
					foreach($languages as $key => $language) :

						$xml .= "<tuv xml:lang=\"" . $language . "\"><seg>" . $tmxdata[$row][0][$key] . "</seg></tuv>\n";
					endforeach;
					//einde van het tuid
					$xml .= "</tu>\n";
				}

				//einde XML
				$xml .= "</body>\n";
				$xml .= "</tmx>";

				//Zend_Debug::dump($xml);die();
				$newtmxfile = APPLICATION_ROOT . '/application/var/locale/' . $tmxname;
				$handle = fopen($newtmxfile, 'w');
				fwrite($handle, $xml);
				fclose($handle);
				chmod($newtmxfile, 0777);
			}
		}

		die('done');
	}

	public function toExcel($masterarray, $lngs) {
		$this->_helper->viewRenderer->setNoRender(true);
		$this->_helper->layout->disableLayout();

		$title = "Export TMX {$_SERVER['SERVER_NAME']}";

		/* create excel */
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("SxCms - Gwen");
		$sheetId = 0;
		foreach($masterarray as $title => $superarray) :
			$objPHPExcel->createSheet(NULL, $sheetId);
			$objPHPExcel->setActiveSheetIndex($sheetId);
			$objPHPExcel->getActiveSheet()->setTitle($title);
			$objPHPSheet = $objPHPExcel->getActiveSheet();

			/* page setup */
			$objPHPSheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
			$objPHPSheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
			$objPHPSheet->getHeaderFooter()->setOddFooter('&Rpagina &P van &N');
			$objPHPSheet->setShowGridlines(false);
			$objPHPSheet->getDefaultStyle()->getFont()->setSize(12.00);
			$objPHPSheet->getDefaultRowDimension()->setRowHeight(20);
			$objPHPSheet->setTitle($title);

			/* page margins */
			$margins = new PHPExcel_Worksheet_PageMargins();
			$margins->setLeft(0.2);
			$margins->setRight(0.2);
			$margins->setTop(0.2);
			$margins->setBottom(0.3);
			$objPHPSheet->setPageMargins($margins);

			/* set headers */
			$objPHPSheet->setCellValue('A3', 'LABEL');
			$i = 0;
			$alphabet = range('A', 'Z');
			foreach($lngs as $lng) {
				$i++;
				$objPHPSheet->setCellValue($alphabet[$i] . '3', $lng);
			}

			/* layout */
			$objPHPSheet->mergeCells('A1:D1');
			$objPHPSheet->duplicateStyleArray(array('font' => array(
					'size' => 21,
					'bold' => TRUE
				)), "A1:F1");
			// title
			$objPHPSheet->duplicateStyleArray(array(
				'font' => array('bold' => TRUE),
				'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
			), "A3:F3");
			//headers

			/* set data */
			$objPHPSheet->setCellValue('A1', $title);
			$rij = 3;
			foreach($superarray as $result) {
				$rij++;
				$objPHPSheet->setCellValue('A' . $rij, $result['label']);
				$xi = 0;
				foreach($lngs as $lng) {
					$xi++;
					$objPHPSheet->setCellValue($alphabet[$xi] . $rij, $result[$lng]);
				}
			}

			/* column width */
			for($ii = 65; $ii < 68; $ii++) {
				$objPHPSheet->getColumnDimension(chr($ii))->setAutoSize(true);
			}

			$sheetId++;
		endforeach;
		$objPHPExcel->setActiveSheetIndex(0);

		/* output */
		$date = date('d-m-Y-h-i-s');
		$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
		//$objWriter->save(APPLICATION_ROOT .
		// "\public_html\\tmp\\export-leden-$date.xls");
		//$objWriter->save("/public_html/tmp/export-leden-$date.xls");

		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header("Content-Disposition: attachment; filename=export-tmx-$date.xls");
		header("Content-Transfer-Encoding: binary");

		$objWriter->save("php://output");
		die();
	}

}
