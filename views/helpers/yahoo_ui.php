<?php
/**
 * Helper to integrate the Yahoo UI library.
 *
 * PHP versions 5 (and 4?)
 *
 * CakePHP :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright (c) 2006, 	cwsTrummer
 *			Christian Trummer
 *			Austria, 8483 Deutsch Goritz, Ratschendorf 42
 *			http://www.cws-trummer.biz | http://blog.cws-trummer.biz
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright    Copyright (c) 2006, cwsTrummer Christian Trummer
 * @link         http://blog.cws-trummer.biz
 * @version      0.2
 * @lastmodified 20.05.2006
 * @license      http://www.opensource.org/licenses/mit-license.php The MIT License
 */


/**
 * YahooUi helper library.
 *
 * Helps to integrate the UI components of the YahooUI library
 *
 */
class YahooUiHelper extends Helper
{
	var $helpers = array('Html','Ajax', 'Javascript');
	
	function showCalendar($id = "1")
	{
		$code = "
				
		<div id='cal".$id."Container'></div>
		
		<script lanuage='javascript'>
		
			var cal".$id.";
			
			cal".$id." = new YAHOO.widget.Calendar('cal".$id."','cal".$id."Container');
			cal".$id.".render();
		
		</script>
		
		";
				
		return $this->output($code);
	}
	
	function _generateCalendarUpScript($field, $params)
	{
		$imgLeftUrl = $this->webroot.IMAGES_URL.$this->themeWeb.$params['imgLeft'];
		$imgRightUrl = $this->webroot.IMAGES_URL.$this->themeWeb.$params['imgRight'];
		$id = $params['id'];
		
		$code = "
		
			<script language='javascript'>
				
				var selMonth".$id.";
				var selDay".$id.";
				var selYear".$id.";
				
				self.init".$id." = function()
				{
					this.today = new Date();

					var thisMonth = this.today.getMonth();
					var thisDay = this.today.getDate();
					var thisYear = this.today.getFullYear();

					selMonth".$id." = document.getElementById('".$field."_month');
					selDay".$id." = document.getElementById('".$field."_day');
					selYear".$id." = document.getElementById('".$field."_year');
					
					cal".$id." = new YAHOO.widget.Calendar('cal".$id."','container".$id."',(thisMonth+1)+'/'+thisYear);
					
					cal".$id.".title = '".$params['title']."';
					cal".$id.".onSelect = setSelectedDate".$id.";
					cal".$id.".Config.Options.NAV_ARROW_LEFT = '". $imgLeftUrl ."';
					cal".$id.".Config.Options.NAV_ARROW_RIGHT = '". $imgRightUrl ."';
					
					//setDate".$id."();
					
					cal".$id.".render();				
				}
				
				self.setDate".$id." = function()
				{
					var date = cal".$id.".getSelectedDates()[0];
					selMonth".$id.".selectedIndex=date.getMonth()+1;
					selDay".$id.".selectedIndex=date.getDate();
					selYear".$id.".value = date.getFullYear();
				}
						
				self.setSelectedDate".$id." = function()
				{
					setDate".$id."();
					new Effect.SlideUp(cal".$id.".oDomContainer,{duration: 1.0});
				}		
				
				self.showCalendar".$id." = function(x, y)
				{
					cal".$id.".oDomContainer.style.position = 'absolute';
					cal".$id.".oDomContainer.style.top = x+'px';
					cal".$id.".oDomContainer.style.left = y+'px';
					
					new Effect.SlideDown(cal".$id.".oDomContainer,{duration: 0.5});
				}
				
			</script>
			
			<div id='container".$id."' style='display:none'></div>
			
			<script language='javascript'> init".$id."(); </script>
			
			";
			
			return $code;
	}
	
	
	function _generateParamsForCalendar($params)
	{
		$id = rand(1,999999);
		
		if ($params == null)
		{
			$params = array('id' => $id,
							'title' => 'Please select Date',
							'text' => 'Select Date',
							'imgLeft' => 'yahoo/callt.gif',
							'imgRight' => 'yahoo/calrt.gif',
							'defaultDate' => null);
		}
		else
		{
			if (empty($params['id'])) $params['id'] = $id;
			if (empty($params['title'])) $params['title'] = 'Please select Date';
			if (empty($params['text'])) $params['text'] = 'Select Date';
			if (empty($params['imgLeft'])) $params['imgLeft'] = 'yahoo/callt.gif';
			if (empty($params['imgRight'])) $params['imgRight'] = 'yahoo/calrt.gif';
			if (empty($params['defaultDate'])) $params['defaultDate'] = null;
		}
		
		return $params;
	}
	
