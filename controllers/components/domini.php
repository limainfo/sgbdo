<?
class DominiComponent extends Object {
	
	function startup(&$controller) {
		
	}
	
	function parseUrl($orgao=null,$setor=null,$date=null) {
		if (!$setor && !$orgao) { // URL = orgaos/view
			$month = date('n');
			$year = date('Y');
			$setor = 'Todos';
			$orgao = 'Todos';
		} 
		
		if ($orgao && !$setor) { // URL ~ orgaos/view/teclab OR orgaos/view/1-2008
			
			$orgao = explode("-",$orgao);
			
			if (array_key_exists(1,$orgao)) {		//check to see if a month-year was passed or a orgao shortname
				$month = $orgao[0];
				$year = $orgao[1];
				$orgao = 'Todos';
				$setor = 'Todos';
			} else {
				$month = date('n');
				$year = date('Y');
				$setor = 'Todos';
				$orgao = $orgao[0];
			}
		} else {				// URL ~ orgaos/view/teclab/livetext OR orgaos/view/teclab/1-2008
			$setor = explode("-",$setor);
			if (array_key_exists(1,$setor)) { // check for month-year in $setor or setor shortname
				$month = $setor[0];
				$year = $setor[1];
				$setor = 'Todos';
			} else {
				if ($date) {
					$month = explode("-",$date);
					$year = $month[1];
					$month = $month[0];
				} else {
					$month = date('n');
					$year = date('Y');
				}
				$setor = $setor[0];
			}
		}
		
		$stamp = mktime(0,0,0,$month,1,$year);
		
		$output = array('orgao'=>$orgao,'setor'=>$setor,'month'=>$month,'year'=>$year,'stamp'=>$stamp);
		return $output;
	}
	
	function findPrev($pass=array()) {
		$output = array();
		$today = true;
		$url = null;
		for ($i=0; $i<count($pass); $i++) {
			$is_date = explode("-",$pass[$i]); //check to see if it's a month-year or orgao/setor
			if (array_key_exists(1,$is_date)) { //yes, it's a month-year
				$i = count($pass)+1;				// break out of loop
				$month = ($is_date[0]-1 != 0 ? $is_date[0]-1 : 12);
				$year = ($is_date[0]-1 == 0 ? $is_date[1]-1 : $is_date[1]);
				$output[$i-2] = $month."-".$year;
				$today = false;
			} else {							//no, it's not a month-year
				$output[$i] = $pass[$i];
			}
		}
		
		if ($today == true) {
			$month = (date('n')-1 != 0 ? date('n')-1 : 12);
			$year = (date('n')-1 == 0 ? date('Y')-1 : date('Y'));
			$output[count($output)+1] = $month."-".$year;
		}
		
		foreach ($output as $val) {
			$url .= $val."/";
		}
		
		return $url;
	}
	
	function findNext($pass=array()) {
		$output = array();
		$today = true;
		$url = null;
		for ($i=0; $i<count($pass); $i++) {
			$is_date = explode("-",$pass[$i]); //check to see if it's a month-year or orgao/setor
			if (array_key_exists(1,$is_date)) { //yes, it's a month-year
				$i = count($pass)+1;				// break out of loop
				$month = ($is_date[0]+1 != 13 ? $is_date[0]+1 : 1);
				$year = ($is_date[0]+1 == 13 ? $is_date[1]+1 : $is_date[1]);
				$output[$i-2] = $month."-".$year;
				$today = false;
			} else {							//no, it's not a month-year
				$output[$i] = $pass[$i];
			}
		}
		
		if ($today == true) {
			$month = (date('n')+1 != 13 ? date('n')+1 : 1);
			$year = (date('n')+1 == 13 ? date('Y')+1 : date('Y'));
			$output[count($output)+1] = $month."-".$year;
		}
		
		foreach ($output as $val) {
			$url .= $val."/";
		}
		
		return $url;
	}
}
?>