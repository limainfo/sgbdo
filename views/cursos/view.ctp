<?php
//print_r($u);
if($u[0]['Usuario']['privilegio_id']==12){
	$leitura = '"readonly"="readonly"';
}else{
	$leitura = "";
}

?>

<div class="cursos view">
<h2><?php  __('Curso');?>&nbsp;&nbsp;&nbsp; <?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
</h2>
<dl>
<?php $i = 0; $class = ' class="altrow"';?>
	<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Codigo'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
	<?php echo $curso[0]['Curso']['codigo']; ?></dt>
	<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Descricao'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
	<?php echo $curso[0]['Curso']['descricao']; ?></dt>
	<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Pre Requisito'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
	<?php echo $curso[0]['Curso']['pre_requisito']; ?></dt>
	<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Objetivo'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
	<?php echo $curso[0]['Curso']['objetivo']; ?></dt>
</dl>
</div>
<br>
<div class="related">
<h3><?php 		echo 'Quantidade: ( '.count($cursoativo).' )'; ?><?php __(' Cursos ativados');?></h3>
<div class="actions">
<ul>
	<li><?php echo $this->Html->link(__('Ativar Curso', true), array('controller'=> 'cursoativos', 'action'=>'add/'.$curso[0]['Curso']['id']),array('class'=>'button'));?>
	</li>
</ul>
</div>

