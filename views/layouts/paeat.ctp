<?=$this->Html->docType('xhtml-strict');?>
<head>
<?=$html->charset('utf-8'); ?>
    
<title>:: SIOp v1.0</title>
<link rel="shortcut icon" href="<?php echo $this->webroot.'img/favicon.ico'; ?>">
<?php
function CadaCons($boli,$titulo,$pasta,$qual=2,$cad='Cadastro'){
	if($boli){
		echo("<a href='javascript:void(0);'>{$titulo}</a>");
		echo("<div><a href='{$pasta}/");
		if($qual>=1)echo("add");
		echo("'>{$cad}</a>");
		if($qual==2)echo("<a href='{$pasta}'>Consulta</a>");
		if($qual>=1)echo("</div>");
	}
}

function CadaCons2($boli,$titulo,$pasta){
	if($boli){
		echo("<span class='qmtitle'><a href='{$pasta}'>{$titulo}</a></span>");
	}
}

echo $this->Html->charset('utf-8');

echo $this->Html->script(array('prototype','tiny_mce/tiny_mce','scriptaculous.js?load=effects,dragdrop,controls'));
//echo $this->Html->script('transport.js');
echo $this->Html->css("dialog.2.0")."\n";
echo $this->Html->css("menu_gerente")."\n";
echo $this->Html->script('dialog.2.0')."\n";
echo $this->Html->script('common.js');
echo $this->Html->css(array("admin"))."\n";
echo $this->Html->css("carregador")."\n";
echo $this->Html->script(array('menu_gerente'));
if((($this->params['action']=='add')||(preg_match('/^externo/',$this->action))||($this->params['action']=='edit')||($this->params['action']=='view'))){
	echo $this->Html->script('jscalendar/calendar.js');
	echo $this->Html->script('jscalendar/lang/calendar-br.js');
	echo $this->Html->script('common.js');
	echo $this->Html->css('../js/jscalendar/skins/aqua/theme');
}
if($this->params['controller']=='aditivos'){
        echo $this->Html->script('fusioncharts.js');
}
if(($this->params['action']=='index')){
	echo $this->Html->script('tooltip.js');
}

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
d.style.left = parseInt(w / 2) - parseInt(d.offsetWidth / 2)+"px";
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
var _loadTimer	= setInterval(__loadAnima,18);
var _loadPos	= 0;
var _loadDir	= 2;
var _loadLen	= 0;

//Anima a barra de progresso
function __loadAnima(){
	var objLoader				= document.getElementById("carregador_pai");
	objLoader.style.display		="block";
	objLoader.style.zIndex		="100";
	objLoader.style.visibility	="visible";
	var elem = document.getElementById("barra_progresso");
	if(elem != null){
		if (_loadPos==0) _loadLen += _loadDir;
		if (_loadLen>32 || _loadPos>79) _loadPos += _loadDir;
		if (_loadPos>79) _loadLen -= _loadDir;
		if (_loadPos>79 && _loadLen==0) _loadPos=0;
		elem.style.left		= _loadPos;
		elem.style.width	= _loadLen;
	}
}

