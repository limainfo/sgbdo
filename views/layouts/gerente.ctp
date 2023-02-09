<?=$this->Html->docType('xhtml-strict');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- QuickMenu Noscript Support [Keep in head for full validation!] -->
<noscript><style type="text/css">.qmmc {width:200px !important;height:200px !important;overflow:scroll;}.qmmc div {position:relative !important;visibility:visible !important;}.qmmc a {float:none !important;white-space:normal !important;}</style></noscript>
<?php 
echo $this->Html->charset('utf-8');
echo $this->Html->css("menu_gerente")."\n";
echo $this->Html->script(array('prototype','scriptaculous.js?load=effects','menu_gerente'));


echo $this->Html->meta('icon');

?>
<title><?=Configure::read('Calendar.name');?></title>

</head>
<body onLoad="new Effect.Fade('flashMsg',{delay: 3});">
<div style="background-color:#333333;border-bottom:1px solid #000000;height:10px;padding:10px;color:black;line-height:1;margin:0;top:0;font-color:#0191F2;">
<?php echo $this->Html->image('dacta.gif',array('style'=>'float:left;align:left;')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link(__('SISTEMA PARA CONTROLE OAPLE', true), '/militars',array("style"=>"top:0;float:top;color:#0191F2;text-decoration:none;font-size:11px;font-color:#0191F2;font-weight:bold;text-shadow:0 1px 1px #000000;"));?>
</div>
<br>
<center><div id="container" style="float:center;align:center;width:100%;"><?php echo $content_for_layout;?></div> </center>

<div id="footer"></div>

<?php echo $cakeDebug?>
</body>
</html>
