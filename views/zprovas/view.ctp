<?=$this->Html->charset('utf-8');?>
<?php
echo $this->Html->script(array('prototype','scriptaculous.js?load=effects,dragdrop'));
$raiz = $this->webroot;

?>
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
<script  type="text/javascript">
tms=new Array()

//Mostra o submenu no mouseover
function over(n){
 if(typeof(tms[n])!="undefined")clearTimeout(tms[n])
 document.getElementById("s"+n).style.visibility="visible"
}
//Esconde o submenu no mouseout
function out(n){
 tms[n]=setTimeout('document.getElementById("s'+n+'").style.visibility="hidden"',500)
}
</script>
<style type="text/css">
/*************************** 
  Disposição do layout 
 ***************************/
body{
	text-align:center;
	background:#FFF;
	font-family:verdana,arial,helvetica,sans-serif;
	font-size:80%;
	padding:0px;
	margin:0px;
}

#conteudo{
	width:750px;
	text-align:left;
	margin:10px auto 10px auto;
	background-image:url(<?php echo $raiz;?>webroot/img/color_cubes.gif);
	background-repeat:no-repeat;
	background-position:630px 50px;
	border-left:2px solid #DD2424;
	border-right:2px solid #DD2424;
}

/*************************** 
  Estilos de texto 
 ***************************/

/* Títulos */
h1{
	background:#DD2424;
	color:white;
	padding:10px;
	margin:0px;
	font-size:20px;
}
h2{
	margin:20px;
	color:#DD2424;
	letter-spacing:5px;
	border-left:35px solid #DD2424;
	padding:0px 20px;
	width:300px;
}

/*Texto*/
ul{
	margin-right:100px;
}
li{
	margin-bottom:5px;
}
code{
	color:#D22;
}
p{
	margin:10px 100px 20px 20px;
	line-height:150%;
}
pre{
	margin:10px 30px;
	padding:10px;
	color:#500;
	font-size:120%;
	background:#EDEDED;
}
pre i{
	color:#D22;
}
dir{
	background:white;
	padding:10px;
	margin:10px;
	margin-right:0px;
	width:300px;
	float:right;
	border-left:7px solid #DD2424;
	border-bottom:7px solid #DD2424;
}

a:hover{
	text-decoration:none;
	color:red;
}

/* Rodapé */
#rodape{
	background:#DD2424;
	color:white;
	text-align:center;
	padding:10px;
	border-top:10px solid #540E0E;
}
#rodape a{
	color:yellow
}

/*************************** 
  Menu 
 ***************************/
.submenu{
	position:absolute;
	top:81px;
	width:100px;
	visibility:hidden;
}
.itemmenu a{
	display:block;
	background:#FC9;
	font-size:12px;
	text-align:center;
	padding:5px;
	color:black;
	text-decoration:none;
	border-right:1px solid #C96;
	border-bottom:1px solid #C96;
	border-top:1px solid #FFC;
	border-left:1px solid #FFC;
	position:relative;
	top:0px;
	left:0px;
}
.itemmenu a:hover{
	background:#DD2424;
	color:white;
	border:1px solid black;
}
.itemmenu{
	float:left;
	width:100px;
}

/* Tooltip */
a span{
	display:none
}
a:hover span{
	display:block;
	position:absolute;
	top:20px;
	left:120px;
	background:#FFC;
	color:black;
	border:1px dotted black;
	width:150px;
	padding:10px;
}

