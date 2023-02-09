<?=$this->Html->docType('html4-strict');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $this->Html->charset(); ?>
<title><?php __('SISTEMA PARA CONTROLE OAPLE'); ?> <?php echo $title_for_layout;?>
</title>

<?php
echo $this->Html->meta('icon');

echo $this->Html->css('admin');

echo $scripts_for_layout;

echo $this->Html->script(array('prototype','scriptaculous.js?load=effects','calendar'));
//echo $this->Html->script(array('prototype'));
?>
<?php 
	echo $this->Html->script('yahoo')."\n";
	echo $this->Html->script('event')."\n";
	echo $this->Html->script('dom')."\n";
?>


<style type="text/css">
div.disabled {
	display: inline;
	float: none;
	clear: none;
	color: #C0C0C0;
}
</style>

</head>

<body onLoad="new Effect.Fade('flashMsg',{delay: 3});">

<div id="main">
<div id="flashMsg"><? $session->setFlash();?></div>
<div id="spinner" style="display: none; float: right;z-index:30;"><?php echo $this->Html->image('spinner.gif'); ?>

</div>

<div id="content"><?php
if ($session->check('Message.flash')):
$session->setFlash();
endif;
?> <?php echo $content_for_layout;?></div>

</div>

</body>

</html>

