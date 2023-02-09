<?=$this->Html->docType('xhtml-strict');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?=$this->Html->charset('utf-8');?>
<?php
echo $this->Html->css("fonts/fonts-min")."\n";
echo $this->Html->css("container/container")."\n";
echo $this->Html->script('prototype');
echo $this->Html->css(array("admin"))."\n";

?>

</head>
<body
	onLoad="<?php //if(!empty($acesso['turnos'])&&!empty($acesso['escalas'])&&!empty($acesso['militars_escalas'])&&!empty($acesso['cumprimentoescalas'])){echo 'window.moveTo(0,0);window.resizeTo(screen.width,screen.height);';}else{echo 'self.close();';} ?>"	class="yui-skin-sam">




<?php
 if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($u[0]['Usuario']['privilegio_id']==5)||($u[0]['Usuario']['privilegio_id']==6)){

	//echo '<div id="wrapper">'.$content_for_layout."</div></div>\n";
	echo $content_for_layout."</div>\n";
	
} ?>


</body>
</html>