<table cellpadding="0" cellspacing="0">
	<tr>
		<th>Curso&nbsp;</th>
		<th>Turma&nbsp;</th>
		<th>Data Início&nbsp;</th>
		<th>Data Término&nbsp;</th>
		<th>Vagas&nbsp;</th>
		<th>Documento Ativação&nbsp;</th>
		<th>Local Realização&nbsp;</th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($cursoativos as $cursoativo):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	$deleta = 0;
	$cor = 'style="background-color: rgb(240, 208, 208);"';
		$compara = strtotime($cursoativo['Cursoativo']['data_termino']);
		$hoje = strtotime(date('Y-m-d'));
		if($hoje<=$compara){
			$deleta = 1;
			$cor = '';
		}
	?>
	<tr <?php echo $class;?>>
		<td <?php echo $cor;?>><?php echo $cursoativo['Curso']['codigo']; ?>&nbsp;</td>
		<td <?php echo $cor;?>><?php echo $cursoativo['Cursoativo']['turma']; ?>&nbsp;</td>
		<td <?php echo $cor;?>><?php echo $cursoativo['Cursoativo']['data_inicio']; ?>&nbsp;</td>
		<td <?php echo $cor;?>><?php echo $cursoativo['Cursoativo']['data_termino']; ?>&nbsp;</td>
		<td <?php echo $cor;?>><?php echo $cursoativo['Cursoativo']['vagas']; ?>&nbsp;</td>
		<td <?php echo $cor;?>><?php echo $cursoativo['Cursoativo']['documento_ativacao']; ?>&nbsp;</td>
		<td <?php echo $cor;?>><?php echo $cursoativo['Cursoativo']['local_realizacao']; ?>&nbsp;</td>
		<td <?php echo $cor;?> class="actions"><?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('controller'=>'cursoativos','action'=>'view', $cursoativo['Cursoativo']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php
		if($deleta){
			?> <?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('controller'=>'cursoativos','action'=>'edit', $cursoativo['Cursoativo']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php 
			 echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$cursoativo['Cursoativo']['id']." ?' ,'".$this->webroot.'cursoativos/delete/'.$cursoativo['Cursoativo']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false); 
		?>
			
			<?php
		}
		?></td>
	</tr>
	<?php endforeach; ?>
</table>
</div>
<br>
<div class="related">
<h3><?php 		echo 'Quantidade: ( '.count($curso).' )'; ?><?php __(' Militares Cursos Relacionados');?></h3>
	<?php if (!empty($curso)):?>
<div class="actions">
<ul>
	<li><?php echo $this->Html->link(__('Cadastrar Militars Curso', true), array('controller'=> 'militars_cursos', 'action'=>'add'),array('class'=>'button'));?>
	<?php
$script = "\$('broffice').href='".$this->webroot."cursos/broffice/".$curso[0]['Curso']['id']."';";

?>
&nbsp;<?php echo $this->Html->link($this->Html->image('broffice.png', array('alt'=> __('BROffice', true), 'border'=> '0', 'title'=>'Dados em planilha BROffice', 'onmouseover'=>$script )), array('action'=>'broffice'), array('id'=>'broffice','escape'=>false), null,false); ?>
	
	</li>
</ul>
</div>
<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php __('Unidade '); ?></th>
		<th><?php __('Setor '); ?></th>
		<th><?php __('Identidade '); ?></th>
		<th><?php __('Militar '); ?></th>
		<th><?php __('Dt Inicio Curso'); ?></th>
		<th><?php __('Dt Fim Curso'); ?></th>
		<th><?php __('Local Realizacao'); ?></th>
		<th><?php __('Documento'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	$i = 0;

	foreach ($curso as $militarsCurso):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td><?php echo $militarsCurso['Unidade']['sigla_unidade'];?></td>
		<td><?php echo $militarsCurso['Setor']['sigla_setor'];?></td>
		<td><?php echo $militarsCurso['Militar']['identidade'];?></td>
		<td><?php echo $militarsCurso[0]['nm_completo'];?></td>
		<td><?php echo $militarsCurso['MilitarsCurso']['dt_inicio_curso'];?></td>
		<td><?php echo $militarsCurso['MilitarsCurso']['dt_fim_curso'];?></td>
		<td><?php echo $militarsCurso['MilitarsCurso']['local_realizacao'];?></td>
		<td><?php echo $militarsCurso['MilitarsCurso']['documento'];?></td>
		<td class="actions">
		<?php //echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('controller'=> 'militars_cursos', 'action'=>'edit', $militarsCurso['MilitarsCurso']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar','onclick'=>"exibe('".$militarsCurso['MilitarsCurso']['id']."' ,'".rawurlencode($militarsCurso['Unidade']['sigla_unidade'])."', '".rawurlencode($militarsCurso['Setor']['sigla_setor'])."', '".rawurlencode($militarsCurso[0]['nm_completo'])."', '".rawurlencode($militarsCurso['Militar']['identidade'])."', '".rawurlencode($militarsCurso['MilitarsCurso']['dt_inicio_curso'])."', '".rawurlencode($militarsCurso['MilitarsCurso']['dt_fim_curso'])."', '".rawurlencode($militarsCurso['MilitarsCurso']['local_realizacao'])."', '".rawurlencode($militarsCurso['MilitarsCurso']['documento'])."');"));  ?>
		<?php 
			 echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".($militarsCurso[0]['nm_completo'])." ?' ,'".$this->webroot.'militars_cursos/delete/'.$militarsCurso['MilitarsCurso']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false); 
		?>
</td>
	</tr>
	<?php endforeach; ?>
</table>
	<?php endif; ?></div>
	
<div id="login"
	style="border-color: rgb(0, 0, 0); padding: 0px; z-index: 0; border: 3px solid #000000; position: absolute; top: 10%; left: 5%; height: auto; width: auto;">
						<?php echo $form->create('MilitarsCurso', array('action'=>'verso','onsubmit'=>'submitForm(this); return false;','type'=>'file'));?>
<table cellspacing="0" cellpadding="0" id="login">
	<tbody>
		<tr>
			<td valign="center" align="center">
			<table cellspacing="0" cellpadding="0" id="login" width="100%">
				<tr>
					<th width="10%" colspan="2"><a href="javascript:HideContent('login');" id="btfechar">X</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php __('Modificar informação de militar');?></th>
				</tr>
				<?php
					$titulo = '30%';
					$campo = '80%';
				?>
				<tr>
					<td width="<?php echo $titulo; ?>">Unidade:</td>
					<td width="<?php echo $campo; ?>"><input
						type="text" readonly="readonly" id="MilitarsCursoUnidade" value=""
						size="50" class="formulario"
						name="data[Unidade][Unidade]" /><input
						type="hidden" <?php echo $leitura;  ?> id="MilitarsCursoId" value=""
						name="data[MilitarsCurso][id]" /></td>
				</tr>
				<tr>
					<td width="<?php echo $titulo; ?>">Setor:</td>
					<td width="<?php echo $campo; ?>"><input
						type="text" readonly="readonly" id="MilitarsCursoSetor" value=""
						size="50" class="formulario"
						name="data[Setor][Setor]" /></td>
				</tr>
				<tr>
					<td width="<?php echo $titulo; ?>">Militar:</td>
					<td width="<?php echo $campo; ?>"><input
						type="text" readonly="readonly" id="MilitarsCursoMilitar" value=""
						size="50" class="formulario"
						name="data[Militar][nm_completo]" /></td>
				</tr>
				<tr>
					<td width="<?php echo $titulo; ?>">Identidade:</td>
					<td width="<?php echo $campo; ?>"><input
						type="text" readonly="readonly" id="MilitarsCursoIdentidade" value=""
						size="50" class="formulario"
						name="data[Militar][identidade]" /></td>
				</tr>
				<tr>
					<td width="<?php echo $titulo; ?>">Data Início:</td>
					<td width="<?php echo $campo; ?>"><input
						type="text" readonly="readonly" id="MilitarsCursoDataInicio" value=""
						size="30" class="formulario"
						name="data[MilitarsCurso][dt_inicio_curso]" /><a onclick="return showCalendar('MilitarsCursoDataInicio', '%Y-%m-%d'); return false;" href="#"><img alt="" src="<?php echo $this->webroot; ?>img/../js/jscalendar/img.gif"/></a></td>
				</tr>
				<tr>
					<td width="<?php echo $titulo; ?>">Data Fim:</td>
					<td width="<?php echo $campo; ?>"><input
						type="text" readonly="readonly" id="MilitarsCursoDataFim" value=""
						size="30" class="formulario"
						name="data[MilitarsCurso][dt_fim_curso]" /><a onclick="return showCalendar('MilitarsCursoDataFim', '%Y-%m-%d'); return false;" href="#"><img alt="" src="<?php echo $this->webroot; ?>img/../js/jscalendar/img.gif"/></a></td>
				</tr>
				<tr>
					<td width="<?php echo $titulo; ?>">Local Realização:</td>
					<td width="<?php echo $campo; ?>"><input
						type="text" <?php echo $leitura;  ?> id="MilitarsCursoLocalRealizacao" value=""
						size="50" class="formulario"
						name="data[MilitarsCurso][local_realizacao]" /></td>
				</tr>
				<tr>
					<td width="<?php echo $titulo; ?>">Documento:</td>
					<td width="<?php echo $campo; ?>"><input
						type="text" <?php echo $leitura;  ?> id="MilitarsCursoDocumento" value=""
						size="50" class="formulario"
						name="data[MilitarsCurso][documento]" /></td>
				</tr>
				<tr>
					<td colspan="3" width="33%"><?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
					</td>
				</tr>

			</table>
			</td>
		</tr>
	</tbody>
</table>
</div>
	
<script type="text/javascript">
<!--
new Draggable('login');
//-->
</script>
	<?php
	$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[

HideContent('login');

function submitForm(form) {
	/*
	usa método request() da classe Form da prototype, que serializa os campos
	do formulário e submete (por POST como default) para a action especificada no form
	*/
	var dados = Form.serialize($('MilitarsCursoVersoForm'));
	new Ajax.Request('{$this->webroot}militars_cursos/externoview', {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			
    		 if (resultado.ok==0){
			 	$('alertaSistema').innerHTML = "<p>Registro não atualizado!</p>";
			 	ShowContent('mensagem');
			}else{
			 	$('alertaSistema').innerHTML = "<p>Registro atualizado!</p>";
			 	location.reload();
			 	ShowContent('mensagem');
    		 	HideContent('login');
					}
				}})
        
        
        return false;
    }
		

function exibe(id, unidade, setor, militar, identidade, dataInicio, dataFim, localRealizacao, documento) {

	$('MilitarsCursoId').value = id;
	$('MilitarsCursoUnidade').value = decodeURIComponent(unidade);
	$('MilitarsCursoSetor').value = decodeURIComponent(setor);
	$('MilitarsCursoMilitar').value = decodeURIComponent(militar);
	$('MilitarsCursoIdentidade').value = decodeURIComponent(identidade);
	$('MilitarsCursoDataInicio').value = decodeURIComponent(dataInicio);
	$('MilitarsCursoDataFim').value = decodeURIComponent(dataFim);
	$('MilitarsCursoLocalRealizacao').value = decodeURIComponent(localRealizacao);
	$('MilitarsCursoDocumento').value = decodeURIComponent(documento);
	ShowContent('login');
 }
 //]]>
</script>
 
SCRIPT;


echo $jscript;

?>