//Esconde o carregador
function __loadEsconde(){
	this.clearInterval(_loadTimer);
	var objLoader				= document.getElementById("carregador_pai");
	objLoader.style.display		="none";
	objLoader.style.visibility	="hidden";
}
//-->
</script>
</head>
<body onload="__loadEsconde();">
<div id="carregador_pai">
<div id="carregador">
<div align="center">Aguarde carregando ...</div>
<div id="carregador_fundo"><div id="barra_progresso"> </div></div>
</div>
</div>
<script language="javascript">
var x=screen.height;
var y=screen.width;
</script>

        
<?php
if(!empty($u[0]['Usuario']['privilegio_id'])){	
?>

<div id="tophead"><?php echo $html->image('dacta.gif',array('style'=>'float:left;align:top;padding:3px;')); ?>
<div id='esquerda' 	style="float: left; font-size: 1px; width: 6px; height: 34px; background-image: url(<?php echo $this->webroot; ?>webroot/css/qmimages/left_cap_blue.gif);">
</div>
<div id="qm0" class="qmmc" style="float: left; height: 34px; background-image: url(<?php echo $this->webroot; ?>webroot/css/qmimages/center_tile_blue.gif); background-repeat: repeat-x;">        
    
    <?php
   
	$compara = $u[0]['Usuario']['privilegio_id'];
/*
	if(($compara==1)||($compara==4)||($compara==12)){
            
		echo("<a href='javascript:void(0)'>Administrador</a>");
		echo("<div><span class='qmdivider qmdividerx'></span> ");
		echo("<span class='qmtitle'>Cadastros</span>");
		if(($compara==12)||($compara==1)||($compara==3)||($compara==4)){
			echo("<a href='".$this->webroot.'escalas/add'."'>Escalas</a>");
		}
		if(!empty($acesso['usuarios'])&&!empty($acesso['privilegios'])&&!empty($acesso['tabelas'])
			&&!empty($acesso['setors_usuarios'])&&!empty($acesso['privilegios_usuarios'])&&!empty($acesso['privilegios_tabelas'])){ 
			echo("<a href='".$this->webroot.'usuarios/add'."'>Usuários</a>");
		} 
		echo("<a href='javascript:void(0);'>Parâmetros</a>");
		echo("<div>");
		echo("<span class='qmtitle'>");
		echo("<a href='".$this->webroot.'paises/externoadd'."'>Corrige Latin1 para UTF8</a>");
		if(!empty($acesso['paises'])){echo("<a href='".$this->webroot.'paises'."'>País</a>");}
		if(!empty($acesso['estados'])){echo("<a href='".$this->webroot.'estados'."'>Estado</a>");}
		if(!empty($acesso['cidades'])){echo("<a href='".$this->webroot.'cidades'."'>Cidade</a>");}
		if(!empty($acesso['postos'])){echo("<a href='".$this->webroot.'postos'."'>Posto</a>");}
		echo("</span>");
		if(!empty($acesso['equipamentos'])){echo("<a href='".$this->webroot.'equipamentos/add'."'>Equipamentos</a>");}
		if(!empty($acesso['especialidades'])){echo("<a href='".$this->webroot.'especialidades/add'."'>Especialidades</a>");}
		if(!empty($acesso['localidades'])){echo("<a href='".$this->webroot.'localidades/add'."'>Localidades</a>");}
		if(!empty($acesso['quadros'])){echo("<a href='".$this->webroot.'quadros/add'."'>Quadros</a>");}
		if(!empty($acesso['setoresassociados'])){echo("<a href='".$this->webroot.'setoresassociados/add'."'>Órgão e setores associados</a>");}
		if(!empty($acesso['setors'])){echo("<a href='".$this->webroot.'setors/add'."'>Setores</a>");}

		if(!empty($acesso['tipocursos'])){echo("<a href='".$this->webroot.'tipocursos/add'."'>Tipos de Cursos</a>");}
		if(!empty($acesso['unidades'])){echo("<a href='".$this->webroot.'unidades/add'."'>Unidades</a>");}
		echo("</div>");
		echo("<span class='qmdivider qmdividerx'></span> <span class='qmtitle'>Consultas</span>");

		if(!empty($acesso['logs'])){echo("<a href='".$this->webroot.'logs'."'>Auditoria</a>");}
		echo("<span class='qmdivider qmdividerx'></span></div>");
		echo("<span class='qmdivider qmdividery'></span>");
	}
	echo("<span class='qmdivider qmdividery'></span> ");
	echo("<a href='javascript:void(0);'>Efetivo</a>");
	echo("<div><span class='qmdivider qmdividerx'></span> ");        
	echo("<span class='qmtitle'>Controle</span>");

	CadaCons($compara==19,'EAOF',$this->webroot.'zprovas');
	CadaCons(!empty($acesso['afastamentos']),'Afastamento',$this->webroot.'afastamentos');
	CadaCons(!empty($acesso['assinaturas']),'Assinatura',$this->webroot.'assinaturas');
	CadaCons(!empty($acesso['atividades']),'Atividade',$this->webroot.'atividades');
	CadaCons(!empty($acesso['cursos']),'Curso',$this->webroot.'cursos');
	CadaCons(!empty($acesso['exames']),'Exame',$this->webroot.'exames');
	CadaCons(!empty($acesso['habilitacaos']),'Habilitação',$this->webroot.'habilitacaos');
	CadaCons(!empty($acesso['fotos']),'Foto',$this->webroot.'fotos');
	CadaCons(!empty($acesso['grausteoricos']),'Grau teórico',$this->webroot.'grausteoricos');
	CadaCons(!empty($acesso['militars']),'Militar',$this->webroot.'militars');
	CadaCons(!empty($acesso['ferias']),'Férias',$this->webroot.'ferias');
	CadaCons(!empty($acesso['setors']),'Setor',$this->webroot.'setors');
	CadaCons(!empty($acesso['unidades']),'Unidade',$this->webroot.'unidades');
	
	echo("<span class='qmdivider qmdividerx'></span></div>"); 
	if(!empty($acesso['habilitacaos'])||!empty($acesso['parecerestecnicos'])||(!empty($acesso['programadetrabalhos']))
		||(!empty($acesso['inspecaos']))||(!empty($acesso['recomendacaos']))||(!empty($acesso['empreendimentos']))||(!empty($acesso['bcas']))){

		echo("<span class='qmdivider qmdividery'></span> ");
		echo("<a href='javascript:void(0);'>Controles</a>");
		echo("<div><span class='qmdivider qmdividerx'></span> ");
		echo("<a href='javascript:void(0);'>Licenciamento/Habilitação</a>");
		echo("<div> <a href='#'>Processo de Habilitação</a>");
		echo("<div>");
		echo("<a href='{$this->webroot}habilitacaos/add'>Designar Instrutores, Estagiários e membros do Conselho</a>");
		echo("<a href='{$this->webroot}habilitacaos/externoanexod'>1 -> Anexo D</a>");
		echo("<a href='{$this->webroot}habilitacaos/externoanexob'>2 -> Anexo B</a>");
		echo("<a href='{$this->webroot}habilitacaos/externoanexoc'>3 -> Anexo C</a>");
		echo("<a href='{$this->webroot}atas/add'>4 -> ATA</a>");
		echo("<a href='{$this->webroot}habilitacaos/externoanexoa'>5 -> Anexo A</a>");
		echo("<a href='{$this->webroot}habilitacaos/add'>Emitir habilitação</a>");
		echo("</div>");
		echo("<a href='{$this->webroot}habilitacaos/externocontrole'>Controle ATM</a>");
		echo("<a href='#'>Habilitação</a>");
		echo("<div>");

		CadaCons2(!empty($acesso['licencas']),'Licenciamento',$this->webroot.'licencas');
		CadaCons2(!empty($acesso['fotos']),'Foto',$this->webroot.'fotos');
		CadaCons2(!empty($acesso['habilitacaos']),'Habilitação',$this->webroot.'habilitacaos');
		CadaCons2(!empty($acesso['membrosconselhos']),'Conselho Operacional',$this->webroot.'membrosconselhos');
		CadaCons2(!empty($acesso['boletiminternos']),'Boletim Interno',$this->webroot.'boletiminternos');
		CadaCons2(!empty($acesso['atas']),'Atas',$this->webroot.'atas');

		echo("<span class='qmtitle'><a href='{$this->webroot}testeopcandidatos/add'>Avaliações</a></span></div>");
		echo("<a href='#'>Cadastro</a>");
		echo("<div>");

		CadaCons2(!empty($acesso['carimbos']),'Emitentes',$this->webroot.'carimbos');
		CadaCons2(!empty($acesso['setors']),'Setores',$this->webroot.'setors');
		CadaCons2(!empty($acesso['nivel_ingles_fase01s']),'Nível Idiomas - Fase 01',$this->webroot.'nivel_ingles_fase01s');
		CadaCons2(!empty($acesso['nivel_ingles_fase02s']),'Nível Idiomas - Fase 02',$this->webroot.'nivel_ingles_fase02s');
		CadaCons2(!empty($acesso['militars']),'Responsáveis',$this->webroot.'militars');
		CadaCons2(!empty($acesso['qualificacaos']),'Qualificações',$this->webroot.'qualificacaos');
		CadaCons2(!empty($acesso['motivosuspensaos']),'Motivos de Suspensão / Perda',$this->webroot.'motivosuspensaos');
		CadaCons2(!empty($acesso['atividadelicencas']),'Atividades',$this->webroot.'atividadelicencas');
		CadaCons2(!empty($acesso['empresas']),'Empresas',$this->webroot.'empresas');
		CadaCons2(!empty($acesso['setors']),'Setores',$this->webroot.'setors');
		CadaCons2(!empty($acesso['especialidades']),'Especialidades',$this->webroot.'especialidades');
		CadaCons2(!empty($acesso['cargosconselhos']),'Cargos do Conselho',$this->webroot.'cargosconselhos');
		CadaCons2(!empty($acesso['unidades']),'Organizações Militares',$this->webroot.'unidades');
		CadaCons2(!empty($acesso['instituicaoensinos']),'Instituições de Ensino',$this->webroot.'instituicaoensinos');
		CadaCons2(!empty($acesso['postos']),'Postos',$this->webroot.'postos');
		CadaCons2(!empty($acesso['quadros']),'Quadros',$this->webroot.'quadros');
		CadaCons2(!empty($acesso['afastamentos']),'Afastamentos',$this->webroot.'afastamentos');
		CadaCons2(!empty($acesso['escalas']),'Escalas',$this->webroot.'escalas');
		//CadaCons2(!empty($acesso['']),'',$this->webroot.'');

		echo("</div>");
		echo("<a href='{$this->webroot}aditivos'>Relatórios</a> ");
		echo("<a href='#'>Cálculos</a>");
		echo("<div>");
		echo("<a href='{$this->webroot}aditivos/edit'>Necessidades por Escala</a>");
		echo("<a href='{$this->webroot}'></a>");
		echo("</div></div>");

		if(!empty($acesso['testeopprovas'])){
			echo("<a href='javascript:void(0)'>Provas</a>");
			echo("<div>");
			echo("<a href='{$this->webroot}testeopprovas/add'><b>1.</b> Cadastrar Siglas das Provas</a>");
			echo("<a href='{$this->webroot}testeopprovasagendadas/add'><b>2.</b> Cadastrar Agendamento das Provas</a>");
			echo("<a href='{$this->webroot}testeopcandidatos/add'><b>3.</b> Cadastrar Candidatos para as Provas</a>");
			echo("<a href='{$this->webroot}testeopcandidatos/edit'><b>4.</b> Atribuir provas para vários candidatos</a>");
			echo("<a href='{$this->webroot}testeopcandidatos/view'><b>5.</b> Filtrar Dados</a>");
			echo("</div>");
		} 
                
		if(!empty($acesso['livroeletronicos'])){
			CadaCons(true,'Livro Eletrônico',$this->webroot.'livroeletronicos');
			CadaCons(true,'Relatório de Inspeção',$this->webroot.'inspecaos');
			CadaCons(true,'Controle de Horas',$this->webroot.'controlehoras');
		}
		echo("<span class='qmdivider qmdividerx'></span></div>");
               
	} 

	if(!empty($acesso['militarscursoscorrigidos'])||!empty($acesso['militars'])){ 
		echo("<span	class='qmdivider qmdividery'></span> ");
		echo("<a href='javascript:void(0)'>Atualização</a>");
		echo("<div><span class='qmdivider qmdividerx'></span> ");
		echo("<a href='{$this->webroot}aditivos/add'>Sincronismo dos dados</a>");
		CadaCons2(true,'Cursos dos Militares',$this->webroot.'militarscursoscorrigidos');
		CadaCons2(($compara==1)||($compara==4)||($compara==12),'Efetivos das divisões',$this->webroot.'militars/externoedit');
		echo("<span class='qmdivider qmdividerx'></span></div>");

	}

	if((!empty($acesso['escalas']))||(!empty($acesso['escalasmonths']))||(!empty($acesso['turnos']))){
		echo("<span class='qmdivider qmdividery'></span> ");
		echo("<a href='{$this->webroot}escalas/view'>Escala</a> ");
		echo("<div><span class='qmdivider qmdividerx'></span> ");
		echo("<a href='{$this->webroot}escalas/externocalendario'>Calendário do escalado</a> ");
		echo("<a href='{$this->webroot}escalas/view'>Escala</a> ");
		echo("<a href='{$this->webroot}escalas/externoboletim'>Escala para Boletim</a> ");
		echo("<a href='{$this->webroot}escalas/externoquantitativo'>Compensação Orgânica</a> ");
		echo("<a href='{$this->webroot}escalas/externoquantitativo'>Atualização de telefones</a> ");
		echo("<span class='qmdivider qmdividerx'></span></div>");
	}
        
        
	if((!empty($acesso['cursos']))||(!empty($acesso['paeats']))||(!empty($acesso['indicadoscursos']))||(!empty($acesso['cursos_setors']))||(!empty($acesso['cursoativos']))||(!empty($acesso['militars_cursos']))||(!empty($acesso['especialidades_setors']))){ 
                echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>Curso</a><div>");
		if((!empty($acesso['cursos']))||(!empty($acesso['militars_cursos']))||(!empty($acesso['especialidades_setors']))){
			echo("<span class='qmdivider qmdividerx'></span><span class='qmtitle'>Cadastro</span>");
			CadaCons(!empty($acesso['cursos']),'Curso',$this->webroot.'cursos');
			CadaCons(!empty($acesso['militars_cursos']),'Militar x Curso',$this->webroot.'militars_cursos',1);
			CadaCons(!empty($acesso['especialidades_setors']),'Capacitação Setor x Curso',$this->webroot.'especialidades_setors',1);
		} 
		echo("<span class='qmdivider qmdividerx'></span>");
		echo("<span class='qmtitle'>Planejamento</span>");
			echo("<a href='{$this->webroot}necessidades/add'>Fichas para proposta PAEAT</a>");
		CadaCons(!empty($acesso['cursoativos']),'Mapear PAEAT/EXTRA/PACESP',$this->webroot.'cursoativos');
		if(!empty($acesso['cursos_setors'])){
			echo("<a href={$this->webroot}cursos_setors'>Status atual</a>");
		} 
		CadaCons(!empty($acesso['indicadoscursos']),'Planejamento',$this->webroot.'indicadoscursos',1,'Planejar');

		if((!empty($acesso['necessidades']))){
			echo("<span class='qmdivider qmdividerx'></span>");
			echo("<span class='qmtitle'>Relatórios</span>");
			echo("<a href='{$this->webroot}testeopprovas/view'>Provas Teste Operacional</a>");
			echo("<a href='javascript:void(0);'></a> ");

		}
        }
         
       

             

                

*/
	if(($compara==1)||($compara==4)||($compara==12)){
            
		echo("<a href='javascript:void(0)'>Administrador</a>");
		echo("<div><span class='qmdivider qmdividerx'></span> ");
		echo("<span class='qmtitle'>Cadastros</span>");
		if(($compara==12)||($compara==1)||($compara==3)||($compara==4)){
			echo("<a href='".$this->webroot.'escalas/add'."'>Escalas</a>");
		}
		if(!empty($acesso['usuarios'])&&!empty($acesso['privilegios'])&&!empty($acesso['tabelas'])
			&&!empty($acesso['setors_usuarios'])&&!empty($acesso['privilegios_usuarios'])&&!empty($acesso['privilegios_tabelas'])){ 
			echo("<a href='".$this->webroot.'usuarios/add'."'>Usuários</a>");
		} 
		echo("<a href='javascript:void(0);'>Parâmetros</a>");
		echo("<div>");
		echo("<span class='qmtitle'>");
		//echo("<a href='".$this->webroot.'paises/externoadd'."'>Corrige Latin1 para UTF8</a>");
		echo("</span>");
		if(!empty($acesso['paises'])){echo("<a href='".$this->webroot.'paises'."'>País</a>");}
		if(!empty($acesso['estados'])){echo("<a href='".$this->webroot.'estados'."'>Estado</a>");}
		if(!empty($acesso['cidades'])){echo("<a href='".$this->webroot.'cidades'."'>Cidade</a>");}
		if(!empty($acesso['especialidades'])){echo("<a href='".$this->webroot.'especialidades/'."'>Especialidades</a>");}
//		if(!empty($acesso['localidades'])){echo("<a href='".$this->webroot.'localidades/add'."'>Localidades</a>");}
		//if(!empty($acesso['postos'])){echo("<a href='".$this->webroot.'postos'."'>Posto</a>");}
		if(!empty($acesso['quadros'])){echo("<a href='".$this->webroot.'quadros'."'>Quadros</a>");}
		if(!empty($acesso['unidades'])){echo("<a href='".$this->webroot.'unidades'."'>Unidades</a>");}
		if(!empty($acesso['setors'])){echo("<a href='".$this->webroot.'setors'."'>Setores</a>");}
//		if(!empty($acesso['setoresassociados'])){echo("<a href='".$this->webroot.'setoresassociados/add'."'>Órgão e setores associados</a>");}
		if(!empty($acesso['tipocursos'])){echo("<a href='".$this->webroot.'tipocursos/add'."'>Tipos de Cursos</a>");}
		echo("</div>");
		echo("<span class='qmdivider qmdividerx'></span> <span class='qmtitle'>Consultas</span>");

		if(!empty($acesso['logs'])){echo("<a href='".$this->webroot.'logs'."'>Auditoria</a>");}
		echo("<span class='qmdivider qmdividerx'></span></div>");
	}        
        
   

        
        
		echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>Efetivo</a><div> ");
        	echo("<span class='qmdivider qmdividerx'></span>");
        	echo("<span class='qmtitle'>Controle</span>");
                
        

	CadaCons($compara==19,'EAOF',$this->webroot.'zprovas');
	CadaCons(!empty($acesso['afastamentos']),'Afastamento',$this->webroot.'afastamentos');
	CadaCons(!empty($acesso['assinaturas']),'Assinatura',$this->webroot.'assinaturas');
	CadaCons(!empty($acesso['atividades']),'Atividade',$this->webroot.'atividades');
	CadaCons(!empty($acesso['cursos']),'Curso',$this->webroot.'cursos');
	CadaCons(!empty($acesso['exames']),'Exame',$this->webroot.'exames');
	CadaCons(!empty($acesso['habilitacaos']),'Habilitação',$this->webroot.'habilitacaos');
	CadaCons(!empty($acesso['fotos']),'Foto',$this->webroot.'fotos');
	CadaCons(!empty($acesso['grausteoricos']),'Grau teórico',$this->webroot.'grausteoricos');
	CadaCons(!empty($acesso['militars']),'Militar',$this->webroot.'militars');
	CadaCons(!empty($acesso['ferias']),'Férias',$this->webroot.'ferias');
	CadaCons(!empty($acesso['setors']),'Setor',$this->webroot.'setors');
	CadaCons(!empty($acesso['unidades']),'Unidade',$this->webroot.'unidades');      
        
                   echo("<span class='qmdivider qmdividerx'></span></div>");
     
        
		echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>Senha</a><div> ");
        	echo("<span class='qmdivider qmdividerx'></span>");
        	echo("<a href='".$this->webroot.'usuarios/edit/'.$u[0]['Usuario']['id']."'>Modificar</a>");
                echo("<span class='qmdivider qmdividerx'></span></div>");

        
	if((!empty($acesso['escalas']))||(!empty($acesso['escalasmonths']))||(!empty($acesso['turnos']))){
		echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>Escala</a><div> ");
        	echo("<span class='qmdivider qmdividerx'></span>");
		echo("<a href='{$this->webroot}escalas/externocalendario'>Calendário do escalado</a> ");
		echo("<a href='{$this->webroot}escalas/view'>Escala</a> ");
		echo("<a href='{$this->webroot}escalas/externoboletim'>Escala para Boletim</a> ");
		echo("<a href='{$this->webroot}escalas/externoquantitativo'>Quantitativo de Etapas por ano</a> ");
		echo("<a href='{$this->webroot}compensacaos/add'>Compensação Orgânica</a> ");
		echo("<a href='{$this->webroot}telefones/add'>Atualização dos telefones</a> ");
                echo("<span class='qmdivider qmdividerx'></span></div>");
	}  
                 
        
                        echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>PAEAT</a><div>");
			echo("<span class='qmdivider qmdividerx'></span>");
		if(!empty($acesso['paeats'])){
			echo("<a href='{$this->webroot}paeats'>Indicar Militares</a>");
			echo("<a href='{$this->webroot}necessidades/add'>Fichas para proposta PAEAT</a>");
		}  
//			if(!empty($acesso['paeatsindicados'])){
				echo("<a href='{$this->webroot}paeatsindicados/externoconsulta'>Consultar Indicação de Curso</a>");
//			}
                        echo("<span class='qmdivider qmdividerx'></span></div>");
		if(!empty($acesso['testeopprovas'])){
                        echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>Provas</a><div>");
			echo("<span class='qmdivider qmdividerx'></span>");
			echo("<a href='{$this->webroot}testeopprovas/add'><b>1.</b> Cadastrar Siglas das Provas</a>");
			echo("<a href='{$this->webroot}testeopprovasagendadas/add'><b>2.</b> Cadastrar Agendamento das Provas</a>");
			echo("<a href='{$this->webroot}testeopcandidatos/add'><b>3.</b> Cadastrar Candidatos para as Provas</a>");
			echo("<a href='{$this->webroot}testeopcandidatos/edit'><b>4.</b> Atribuir provas para vários candidatos</a>");
			echo("<a href='{$this->webroot}testeopcandidatos/view'><b>5.</b> Filtrar Dados</a>");
			echo("<span class='qmdivider qmdividerx'></span></div>");
		}                 
                
	if(($compara==1)||($compara==4)||($compara==12)){
                
//		if(!empty($acesso['habilitacaos'])){
            /*
                        echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>Habilitações</a><div>");
			echo("<span class='qmdivider qmdividerx'></span>");
			echo("<a href='{$this->webroot}licencas/add'><b>1.</b> Cadastrar Licenças</a>");
			echo("<a href='{$this->webroot}habilitacaos/add'><b>2.</b> Cadastrar Habilitações</a>");
			echo("<a href='{$this->webroot}nivel_ingles_fase01s/'><b>3.</b> Consultar Nível de Inglês Fase 01</a>");
			echo("<a href='{$this->webroot}nivel_ingles_fase02s/'><b>4.</b> Consultar Nível de Inglês Fase 02</a>");
			echo("<span class='qmdivider qmdividerx'></span>");
                        
                        echo("<a href='javascript:void(0)'>Parâmetros</a>");
                        echo("<div>");
			echo("<a href='{$this->webroot}carimbos/add'> Cadastar Emitentes </a>");
			echo("<a href='{$this->webroot}setors/add'> Cadastar Setores </a>");
			echo("<a href='{$this->webroot}militars/add'> Cadastar Efetivo </a>");
			echo("<a href='{$this->webroot}qualificacaos/add'> Cadastar Qualificação </a>");
			echo("<a href='{$this->webroot}motivossuspensaos/add'> Cadastar Motivo para Suspensão/Perda </a>");
			echo("<a href='{$this->webroot}atividades/add'> Cadastar Empresas </a>");
			echo("<a href='{$this->webroot}especialidades/add'> Cadastar Especialidades </a>");
			echo("<a href='{$this->webroot}cargosconselhos/add'> Cadastar Cargos do Conselho </a>");
			echo("<a href='{$this->webroot}unidades/add'> Cadastar Organizações Civis/Militares </a>");
			echo("<a href='{$this->webroot}instituicaoensinos/add'> Cadastar Instituições de Ensino </a>");
			echo("<a href='{$this->webroot}postos/add'> Cadastar Postos </a>");
			echo("<a href='{$this->webroot}quadros/add'> Cadastar Quadros </a>");
                        echo("</div>");
                        
    			echo("<span class='qmdivider qmdividerx'></span>");
                    echo("</div>");                        
*/
//                }
                        echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>EPTA</a><div>");
			echo("<span class='qmdivider qmdividerx'></span>");
			echo("<a href='{$this->webroot}epta_eptas/add'><b>1.</b> Cadastrar EPTA</a>");
			echo("<a href='{$this->webroot}epta_eptas/add'><b>2.</b> Consultar EPTA</a>");
			echo("<a href='{$this->webroot}base_indic_locs/add'><b>3.</b> Cadastrar Indicativos de Localidades</a>");
			echo("<span class='qmdivider qmdividerx'></span></div>");
                
                        echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>Inspeções / BCA</a><div>");
			echo("<span class='qmdivider qmdividerx'></span>");
			echo("<a href='{$this->webroot}inspecaos'>Inspeções</a>");
			echo("<a href='{$this->webroot}bcas'>BCAs</a>");
			echo("<span class='qmdivider qmdividerx'></span></div>");

                        echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>Sincronismo / Cálculo ATM</a><div>");
			echo("<span class='qmdivider qmdividerx'></span>");
			echo("<a href='{$this->webroot}aditivos/add'>Sincronismo</a>");
			echo("<a href='{$this->webroot}aditivos/edit'>Cálculo ATM</a>");
			echo("<span class='qmdivider qmdividerx'></span></div>");

            echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>LPNA</a><div>");
			echo("<span class='qmdivider qmdividerx'></span>");
			echo("<a href='{$this->webroot}aditivos/externolpna'>Consulta dados cadastrais</a>");
			echo("<span class='qmdivider qmdividerx'></span></div>");

			
			if($compara==1){
				echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>Orçamento</a><div>");
				echo("<span class='qmdivider qmdividerx'></span>");
				echo("<a href='{$this->webroot}orcamento/controller_planejado.php?d=35A62A8C-903E-86BA-C6D4-0F0DBC9325C7&i=planejado&acao=list'><b>1.</b> Cadastrar Planejado</a>");
				echo("<span class='qmdivider qmdividerx'></span></div>");
			}
				
//		if(!empty($acesso['aditivos'])){
//		}                 
        }
        /*
                        echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>Excluídos</a><div>");
			echo("<span class='qmdivider qmdividerx'></span>");
			echo("<a href='{$this->webroot}aditivos/'><b>1.</b> Relatórios</a>");
			echo("<a href='{$this->webroot}aditivos/externograficos'><b>2.</b> Gráficos X4000</a>");
			echo("<a href='{$this->webroot}aditivos/externodownload'><b>3.</b> Download dados X4000</a>");
			echo("<span class='qmdivider qmdividerx'></span></div>");


                        echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>Reunião SDOP</a><div>");
			echo("<span class='qmdivider qmdividerx'></span>");
			echo("<a href='{$this->webroot}habilitacaos/externocontrole'><b>1.</b> Ficha Cadastral</a>");
			echo("<a href='{$this->webroot}habilitacaos/externoanexoa'><b>2.</b> Anexo A</a>");
			echo("<a href='{$this->webroot}habilitacaos/externoanexob'><b>3.</b> Anexo B</a>");
			echo("<a href='{$this->webroot}habilitacaos/externoanexoc'><b>4.</b> Anexo C</a>");
			echo("<a href='{$this->webroot}habilitacaos/externoanexod'><b>5.</b> Anexo D</a>");
			echo("<a href='{$this->webroot}estagios/'><b>6.</b> Estágios</a>");
			echo("<a href='{$this->webroot}controlehoras/'><b>7.</b> Controle de horas</a>");
			echo("<a href='{$this->webroot}aditivos/externofaltas'><b>8.</b> Controle de Presença</a>");
			echo("<span class='qmdivider qmdividerx'></span></div>");
                        
          */   
        //print_r($u);
?>
                
<span class="qmdivider qmdividery"></span><a href="javascript:void(0);"><?php echo $html->link('SAIR',array('controller'=>'usuarios','action'=>'logout'))."\n"; ?></a><span class="qmclear"></span>
</div>

<div id='direita' style="float: left; font-size: 1px; width: 6px; height: 34px; background-image: url(<?php echo $this->webroot; ?>webroot/css/qmimages/right_cap_blue.gif);"></div> 
<div style="color: rgb(153, 153, 153); font-size: 0.7em; margin: 0px; float: right; position: relative; width: 260px; line-height: 0px; padding: 6px 0px 0px;" id="privilegio"><?php  if($u[0][0]['nome']!=''){  echo $u[0][0]['nome'];} ?>&nbsp;<?php echo $form->create('Usuario',array('action'=>'loginMuda'));?>
<input type='hidden' id='UsuarioMilitarId' class='formulario' name='data[Usuario][militar_id]' value='<?php echo $u[0]['Usuario']['militar_id']; ?>'>
<select id='UsuarioPrivilegioId' class='formulario' name='data[Usuario][privilegio_id]' onchange="$('UsuarioLoginMudaForm').submit();">
<?php 
foreach($u['ModificaPerfil'] as $v1=>$v2):
foreach($v2 as $v3=>$v4):
?>
<option  value='<?php echo $v3; ?>'><?php echo $v4; ?></option>
<?php endforeach; ?>
<?php endforeach; ?>
<option selected='selected' value='<?php echo $u[0]['Usuario']['privilegio_id']; ?>'/><?php echo $u[0]['Privilegio']['descricao'];?>
</select>
<input type="text" readonly="readonly" id="timeid" class='formulario'  value="60:00" size="4">
<?php echo $form->end();?>
</div>


</div>
<?php
} ?>
        <!-- containerMenuPrivado e containerMenuPrivadoInterno -->
