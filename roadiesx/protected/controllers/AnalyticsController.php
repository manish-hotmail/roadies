<?php

class AnalyticsController extends Controller {
	public $layout = '//layouts/admin_column2';
	
	public function actionAnalytics() {
		$this->render('/site/analytics');
	}
	
	public function actionDownload() {
		$this->render('/site/download');
	}
	
	public function actionInstallAnalytics() {
		$intervalo = date_diff(date_create('2013-02-21'), date_create());
		$out = $intervalo->format("%m%d");
        $a_out = array();
        array_walk(explode(',',$out),
        function($val,$key) use(&$a_out){
            $v=explode(':',$val);
            $a_out[0] = $v[0];
        });
		$days = $a_out[0];
		$count = 0;
		$user_install_array = array();
		$user_install = array();
		while ($count < $days) {
			$tomorrow = mktime(0,0,0,date("m"),date("d")-$count,date("Y"));
			$tomorrow1 = date("Y-m-d", $tomorrow);
			$criteria = new CDbCriteria;
			$criteria->condition = 'create_time like "'.$tomorrow1.'%"';
			$users_installed = UserInfo::model()->count($criteria);
			$user_install['date'] = $tomorrow1;
			$user_install['install_count'] = $users_installed;
			$count++;
			array_push($user_install_array, $user_install);
		}
		$user_install_array = array_reverse($user_install_array);
		$user_install_array_js = json_encode($user_install_array);
		$this->render('/site/analytics_install', array('user_install_array'=>$user_install_array_js));
	}
	public function actionDownloadData() {
			$intervalo = date_diff(date_create('2013-02-21'), date_create());
			$out = $intervalo->format("%d");
	        $a_out = array();
	        array_walk(explode(',',$out),
	        function($val,$key) use(&$a_out){
	            $v=explode(':',$val);
	            $a_out[0] = $v[0];
	        });
			$days = $a_out[0];
			$count = 0;
			$user_install_array = array();
			$user_install = array();
			while ($count < $days) {
				$tomorrow = mktime(0,0,0,date("m"),date("d")-$count,date("Y"));
				$tomorrow1 = date("Y-m-d", $tomorrow);
				$criteria = new CDbCriteria;
				$criteria->condition = 'create_time like "'.$tomorrow1.'%"';
				$users_installed = UserInfo::model()->count($criteria);
				$user_install['date'] = $tomorrow1;
				$user_install['install_count'] = $users_installed;
				$count++;
				array_push($user_install_array, $user_install);
			}
			$user_install_array = array_reverse($user_install_array);
			$user_install_array_js = json_encode($user_install_array);
			//$this->render('/site/download_data', array('user_install_array'=>$user_install_array));
			// get a reference to the path of PHPExcel classes 
		$phpExcelPath = Yii::getPathOfAlias('ext.phpexcel.Classes');
		 
		// Turn off our amazing library autoload 
		spl_autoload_unregister(array('YiiBase','autoload'));        
		 
		     //
		 // making use of our reference, include the main class
		 // when we do this, phpExcel has its own autoload registration
		 // procedure (PHPExcel_Autoloader::Register();)
		include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
		 
		$objPHPExcel = new PHPExcel(); 
		
		$objPHPExcel->setActiveSheetIndex(0); 
		// Initialise the Excel row number
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
		
		/* SET CELL HEADERS */
		$objPHPExcel->getActiveSheet()->SetCellValue('A1','Date');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1','Install Count');
		
		/* set font weigth to header */	
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
		
		$rowCount = 2;
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
		
		// Instantiate a Writer to create an OfficeOpenXML Excel .xlsx file
		//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		header('Content-type: application/vnd.ms-excel');
		
		// It will be called file.xls
		header('Content-Disposition: attachment; filename="Users_'.date("d-m-Y").'.xls"');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel5");
		
		$objWriter->save("php://output");
		// Write the Excel file to filename some_excel_file.xlsx in the current directory
		//$objWriter->save('php://output'); 
		Yii::app()->end();
		 
		       // 
		   // Once we have finished using the library, give back the 
		   // power to Yii... 
		spl_autoload_register(array('YiiBase','autoload'));
		}

	public function actionLikeAnalysis() {
		$like_analysis_array = array();
		$command = "SELECT count(*) from user_info" ;
		$x = intval(Yii::app()->db->createCommand($command)->queryScalar());
		$command = "SELECT count(*) from transaction where transaction_type = 7" ;
		$like_analysis_array['already_likes'] = intval(Yii::app()->db->createCommand($command)->queryScalar());
		$command = "SELECT count(*) from transaction where transaction_type = 8" ;
		$like_analysis_array['new_likes'] = intval(Yii::app()->db->createCommand($command)->queryScalar());
		$like_analysis_array['rest_users'] = $x - $like_analysis_array['already_likes'] - $like_analysis_array['new_likes'];
		$this->render('/site/analytics_like', array('like_analysis_array'=>json_encode($like_analysis_array)));
	}

