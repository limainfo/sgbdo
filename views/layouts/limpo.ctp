<?=$this->Html->docType('xhtml-strict');?>
<head>
<?=$html->charset('utf-8'); ?>
    
<title>:: SIOp v1.0</title>
<link rel="shortcut icon" href="<?php echo $this->webroot.'img/favicon.ico'; ?>">
<?php
echo $this->Html->charset('utf-8');

echo $this->Html->script(array('prototype','tiny_mce/tiny_mce','scriptaculous.js?load=effects,dragdrop,controls'));

?>
<script type="text/javascript" language="JavaScript">
var cX = 0; var cY = 0; var rX = 0; var rY = 0;
function UpdateCursorPosition(e){ cX = e.pageX; cY = e.pageY;}
function UpdateCursorPositionDocAll(e){ cX = event.clientX; cY = event.clientY;}
if(document.all) { document.onmousemove = UpdateCursorPositionDocAll; }
else { document.onmousemove = UpdateCursorPosition; }
function AssignPosition(d) {
if(self.pageYOffset) {
	rX = self.pageXOffset;
	rY = self.pageYOffset;
	h=self.clientHeight;
	w=self.clientWidth;
	}
else if(document.documentElement && document.documentElement.scrollTop) {
	rX = document.documentElement.scrollLeft;
	rY = document.documentElement.scrollTop;
	h=document.documentElement.clientHeight;
	w=document.documentElement.clientWidth;
	}
else if(document.body) {
	rX = document.body.scrollLeft;
	rY = document.body.scrollTop;
	h = document.body.clientHeight;
	w = document.body.clientWidth;
	}
if(document.all) {
	cX += rX; 
	cY += rY;
	}
d.style.left = parseInt(w / 2) - parseInt(cX / 2)+"px";
//d.style.left = parseInt(w / 2) - parseInt(d.offsetWidth / 2)+"px";
//d.style.left = parseInt(w / 2) +"px";
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
if(dd.style.display == "none") { dd.style.display = "block"; }else { dd.style.display = "none"; }
}
//-->
</script>
</head>
<?php if(strlen($this->Session->flash())>5){ ?>

<div id='flashMsg' style='float: center;'><a style='float: right; margin: 0px;'		onclick="HideContent('flashMsg');$('flashMsg').fire('flashMsg:fechada', {mensagemId:0});"	><img border='0' width='15'	height='15' title='Excluir' alt='Excluir'	src='<?php echo $this->webroot; ?>img/lixo.gif' /> </a>
<?php  
echo $this->Session->flash();
$this->Session->delete('Message.flash');
?>
</div>
<?php } ?>
<?php echo $content_for_layout;  ?>