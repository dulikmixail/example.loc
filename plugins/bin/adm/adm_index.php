<?


#������� �������

$a = $_REQUEST['a'];


if($a=='sendmailtest2'){
	$email = $_REQUEST['email'];
	
	include_once '../plugins/mailer.php';
	$send_title = '������';
	$send_text_ready = '
	��������� ������������, ��� ���������� ���, ��� � ��� ������ �� ����� www.RAMOK.by ��� ���� �� ���������������� ������������� ������ �������.	
	���� ��� ��� �����  :�����, (1 ��� ����� ��������, ����� �������� �� email). ������: ��������, (���)
	����� � ������ ������� �� ������.
	� ����� �������� �� ������ �����������: �� ���������, ����, ��������� ������������ � �������, �������, �������� �����, ��������� ����������� ���������, ������� �������, ������� ���-������. � ������ �������� �� ������ ������ ���� ������������ ������ �� �����.
	
	������� ������, �� ��������� �������, ������� ���� ������� �� ��������� �����.
	
	������ �� ����������� �����, ����������.	
	
	����������� ��� ��� ���� �� ��������� ����������: ������� ����� ������ � ��� 20%� ����������� ��� �� ������������� ������ 
	
	��� ������ ������� ����� ���� � ������ ������� �������� �� �������� ������ (�� ���� �� �������������, ��� ����� ��������).	
	
	
	';
	mailer_send('antylevsky@ya.ru', $send_title, $send_text_ready, $files);
	
	}


	
if($a=='importprice'){

	$date_add = date("Y-m-d");
	
	//mysql_query("UPDATE tbl_products SET price='0'");
	//mysql_query("UPDATE tbl_modification SET price='0'");


	include '../plugins/phpexcel/Classes/PHPExcel/IOFactory.php';
	$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
	$cacheSettings = array( 'memoryCacheSize' => '100MB');
	PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
	
	
	$objReader = new PHPExcel_Reader_Excel2007();
		
	$objReader->setReadDataOnly(true); 
	
	$objPHPExcel = $objReader->load($_FILES['price']['tmp_name']);
	
	$objWorksheet = $objPHPExcel->getActiveSheet();
	
	$n=0;
	$c=0;
	foreach ($objWorksheet->getRowIterator() as $row) {
		$n++;
		
		if($n>1){
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); 
			
			$i = 0;
			foreach ($cellIterator as $cell) {
				$i++;
				if($i==1){$artikul = $cell->getValue();}
				if($i==5){$price_client = $cell->getValue();}
				if($i==6){$price_diller = $cell->getValue();}
				if($i==7){$count = $cell->getValue();}
				}
			 
			$price_client = str_replace(',', '.', $price_client);
			$price_diller = str_replace(',', '.', $price_diller);
			
			$artikul = mb_convert_encoding($artikul,'cp1251','utf8');
			$artikul = trim($artikul);

			if($artikul && $artikul<>''){
				
				$query = mysql_query("SELECT id, price FROM tbl_products WHERE artikul='" .$artikul. "'");
				if(mysql_num_rows($query)){
                    while ($result = mysql_fetch_array($query)) {
                        if($result['price']>$price_client){
                            $price_old = $result['price'];
                            mysql_query("UPDATE tbl_products SET price='" .$price_client. "', price_old='" .$price_old. "', price_old_date='" .$date_add. "' WHERE id='" .$result['id']. "'");
                        }
                        else{
                            mysql_query("UPDATE tbl_products SET price='" .$price_client. "' WHERE id='" .$result['id']. "'");
                        }
                        $notify2 .= '��������� ��� ������ <strong>' .$artikul. '</strong> �������� (' .$price_client. ')<br>';
                        $ids1 .= $result['id'].',';
                    }
					}
				else{
					$query = mysql_query("SELECT id, price, name FROM tbl_modification WHERE artikul='" .$artikul. "' LIMIT 1");
					if(mysql_num_rows($query)){
						$result = mysql_fetch_array($query);
						$n++;
						$found .= '<strong>' .$articul.'</strong> ' .$result['name']. '<br>';
						if($result['price']>$price_client){
							$price_old = $result['price'];
							mysql_query("UPDATE tbl_modification SET price='" .$price_client. "', price_old='" .$price_old. "', price_old_date='" .$date_add. "' WHERE id='" .$result['id']. "'");
							}
						else{
							mysql_query("UPDATE tbl_modification SET price='" .$price_client. "' WHERE id='" .$result['id']. "'");
							}
						$notify2 .= '��������� ��� ������ <strong>' .$artikul. '</strong> �������� (' .$price_client. ')<br>';
						$ids2 .= $result['id'].',';
						}
					else{
						$notify2 .= '�� ������ ����� � ��������� <strong>' .$artikul. '</strong><br>';
						}			
					
					
					
					
					}
				
				}
				
			}
			
			
		}
		
		
	mysql_query("UPDATE tbl_products SET price='0' WHERE id NOT IN (" .$ids1. ")");
	mysql_query("UPDATE tbl_modification SET price='0' WHERE id NOT IN (" .$ids2. ")");
		
		
	}


?>
