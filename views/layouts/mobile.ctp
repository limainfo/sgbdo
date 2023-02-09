<?=$this->Html->docType('xhtml-strict');?>
<head>
<meta name="viewport" content="initial-scale=0.5, maximum-scale=1">
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

//echo $this->Html->script(array('prototype','tiny_mce/tiny_mce','scriptaculous.js?load=effects,dragdrop,controls'));
echo $this->Html->css(array("jqmobile/jquery.mobile-1.3.2.min"))."\n";
echo $this->Html->css(array("jqmobile/jquery-mobile-fluid960"))."\n";
echo $this->Html->css(array("jqmobile/fab"))."\n";
echo $this->Html->css(array("jqmobile/jqm-datebox.min"))."\n";
echo $this->Html->script(array('jqmobile/jquery-1.10.2','jqmobile/jquery.mobile-1.3.2.min','jqmobile/jqm-datebox.core.min','jqmobile/jqm-datebox.mode.datebox.min','jqmobile/jqm-datebox.mode.calbox.min','jqmobile/jquery.mobile.datebox.i18n.pt-BR.utf8'));
echo $this->Html->css("dialog.2.0")."\n";
echo $this->Html->css("menu_gerente")."\n";
echo $this->Html->script('dialog.2.0')."\n";
//echo $this->Html->css(array("admin"))."\n";
echo $this->Html->script(array('menu_gerente'));

?>
</head>
<body>

        
<?php
if(!empty($u[0]['Usuario']['privilegio_id'])){	
?>

<div id="tophead"><?php echo $html->image('dacta.gif',array('style'=>'float:left;align:top;padding:3px;')); ?>
<div id='esquerda' 	style="float: left; font-size: 1px; width: 6px; height: 34px; background-image: url(<?php echo $this->webroot; ?>webroot/css/qmimages/left_cap_blue.gif);">
</div>
<div id="qm0" class="qmmc" style="float: left; height: 34px; background-image: url(<?php echo $this->webroot; ?>webroot/css/qmimages/center_tile_blue.gif); background-repeat: repeat-x;">        
    
    <?php
   
	$compara = $u[0]['Usuario']['privilegio_id'];
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
		echo("</span>");
		if(!empty($acesso['paises'])){echo("<a href='".$this->webroot.'paises'."'>País</a>");}
		if(!empty($acesso['estados'])){echo("<a href='".$this->webroot.'estados'."'>Estado</a>");}
		if(!empty($acesso['cidades'])){echo("<a href='".$this->webroot.'cidades'."'>Cidade</a>");}
		if(!empty($acesso['especialidades'])){echo("<a href='".$this->webroot.'especialidades/'."'>Especialidades</a>");}
		if(!empty($acesso['quadros'])){echo("<a href='".$this->webroot.'quadros'."'>Quadros</a>");}
		if(!empty($acesso['unidades'])){echo("<a href='".$this->webroot.'unidades'."'>Unidades</a>");}
		if(!empty($acesso['setors'])){echo("<a href='".$this->webroot.'setors'."'>Setores</a>");}
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
		echo("<a href='{$this->webroot}paeatsindicados/externoconsulta'>Consultar Indicação de Curso</a>");
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
                        
        }
        if(($compara==1)||($compara==17)){
        
        	echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>Chamada</a><div>");
        	echo("<span class='qmdivider qmdividerx'></span>");
        	echo("<a href='{$this->webroot}chamadaefetivos/add'><b>1.</b> Cadastrar efetivo</a>");
        	echo("<a href='{$this->webroot}chamadas/add'><b>2.</b> Gerar chamada</a>");
        	echo("<a href='{$this->webroot}chamadas/externocalendario'><b>3.</b> Consultar chamada</a>");
        	echo("<a href='{$this->webroot}chamadas/externocomunicado'><b>4.</b> Incluir comunicado na página inicial</a>");
        	echo("<span class='qmdivider qmdividerx'></span></div>");
        
        
 }
 if($compara==1){
 echo("<span class='qmdivider qmdividery'></span><a href='javascript:void(0)'>Orçamento</a><div>");
 echo("<span class='qmdivider qmdividerx'></span>");
 echo("<a href='{$this->webroot}orcamentos/add'><b>1.</b> Cadastrar Planejado</a>");
 echo("<a href='{$this->webroot}orcamentos/add'><b>2.</b> Atualizar Atual</a>");
 echo("<a href='{$this->webroot}orcamentos/externocalendario'><b>3.</b> Relatório do Orçamento</a>");
 echo("<span class='qmdivider qmdividerx'></span></div>");
 }
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
?>
</div>
<?php } ?>

<div id='spinner'
	style='background-color: #FFFFFF; display: none; z-index: 1030; position: fixed; top: 30%; left: 30%; float: center; border-top-width: thin; border-right-width: thin; border-bottom-width: thin; border-left-width: thin; border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: #000000; border-right-color: #000000; border-bottom-color: #000000; border-left-color: #000000;'><?php echo $this->Html->image('spinner.gif',array('width'=>15,'height'=>15)).' Carregando ...'; ?>
</div>

<br>
<br>
<br>
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