	function _generateParamsForSimpleDialogScript($params)
	{
		if ($params == null)
		{
			$params = array('width'=>'25em',
								'fixedcenter'=>'true',
								'modal'=>'true',
								'draggable'=>'false',
								'header'=>'Excluir',
								'body'=>'Tem certeza que deseja excluir ?');
		}
		else
		{
			if (empty($params['width'])) $params['width'] = "25em";
			if (empty($params['fixedcenter'])) $params['fixedcenter'] = "true";
			if (empty($params['modal'])) $params['modal'] = "true";
			if (empty($params['draggable'])) $params['draggable'] = "false";
			if (empty($params['header'])) $params['header'] = "Excluir";
			if (empty($params['body'])) $params['body'] = "Tem certeza que deseja excluir ?";
		}
		
		return $params;
	}
	
	function _generateParamsForSimpleDialogLink($params)
	{
		if ($params == null)
		{
			$params = array('function'=>'delete',
								'id'=>'0',
								'update'=>'content',
								'bt1text'=>'Sim',
								'bt2text'=>'Nào',
								'text'=>'Excluir',
								'useAjax'=>'false');
		}
		else
		{
			if (empty($params['function'])) $params['function'] = "delete";
			if (empty($params['id'])) $params['id'] = "0";
			if (empty($params['update'])) $params['update'] = "content";
			if (empty($params['bt1text'])) $params['bt1text'] = "Sim";
			if (empty($params['bt2text'])) $params['bt2text'] = "Não";
			if (empty($params['text'])) $params['text'] = "Excluir";
			if (empty($params['useAjax'])) $params['useAjax'] = 'false';
		}
		
		return $params;
	}
	
	
	function _generateParamsForSlider($params)
	{
		if ($params == null)
		{
			$params = array('leftUp' => '200',
							'rightDown' => '200');
		}
		else
		{
			if (empty($params['leftUp'])) $params['leftUp'] = '100';
			if (empty($params['rightDown'])) $params['rightDown'] = '100';
		}
		
		return $params;
	}
	
	function _generateParamsForMotion($params)
	{
		if ($params == null)
		{
			$params = array('attributes' => '',
							'duration' => '1',
							'easingMethod' => 'YAHOO.util.Easing.easeNone');
		}
		else
		{
			if (empty($params['attributes'])) $params['attributes'] = '';
			if (empty($params['duration'])) $params['duration'] = '1';
			if (empty($params['easingMethod'])) $params['easingMethod'] = 'YAHOO.util.Easing.easeNone';
		}
		
		return $params;
	}
	
	function linkForPopupCalendar($field, $params)
	{
		$params = $this->_generateParamsForCalendar($params);
		
		$code = $this->_generateCalendarUpScript($field, $params);
		
		$code = $code." <a href='#' onClick='showCalendar".$params['id']."(this.offsetTop + this.offsetParent.offsetTop, this.offsetLeft); return false;'>".$params['text']."</a>";
		
		return $this->output($code);		
	}
	
	function imgForPopupCalendar($field, $img, $params)
	{
		$params = $this->_generateParamsForCalendar($params);
		
		$code = $this->_generateCalendarUpScript($field, $params);
		
		$code = $code ." <a href='#' onClick='showCalendar".$params['id']."(this.offsetTop + this.offsetParent.offsetTop, this.offsetLeft); return false;'>".
				$this->Html->image($img,array('alt'=>$params['text'],'border'=>'0')).
				"</a>";
				
		return $this->output($code);
	}
	
	
	function generateScriptForSimpleDialog($name, $params=null)
	{
		$params = $this->_generateParamsForSimpleDialogScript($params);
		
		$code = "<script language='javascript'>\n" .
				"	$name = new YAHOO.widget.SimpleDialog('".$name."', {\n" .
						"visible:false,\n" .
	  					"width:'".$params['width']."',\n" .
						"fixedcenter:".$params['fixedcenter'].",\n " .
						"modal:".$params['modal'].",\n" .
						"icon:YAHOO.widget.SimpleDialog.ICON_WARN,\n" .
						"draggable:".$params['draggable']."});\n" .
				"\n" .
				"	$name.setHeader('".$params['header']."');\n" .
				"	$name.setBody('".$params['body']."');\n" .
				"</script>\n";
				
		return $this->output($code);
	}
	