	public function actionGetBetsOnQuestions() {
		$intervalo = date_diff(date_create('2013-02-21'), date_create());
		$out = $intervalo->format("%d");
        $a_out = array();
        array_walk(explode(',',$out),
        function($val,$key) use(&$a_out) {
            $v=explode(':',$val);
            $a_out[0] = $v[0];
        });
		$days = $a_out[0];
		$count = 0;
		$questions_array = array();
		$crit = new CDbCriteria;
		$all_questions = Questions::model()->findAll($crit);
		$all_questions_array = array();
		$bets_array = array();
		foreach ($all_questions as $key => $value) {
			$questions_array['id'] = $value->id;
			$questions_array['title'] = $value->title;
			$bets = array();
			$count = 0;
			while ($count < $days) {
				$tomorrow = mktime(0,0,0,date("m"),date("d")-$count,date("Y"));
				$tomorrow1 = date("Y-m-d", $tomorrow);
				$criteria = new CDbCriteria;
				$criteria->condition = 'create_time like "'.$tomorrow1.'%" AND question_id=:qid';
				$criteria->params = array(':qid'=>$questions_array['id']);
				$bets_placed = Bets::model()->count($criteria);
				$bets['date'] = $tomorrow1;
				$bets['bet_count'] = $bets_placed;
				$bets['question'] = $questions_array['title'];
				$count++;
				$bets = array_reverse($bets);
				array_push($bets_array, $bets);
			}
			$bets_array_js = json_encode($bets_array);
		}
		//$this->render('/site/analytics_question', array('bets'=>$bets_array_js));
		$phpExcelPath = Yii::getPathOfAlias('ext.phpexcel.Classes');
		 
		// Turn off our amazing library autoload 
		spl_autoload_unregister(array('YiiBase','autoload'));        
		 
		     //
		 // making use of our reference, include the main class
		 // when we do this, phpExcel has its own autoload registration
		 // procedure (PHPExcel_Autoloader::Register();)
		include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
		 
		$objPHPExcel = new PHPExcel(); 
		
		$objPHPExcel->setActiveSheetIndex(0); 
		// Initialise the Excel row number
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
		
		/* SET CELL HEADERS */
		$objPHPExcel->getActiveSheet()->SetCellValue('A1','Date');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1','Question No.');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1','Bet Count');
		
		/* set font weigth to header */	
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
		
		$rowCount = 2;
		foreach ($bets_array as $key => $value) {
		 // Set cell An to the "name" column from the database (assuming you have a column called name)
	    //    where n is the Excel row number (ie cell A1 in the first row)
	    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value['date']); 
	    // Set cell Bn to the "age" column from the database (assuming you have a column called age)
	    //    where n is the Excel row number (ie cell A1 in the first row)
	    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value['question']); 
		//$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['socname']); 
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $value['bet_count']); 
	    // Increment the Excel row counter
	    $rowCount++; 
		}
		
		// Instantiate a Writer to create an OfficeOpenXML Excel .xlsx file
		//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		header('Content-type: application/vnd.ms-excel');
		
		// It will be called file.xls
		header('Content-Disposition: attachment; filename="Question_'.date("d-m-Y").'.xls"');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel5");
		
		$objWriter->save("php://output");
		// Write the Excel file to filename some_excel_file.xlsx in the current directory
		//$objWriter->save('php://output'); 
		Yii::app()->end();
		 
		       // 
		   // Once we have finished using the library, give back the 
		   // power to Yii... 
		spl_autoload_register(array('YiiBase','autoload'));
	}

	public function actionInviteAnalysis() {
		$invite_analysis_array = array();
		$command = "SELECT count(*) from invite_data" ;
		$x = intval(Yii::app()->db->createCommand($command)->queryScalar());
		$command = "SELECT count(*) from invite_data, user_info where invite_data.fid = user_info.uid" ;
		$y = intval(Yii::app()->db->createCommand($command)->queryScalar());
		$command = "SELECT count(*) from transaction where transaction_type = 6" ;
		$invites_accepted = intval(Yii::app()->db->createCommand($command)->queryScalar());
		$total_invites = $x - $invites_accepted - $y;
		$this->render('/site/analytics_invite', array('total_invites'=>$total_invites, 'invites_accepted'=> $invites_accepted));
	}
	
	public function actionEventLeaderBoard() {
		
	}
}
?>