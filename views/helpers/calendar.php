<?
class CalendarHelper extends Helper {

	var $helpers = array('Html','Ajax');

	function events($month=null,$day=null,$year=null,$events=array()) {
		$entry = array();
		$i = 0;
		$x = 0;
		$max = Configure::read('Calendar.max_items');
		$maxed = false;
		if ($month < 10) { $month = "0".$month; }
		if ($day < 10) { $day = "0".$day; }

		if (empty($events)) {
			return null;
		} else {
				//print_r($events);
			foreach ($events as $calrot) {
				//print_r($calrot);
				
				//foreach ($event['Calendariorotina'] as $calrot) {
					$date = strtotime($calrot['Calendariorotina']['dt_inicio_previsto']);
					$dday = date("d",$date);
					$mmonth = date("m",$date);
					$yyear = date("Y", $date);
					if ($dday == $day && $mmonth == $month && $yyear == $year) {
						$entry[$i]['headline'] = $calrot['Rotina']['responsavel'];
						$entry[$i]['id'] = $calrot['Calendariorotina']['id'];
						$entry[$i]['date'] = strtotime($calrot['Calendariorotina']['dt_inicio_previsto']);
						$entry[$i]['rubrica'] = $calrot['Calendariorotina']['rubrica'];
						$entry[$i]['obs'] = $calrot['Calendariorotina']['obs'];
					}
					$i++;
				//}
			}
				
			if ($entry) {
				$output = '<ul>';
				//print_r($entry);
				foreach ($entry as $item) {
					if ($x == $max) {
						//$output .= '<li  id="max_'.$day.'_toggle" class=""><a href="#" onClick="new Effect.SlideDown(\'max_'.$day.'\'); $(\'max_'.$day.'_toggle\').hide();">mais...</a></li>';
						$output .= '<div id="max_'.$day.'_togle"><a href="#" onClick="$(\'max_'.$day.'\').show(); $(\'max_'.$day.'_togle\').hide();">mais...</a></div>';
						$output .= '<div id="max_'.$day.'" style="display: none;">';
						$maxed = true;
					}
					//if(date('Ymd',strtotime($event['Event']['date']))<date('Ymd',strtotime('now'))){
					if((date('Ymd',$item['date'])<date('Ymd',strtotime('now')))&&($item['rubrica']=='')){
						$output .= '<p style="background-color: #c0a0a0;"><a  href="#" onClick="new Effect.SlideUpAndDown(\'details_'.$item['id'].'\',\'1\');">'.$item['headline'].'</a><br></p>';
					}
					if((date('Ymd',$item['date'])>=date('Ymd',strtotime('now')))&&($item['rubrica']=='')){
						$output .= '<p style="background-color: #a0c0a0;"><a  href="#" onClick="new Effect.SlideUpAndDown(\'details_'.$item['id'].'\',\'1\');">'.$item['headline'].'</a><br></p>';
					}
					if(($item['rubrica']!='')){
						$output .= '<p style="background-color: #b0b0b0;"><a  href="#" >'.$item['headline'].'-'.$item['rubrica'].' - acao:'.$item['obs'].'</a><br></p>';
					}
					
					$x++;
				}
				if ($maxed == true) {
					//$output .= '<li class=""><a href="#" onClick="new Effect.SlideUp(\'max_'.$day.'\'); $(\'max_'.$day.'_toggle\').show();">menos...</a></li>';
					$output .= '<a href="#" onClick=" $(\'max_'.$day.'_togle\').show();$(\'max_'.$day.'\').hide();">menos...</a><br>';
					$output .= '</div><script>$(\'max_'.$day.'_togle\').show();$(\'max_'.$day.'\').hide();</script>';
				}
				$output .= '</ul>';
				return $this->output($output);
			} else {
				return null;
			}
		}
	}

	function today($day=null,$month=null,$year=null) {
		if ($day == date('j') && $month == date('m') && $year == date('Y')) {
			$output = '<b class="today">'.$day.'</b>';
		} else {
			$output = '<b>'.$day.'</b>';
		}
		return $this->output($output);
	}

	function button($text=null,$options=array(),$type='default'){
		$output = null;
		$link = null;
		if (isset($options['form'])) {
			$link = "document.".$options['form'].".submit()";
		}

		if (isset($options['anchor'])) {
			$anchor = '#'.$options['anchor'].'" name=\"'.$options['anchor'];
		} else {
			$anchor = "#";
		}

		if (isset($options['link'])) {
			$link = "window.location='".$this->Html->url($options['link'])."'";
		}

		if ($type=='ajax' && isset($options['url']) && isset($options['update'])) {
			$output = $this->Ajax->link('<span>'.$text.'</span>',$options['url'],array('update'=>$options['update'],'class'=>'btn','loading'=>'$(\''.$options['loading'].'\').style.display=\'inline\'','loaded'=>'$(\''.$options['loading'].'\').style.display=\'none\'', 'escape'=>false), null,false);
		}

		if ($type=='effect' && isset($options['effect'])) {
			$link = 'new Effect.'.$options['effect'].'($(\''.$options['id'].'\'),0.5);';
		}

		if ($output) {
			return $output;
		} else {
			return '<a href="'.$anchor.'" class="btn" onClick="'.$link.'" '.(isset($options['style']) ? 'style=\''.$options['style'].'\'' : '').'><span>'.$text.'</span></a>';
		}
	}
}
?>