	function _generateScriptForSimpleDialogCall($name, $params)
	{
		if ($params['useAjax'] == "true"){
		
			$function1 = $this->Ajax->remoteFunction(array('url'=>$params['function'].'/'.$params['id'], 'update'=>$params['update']))."; this.hide();";
		}
		else{
			if(empty($params['controller'])){
			$function1 = "window.location.href = '".$this->Html->url($params['function']."/".$params['id'])."'; this.hide();";
			}else{
			$function1 = "window.location.href = '".$this->webroot.$params['controller']."/".$params['function']."/".$params['id']."'; this.hide();";
			}
		}
			
		$function2 = "this.hide();";
		
		$button1 = "{text:'".$params['bt1text']."',\n" .
				"	handler: function() { $function1 }}\n";
		
		$button2 = "{text:'".$params['bt2text']."',\n" .
				"	handler: function() { $function2 }}\n";
				
		$buttons = $button1.", ".$button2;
		
		$script = "";
		
		if (isset($params['header'])) 	$script .= "$name.setHeader('".$params['header']."');\n";
		
		$script = $script."$name.cfg.queueProperty('buttons',[$buttons]);\n" .
				"$name.render(document.body);\n" .
				"$name.show();\n" .
				"return false;\n";
				
		return $script;
	}
	
	function _generateScriptForSlider($name, $params)
	{
		$tick = "";
		$event = "";
		
		if (isset($params['tick']))
			$tick = ", ".$params['tick'];
			
		if (isset($params['onChange']))
			$event = $name."slider.onChange = function(value) { ".$params['onChange']." };";
			
		$script = "<script language='javascript'>" .
				"	var $name"."slider;\n" .
					"$name"."slider = YAHOO.widget.Slider.getHorizSlider('".$name."Background'," .
							"'".$name."Thumb', ".$params['leftUp'].", ".$params['rightDown'].$tick.");" .
					$event.
				"</script>";
				
		return $script;
	}
	
	function _generateScriptForMotion($id, $params)
	{	
		$script  = "<script language='javascript'>" .
				"var motion".$id." = new YAHOO.util.Motion('".$id."', {".$params['attributes']."}, ".$params['duration'].", ".$params['easingMethod'].");" .
				"motion".$id.".animate();" .
				"</script>";
		
		return $script;
	}
	
	function linkForSimpleDialog($name, $params=null)
	{		
		$params = $this->_generateParamsForSimpleDialogLink($params);
		
		$script = $this->_generateScriptForSimpleDialogCall($name, $params);		
		
		$code = "<a href='#' onClick=\"".$script."\">".$params['text']."</a>";
		
		return $this->output($code);
	}
	
	function imgForSimpleDialog($name, $img, $params=null)
	{
		$params = $this->_generateParamsForSimpleDialogLink($params);
		
		$script = $this->_generateScriptForSimpleDialogCall($name, $params);		
		
		$code = "<a href='#' onClick=\"".$script."\">".
				$this->Html->image($img,array('alt'=>$params['text'],'border'=>'0')).
				"</a>";
		
		return $this->output($code);
	}
	
	function slider($name, $params=null)
	{
		$params = $this->_generateParamsForSlider($params);
		
		if (isset($params['bgImage']))
			$bgImage = "background:url(".$this->webroot.IMAGES_URL.$this->themeWeb.$params['bgImage'].") no-repeat;";
		
		$code = "<div id='".$name."Background' style='position:relative;".$bgImage." height:26px; width:218px;'>" .
				"	<div id='".$name."Thumb' style='position:absolute;left: 100px;top: 8px;cursor:default; width:18px; height:18px; '>".$this->Html->image('yahoo/horizSlider.png')."</div>" .
				"</div>";
				
		$script = $this->_generateScriptForSlider($name, $params);
		
		return $this->output($code."\n\n".$script);
	}
	
	function motion($id, $params=null)
	{
		$params = $this->_generateParamsForMotion($params);
		$script = $this->_generateScriptForMotion($id, $params);
		
		return $this->output($script);
	}
}

?>
