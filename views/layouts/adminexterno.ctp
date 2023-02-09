<?=$this->Html->docType('xhtml-strict');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?=$this->Html->charset('utf-8');?>
<?php
echo $this->Html->script(array('prototype','scriptaculous.js?load=effects'));
echo $this->Html->css(array("calendar"))."\n";
echo $this->Html->css("fonts/fonts-min")."\n";
//echo $this->Html->css("tabview/assets/skins/sam/tabview")."\n";"calendar",
echo $this->Html->css("container/container")."\n";
echo $this->Html->css("container/button")."\n";
echo $this->Html->css("dialog.2.0")."\n";
echo $this->Html->script('dialog.2.0')."\n";
//echo $this->Html->script('yahoo-dom-event/yahoo-dom-event')."\n";
//echo $this->Html->script('animation/animation-min')."\n";
//echo $this->Html->script('connection/connection-min')."\n";
//echo $this->Html->script('element/element-min')."\n";
//echo $this->Html->script('container/container-min')."\n";

echo $this->Html->script('common.js');
echo $this->Html->css(array("admin"))."\n";
//}
//||($this->params['controller']=='inspecaos')
    echo $this->Html->script('jscalendar/calendar.js'); 
    echo $this->Html->script('jscalendar/lang/calendar-br.js'); 
    echo $this->Html->script('common.js'); 
    echo $this->Html->css('../js/jscalendar/skins/aqua/theme');
echo $this->Html->script('tooltip.js');

?>

</head>
<body onLoad="new Effect.Fade('flashMsg',{delay: 10});">
<div id="flashMsg"><?  echo $session->flash();?></div>
<div id="spinner" style="background-color:#FFFFFF;display: none;  z-index: 30;position: fixed; top: 30%; left: 30%;float:center;border-top-width: thin;
    border-right-width: thin;
    border-bottom-width: thin;
    border-left-width: thin;
    border-top-style: solid;
    border-right-style: solid;
    border-bottom-style: solid;
    border-left-style: solid;
    border-top-color: #000000;
    border-right-color: #000000;
    border-bottom-color: #000000;
    border-left-color: #000000;"><?php echo $this->Html->image('spinner.gif',array('width'=>15,'height'=>15)).' Carregando ...'; ?></div>
<div id="wrapper" style="float:center;">
<?php echo $content_for_layout;  ?></div>

</body>
</html>




