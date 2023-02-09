<?=$this->Html->docType('xhtml-strict');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?=$this->Html->charset('utf-8');?>
<?php
echo $this->Html->css("fonts/fonts-min")."\n";
echo $this->Html->css("tabview/assets/skins/sam/tabview")."\n";
echo $this->Html->css("container/container")."\n";
echo $this->Html->css("container/button")."\n";
echo $this->Html->script('yahoo-dom-event/yahoo-dom-event')."\n";
//echo $this->Html->script('animation/animation-min')."\n";
//echo $this->Html->script("container/connection-min");
//echo $this->Html->script('dragdrop/dragdrop-min')."\n";
echo $this->Html->script('element/element-beta-min')."\n";
echo $this->Html->script('tabview/tabview-min')."\n";
//echo $this->Html->script('button/button-min')."\n";
echo $this->Html->script("container/container-min");
echo $this->Html->script(array('prototype','scriptaculous.js?load=effects'));
echo $this->Html->css(array("admin"))."\n";
if (!(($this->params['controller']=='escalas')&&($this->params['action']=='add'))){
	echo $this->Html->script(array('menu_gerente'));
	echo $this->Html->css(array("menu_gerente","quickmenu_styles"))."\n";
	
}
if(($this->params['action']=='add')||($this->params['action']=='edit')){
    echo $this->Html->script('jscalendar/calendar.js'); 
    echo $this->Html->script('jscalendar/lang/calendar-br.js'); 
    echo $this->Html->script('common.js'); 
    echo $this->Html->css('../js/jscalendar/skins/aqua/theme');
}
if(($this->params['action']=='index')){
echo $this->Html->script('tooltip.js');
}
?>

</head>
<body onLoad="new Effect.Fade('flashMsg',{delay: 10});"
	class="yui-skin-sam">
