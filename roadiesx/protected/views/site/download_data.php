<?php
	require 'Classes/PHPExcel.php';
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
	//$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
	
	
	
	/* SET CELL HEADERS */
	$objPHPExcel->getActiveSheet()->SetCellValue('A1','Name');
	$objPHPExcel->getActiveSheet()->SetCellValue('B1','e-mail');
	//$objPHPExcel->getActiveSheet()->SetCellValue('C1','Society Name');
	
	/* set font weigth to header */	
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
	//$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
	
	// Iterate through each result from the SQL query in turn
	// We fetch each database result row into $row in turn
	
	foreach ($user_install_array as $key => $value) {
		 // Set cell An to the "name" column from the database (assuming you have a column called name)
	    //    where n is the Excel row number (ie cell A1 in the first row)
	    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value['date']); 
	    // Set cell Bn to the "age" column from the database (assuming you have a column called age)
	    //    where n is the Excel row number (ie cell A1 in the first row)
	    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value['install_count']); 
		//$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['socname']); 
		
	    // Increment the Excel row counter
	    $rowCount++; 
	}
	
	/*
	while($row = mysql_fetch_array($result)) { 
	    // Set cell An to the "name" column from the database (assuming you have a column called name)
	    //    where n is the Excel row number (ie cell A1 in the first row)
	    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['name']." ".$row['sname']); 
	    // Set cell Bn to the "age" column from the database (assuming you have a column called age)
	    //    where n is the Excel row number (ie cell A1 in the first row)
	    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['email']); 
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['socname']); 
		
	    // Increment the Excel row counter
	    $rowCount++; 
	} */
	
	// Instantiate a Writer to create an OfficeOpenXML Excel .xlsx file
	//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel5");
	$objWriter->save("php://output");
	// Write the Excel file to filename some_excel_file.xlsx in the current directory
	//$objWriter->save('php://output'); 
?>
