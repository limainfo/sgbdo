<?=$this->Html->docType('xhtml-strict');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" language="JavaScript">
<!-- Copyright 2006,2007 Bontrager Connection, LLC
// http://bontragerconnection.com/ and http://www.willmaster.com/
// Version: July 28, 2007
var cX = 0; var cY = 0; var rX = 0; var rY = 0;
function UpdateCursorPosition(e){ cX = e.pageX; cY = e.pageY;}
function UpdateCursorPositionDocAll(e){ cX = event.clientX; cY = event.clientY;}
if(document.all) { document.onmousemove = UpdateCursorPositionDocAll; }
else { document.onmousemove = UpdateCursorPosition; }
function AssignPosition(d) {
if(self.pageYOffset) {
	rX = self.pageXOffset;
	rY = self.pageYOffset;
	}
else if(document.documentElement && document.documentElement.scrollTop) {
	rX = document.documentElement.scrollLeft;
	rY = document.documentElement.scrollTop;
	}
else if(document.body) {
	rX = document.body.scrollLeft;
	rY = document.body.scrollTop;
	}
if(document.all) {
	cX += rX; 
	cY += rY;
	}
//d.style.left = (cX+10) + "px";
d.style.left = "300px";
d.style.top = (cY+10) + "px";
}
function HideContent(d) {
if(d.length < 1) { return; }
document.getElementById(d).style.display = "none";
}
function ShowContent(d) {
if(d.length < 1) { return; }
var dd = document.getElementById(d);
AssignPosition(dd);
dd.style.display = "block";
}
function ReverseContentDisplay(d) {
if(d.length < 1) { return; }
var dd = document.getElementById(d);
AssignPosition(dd);
if(dd.style.display == "none") { dd.style.display = "block"; }
else { dd.style.display = "none"; }
}
//-->
</script>
<script type="text/javascript">
function clickElement(elementid)
	{
	var e = document.getElementById(elementid);
		if (typeof e == 'object')
		{
			//alert( "type object" );
			if(document.createEventObject)
			{
				//alert('createEventObject');
				e.fireEvent('onclick');
				return false;
			}
			else if(document.createEvent)
			{
				//alert('createEvent');
				var evObj = document.createEvent('MouseEvents');
				evObj.initEvent('click',true,true);
				e.dispatchEvent(evObj);
				return false;
			}else
				{
					//alert('click');
					e.click();
					return false;
				}
			}
		//else
			//alert( "not type object" );
		}
window.setTimeout(function() {
 window.close();
 }, 3000000);
</script>
<head>

<?=$this->Html->charset('utf-8');?>
<?php
echo $this->Html->script(array('prototype','scriptaculous.js?load=effects,dragdrop'));
echo $this->Html->css("fonts/fonts-min")."\n";
echo $this->Html->css("container/container")."\n";
//echo $this->Html->script('yahoo-dom-event/yahoo-dom-event')."\n";
//echo $this->Html->script('animation/animation-min')."\n";
//echo $this->Html->script("container/connection-min");
//echo $this->Html->script('dragdrop/dragdrop-min')."\n";
//echo $this->Html->script("container/container-min");
//echo $this->Html->script('prototype');
//echo $this->Html->script('effects');
//echo $this->Html->script('window');
//echo $this->Html->script('window_effects');
echo $this->Html->css(array("admin"))."\n";
//echo $this->Html->css(array("themes/alphacube"))."\n";
//echo $this->Html->css(array("themes/default"))."\n";
//echo $this->Html->css(array("themes/spread"))."\n";
echo $this->Html->css("dialog.2.0")."\n";
echo $this->Html->script('dialog.2.0')."\n";


?>

</head>
<body
	onLoad="<?php if((!empty($acesso['turnos'])&&!empty($acesso['escalas'])&&!empty($acesso['militars_escalas'])&&!empty($acesso['cumprimentoescalas'])) ){echo 'window.moveTo(0,0);window.resizeTo(screen.width,screen.height);';}else{
		
if(empty($pams)){
	echo 'self.close();';
}
		} ?>"
	style="background: #ffffff;">




<?php if((!empty($acesso['escalantes'])||!empty($acesso['turnos'])&&!empty($acesso['escalas'])&&!empty($acesso['militars_escalas'])&&!empty($acesso['cumprimentoescalas']))&&empty($pams) ){

	echo '<div id="wrapper">'.$content_for_layout."</div></div>\n";

} 
if(!empty($pams)){
	echo $content_for_layout;
}

?>


</body>
</html>


