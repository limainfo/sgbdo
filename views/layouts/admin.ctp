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

$menu =1;

if($this->params['controller']=='assinaturas'){
    echo $this->Html->script(array('jquery','jquery.jqscribble','jqscribble.extrabrushes'));
    $menu =0;
    
//}if($this->params['controller']=='avisos'){
}else{
    echo $this->Html->script(array('prototype','tinymce/tinymce.min','scriptaculous.js?load=effects,dragdrop,controls'));
}

//echo $this->Html->script(array('jquery'));
//echo $this->Html->script('transport.js');
echo $this->Html->css("dialog.2.0")."\n";
echo $this->Html->script('dialog.2.0')."\n";
echo $this->Html->script('common.js');
echo $this->Html->css(array("admin"))."\n";
echo $this->Html->css("menu_gerente")."\n";
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
if(($this->params['controller']=='avisos')&&($this->params['action']=='add')){
    echo $this->Html->script(array('prototype','tinymce/tinymce.min','scriptaculous.js?load=effects,dragdrop,controls'));
}
if(($this->params['controller']=='avisos')&&($this->params['action']=='edit')){
    echo $this->Html->script(array('prototype','tinymce/tinymce.min','scriptaculous.js?load=effects,dragdrop,controls'));
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
//-->
</script>
</head>
<body onLoad="//new Effect.Fade('flashMsg',{delay: 50});">
<script language="javascript">
var x=screen.height;
var y=screen.width;
</script>

        
<?php
if(!empty($u[0]['Usuario']['privilegio_id'])){	
?>

<div id="tophead"><?php echo $html->image('dacta.gif',array('style'=>'float:left;align:top;padding:3px;')); ?>
<!---<div id='esquerda' 	style="float: left; font-size: 1px; width: 6px; height: 34px; background-image: url(<?php echo $this->webroot; ?>webroot/css/qmimages/left_cap_blue.gif);">
</div> --->
<div id="qm0" class="qmmc" style="float: left; height: 34px; background-image: url(<?php echo $this->webroot; ?>webroot/css/qmimages/center_tile_blue.gif); background-repeat: repeat-x;">        
    
    <?php
    //print_r($u);
if($menu){
   
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
			echo("<a href='".$this->webroot.'usuarios/add'."'>Usu??rios</a>");
		} 
		echo("<a href='javascript:void(0);'>Par??metros</a>");
		echo("<div>");
		echo("<span class='qmtitle'>");
		echo("<a href='".$this->webroot.'paises/externoadd'."'>Corrige Latin1 para UTF8</a>");
		if(!empty($acesso['paises'])){echo("<a href='".$this->webroot.'paises'."'>Pa??s</a>");}
		if(!empty($acesso['estados'])){echo("<a href='".$this->webroot.'estados'."'>Estado</a>");}
		if(!empty($acesso['cidades'])){echo("<a href='".$this->webroot.'cidades'."'>Cidade</a>");}
		if(!empty($acesso['postos'])){echo("<a href='".$this->webroot.'postos'."'>Posto</a>");}
		echo("</span>");
		if(!empty($acesso['equipamentos'])){echo("<a href='".$this->webroot.'equipamentos/add'."'>Equipamentos</a>");}
		if(!empty($acesso['especialidades'])){echo("<a href='".$this->webroot.'especialidades/add'."'>Especialidades</a>");}
		if(!empty($acesso['localidades'])){echo("<a href='".$this->webroot.'localidades/add'."'>Localidades</a>");}
		if(!empty($acesso['quadros'])){echo("<a href='".$this->webroot.'quadros/add'."'>Quadros</a>");}
		if(!empty($acesso['setoresassociados'])){echo("<a href='".$this->webroot.'setoresassociados/add'."'>??rg??o e setores associados</a>");}
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
	CadaCons(!empty($acesso['habilitacaos']),'Habilita????o',$this->webroot.'habilitacaos');
	CadaCons(!empty($acesso['fotos']),'Foto',$this->webroot.'fotos');
	CadaCons(!empty($acesso['grausteoricos']),'Grau te??rico',$this->webroot.'grausteoricos');
	CadaCons(!empty($acesso['militars']),'Militar',$this->webroot.'militars');
	CadaCons(!empty($acesso['ferias']),'F??rias',$this->webroot.'ferias');
	CadaCons(!empty($acesso['setors']),'Setor',$this->webroot.'setors');
	CadaCons(!empty($acesso['unidades']),'Unidade',$this->webroot.'unidades');
	
	echo("<span class='qmdivider qmdividerx'></span></div>"); 
	if(!empty($acesso['habilitacaos'])||!empty($acesso['parecerestecnicos'])||(!empty($acesso['programadetrabalhos']))
		||(!empty($acesso['inspecaos']))||(!empty($acesso['recomendacaos']))||(!empty($acesso['empreendimentos']))||(!empty($acesso['bcas']))){

		echo("<span class='qmdivider qmdividery'></span> ");
		echo("<a href='javascript:void(0);'>Controles</a>");
		echo("<div><span class='qmdivider qmdividerx'></span> ");
		echo("<a href='javascript:void(0);'>Licenciamento/Habilita????o</a>");
		echo("<div> <a href='#'>Processo de Habilita????o</a>");
		echo("<div>");
		echo("<a href='{$this->webroot}habilitacaos/add'>Designar Instrutores, Estagi??rios e membros do Conselho</a>");
		echo("<a href='{$this->webroot}habilitacaos/externoanexod'>1 -> Anexo D</a>");
		echo("<a href='{$this->webroot}habilitacaos/externoanexob'>2 -> Anexo B</a>");
		echo("<a href='{$this->webroot}habilitacaos/externoanexoc'>3 -> Anexo C</a>");
		echo("<a href='{$this->webroot}atas/add'>4 -> ATA</a>");
		echo("<a href='{$this->webroot}habilitacaos/externoanexoa'>5 -> Anexo A</a>");
		echo("<a href='{$this->webroot}habilitacaos/add'>Emitir habilita????o</a>");
		echo("</div>");
		echo("<a href='{$this->webroot}habilitacaos/externocontrole'>Controle ATM</a>");
		echo("<a href='#'>Habilita????o</a>");
		echo("<div>");

		CadaCons2(!empty($acesso['licencas']),'Licenciamento',$this->webroot.'licencas');
		CadaCons2(!empty($acesso['fotos']),'Foto',$this->webroot.'fotos');
		CadaCons2(!empty($acesso['habilitacaos']),'Habilita????o',$this->webroot.'habilitacaos');
		CadaCons2(!empty($acesso['membrosconselhos']),'Conselho Operacional',$this->webroot.'membrosconselhos');
		CadaCons2(!empty($acesso['boletiminternos']),'Boletim Interno',$this->webroot.'boletiminternos');
		CadaCons2(!empty($acesso['atas']),'Atas',$this->webroot.'atas');

		echo("<span class='qmtitle'><a href='{$this->webroot}testeopcandidatos/add'>Avalia????es</a></span></div>");
		echo("<a href='#'>Cadastro</a>");
		echo("<div>");

		CadaCons2(!empty($acesso['carimbos']),'Emitentes',$this->webroot.'carimbos');
		CadaCons2(!empty($acesso['setors']),'Setores',$this->webroot.'setors');
		CadaCons2(!empty($acesso['nivel_ingles_fase01s']),'N??vel Idiomas - Fase 01',$this->webroot.'nivel_ingles_fase01s');
		CadaCons2(!empty($acesso['nivel_ingles_fase02s']),'N??vel Idiomas - Fase 02',$this->webroot.'nivel_ingles_fase02s');
		CadaCons2(!empty($acesso['militars']),'Respons??veis',$this->webroot.'militars');
		CadaCons2(!empty($acesso['qualificacaos']),'Qualifica????es',$this->webroot.'qualificacaos');
		CadaCons2(!empty($acesso['motivosuspensaos']),'Motivos de Suspens??o / Perda',$this->webroot.'motivosuspensaos');
		CadaCons2(!empty($acesso['atividadelicencas']),'Atividades',$this->webroot.'atividadelicencas');
		CadaCons2(!empty($acesso['empresas']),'Empresas',$this->webroot.'empresas');
		CadaCons2(!empty($acesso['setors']),'Setores',$this->webroot.'setors');
		CadaCons2(!empty($acesso['especialidades']),'Especialidades',$this->webroot.'especialidades');
		CadaCons2(!empty($acesso['cargosconselhos']),'Cargos do Conselho',$this->webroot.'cargosconselhos');
		CadaCons2(!empty($acesso['unidades']),'Organiza????es Militares',$this->webroot.'unidades');
		CadaCons2(!empty($acesso['instituicaoensinos']),'Institui????es de Ensino',$this->webroot.'instituicaoensinos');
		CadaCons2(!empty($acesso['postos']),'Postos',$this->webroot.'postos');
		CadaCons2(!empty($acesso['quadros']),'Quadros',$this->webroot.'quadros');
		CadaCons2(!empty($acesso['afastamentos']),'Afastamentos',$this->webroot.'afastamentos');
		CadaCons2(!empty($acesso['escalas']),'Escalas',$this->webroot.'escalas');
		//CadaCons2(!empty($acesso['']),'',$this->webroot.'');

		echo("</div>");
		echo("<a href='{$this->webroot}aditivos'>Relat??rios</a> ");
		echo("<a href='#'>C??lculos</a>");
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
			echo("<a href='{$this->webroot}testeopcandidatos/edit'><b>4.</b> Atribuir provas para v??rios candidatos</a>");
			echo("<a href='{$this->webroot}testeopcandidatos/view'><b>5.</b> Filtrar Dados</a>");
			echo("</div>");
		} 
                
		if(!empty($acesso['livroeletronicos'])){
			CadaCons(true,'Livro Eletr??nico',$this->webroot.'livroeletronicos');
			CadaCons(true,'Relat??rio de Inspe????o',$this->webroot.'inspecaos');
			CadaCons(true,'Controle de Horas',$this->webroot.'controlehoras');
		}
		echo("<span class='qmdivider qmdividerx'></span></div>");
               
	} 

	if(!empty($acesso['militarscursoscorrigidos'])||!empty($acesso['militars'])){ 
		echo("<span	class='qmdivider qmdividery'></span> ");
		echo("<a href='javascript:void(0)'>Atualiza????o</a>");
		echo("<div><span class='qmdivider qmdividerx'></span> ");
		echo("<a href='{$this->webroot}aditivos/add'>Sincronismo dos dados</a>");
		CadaCons2(true,'Cursos dos Militares',$this->webroot.'militarscursoscorrigidos');
		CadaCons2(($compara==1)||($compara==4)||($compara==12),'Efetivos das divis??es',$this->webroot.'militars/externoedit');
		echo("<span class='qmdivider qmdividerx'></span></div>");

	}

	if((!empty($acesso['escalas']))||(!empty($acesso['escalasmonths']))||(!empty($acesso['turnos']))){
		echo("<span class='qmdivider qmdividery'></span> ");
		echo("<a href='{$this->webroot}escalas/view'>Escala</a> ");
		echo("<div><span class='qmdivider qmdividerx'></span> ");
		echo("<a href='{$this->webroot}escalas/externocalendario'>Calend??rio do escalado</a> ");
		echo("<a href='{$this->webroot}escalas/view'>Escala</a> ");
		echo("<a href='{$this->webroot}escalas/externoboletim'>Escala para Boletim</a> ");
		echo("<a href='{$this->webroot}escalas/externoquantitativo'>Compensa????o Org??nica</a> ");
		echo("<a href='{$this->webroot}escalas/externoquantitativo'>Atualiza????o de telefones</a> ");
		echo("<span class='qmdivider qmdividerx'></span></div>");
	}
        
        
	if((!empty($acesso['cursos']))||(!empty($acesso['paeats']))||(!empty($acesso['indicadoscursos']))||(!empty($acesso['cursos_setors']))||(!empty($acesso['cursoativos']))||(!empty($acesso['militars_cursos']))||(!empty($acesso['especialidades_setors']))){ 
                echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>Curso</a><div>");
		if((!empty($acesso['cursos']))||(!empty($acesso['militars_cursos']))||(!empty($acesso['especialidades_setors']))){
			echo("<span class='qmdivider qmdividerx'></span><span class='qmtitle'>Cadastro</span>");
			CadaCons(!empty($acesso['cursos']),'Curso',$this->webroot.'cursos');
			CadaCons(!empty($acesso['militars_cursos']),'Militar x Curso',$this->webroot.'militars_cursos',1);
			CadaCons(!empty($acesso['especialidades_setors']),'Capacita????o Setor x Curso',$this->webroot.'especialidades_setors',1);
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
			echo("<span class='qmtitle'>Relat??rios</span>");
			echo("<a href='{$this->webroot}testeopprovas/view'>Provas Teste Operacional</a>");
			echo("<a href='javascript:void(0);'></a> ");

		}
        }
         
       

             

                

*/
   //     echo '<pre>'.print_r($u,true).'</pre>';
        
 
		echo("<span class='qmdivider qmdividery'></span> ");
		echo("<a href='javascript:void(0)'>Facilidades</a>");
		echo("<div><span class='qmdivider qmdividerx'></span> ");
		//echo("<span class='qmtitle'>Consultas</span>");
		//echo('<a href="javascript:form_buscalbol.submit();"><form name="form_buscalbol" target="_blank" method="post" action="http://sistemas.cindacta4.intraer/buscabol/resultado.php"><input type="hidden" value="'.$u[0]['Militar']['saram'].'" name="saram"></form>Boletim interno</a>');
		//echo("<a href='".$this->webroot.'escalas/externocalendario'."'>calend??rio de escalas</a>");
		//echo("<a href='/classificados' target='_blank'>Classificados</a>");
		//echo("<a href='".$this->webroot.'aditivos/externocontracheque'."' target='_blank'>contracheque</a>");
		//echo("<a href='".$this->webroot.'mapas'."'  target='_blank'>Mapas AIS</a>");
		//echo("<a href='".$this->webroot.'setors'."'>habilita????o</a>");
		//echo("<a href='".$this->webroot.'aditivos/externoindicacoes'."' target='_blank'>indica????es em cursos</a>");
		//echo("<a href='/siop/controller_indicadoresopg.php?d=35A62A8C-903E-86BA-C6D4-0F0DBC9325C7&i=indicadoresopg&acao=gera' target='_blank'>Indicadores OPG</a>");
                
		//echo("<a href='".$this->webroot.'mapas'."'  target='_blank'>NOTAM</a>");
		//echo('<a href="javascript:form_osonix.submit();"><form name="form_osonix" target="_blank" method="post" action="'.$this->webroot.'acompanhamento/processasaram.php"><input type="hidden" value="'.$u[0]['Militar']['saram'].'" name="busca"><input type="hidden" value="saram" name="opcao"></form>OS ONIX e PTA</a>');
		//echo('<a href="javascript:form_pta_2.submit();"><form name="form_pta_2" target="_blank" method="post" action="http://servicos.decea.intraer/passagem/rs.cfm"><input type="hidden" value="'.$u[0]['Militar']['identidade'].'" name="identidade"><input type="hidden" value="" name="email"></form>Passagens DECEA</a>');
		//echo('<a href="javascript:form_pta_1.submit();"><form name="form_pta_1" target="_blank" method="post" action="http://10.32.59.43/cpa_int/cpa_relatorio.asp"><input type="hidden" value="'.$u[0]['Militar']['identidade'].'" name="identidade"></form>Passagens CPA</a>');
		//echo("<a href='/siop/controller_menorcusto.php?d=35A62A8C-903E-86BA-C6D4-0F0DBC9325C7&i=menorcusto&acao=calculo'  target='_blank'>Planilha Comparativa</a>");
		//echo("<span class='qmdivider qmdividerx'></span>");
		echo("<span class='qmtitle'>Atualiza????es</span>");
		//echo("<a href='".$this->webroot.'assinaturas/add'."'>assinatura</a>");
		if(($compara!=5)&&($compara!=6)){
			echo("<a href='".$this->webroot.'militars/edit/'.$u[0]['Usuario']['militar_id']."'>dados pessoais</a>");
		}
		//echo("<a href='".$this->webroot.'fotos/add/'.$u[0]['Usuario']['militar_id']."'>foto</a>");
		echo("<a href='".$this->webroot.'usuarios/edit/'.$u[0]['Usuario']['id']."'>senha</a>");
		echo("<span class='qmdivider qmdividerx'></span></div>");

        if(($compara==1)){
            
		echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>Administrador</a>");
		echo("<div><span class='qmdivider qmdividerx'></span> ");
		echo("<span class='qmtitle'>Cadastros</span>");
		//if(!empty($acesso['avisos'])){echo("<a href='".$this->webroot.'avisos'."'>Avisos</a>");}
		if(!empty($acesso['paises'])){echo("<a href='".$this->webroot.'avisos'."'>Avisos</a>");}
		if(!empty($acesso['paises'])){echo("<a href='".$this->webroot.'paises'."'>Pa??s</a>");}
		if(!empty($acesso['estados'])){echo("<a href='".$this->webroot.'estados'."'>Estado</a>");}
		if(!empty($acesso['cidades'])){echo("<a href='".$this->webroot.'cidades'."'>Cidade</a>");}
		if(!empty($acesso['unidades'])){echo("<a href='".$this->webroot.'unidades'."'>Unidade</a>");}
		if(!empty($acesso['setors'])){echo("<a href='".$this->webroot.'setors'."'>Setor</a>");}
        	//CadaCons(!empty($acesso['unidades']),'Unidade',$this->webroot.'unidades');      
        	//CadaCons(!empty($acesso['setors']),'Setor',$this->webroot.'setors');
		if(!empty($acesso['postos'])){echo("<a href='".$this->webroot.'postos'."'>Posto</a>");}
		if(!empty($acesso['quadros'])){echo("<a href='".$this->webroot.'quadros'."'>Quadros</a>");}
		if(!empty($acesso['especialidades'])){echo("<a href='".$this->webroot.'especialidades/'."'>Especialidades</a>");}
		//if(!empty($acesso['tipocursos'])){echo("<a href='".$this->webroot.'tipocursos/add'."'>Tipos de Cursos</a>");}
		if(!empty($acesso['escalas'])){echo("<a href='".$this->webroot.'escalas/add'."'>Escalas</a>");}
		if(!empty($acesso['usuarios'])&&!empty($acesso['privilegios'])&&!empty($acesso['tabelas'])){echo("<a href='".$this->webroot.'usuarios/add'."'>Usu??rios</a>");}
		//if(!empty($acesso['logs'])){echo("<a href='".$this->webroot.'logs'."'>Auditoria</a>");}
                //CadaCons(!empty($acesso['assinaturas']),'Assinatura',$this->webroot.'assinaturas');
                CadaCons(!empty($acesso['cursos']),'Curso',$this->webroot.'cursos');
		
				
		echo("<span class='qmdivider qmdividerx'></span> <span class='qmtitle'>Consultas</span>");
		//if(!empty($acesso['logs'])){echo("<a href='".$this->webroot.'logs'."'>Auditoria</a>");}
                //CadaCons(!empty($acesso['assinaturas']),'Assinatura',$this->webroot.'assinaturas');
                //CadaCons(!empty($acesso['cursos']),'Curso',$this->webroot.'cursos');
                //CadaCons(!empty($acesso['fotos']),'Foto',$this->webroot.'fotos');
                echo("<a href='{$this->webroot}aditivos/add'>Sincronismo</a>");
                echo("<a href='{$this->webroot}aditivos/edit'>C??lculo ATM</a>");
				if(!empty($acesso['logs'])){echo("<a href='".$this->webroot.'logs'."'>Auditoria</a>");}
				echo("<span class='qmdivider qmdividerx'></span></div>");
                
                
	}        
        
        
	if(($compara==1)||($compara==4)){
            
		echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>Planejamento</a>");
		echo("<div><span class='qmdivider qmdividerx'></span> ");
		echo("<span class='qmtitle'>Cadastros</span>");
		if(!empty($acesso['militars'])){echo("<a href='".$this->webroot.'militars'."'>Militar</a>");}
                //CadaCons(!empty($acesso['militars']),'Militar',$this->webroot.'militars');
                
		if(!empty($acesso['unidades'])){echo("<a href='".$this->webroot.'unidades'."'>Unidades</a>");}
		if(!empty($acesso['setors'])){echo("<a href='".$this->webroot.'setors'."'>Setores</a>");}
		if(!empty($acesso['escalas'])){echo("<a href='".$this->webroot.'escalas/add'."'>Escalas</a>");}
		if(!empty($acesso['usuarios'])&&!empty($acesso['privilegios'])&&!empty($acesso['tabelas'])){echo("<a href='".$this->webroot.'usuarios/add'."'>Usu??rios</a>");}
		echo("<span class='qmdivider qmdividerx'></span> <span class='qmtitle'>Consultas</span>");
		//if(!empty($acesso['logs'])){echo("<a href='".$this->webroot.'logs'."'>Auditoria</a>");}
                if($compara==1){
                       echo("<span class='qmdivider qmdividerx'></span><span class='qmtitle'>Or??amento</span>");
                       echo("<a href='/siop/controller_planejado.php?d=35A62A8C-903E-86BA-C6D4-0F0DBC9325C7&i=planejado&acao=list'><b>1.</b> Cadastrar Planejado</a>");
                }
				/*
			echo("<span class='qmdivider qmdividerx'></span><span class='qmtitle'>EPTA</span>");
			echo("<a href='{$this->webroot}epta_eptas/add'><b>1.</b> Cadastrar EPTA</a>");
			echo("<a href='{$this->webroot}epta_eptas/add'><b>2.</b> Consultar EPTA</a>");
			*/
			echo("<a href='{$this->webroot}base_indic_locs/add'><b>3.</b> Cadastrar Indicativos de Localidades</a>");
                
			//echo("<span class='qmdivider qmdividerx'></span><span class='qmtitle'>Inspe????es / BCA</span>");
			//echo("<a href='{$this->webroot}inspecaos'>Inspe????es</a>");
			//echo("<a href='{$this->webroot}bcas'>BCAs</a>");
		echo("<span class='qmdivider qmdividerx'></span></div>");
	}        

        if(($compara==1)||($compara==4)||($compara==3)){
            
		echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>Chefe Divis??o</a>");
		echo("<div><span class='qmdivider qmdividerx'></span> ");
		echo("<span class='qmtitle'>Cadastros</span>");
		if(!empty($acesso['unidades'])){echo("<a href='".$this->webroot.'unidades'."'>Unidades</a>");}
		if(!empty($acesso['setors'])){echo("<a href='".$this->webroot.'setors'."'>Setores</a>");}
		if(!empty($acesso['escalas'])){echo("<a href='".$this->webroot.'escalas/view'."'>Escalas</a>");}
		if(!empty($acesso['usuarios'])&&!empty($acesso['privilegios'])&&!empty($acesso['tabelas'])){echo("<a href='".$this->webroot.'usuarios/add'."'>Usu??rios</a>");}
		//echo("<span class='qmdivider qmdividerx'></span> <span class='qmtitle'>Consultas</span>");
		//if(!empty($acesso['logs'])){echo("<a href='".$this->webroot.'logs'."'>Auditoria</a>");}
		echo("<span class='qmdivider qmdividerx'></span></div>");
	}        

        if(($compara==1)||($compara==4)||($compara==12)||($compara==3)){
            
		echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>Chefe Regional</a>");
		echo("<div><span class='qmdivider qmdividerx'></span> ");
                echo("<span class='qmtitle'>Controles</span>");
                if((!empty($acesso['escalas']))||(!empty($acesso['escalasmonths']))||(!empty($acesso['turnos']))){
                    //echo("<a href='{$this->webroot}boletiminternos/'>Boletim Interno</a> ");
					if(!empty($acesso['militars'])){echo("<a href='".$this->webroot.'militars'."'>Militar</a>");}
					if(!empty($acesso['setors'])){echo("<a href='".$this->webroot.'setors'."'>Setor</a>");}
                    //echo("<a href='{$this->webroot}atas/'>ATA</a> ");
                    //echo("<a href='{$this->webroot}licencas/'>Licen??as</a> ");
                    echo("<a href='{$this->webroot}necessidades/add'>Necessidades</a> ");
                    echo("<a href='{$this->webroot}escalas/view'>Escalas</a> ");
                    //echo("<a href='{$this->webroot}escalas/externoboletim'>Escala para Boletim</a> ");
                    //echo("<a href='{$this->webroot}escalas/externoquantitativo'>Quantitativo de Etapas por ano</a> ");
					if(($compara!=3)){       echo("<a href='{$this->webroot}compensacaos/add'>Compensa????o Org??nica</a> "); }
                    echo("<a href='{$this->webroot}escalas/externomilitarescala'>Cadastrar legendas/Carga de Trabalho</a> ");
                    echo("<a href='{$this->webroot}escalas/externomilitarlegenda'>Modificar legendas rapidamente</a> ");
                    echo("<a href='{$this->webroot}usuarios/add'>Cadastrar usu??rios</a> ");
                    if(!empty($acesso['paeats'])){
                            echo("<span class='qmtitle'>PAEAT</span>");
                            echo("<a href='{$this->webroot}paeats'>Indicar Militares</a>");
                            echo("<a href='{$this->webroot}necessidades/add'>Fichas para proposta PAEAT</a>");
                    }  
                    //echo("<a href='{$this->webroot}paeatsindicados/externoconsulta'>Consultar Indica????o de Curso</a>");
					/*
                        if(!empty($acesso['testeopprovas'])){
                        echo("<span class='qmdivider qmdividerx'></span><span class='qmtitle'>Provas</span>");
                        echo("<a href='{$this->webroot}testeopprovas/add'><b>1.</b> Cadastrar Siglas das Provas</a>");
                        echo("<a href='{$this->webroot}testeopprovasagendadas/add'><b>2.</b> Cadastrar Agendamento das Provas</a>");
                        echo("<a href='{$this->webroot}testeopcandidatos/add'><b>3.</b> Cadastrar Candidatos para as Provas</a>");
                        echo("<a href='{$this->webroot}testeopcandidatos/edit'><b>4.</b> Atribuir provas para v??rios candidatos</a>");
                        echo("<a href='{$this->webroot}testeopcandidatos/view'><b>5.</b> Filtrar Dados</a>");
                        echo("<span class='qmdivider qmdividerx'></span>");
                        }                 
						*/
						/*
                            echo("<span class='qmdivider qmdividerx'></span><span class='qmtitle'>Chamada</span>");
                            echo("<a href='{$this->webroot}chamadaefetivos/add'><b>1.</b> Cadastrar efetivo</a>");
                            echo("<a href='{$this->webroot}chamadas/add'><b>2.</b> Gerar chamada</a>");
                            echo("<a href='{$this->webroot}chamadas/externocalendario'><b>3.</b> Consultar chamada</a>");
                            echo("<a href='{$this->webroot}chamadas/externocomunicado'><b>4.</b> Incluir comunicado na p??gina inicial</a>");
							*/
						/*
                        echo("<span class='qmdivider qmdividerx'></span>");
                        echo("<span class='qmtitle'>LPNA</span>");
                        echo("<span class='qmdivider qmdividerx'></span>");
                        echo("<a href='{$this->webroot}aditivos/externolpna'>Consulta dados cadastrais</a>");
						*/
                    echo("<span class='qmdivider qmdividerx'></span></div>");
                }  
	}        
        
   
        if(($compara==1)||($compara==4)||($compara==6)||($compara==12)||($compara==3)){
            
		echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>Aprova Escala</a>");
		echo("<div><span class='qmdivider qmdividerx'></span> ");
                    if((!empty($acesso['escalas']))||(!empty($acesso['escalasmonths']))||(!empty($acesso['turnos']))){
        		echo("<span class='qmtitle'>Controles</span>");
                        echo("<a href='{$this->webroot}escalas/view'>Escala - ASSINA</a> ");
                        echo("<a href='{$this->webroot}escalas/externoboletim'>Escala para Boletim</a> ");
                        echo("<span class='qmdivider qmdividerx'></span></div>");
                }  
	}        

        if(($compara==1)||($compara==4)||($compara==5)||($compara==6)||($compara==12)||($compara==3)){
            
		echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>Escalante</a>");
		echo("<div><span class='qmdivider qmdividerx'></span> ");
		echo("<span class='qmtitle'>Cadastros</span>");
                CadaCons(!empty($acesso['afastamentos']),'Afastamento',$this->webroot.'afastamentos');
                CadaCons(!empty($acesso['atividades']),'Atividade',$this->webroot.'atividades');
                //CadaCons(!empty($acesso['exames']),'Exame',$this->webroot.'exames');
                CadaCons(!empty($acesso['habilitacaos']),'Habilita????o',$this->webroot.'habilitacaos');
                //CadaCons(!empty($acesso['grausteoricos']),'Grau te??rico',$this->webroot.'grausteoricos');
                //CadaCons(!empty($acesso['ferias']),'F??rias',$this->webroot.'ferias');
                //echo("<a href='{$this->webroot}pimos/add'>Escala (PIMO)</a> ");

                    if((!empty($acesso['escalas']))||(!empty($acesso['escalasmonths']))||(!empty($acesso['turnos']))){
        		echo("<span class='qmtitle'>Controles</span>");
                        echo("<a href='{$this->webroot}escalas/view'>Escala</a> ");
                        //echo("<a href='{$this->webroot}controlehoras/add'>Controle de horas</a> ");
                        echo("<a href='{$this->webroot}escalas/externoboletim'>Escala para Boletim</a> ");
                        echo("<span class='qmdivider qmdividerx'></span></div>");
                }  
	}        

        
        

	CadaCons($compara==19,'EAOF',$this->webroot.'zprovas');
        
     

        
                 
        

	if(($compara==1)||($compara==4)||($compara==12)){
                
//		if(!empty($acesso['habilitacaos'])){
            /*
                        echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>Habilita????es</a><div>");
			echo("<span class='qmdivider qmdividerx'></span>");
			echo("<a href='{$this->webroot}licencas/add'><b>1.</b> Cadastrar Licen??as</a>");
			echo("<a href='{$this->webroot}habilitacaos/add'><b>2.</b> Cadastrar Habilita????es</a>");
			echo("<a href='{$this->webroot}nivel_ingles_fase01s/'><b>3.</b> Consultar N??vel de Ingl??s Fase 01</a>");
			echo("<a href='{$this->webroot}nivel_ingles_fase02s/'><b>4.</b> Consultar N??vel de Ingl??s Fase 02</a>");
			echo("<span class='qmdivider qmdividerx'></span>");
                        
                        echo("<a href='javascript:void(0)'>Par??metros</a>");
                        echo("<div>");
			echo("<a href='{$this->webroot}carimbos/add'> Cadastar Emitentes </a>");
			echo("<a href='{$this->webroot}setors/add'> Cadastar Setores </a>");
			echo("<a href='{$this->webroot}militars/add'> Cadastar Efetivo </a>");
			echo("<a href='{$this->webroot}qualificacaos/add'> Cadastar Qualifica????o </a>");
			echo("<a href='{$this->webroot}motivossuspensaos/add'> Cadastar Motivo para Suspens??o/Perda </a>");
			echo("<a href='{$this->webroot}atividades/add'> Cadastar Empresas </a>");
			echo("<a href='{$this->webroot}especialidades/add'> Cadastar Especialidades </a>");
			echo("<a href='{$this->webroot}cargosconselhos/add'> Cadastar Cargos do Conselho </a>");
			echo("<a href='{$this->webroot}unidades/add'> Cadastar Organiza????es Civis/Militares </a>");
			echo("<a href='{$this->webroot}instituicaoensinos/add'> Cadastar Institui????es de Ensino </a>");
			echo("<a href='{$this->webroot}postos/add'> Cadastar Postos </a>");
			echo("<a href='{$this->webroot}quadros/add'> Cadastar Quadros </a>");
                        echo("</div>");
                        
    			echo("<span class='qmdivider qmdividerx'></span>");
                    echo("</div>");                        
*/
//                }

                        
//		if(!empty($acesso['aditivos'])){
//		}                 
        }
 
        /*
                        echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>Exclu??dos</a><div>");
			echo("<span class='qmdivider qmdividerx'></span>");
			echo("<a href='{$this->webroot}aditivos/'><b>1.</b> Relat??rios</a>");
			echo("<a href='{$this->webroot}aditivos/externograficos'><b>2.</b> Gr??ficos X4000</a>");
			echo("<a href='{$this->webroot}aditivos/externodownload'><b>3.</b> Download dados X4000</a>");
			echo("<span class='qmdivider qmdividerx'></span></div>");


                        echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>Reuni??o SDOP</a><div>");
			echo("<span class='qmdivider qmdividerx'></span>");
			echo("<a href='{$this->webroot}habilitacaos/externocontrole'><b>1.</b> Ficha Cadastral</a>");
			echo("<a href='{$this->webroot}habilitacaos/externoanexoa'><b>2.</b> Anexo A</a>");
			echo("<a href='{$this->webroot}habilitacaos/externoanexob'><b>3.</b> Anexo B</a>");
			echo("<a href='{$this->webroot}habilitacaos/externoanexoc'><b>4.</b> Anexo C</a>");
			echo("<a href='{$this->webroot}habilitacaos/externoanexod'><b>5.</b> Anexo D</a>");
			echo("<a href='{$this->webroot}estagios/'><b>6.</b> Est??gios</a>");
			echo("<a href='{$this->webroot}controlehoras/'><b>7.</b> Controle de horas</a>");
			echo("<a href='{$this->webroot}aditivos/externofaltas'><b>8.</b> Controle de Presen??a</a>");
			echo("<span class='qmdivider qmdividerx'></span></div>");
                        
          */   
        //print_r($u);
}                
?>
    <span class="qmdivider qmdividery"></span><a href="javascript:void(0);">SAIR</a><div><span class='qmdivider qmdividerx'></span><?php echo $html->link('LOGOUT',array('controller'=>'usuarios','action'=>'logout'))."\n"; ?><span class='qmdivider qmdividerx'></span></div><span class='qmdivider qmdividery'></span><span class="qmclear"></span>