select.Menu{
	font-family: Verdana, sans serif;
	font-size: 8pt;
	font-style: normal;
}
option.certa{
	color:#000000;
	background-color:#80FF80;
}
option.errada{
	color:#000000;
	background-color:#FF8080;
}
option.naomarcada{
	color:#000000;
	background-color:#8080FF;
}
</style>
<div id="conteudo">
      <h1>
        <?php
	echo $this->data['Zprova']['nomeprova'].' - ';
	echo $this->data['Zprova']['dataprova'].'<br>';
	echo $this->data['Zprova']['regulamento'];
	     ?>
      </h1>
       
      <div id="menu">

        <div onmouseout="out(1)" onmouseover="over(1)" class="itemmenu">
          <a href=".?cont=1">Home</a><br>

          <div id="s1" class="submenu" style="visibility: hidden;">
            <a href=".?cont=2">Tableless?<span> - Que negócio é esse de Tableless, afinal?</span></a>
            <a href=".?cont=3">Iniciando<span> - O que você precisa saber antes de começar?</span></a>
          </div>
        </div>

        <div onmouseout="out(2)" onmouseover="over(2)" class="itemmenu">
          <a href=".?cont=4">HTML</a><br>

          <div id="s2" class="submenu" style="visibility: hidden;">
            <a href=".?cont=5">XHTML<span> - Um HTML mais "esperto"</span></a>
            <a href=".?cont=6">Primeiras linhas<span> - CSS externo, JS externo e suas vantagens</span></a>
            <a href=".?cont=7">Vamos ao conteúdo!<span> - Tag pra cá, tag pra lá, mantenha isso simples!</span></a>
          </div>
        </div>

        <div onmouseout="out(3)" onmouseover="over(3)" class="itemmenu">
          <a href=".?cont=8">CSS</a><br>

          <div id="s3" class="submenu" style="visibility: hidden;">
            <a href=".?cont=9">O básico<span> - Cada coisa em seu devido lugar</span></a>
            <a href=".?cont=10">Conteúdo<span> - Títulos, caixas, códigos, e etc.</span></a>
            <a href=".?cont=11">E o menu?<span> - Ainda dá pra manter isso simples!</span></a>
            <a href=".?cont=12">Javascript<span> - Vamos colocar um pouco de ação nisso aqui!</span></a>
          </div>
        </div>

        <div onmouseout="out(4)" onmouseover="over(4)" class="itemmenu">
          <a href=".?cont=13">Mais</a><br>

          <div id="s4" class="submenu" style="visibility: hidden;">
            <a href=".?cont=14">Links<span> - Recursos online para quem escreve HTML</span></a>
            <a href=".?cont=15">Sobre<span> - Quem é o sujeito simpático que escreveu isso aqui?</span></a>
          </div>
        </div>

		<br clear="all">

      </div>
 
	     <h2>	<?php
	echo $this->data['Zprova']['referencia'];
	     ?></h2>
	<p><b><h3><?php
	
	
      $this->data['Zprova']['item']=str_replace('a)','<br>a)',$this->data['Zprova']['item']);
      $this->data['Zprova']['item']=str_replace('b)','<br>b)',$this->data['Zprova']['item']);
      $this->data['Zprova']['item']=str_replace('c)','<br>c)',$this->data['Zprova']['item']);
      $this->data['Zprova']['item']=str_replace('d)','<br>d)',$this->data['Zprova']['item']);
      $this->data['Zprova']['item']=str_replace('Escolha a resp','<br><br>Escolha a resp',$this->data['Zprova']['item']);
      echo $this->data['Zprova']['indice'].')  </h3>'.($this->data['Zprova']['item']);

      ?>
      </b></p><p align="center">
      <?php 
			if($this->data['Zprova']['zfoto_id']>0){
				$img = $this->data['Zprova']['zfoto_id'];
				echo $this->Html->image(array('controller'=> 'zquestaos', 'action'=>'externodownload',$img ), array( 'border'=> '0')); 
			}
      ?></p>
	<div  id="mensagem">
	<dir>
	<font size='1'>
	<b>Estatísticas:</b><br>
	Acertos:&nbsp;&nbsp;<b style="background-color:#80FF80">&nbsp;<?php echo $this->data['Zprova']['acertos']; ?>&nbsp;</b><br>
	Erros:&nbsp;&nbsp;<b style="background-color:#FF8080">&nbsp;<?php echo $this->data['Zprova']['erros']; ?>&nbsp;</b><br>
	Tentativas:<u><?php echo $this->data['Zprova']['tentativas']; ?></u><br>
	Não Marcadas:&nbsp;&nbsp;<b style="background-color:#8080FF">&nbsp;<?php echo $this->data['Zprova']['naomarcadas']; ?>&nbsp;</b><br>
	Total:<u><?php echo $this->data['Zprova']['total']; ?></u><br>
	Atual: <?php if($this->data['Zprova']['resposta']==$this->data['Zprova']['respostamarcada']){
		echo '&nbsp;&nbsp;<b style="background-color:#40ff40;vertical-align:top;">&nbsp;OK&nbsp;</b><img style="vertical-align:middle;width:15px;height:15px;" src="'.$raiz.'webroot/img/verde.gif">';
	}else{
		if(empty($this->data['Zprova']['respostamarcada'])){
			echo '&nbsp;&nbsp;<b style="background-color:yellow;vertical-align:top;">&nbsp;NÃO MARCADA&nbsp;</b>';
		}else{
			echo '&nbsp;&nbsp;<b style="background-color:#ff4040;;vertical-align:top;">&nbsp;INCORRETA</b><img style="vertical-align:middle;width:15px;height:15px;"  src="'.$raiz.'webroot/img/vermelho.gif">';
		}
	}?>
	</font>
	</dir>
	</div>
	<script language="javascript">
//	$('mensagem').hide();
	$('menu').hide();</script>
	<p class="proxanter">
