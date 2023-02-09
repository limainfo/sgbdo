<?=$this->Html->docType('xhtml-strict');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?=$this->Html->charset('utf-8');?>
<?php 
	//echo $this->Html->script(array('prototype','scriptaculous.js?load=effects'))."\n";
    echo $this->Html->script(array('prototype'));
    //echo $this->Html->script(array('prototype','scriptaculous.js?load=effects'));
	echo $this->Html->css("fonts/fonts-min")."\n";
    echo $this->Html->css("tabview/assets/skins/sam/tabview")."\n";
    echo $this->Html->script('yahoo-dom-event/yahoo-dom-event')."\n";
	echo $this->Html->script('element/element-beta-min')."\n";  
	echo $this->Html->script('tabview/tabview-min')."\n";  
	//	echo $this->Html->script("container/container-min");
//	echo $this->Html->script("animation/animation-min");
//	echo $this->Html->script("connection/connection-min");
//	echo $this->Html->script("dragdrop/dragdrop-min");
//	echo $this->Html->css("container/container")."\n";
	echo $this->Html->css("admin")."\n";
	//echo $this->Html->css(array('admin','menu_usuarios'))."\n";
	
?>
<script type="text/javascript">
function clickElement(elementid)
	{
	var e = document.getElementById(elementid);
		if (typeof e == 'object')
		{
			//alert( "type object" );
			if(document.createEventObject)
			{
				//alert('createEventObject');
				e.fireEvent('onclick');
				return false;
			}
			else if(document.createEvent)
			{
				//alert('createEvent');
				var evObj = document.createEvent('MouseEvents');
				evObj.initEvent('click',true,true);
				e.dispatchEvent(evObj);
				return false;
			}else
				{
					//alert('click');
					e.click();
					return false;
				}
			}
		//else
			//alert( "not type object" );
		}

</script>

<title><?=Configure::read('Calendar.name');?> :: Administração</title>
</head>
<body  class="yui-skin-sam">
<div id="tophead">
<h5><?php echo $this->Html->image('dacta.gif',array('style'=>'float:left;align:left;')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=Configure::read('Calendar.name');?></h5>
<h5 class="right"></h5>
</div>

<div id="demo" class="yui-navset yui-navset-top">
<ul class="yui-nav">


	<li <?php if ($this->params['controller']=='afastamentos'){echo 'class="selected" title="active" ';}?>><a href="<?php echo $this->webroot.$this->params['url']['url']; ?>" ><em>Afastamentos</em></a>
	</li>

	<li <?php if ($this->params['controller']=='users'){echo 'class="selected" title="active" ';}?>><a href="<?php echo $this->webroot.$this->params['url']['url']; ?>" ><em>Autenticação</em></a>
	</li>

	<li><a href="#tab1" onclick="$('atividades').src='/operacional/calendariorotinas';"><em>Afastamentos</em></a>
	</li>

	<li><a href="#tab1"><em><?php echo $this->base; ?>Atividades</em></a>
	</li>

	<li><a href="#tab1"><em><?php echo $raiz; ?>Cursos</em></a>
	</li>

	<li><a href="#tab1">Escalas</a>
	</li>

	<li><a href="#tab1">Especialidades</a>
	</li>

	<li><a href="#tab1">Exames</a>
	</li>

	<li><a href="#tab1">Fotos</a>
	</li>

	<li><a href="#tab1">Habilitações</a>
	</li>

	<li><a href="#tab1">Localidades</a>
	</li>

	<li><a href="#tab1">Militares</a>
	</li>


	<li><a href="#tab1">Militar/Curso</a>
	</li>


	<li><a href="#tab1">Militar/Escala</a>
	</li>


	<li><a href="#tab1">Militar/Órgão</a>
	</li>


	<li><a href="#tab1">Motivos</a>
	</li>


	<li><a href="#tab1">Obs_escala</a>
	</li>


	<li><a href="#tab1">Órgãos</a>
	</li>


	<li><a href="#tab1">Órgão/Especialidade</a>
	</li>


	<li><a href="#tab1">Quadros</a>
	</li>


	<li><a href="#tab1">Rotinas</a>
	</li>


	<li><a href="#tab1">Setores</a>
	</li>


	<li><a href="#tab1">Turnos</a>
	</li>


	<li><a href="#tab1">Unidades</a>
	</li>

</ul>
<div class="yui-content">
<div id="tab1" style="display: block;height:600px;"><?php echo $content_for_layout; ?></div>
</div>
</div>
<script>
(function() {
    var tabView = new YAHOO.widget.TabView('demo');

    YAHOO.log("The example has finished loading; as you interact with it, you'll see log messages appearing here.", "info", "example");
})();
</script>
<?php
echo '<PRE>';
print_r($GLOBALS);
echo '</PRE>';
?>
<!-- 
<div id="menubar">
<ul>
	<li><?=$this->Html->link('Afastamentos','/afastamentos');?></li>
	<li><?=$this->Html->link('Atividades','/atividades');?></li>
	<li><?=$this->Html->link('Habilitações','/habilitacaos');?></li>

	<li><?=$this->Html->link('Cursos','/cursos');?></li>
	<li><?=$this->Html->link('Escalas','/escalas');?></li>
	<li><?=$this->Html->link('Especialidades','/especialidades');?></li>
	<li><?=$this->Html->link('Exames','/exames');?></li>
	<li><?=$this->Html->link('Fotos','/fotos');?></li>
	<li><?=$this->Html->link('Localidades','/localidades');?></li>
	<li><?=$this->Html->link('Militares','/militars');?></li>
	<li><?=$this->Html->link('Militar/Curso','/militars_cursos');?></li>
	<li><?=$this->Html->link('Militar/Escala','/militars_escalas');?></li>
	<li><?=$this->Html->link('Militar/Órgão','/militars_orgaos');?></li>
	<li><?=$this->Html->link('Motivos','/motivos');?></li>
	<li><?=$this->Html->link('Obs_escala','/obs');?></li>
	<li><?=$this->Html->link('Órgãos','/orgaos');?></li>
	<li><?=$this->Html->link('Órgão/Especialidade','/orgaos_especialidades');?></li>
	<li><?=$this->Html->link('Quadros','/quadros');?></li>
	<li><?=$this->Html->link('Rotinas','/rotinas');?></li>
	<li><?=$this->Html->link('Setores','/setors');?></li>
	<li><?=$this->Html->link('Turnos','/turnos');?></li>
	<li><?=$this->Html->link('Unidades','/unidades');?></li>
	<li><?//=$this->Html->link('Usuários','/admin/users');?></li>
	<li style="float: right;"><?=$this->Html->link('<<CALENDÁRIO>>','/calendariorotinas/view/');?></li>
	<li style="float: right;"><?=$this->Html->link('SAIR','/admin/logout');?></li>
</ul>
</div>
<div id="flashMsg"><? $session->setFlash();?></div>
<div id="spinner" style="display: none; float: left;z-index:30;"><?php echo $this->Html->image('spinner.gif'); ?></div>
 
-->

</body>
</html>