</div>

<!---<div id='direita' style="float: left; font-size: 1px; width: 6px; height: 34px; background-image: url(<?php echo $this->webroot; ?>webroot/css/qmimages/right_cap_blue.gif);"></div>  ---->
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
<input type="text" readonly="readonly" id="timeid"   value="60:00" size="4">
<?php echo $form->end();?>
</div>


</div>
<?php
}
?>
        <!-- containerMenuPrivado e containerMenuPrivadoInterno -->
<script type='text/javascript'>qm_create(0,false,0,500,false,false,false,false,false);</script>

<?php

$mensagensflash = $this->Session->flash();

if(strlen($mensagensflash)>5){ ?>
<div id='flashMsg' onclick="HideContent('flashMsg');$('flashMsg').fire('flashMsg:fechada', {mensagemId:0});"><a style='float: right; margin: 0px;'		onclick="HideContent('flashMsg');$('flashMsg').fire('flashMsg:fechada', {mensagemId:0});"	><img border='0' width='15'	height='15' title='Excluir' alt='Excluir'	src='<?php echo $this->webroot; ?>img/lixo.gif' /> </a>
<?php  
//echo $session->flash();
//echo $this->Session->flash();
//$this->Session->delete('Message.flash');
//echo $this->Session->Message;
//echo $session->flash();
echo $mensagensflash;
?>
</div>
<?php 

}
?>

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
<b>EXTRATOS BCA DISPON??VEIS</b><a style='float: right; margin: 0px;' id='fechar'
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
			 	$('alertaSistema').innerHTML = '<p>Registro n??o atualizado!</p>';
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
<div style='display: none; position: absolute;left:40%; border-style: solid; background-color: white; padding: 0px; width: 30%; height:auto; border: 2px solid rgb(0, 0, 0); z-index: 1000' id='mensagem'>
<div id='alertaSistemaTitulo'><p style='background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;text-align: center;font-weight: bolder;'>MENSAGEM DO SISTEMA<a style='float: right; margin: 0px;'		onclick="HideContent('mensagem');$('mensagem').fire('mensagem:fechada', {mensagemId:0});"	><img border='0' width='15'	height='15' title='Excluir' alt='Excluir'	src='<?php echo $this->webroot; ?>img/lixo.gif' /> </a></p></div>

<div id='alertaSistema' style='margin: 0px; background-color: #ffff00; border: 1px solid #000;font-weight: bolder;height:auto;'><p></p></div>
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
var tempodesessao = window.setTimeout(function() {
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