<div id="cadastraprova">
<?php 
echo $this->Form->create('Zprova', array('action'=>'view','onsubmit'=>'','type'=>'file'));
//print_r($regulamentos);
?>
	<fieldset>
	<?php
	echo $this->Form->hidden('id');
	echo $this->Form->hidden('indice');
	echo $this->Form->hidden('nomeprova');
	echo $this->Form->hidden('nome_prova');
	echo $this->Form->hidden('total');
	echo $this->Form->hidden('dataprova');
	echo $this->Form->hidden('resposta');
	echo $this->Form->hidden('regulamento');
	echo $this->Form->hidden('proximoindice');
	echo 'Resp.:<br>'.$this->Form->select('Zprova.respostamarcada',array(''=>'','A'=>'A','B'=>'B','C'=>'C','D'=>'D','E'=>'E'),$this->data['Zprova']['respostamarcada'],array('multiple'=>'multiple','size'=>'7','onchange'=>'submitForm(this);'));
		?>
	</fieldset>
</div>		|
<?php
$contagem=count($listaquestoes);
$select = '<select id="ZprovaQuestoes" class="Menu" onchange=" $(\'ZprovaProximoindice\').value=$(\'ZprovaQuestoes\').value;$(\'ZprovaViewForm\').submit();" name="data[Zprova][questoes]">';
for($i=1;$i<=$contagem;$i++){
	if($listaquestoes[$i]=='ok'){
		$select .= '<option class="certa" value="'.$i.'">'.$i;
		
	}
	if($listaquestoes[$i]=='erro'){
		$select .= '<option class="errada" value="'.$i.'">'.$i;
		
	}
	if($listaquestoes[$i]=='vazio'){
		$select .= '<option class="naomarcada" value="'.$i.'">'.$i;
		
	}
}
$select .='</select>';
//$form->select('questoes', $itens ,$this->data['Zprova']['indice'] ,array('onChange'=>" $('ZprovaProximoindice').value=$('ZprovaQuestoes').value;$('ZprovaViewForm').submit();",'class'=>'formulario'), false)
echo '<div id="rodape"><input style="float:left;" type="submit" value="anterior" onmouseover="recua();">'.$select.'<input style="float:right;" type="submit" value="próximo" onmouseover="avanca();"><br><br>';
		//print_r($listaquestoes);

?>
Evaldo Lima - 2010
	  - <a title="Tableless Sites" href="<?php echo $raiz.'zprovas/add';?>"><?php
	echo $this->data['Zprova']['indice'].'/'.$this->data['Zprova']['total'];
	     ?></a>
	     
</div>

<?php 

$raiz = $this->webroot;

$observaUnidade=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[

$('ZprovaProximoindice').value=$('ZprovaIndice').value;

function avanca(){
    var indice=parseInt($('ZprovaIndice').value);
    var total=parseInt($('ZprovaTotal').value);
    var depois = indice + 1;
    $('ZprovaProximoindice').value=depois;
	if($('ZprovaProximoindice').value>total){
		$('ZprovaProximoindice').value=1;
	}
}
function recua(){
    var indice=parseInt($('ZprovaIndice').value);
    var total=parseInt($('ZprovaTotal').value);
    var antes = indice - 1;
	$('ZprovaProximoindice').value=antes;
	if($('ZprovaProximoindice').value<1){
		$('ZprovaProximoindice').value=total;
	}

}

function submitForm(form) {
/*
usa método request() da classe Form da prototype, que serializa os campos
do formulário e submete (por POST como default) para a action especificada no form
*/
var dados = Form.serialize($('ZprovaViewForm'));
var idS = $('ZprovaRespostamarcada').value;
new Ajax.Request('{$this->webroot}zprovas/externomarca/'+idS, {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			
			 if (resultado.ok==0){
				alert('Registro não atualizado!');
				//$('dados').innerHTML = resultado.mensagem;
				//$('atuais').innerHTML = resultado.atual;
			}else{
				//alert('Registro atualizado!');
				//alert($('mensagem').innerHTML);
				var tentativa = resultado.tentativas;
				if($('ZprovaResposta').value==$('ZprovaRespostamarcada').value){
					$('mensagem').innerHTML='<dir><img src="{$raiz}webroot/img/verde.gif">Resposta Correta! '+tentativa+' Tentativas!</dir>';
				}else{
					$('mensagem').innerHTML='<dir><img src="{$raiz}webroot/img/vermelho.gif">Resposta Errada! '+tentativa+' Tentativas!</dir>';
				}
				$('mensagem').show();
				//$('dados').innerHTML = resultado.mensagem;
				//$('atuais').innerHTML = resultado.atual;
							
			}
		}
				})
        
        
        return false;
    }
    
//]]>
</script>
SCRIPT;
echo $observaUnidade;
?>