<script type='text/javascript'>qm_create(0,false,0,500,false,false,false,false,false);</script>

<?php if(strlen($this->Session->flash())>5){ ?>
<div id='flashMsg' onclick="HideContent('flashMsg');$('flashMsg').fire('flashMsg:fechada', {mensagemId:0});"><a style='float: right; margin: 0px;'		onclick="HideContent('flashMsg');$('flashMsg').fire('flashMsg:fechada', {mensagemId:0});"	><img border='0' width='15'	height='15' title='Excluir' alt='Excluir'	src='<?php echo $this->webroot; ?>img/lixo.gif' /> </a>
<?php  
echo $this->Session->flash();
$this->Session->delete('Message.flash');
//echo $session->flash();
//echo $mensagem;
?>
</div>
<?php } ?>

<div id='spinner'
	style='background-color: #FFFFFF; display: none; z-index: 1030; position: fixed; top: 30%; left: 30%; float: center; border-top-width: thin; border-right-width: thin; border-bottom-width: thin; border-left-width: thin; border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: #000000; border-right-color: #000000; border-bottom-color: #000000; border-left-color: #000000;'><?php echo $this->Html->image('spinner.gif',array('width'=>15,'height'=>15)).' Carregando ...'; ?>
</div>

<br>
<br>
<br>
<?php