<div id="tophead">
<h5><?php echo $this->Html->image('dacta.gif',array('style'=>'float:left;align:left;')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=Configure::read('Calendar.name').' - '.$u[0]['Privilegio']['descricao'];?></h5>
<h5 class="right"><?php  if($u[0][0]['nome']!=''){  echo $u[0][0]['nome'].' | '.$this->Html->link('Logout',array('controller'=>'usuarios','action'=>'logout'))."\n";}   ?></h5>
</div>
<div id="flashMsg"><? $session->setFlash();?></div>
<div id="spinner" style="display: none; float: left; z-index: 30;"><?php echo $this->Html->image('spinner.gif'); ?></div>
<div id="demo" class="yui-navset yui-navset-top">

<ul class="yui-nav">
<?php
//print_r($u);
?>
<?php $c=0;
?>

<?php if(!empty($acesso['rotinas'])){ ?>
	<li
	<?php $c++; if ($this->params['controller']=='rotinas'){echo 'class="selected" title="active" ';$op=$c;}?>><a
		href="<?php  if ($this->params['controller']=='rotinas'){echo $this->webroot.$this->params['url']['url'];}else {echo $this->webroot.'rotinas';} ?>"
		onclick="<?php echo 'location.href=\''.$this->webroot.'rotinas'.'\';'; ?>"><em>Cadastro
	de Rotinas</em></a></li>
	<?php } ?>

	<?php if(!empty($acesso['parecerestecnicos'])){ ?>
	<li
	<?php $c++; if (($this->params['controller']=='parecerestecnicos')){echo 'class="selected" title="active" ';$op=$c;}?>><a
		href="<?php  if (($this->params['controller']=='parecerestecnicos')){echo $this->webroot.$this->params['url']['url'];}else {echo $this->webroot.'parecerestecnicos';} ?>"
		onclick="<?php echo 'location.href=\''.$this->webroot.'parecerestecnicos\';'; ?>"><em>Parecer
	Técnico</em></a></li>
	<?php } ?>

	<?php if(!empty($acesso['estagios'])){ ?>
	<li
	<?php $c++; if (($this->params['controller']=='estagios')){echo 'class="selected" title="active" ';$op=$c;}?>><a
		href="<?php  if (($this->params['controller']=='estagios')){echo $this->webroot.$this->params['url']['url'];}else {echo $this->webroot.'estagios';} ?>"
		onclick="<?php echo 'location.href=\''.$this->webroot.'estagios'.'\';'; ?>"><em>Ficha
	de Avaliação de Estágio</em></a></li>
	<?php } ?>


	<?php if(!empty($acesso['escalantes'])){ ?>
	<li
	<?php $c++; if (($this->params['controller']=='escalantes')||($this->params['controller']=='escalas')){echo 'class="selected" title="active" ';$op=$c;}?>><a
		href="<?php  if (($this->params['controller']=='escalantes')||($this->params['controller']=='escalas')&&($this->params['action']=='relatorioPdf')){echo $this->webroot.$this->params['url']['url'];}else {echo $this->webroot.'escalas/view';} ?>"
		onclick="<?php echo 'location.href=\''.$this->webroot.'escalas/view\';'; ?>"><em>Escala
	de Serviço</em></a></li>
	<?php } ?>


	<?php if(!empty($acesso['cursos'])&&!empty($acesso['militars_cursos'])||($this->params['controller']=='cursos_setors')||($this->params['controller']=='cursoativos')||($this->params['controller']=='indicadoscursos')){ ?>
	<li
	<?php $c++; if (($this->params['controller']=='cursos')||($this->params['controller']=='militars_cursos')||($this->params['controller']=='cursos_setors')||($this->params['controller']=='cursoativos')||($this->params['controller']=='indicadoscursos')){echo 'class="selected" title="active" ';$op=$c;}?>><a
		href="<?php  if (($this->params['controller']=='cursos')||($this->params['controller']=='militars_cursos')||($this->params['controller']=='cursos_setors')||($this->params['controller']=='cursoativos')||($this->params['controller']=='indicadoscursos')){echo $this->webroot.$this->params['url']['url'];}else {echo $this->webroot.'cursos';} ?>"
		onclick="<?php echo 'location.href=\''.$this->webroot.'cursos'.'\';'; ?>"><em>Planejamento
	e Controle de Cursos</em></a></li>
	<?php } ?>


	<?php /*if(!empty($acesso['chefesescalas'])){ ?>
	<li <?php $c++; if (($this->params['controller']=='chefesescalas')){echo 'class="selected" title="active" ';$op=$c;}?>><a href="<?php  if (($this->params['controller']=='chefeescalas')){echo $this->webroot.$this->params['url']['url'];}else {echo $this->webroot.'chefesescalas';} ?>" onclick="<?php echo 'location.href=\''.$this->webroot.'chefesescalas'.'\';'; ?>" ><em>Chefe Escala</em></a>
	</li>
	<?php } */?>

	<?php if(!empty($acesso['atividades'])&&!empty($acesso['assinaturas'])&&!empty($acesso['exames'])&&!empty($acesso['fotos'])&&!empty($acesso['habilitacaos'])&&!empty($acesso['afastamentos'])&&!empty($acesso['militars'])){ ?>
	<li
	<?php $c++; if (($this->params['controller']=='atividades')||($this->params['controller']=='assinaturas')||($this->params['controller']=='exames')||($this->params['controller']=='fotos')||($this->params['controller']=='habilitacaos')||($this->params['controller']=='afastamentos')||($this->params['controller']=='militars')){echo 'class="selected" title="active" ';$op=$c;}?>><a
		href="<?php  if (($this->params['controller']=='atividades')||($this->params['controller']=='assinaturas')||($this->params['controller']=='exames')||($this->params['controller']=='fotos')||($this->params['controller']=='habilitacaos')||($this->params['controller']=='afastamentos')||($this->params['controller']=='militars')){echo $this->webroot.$this->params['url']['url'];}else {echo $this->webroot.'militars';} ?>"
		onclick="<?php echo 'location.href=\''.$this->webroot.'militars'.'\';'; ?>"><em>Controle
	de Efetivo Operacional</em></a></li>
	<?php } ?>


	<?php if(!empty($acesso['programadetrabalhos'])){ ?>
	<li
	<?php $c++;  if ($this->params['controller']=='programadetrabalhos'){ echo 'class="selected" title="active" ';$op=$c;} ?>><a
		href="<?php  if ($this->params['controller']=='programadetrabalhos'){ echo $this->webroot.$this->params['url']['url'];}else{echo $this->webroot.'programadetrabalhos';} ?>"
		onclick="<?php echo 'location.href=\''.$this->webroot.'programadetrabalhos'.'\';'; ?>"><em>Programa
	de Trabalho</em></a></li>
	<?php } ?>



	<?php if(!empty($acesso['inspecaos'])){ ?>

	<li
	<?php $c++; if ($this->params['controller']=='inspecaos'){echo 'class="selected" title="active" ';$op=$c;} ?>><a
		href="<?php  if ($this->params['controller']=='inspecaos'){echo $this->webroot.$this->params['url']['url'];}else{echo $this->webroot.'inspecaos';} ?>"
		onclick="<?php echo 'location.href=\''.$this->webroot.'inspecaos'.'\';'; ?>"><em>Relatório
	de Inspeção Operacional</em></a></li>
	<?php } ?>

	<?php if(!empty($acesso['recomendacaos'])){ ?>
	<li
	<?php $c++; if ($this->params['controller']=='recomendacaos'){echo 'class="selected" title="active" ';$op=$c;}?>><a
		href="<?php  if ($this->params['controller']=='recomendacaos'){echo $this->webroot.$this->params['url']['url'];}else{echo $this->webroot.'recomendacaos';} ?>"
		onclick="<?php echo 'location.href=\''.$this->webroot.'recomendacaos'.'\';'; ?>"><em>Controle
	de Recomendação de Segurança</em></a></li>
	<?php } ?>

	<?php /* ?>
	<li <?php $c++; echo 'class="selected" title="active" ';$op=$c;?>><a href="<?php  echo $this->webroot.$this->params['url']['url']; ?>" onclick="<?php echo 'location.href=\''.$this->webroot.'escalantes'.'\';'; ?>" ><em>Controle de EPTA</em></a>
	</li>
	<?php */ ?>



	<?php
	$compara = $u[0]['Usuario']['privilegio_id'];

	if(($compara==1)||($compara==4)){

		if(!empty($acesso['turnos'])&&!empty($acesso['escalas'])&&!empty($acesso['militars_escalas'])&&!empty($acesso['cumprimentoescalas'])){ ?>
	<li
	<?php $c++; if ((($this->params['controller']=='turnos')||($this->params['controller']=='escalas')||($this->params['controller']=='militars_escalas')||($this->params['controller']=='cumprimentoescalas'))&&($this->params['action']=='add')){echo 'class="selected" title="active" ';$op=$c;}?>><a
		href="<?php  if (($this->params['controller']=='turnos')||($this->params['controller']=='escalas')||($this->params['controller']=='militars_escalas')||($this->params['controller']=='cumprimentoescalas')){echo $this->webroot.$this->params['url']['url'];}else {echo $this->webroot.'escalas/add';} ?>"
		onclick="<?php echo 'location.href=\''.$this->webroot.'escalas'.'/add\';'; ?>"><em>Cadastro
	e Controle de Escalas</em></a></li>
	<?php 
		}
	}?>



	<?php
	/* ?>
	 <?php if(!empty($acesso['gerentes'])){ ?>
	 <li <?php $c++; if ($this->params['controller']=='gerentes'){echo 'class="selected" title="active" ';$op=$c;}?>><a href="<?php  if ($this->params['controller']=='gerentes'){echo $this->webroot.$this->params['url']['url'];}else {echo $this->webroot.'gerentes';} ?>" onclick="<?php echo 'location.href=\''.$this->webroot.'gerentes'.'\';'; ?>" ><em>Indicadores e Controles Gerenciais</em></a>
	 </li>
	 <?php } ?>
	 <?php */ ?>

	<?php if(!empty($acesso['parametros'])&&!empty($acesso['especialidades'])&&!empty($acesso['estados'])&&!empty($acesso['quadros'])&&!empty($acesso['setors'])&&!empty($acesso['unidades'])&&!empty($acesso['turnos'])&&(!empty($acesso['escalas']))&&(!empty($acesso['gerentes']))&&!empty($acesso['militars_escalas'])){ ?>
	<li
	<?php $c++; if (($this->params['controller']=='turnos')&&(($this->params['controller']=='escalas')&&($this->params['action']=='add'))||($this->params['controller']=='parametros')||($this->params['controller']=='especialidades')||($this->params['controller']=='estados')||($this->params['controller']=='orgaos')||($this->params['controller']=='quadros')||($this->params['controller']=='setors')||($this->params['controller']=='unidades')){echo ' class="selected" title="active" ';$op=$c;}?>><a
		href="<?php  if (($this->params['controller']=='parametros')||($this->params['controller']=='especialidades')||($this->params['controller']=='estados')||($this->params['controller']=='orgaos')||($this->params['controller']=='quadros')||($this->params['controller']=='setors')||($this->params['controller']=='unidades')){echo $this->webroot.$this->params['url']['url'];}else {echo $this->webroot.'parametros';} ?>"
		onclick="<?php echo 'location.href=\''.$this->webroot.'parametros'.'\';'; ?>"><em>Configuração</em></a>
	</li>
	<?php } ?>

	<?php if(!empty($acesso['usuarios'])&&!empty($acesso['privilegios'])&&!empty($acesso['tabelas'])&&!empty($acesso['setors_usuarios'])&&!empty($acesso['privilegios_usuarios'])&&!empty($acesso['privilegios_tabelas'])){ ?>
	<li
	<?php $c++; if (($this->params['controller']=='usuarios')||($this->params['controller']=='privilegios')||($this->params['controller']=='tabelas')||($this->params['controller']=='setors_usuarios')||($this->params['controller']=='privilegios_usuarios')||($this->params['controller']=='privilegios_tabelas')){echo 'class="selected" title="active" ';$op=$c;}?>><a
		href="<?php  if (($this->params['controller']=='usuarios')||($this->params['controller']=='privilegios')||($this->params['controller']=='tabelas')||($this->params['controller']=='setors_usuarios')||($this->params['controller']=='privilegios_usuarios')||($this->params['controller']=='privilegios_tabelas')){echo $this->webroot.$this->params['url']['url'];}else {echo $this->webroot.'usuarios/add';} ?>"
		onclick="<?php echo 'location.href=\''.$this->webroot.'usuarios/add'.'\';'; ?>"><em>Cadastro
	de Usuários</em></a></li>
	<?php } ?>


	<?php if(!empty($acesso['afastamentos'])&&(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($u[0]['Usuario']['privilegio_id']==5)||($u[0]['Usuario']['privilegio_id']==6))){ ?>
	<li
	<?php $c++; if (($this->params['controller']=='afastamentos')){echo 'class="selected" title="active" ';$op=$c;}?>><a
		href="<?php  if (($this->params['controller']=='afastamentos')){echo $this->webroot.$this->params['url']['url'];}else {echo $this->webroot.'afastamentos/add';} ?>"
		onclick="<?php echo 'location.href=\''.$this->webroot.'afastamentos/add'.'\';'; ?>"><em>Afastamentos</em></a>
	</li>
	<?php } ?>


	<?php if(!empty($acesso['usuarios'])){ ?>
	<li
	<?php $c++; if (($this->params['controller']=='usuarios')&&($this->params['action']=='edit')){echo 'class="selected" title="active" ';$op=$c;}?>><a
		href="<?php  if (($this->params['controller']=='usuarios')&&($this->params['action']=='edit')){echo $this->webroot.$this->params['url']['url'];}else {echo $this->webroot.'usuarios/edit/'.$u[0]['Usuario']['id'];} ?>"
		onclick="<?php echo 'location.href=\''.$this->webroot.'usuarios/edit/'.$u[0]['Usuario']['id'].'\';'; ?>"><em>Modificar
	Senha</em></a></li>
	<?php } ?>

	<li <?php $c++; ?>><a
		href="<?php  echo $this->webroot.'calendariorotinas/view'; ?>"
		onclick="<?php echo 'location.href=\''.$this->webroot.'calendariorotinas/view'.'\';'; ?>"><em>CALENDÁRIO</em></a>
	</li>


	<?php if(empty($u[0][0]['nome'])){ ?>
	<li
	<?php $c++; if (($this->params['controller']=='usuarios')&&($this->params['action']=='login')){echo 'class="selected" title="active" ';$op=$c;}?>><a
		href="<?php  if (($this->params['controller']=='usuarios')&&($this->params['action']=='login')){echo $this->webroot.$this->params['url']['url'];}else {echo $this->webroot.'usuarios/login/';} ?>"
		onclick="<?php echo 'location.href=\''.$this->webroot.'usuarios/login/'.'\';'; ?>"><em>AUTORIZAÇÃO</em></a>
	</li>
	<?php } ?>


	<?php if(!empty($acesso['eptas'])&&(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)||($u[0]['Usuario']['privilegio_id']==5)||($u[0]['Usuario']['privilegio_id']==6))){ ?>
	<li
	<?php  $c++; if (strpos($this->params['controller'],'ptas')>0){echo 'class="selected" title="active" ';$op=$c;}?>><a
		href="<?php  if (strpos($this->params['controller'],'eptas')!==false){echo $this->webroot.$this->params['url']['url'];}else {echo $this->webroot.'eptas/ajax';} ?>"
		onclick="<?php echo 'location.href=\''.$this->webroot.'eptas/ajax'.'\';'; ?>"><em>EPTA</em></a>
	</li>
	<?php } ?>

	<?php if(!empty($acesso['controlehoras'])){ ?>
	<li
	<?php  $c++; if ($this->params['controller']=='controlehoras'){echo 'class="selected" title="active" ';$op=$c;}?>><a
		href="<?php  if ($this->params['controller']=='controlehoras'){echo $this->webroot.$this->params['url']['url'];}else {echo $this->webroot.'controlehoras/add';} ?>"
		onclick="<?php echo 'location.href=\''.$this->webroot.'controlehoras/add'.'\';'; ?>"><em>Controle de horas</em></a>
	</li>
	<?php } ?>
	
	<?php if(!empty($acesso['logs'])){ ?>
	<li
	<?php  $c++; if ($this->params['controller']=='logs'){echo 'class="selected" title="active" ';$op=$c;}?>><a
		href="<?php  if ($this->params['controller']=='logs'){echo $this->webroot.$this->params['url']['url'];}else {echo $this->webroot.'logs';} ?>"
		onclick="<?php echo 'location.href=\''.$this->webroot.'logs'.'\';'; ?>"><em>Auditoria</em></a>
	</li>
	<?php } 
	?>

	<?php if(!empty($acesso['empreendimentos'])){ ?>
	<li
	<?php  $c++; if ($this->params['controller']=='empreendimentos'){echo 'class="selected" title="active" ';$op=$c;}?>><a
		href="<?php  if ($this->params['controller']=='empreendimentos'){echo $this->webroot.$this->params['url']['url'];}else {echo $this->webroot.'empreendimentos';} ?>"
		onclick="<?php echo 'location.href=\''.$this->webroot.'empreendimentos'.'\';'; ?>"><em>Empreendimentos</em></a>
	</li>
	<?php } ?>
	
	<?php if(!empty($acesso['englishtowns'])){ ?>
	<li
	<?php  $c++; if ($this->params['controller']=='englishtowns'){echo 'class="selected" title="active" ';$op=$c;}?>><a
		href="<?php  if ($this->params['controller']=='englishtowns'){echo $this->webroot.$this->params['url']['url'];}else {echo $this->webroot.'englishtowns';} ?>"
		onclick="<?php echo 'location.href=\''.$this->webroot.'englishtowns'.'\';'; ?>"><em>EnglishTown</em></a>
	</li>
	<?php } ?>
	
</ul>
<div class="yui-content"><?php
for ($i=1;$i<=$c;$i++){
	if($i==$op){
		echo '<div id="tab'.$i.'" style="display: block;height:2600px;" ><div id="wrapper">'.$content_for_layout."</div></div>\n";
	}else{
		echo '<div id="tab'.$i.'" style="display: none;height:1px;" ></div>'."\n";

	}
}
?></div>
</div>
<script>
(function() {
    var tabView = new YAHOO.widget.TabView('demo');

    YAHOO.log("The example has finished loading; as you interact with it, you'll see log messages appearing here.", "info", "example");
})();
</script>
</body>
</html>


