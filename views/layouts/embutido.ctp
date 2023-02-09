<?=$this->Html->docType('xhtml-strict');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

  <?=$this->Html->charset('utf-8');?>
  <?php
  echo $this->Html->script(array('prototype','scriptaculous.js?load=effects','calendar'));
  echo $this->Html->css("admin")."\n";
  ?>
</head>
<body>
<div id="wrapperEmbutido"><?=$content_for_layout;?></div>

</body>
</html>