if(($this->name!='Usuarios')&&($bca==1)){
?>
<div style='display: none;top:10%;left:20%; position: absolute; border-style: solid;z-index: 1000; background-color: white; padding: 0px; width: 700px; border: 2px solid rgb(0, 0, 0);' id='leituraBCA' class='fixed'>
<p	style='background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;'>
<b>EXTRATOS BCA DISPONÍVEIS</b><a style='float: right; margin: 0px;' id='fechar'
	href="javascript:HideContent('leituraBCA')"><img border='0'
	width='15' height='15' title='Excluir' alt='Excluir'
	src='<?php echo $this->webroot; ?>img/lixo.gif' /> </a></p>
<div id='conteudoBCA'>
</div>
<script type='text/javascript'>
<!--
new Draggable('leituraBCA');
ShowContent('leituraBCA');
//-->
</script></div>
<script type='text/javascript'>
function listaBCA() {
new Ajax.Request('<?php echo $this->webroot; ?>bcas/externobca/<?php echo $u[0]['Usuario']['militar_id']; ?>', {
			method: 'get',
			onSuccess: function(transport) {
			var resultado = transport.responseText.evalJSON(true);
    		 if (resultado.total==0){
    		 	HideContent('leituraBCA');
			}else{
			 	$('conteudoBCA').innerHTML = unescape(resultado.mensagem);
			}
		}
	});
}

listaBCA();
</script>
<script type='text/javascript'>
function despachaBCA(form) {
var dados = Form.serialize($(form));
new Ajax.Request('<?php echo $this->webroot; ?>bcas/externodespacho/', {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {
			var resultado = transport.responseText.evalJSON(true);
    		 if (resultado.ok==0){
			 	$('alertaSistema').innerHTML = '<p>Registro não atualizado!</p>';
			 	ShowContent('mensagem');
			}else{
			 	$('alertaSistema').innerHTML = '<p>Registro atualizado!</p>';
			 	ShowContent('mensagem');
			 	$('conteudoBCA').innerHTML = unescape(resultado.mensagem);
			 	if (resultado.qtd==0){
    		 	HideContent('leituraBCA');
    		 	}
			}
		}
	});
}
</script>
<?php
}
?>
<div style='display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0); z-index: 1000' id='mensagem'>
<div id='alertaSistemaTitulo'><p style='background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;'>MENSAGEM DO SISTEMA<a style='float: right; margin: 0px;'		onclick="HideContent('mensagem');$('mensagem').fire('mensagem:fechada', {mensagemId:0});"	><img border='0' width='15'	height='15' title='Excluir' alt='Excluir'	src='<?php echo $this->webroot; ?>img/lixo.gif' /> </a></p></div>

<div id='alertaSistema'><p	style='margin: 0px; background-color: #ffff00; border: 1px solid #000;'></p></div>
<script type='text/javascript'>
<!--
new Draggable('mensagem');
//-->
</script>
</div>

<script type='text/javascript'>
$('mensagem').hide();
$('mensagem').fire('mensagem:fechada', {mensagemId:1});
HideContent('mensagem');
window.setTimeout(function() {
 window.location.href = '<?php echo $this->webroot; ?>usuarios/logout';
 }, 3600000);

var tempocalculado = 1000*60*60; // 1hora

function mudaValor(){
  tempocalculado = tempocalculado - 10000;
 if($('timeid')!=null){  
    $('timeid').value= Math.floor((tempocalculado)/60000) + ':' + ((tempocalculado)%60000)/1000;
 }
}
var idTime = window.setInterval(mudaValor, 10000);

</script>
<div id='wrapper' style='float: center;'><?php echo $content_for_layout;  ?></div>
</body>
</html>
