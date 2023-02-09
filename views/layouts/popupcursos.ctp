<?=$this->Html->docType('xhtml-strict');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?=$this->Html->charset('utf-8');?>
<?php
echo $this->Html->css("fonts/fonts-min")."\n";
echo $this->Html->css("container/container")."\n";
echo $this->Html->script('yahoo-dom-event/yahoo-dom-event')."\n";
echo $this->Html->script('animation/animation-min')."\n";
echo $this->Html->script("container/connection-min");
echo $this->Html->script('dragdrop/dragdrop-min')."\n";
echo $this->Html->script("container/container-min");
echo $this->Html->script('prototype');
echo $this->Html->css(array("admin"))."\n";
echo $this->Html->script('jscalendar/calendar.js');
echo $this->Html->script('jscalendar/lang/calendar-br.js');
echo $this->Html->script('common.js');
echo $this->Html->css('../js/jscalendar/skins/aqua/theme');


?>

</head>
<body
	onLoad="<?php if(!empty($acesso['cursos'])&&!empty($acesso['militars_cursos'])&&!empty($acesso['militars'])){echo 'window.moveTo(0,0);window.resizeTo(600,600);';}else{echo 'self.close();';} ?>"
	class="yui-skin-sam">




<?php
echo '<div id="wrapper">'.$content_for_layout."</div></div>\n";
?>


</body>
</html>


