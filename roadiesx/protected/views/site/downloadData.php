<?php
	require 'vendor/Classes/PHPExcel.php';
	$option = $_GET['option'];
	$location = $_GET['location'];
	$store = $_GET['store'];
	$hostname = 'localhost';
	$dbname = 'harisadu';
	$username = 'root';
	$password = 'LMWadmin12345';
	$subpath = "https://apps3.likemyworld.com/bigb/";
	$con = mysql_connect($hostname, $username, $password);
	if (!$con) {
		die('Unable to connect to the database: ' . mysql_error());
	}
	$dataArray = array();
	mysql_select_db($dbname, $con);
	
	if($store != 0 && $location != 0){
		$result = mysql_query("SELECT * FROM heroine_participants_entries where status='".$option."' and city=".$location." and loc=".$store) or die(mysql_error());
	} else if ($location != 0){
		$result = mysql_query("SELECT * FROM heroine_participants_entries where status='".$option."' and city=".$location) or die(mysql_error());
	} else {
		$result = mysql_query("SELECT * FROM heroine_participants_entries where status='".$option."'") or die(mysql_error());
	}
	// Instantiate a new PHPExcel object
	$objPHPExcel = new PHPExcel(); 
	// We'll be outputting an excel file
	header('Content-type: application/vnd.ms-excel');
	
	// It will be called file.xls
	header('Content-Disposition: attachment; filename="file_'.$option.'_'.date("d-m-Y").'.xls"');
	// Set the active Excel worksheet to sheet 0
	$objPHPExcel->setActiveSheetIndex(0); 
	// Initialise the Excel row number
	$rowCount = 2; 
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(60);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(100);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(100);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(100);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(40);
	$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
	$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
	
	
	
	/* SET CELL HEADERS */
	$objPHPExcel->getActiveSheet()->SetCellValue('A1','Name');
	$objPHPExcel->getActiveSheet()->SetCellValue('B1','e-mail');
	$objPHPExcel->getActiveSheet()->SetCellValue('C1','Society Name');
	$objPHPExcel->getActiveSheet()->SetCellValue('D1','Address');
	$objPHPExcel->getActiveSheet()->SetCellValue('E1','Image_1');
	$objPHPExcel->getActiveSheet()->SetCellValue('F1','Image_2');
	$objPHPExcel->getActiveSheet()->SetCellValue('G1','Image_3');	
	$objPHPExcel->getActiveSheet()->SetCellValue('H1','Date of Purchase');
	$objPHPExcel->getActiveSheet()->SetCellValue('I1','Status');
	$objPHPExcel->getActiveSheet()->SetCellValue('J1','Store');
	$objPHPExcel->getActiveSheet()->SetCellValue('K1','City');
	$objPHPExcel->getActiveSheet()->SetCellValue('L1','Contact');
	$objPHPExcel->getActiveSheet()->SetCellValue('M1','Landline');
	$objPHPExcel->getActiveSheet()->SetCellValue('N1','Bill Number');
	$objPHPExcel->getActiveSheet()->SetCellValue('O1','Created Date');
	
	/* set font weigth to header */	
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
	
	// Iterate through each result from the SQL query in turn
	// We fetch each database result row into $row in turn
	while($row = mysql_fetch_array($result)){ 
	    // Set cell An to the "name" column from the database (assuming you have a column called name)
	    //    where n is the Excel row number (ie cell A1 in the first row)
	    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['name']." ".$row['sname']); 
	    // Set cell Bn to the "age" column from the database (assuming you have a column called age)
	    //    where n is the Excel row number (ie cell A1 in the first row)
	    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['email']); 
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['socname']); 
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row['address']); 
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $subpath . $row['img1']); 
		$objPHPExcel->getActiveSheet()->getCell('E'.$rowCount)->getHyperlink()->setUrl($subpath . $row['img1']);		
		$objPHPExcel->getActiveSheet()->getStyle('E'.$rowCount)->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
		$objPHPExcel->getActiveSheet()->getStyle('E'.$rowCount)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
		
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $subpath . $row['img2']); 
		$objPHPExcel->getActiveSheet()->getCell('F'.$rowCount)->getHyperlink()->setUrl($subpath . $row['img2']);		
		$objPHPExcel->getActiveSheet()->getStyle('F'.$rowCount)->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
		$objPHPExcel->getActiveSheet()->getStyle('F'.$rowCount)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $subpath . $row['img3']); 
		$objPHPExcel->getActiveSheet()->getCell('G'.$rowCount)->getHyperlink()->setUrl($subpath . $row['img2']);		
		$objPHPExcel->getActiveSheet()->getStyle('G'.$rowCount)->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
		$objPHPExcel->getActiveSheet()->getStyle('G'.$rowCount)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
		$objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $row['dop']); 
		$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $row['status']);
		while ($row_loc =  mysql_fetch_array($result_location)) {
			$data['city'] = $row_loc['city_name'];
		}
		$result_store = mysql_query("SELECT * FROM location_info where city_id='".$row['city']."'");
		$cnt = 0;
		while ($row_store =  mysql_fetch_array($result_store)) {							
			$cnt++;	
			if($cnt == $row['loc']){
				$data['store'] = $row_store['location_name'];
			}			
		} 		
		$objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $data['store']); 
		$objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $data['city']);
		$objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $row['contact']); 
		$objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, $row['landline']); 
		$objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowCount, $row['billno']); 
		$objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount, date("d-m-Y", strtotime($row['create_date']))); 
		$result_location = mysql_query("SELECT * FROM city_info where id='".$row['city']."'");
		
		
	    // Increment the Excel row counter
	    $rowCount++; 
	} 
	
	// Instantiate a Writer to create an OfficeOpenXML Excel .xlsx file
	//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel5");
	$objWriter->save("php://output");
	// Write the Excel file to filename some_excel_file.xlsx in the current directory
	//$objWriter->save('php://output'); 
?>
