<?php
/* SVN FILE: $Id: default.ctp 7118 2008-06-04 20:49:29Z gwoo $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.cake.console.libs.templates.skel.views.layouts
 * @since			CakePHP(tm) v 0.10.0.1076
 * @version			$Revision: 7118 $
 * @modifiedby		$LastChangedBy: gwoo $
 * @lastmodified	$Date: 2008-06-04 13:49:29 -0700 (Wed, 04 Jun 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title><?=Configure::read('Calendar.name');?></title>
	<?php
		echo $this->Html->meta('icon');

	$this->Html->css('calendar');
	//echo $this->Html->css('cake.generic');

	$this->Html->script(array('prototype','scriptaculous.js?load=effects','calendar'));
		//echo $this->Html->script(array('prototype'));
		
		echo $scripts_for_layout;
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
<div id="flashMsg"><? $session->setFlash();?></div>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link(__('SISTEMA PARA CONTROLE OAPLE', true), '/cake_1.2/operacional/militars');?></h1>
		</div>
		<div id="content">
			<?php
				if ($session->check('Message.flash')):
						$session->setFlash();
				endif;
			?>
<div id="spinner" style="display: none; float: right;"><?php echo $this->Html->image('spinner.gif'); ?></div>

			<?php echo $content_for_layout;?>

		</div>
		<div id="footer">
			<?php   /*
			           echo $this->Html->link(
							$this->Html->image('cake.power.gif', array('alt'=> __("CakePHP: the rapid development php framework", true), 'border'=>"0")),
							'http://www.cakephp.org/',
							array('target'=>'_new'), null, false
						);
*/
			?>
		</div>
	</div>
	<?php echo $cakeDebug?>
</body>
</html>