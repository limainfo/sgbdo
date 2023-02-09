<center>
<?php
//print_r($militar);
?>
<div class="militars view">
<h2><?php  __('Militar');?>&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
 		</h2>
 		
 		
 		
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Unidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($militar['Unidade']['sigla_unidade'], array('controller'=> 'unidades', 'action'=>'view', $militar['Setor']['unidade_id'])); ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Divisão'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['divisao']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Subdivisão'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['subdivisao']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Setor'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($militar['Setor']['sigla_setor'], array('controller'=> 'setors', 'action'=>'view', $militar['Setor']['id'])); ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Posto'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($militar['Posto']['sigla_posto'], array('controller'=> 'postos', 'action'=>'view', $militar['Posto']['id'])); ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Especialidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($militar['Especialidade']['nm_especialidade'], array('controller'=> 'especialidades', 'action'=>'view', $militar['Especialidade']['id'])); ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Identidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['identidade']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Saram'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['saram']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('PASEP'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['pasep']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('RC'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['rc']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Divisão'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['divisao']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Estado Civil'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['estado_civil']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Escolaridade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['escolaridade']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sexo'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['sexo']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Total de Beneficiários'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['total_beneficiarios']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cidade Nascimento'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['cidade_nascimento']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('UF Nascimento'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['uf_nascimento']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('RC'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['rc']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('CPF'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['cpf']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Agência'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['agencia']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Banco'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['banco']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Conta'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['conta']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nome Completo'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['nm_completo']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nome de Guerra'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['nm_guerra']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Data de Apresentação'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['dt_apresentacao']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Data de Nascimento'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['dt_nascimento']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Data de Admissão'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['dt_admissao']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Data da Última Promoção'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['dt_ultima_promocao']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Local de Apresentação'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['local_apresentacao']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Procedencia'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['procedencia']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Situação'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['situacao']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Observação'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['obs']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Instrutor'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['instrutor']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Supervisor'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['supervisor']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ativa'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $militar['Militar']['ativa']; ?>
		</dt>
	</dl>
</div>
<br>
		<div class="related">
		<h3><?php  __(' Assinatura');?></h3>
	<?php if (!empty($militar['Assinatura'])):?>
		<dl>	<?php $i = 0; $class = ' class="altrow"';?>
		<dt><?php __('Assinatura');?>:&nbsp;&nbsp;&nbsp;&nbsp;
		</dt>
		<dd>
<?php		
			if(isset($militar['Assinatura']['id'])){
				$img = $militar['Assinatura']['id'];
				echo $this->Html->image(array('controller'=> 'assinaturas', 'action'=>'download',$img), array( 'border'=> '0', 'width'=>'283', 'height'=>'57' )); 
			}else{
				$img = 'Z';
			}
			?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tipo');?>:&nbsp;&nbsp;&nbsp;&nbsp;
		</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $militar['Assinatura']['type'];?>
&nbsp;
	<?php if($img!='Z'){ echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array('controller'=> 'assinaturas', 'action'=>'delete', $img), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir # %s?', true), $img),false);} ?>
</dd>

		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
       	        <li><?php echo $this->Html->link(__('Cadastrar Assinatura', true), array('controller'=> 'assinaturas', 'action'=>'add', $militar['Militar']['id'])); ?> </li>
			</ul>
		</div>
	</div>
<br>
		<div class="related">
		<h3><?php  __(' Fotos Relacionados');?></h3>
	<?php if (!empty($militar['Foto'])):?>
		<dl>	<?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Foto');?>:&nbsp;&nbsp;&nbsp;&nbsp;
		</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
<?php			
			if(isset($militar['Foto']['id'])){
				$img = $militar['Foto']['id'];
				echo $this->Html->image(array('controller'=> 'fotos', 'action'=>'externodownload',$img,1 ), array( 'border'=> '0')); 
			}else{
				$img = 'Z';
			}
			?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tipo');?>:&nbsp;&nbsp;&nbsp;&nbsp;
		</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $militar['Foto']['type'];?>
&nbsp;
	<?php if($img!='Z'){ echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array('controller'=> 'fotos', 'action'=>'delete', $img), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir # %s?', true), $img),false);} ?>
</dd>

		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
       	        <li><?php echo $this->Html->link(__('Cadastrar Foto', true), array('controller'=> 'fotos', 'action'=>'add', $militar['Militar']['id'])); ?> </li>
			</ul>
		</div>
	</div>
<br>
	<div class="related">
	<h3><?php echo 'Quantidade: ( '.count($militar['Atividade']).' )'; ?><?php __(' Atividades Relacionados');?></h3>
	<?php if (!empty($militar['Atividade'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Orgao'); ?></th>
		<th><?php __('Desc Atividade'); ?></th>
		<th><?php __('Período'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($militar['Atividade'] as $atividade):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $atividade['orgao'];?></td>
			<td><?php echo $atividade['desc_atividade'];?></td>
			<td><?php echo $atividade['periodo'];?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('controller'=> 'atividades', 'action'=>'view', $atividade['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('controller'=> 'atividades', 'action'=>'edit', $atividade['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array('controller'=> 'atividades', 'action'=>'delete', $militar['Militar']['id']), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir # %s?', true), $atividade['id']),false); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Cadastrar Atividade', true), array('controller'=> 'atividades', 'action'=>'add',$militar['Militar']['id']),array('class'=>'button'));?> </li>
		</ul>
	</div>
</div>
<br>
<div class="related">
	<h3><?php echo 'Quantidade: ( '.count($militar['Exame']).' )'; ?><?php __(' Exames Relacionados');?></h3>
	<?php if (!empty($militar['Exame'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Data Exame'); ?></th>
		<th><?php __('Parecer'); ?></th>
		<th><?php __('Data Validade'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($militar['Exame'] as $exame):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $exame['data_exame'];?></td>
			<td><?php echo $exame['parecer'];?></td>
			<td><?php echo $exame['data_validade'];?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('controller'=> 'exames', 'action'=>'view', $exame['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('controller'=> 'exames', 'action'=>'edit', $exame['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array('controller'=> 'exames', 'action'=>'delete', $militar['Militar']['id']), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir # %s?', true), $exame['id']),false); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Cadastrar Exame', true), array('controller'=> 'exames', 'action'=>'add', $militar['Militar']['id']),array('class'=>'button'));?> </li>
		</ul>
	</div>
</div>
<br>
<div class="related">
	<h3><?php echo 'Quantidade: ( '.count($militar['Habilitacao']).' )'; ?><?php __(' Habilitacaos Relacionados');?></h3>
	<?php if (!empty($militar['Habilitacao'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Cht'); ?></th>
		<th><?php __('Validade Cht'); ?></th>
		<th><?php __('Função'); ?></th>
		<th><?php __('Localidade'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($militar['Habilitacao'] as $habilitacao):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $habilitacao['cht'];?></td>
			<td><?php echo $habilitacao['validade_cht'];?></td>
			<td><?php echo $habilitacao['funcao'];?></td>
			<td><?php echo $habilitacao['localidade'];?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('controller'=> 'habilitacaos', 'action'=>'view', $habilitacao['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('controller'=> 'habilitacaos', 'action'=>'edit', $habilitacao['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array('controller'=> 'habilitacaos', 'action'=>'delete', $habilitacao['id']), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir # %s?', true), $habilitacao['id']),false); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Cadastrar Habilitacao', true), array('controller'=> 'habilitacaos', 'action'=>'add', $militar['Militar']['id']),array('class'=>'button'));?> </li>
		</ul>
	</div>
</div>
<br>
<div class="related">
	<h3><?php echo 'Quantidade: ( '.count($militar['Curso']).' )'; ?><?php __(' Cursos Relacionados');?></h3>
	<?php if (!empty($militar['Curso'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Codigo'); ?></th>
		<th><?php __('Descricao'); ?></th>
		<th><?php __('Data Início'); ?></th>
		<th><?php __('Data Término'); ?></th>
		<th><?php __('Período'); ?></th>
		<th><?php __('Origem'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($militar['Curso'] as $curso):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $curso['codigo'];?></td>
			<td><?php echo $curso['descricao'];?></td>
 <td><?php echo date('d-m-Y',strtotime($curso['MilitarsCurso']['dt_inicio_curso']));?></td> 			
 <td><?php echo date('d-m-Y',strtotime($curso['MilitarsCurso']['dt_fim_curso']));?></td> 			
<!-- <td><?php echo $curso['MilitarsCurso']['dt_inicio_curso'];?></td> -->			
			<td><?php echo $curso['MilitarsCurso']['periodo'];?></td>
			<td><?php echo $curso['MilitarsCurso']['local_realizacao'];?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('controller'=> 'cursos', 'action'=>'view', $curso['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Cadastrar Curso', true), array('controller'=> 'cursos', 'action'=>'add', $militar['Militar']['id']),array('class'=>'button'));?> </li>
		</ul>
	</div>
</div>
<br>
<div class="related">
	<h3><?php echo 'Quantidade: ( '.count($militar['Escala']).' )'; ?><?php __(' Escalas Relacionados');?></h3>
	<?php if (!empty($militar['Escala'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Escala'); ?></th>
		<th><?php __('Escalante'); ?></th>
		<th><?php __('Chefe Órgão'); ?></th>
		<th><?php __('Legenda Prevista'); ?></th>
		<th><?php __('Legenda Cumprida'); ?></th>
		<th><?php __('Mês'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($militar['Escala'] as $escala):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
			if($escala['mes']<10){
				$escala['mes']='0'.$escala['mes'];
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $escalas[$militar['Setor']['id']];?></td>
			<td><?php echo $escala['nm_escalante'];?></td>
			<td><?php echo $escala['nm_chefe_orgao'];?></td>
			<td><?php echo $this->Html->link($escala['MilitarsEscala']['legenda_prevista'], array('controller'=> 'escalas', 'action'=>'indexPdf', $escala['id'].'/'.$escala['mes'].'/'.$escala['ano'].'/p'),array('escape'=>false, 'escape'=>false), null,false);?></td>
			<td><?php echo $this->Html->link($escala['MilitarsEscala']['legenda_cumprida'], array('controller'=> 'escalas', 'action'=>'indexPdf', $escala['id'].'/'.$escala['mes'].'/'.$escala['ano'].'/c'),array('escape'=>false, 'escape'=>false), null,false);?></td>
			<td><?php echo $escala['mes'].'/'.$escala['ano'];?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Cadastrar Escala', true), array('controller'=> 'escalas', 'action'=>'add'),array('class'=>'button'));?> </li>
		</ul>
	</div>
</div>
	<div class="related">
	<h3><?php echo 'Quantidade: ( '.count($militar['Afastamento']).' )'; ?><?php __(' Afastamentos Relacionados');?></h3>
	<?php if (!empty($militar['Afastamento'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Início'); ?></th>
		<th><?php __('Término'); ?></th>
		<th><?php __('Motivo'); ?></th>
		<th><?php __('obs'); ?></th>
		<th><?php __('Escala Afetada'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($militar['Afastamento'] as $atividade):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $atividade['dt_inicio'];?></td>
			<td><?php echo $atividade['dt_termino'];?></td>
			<td><?php echo $atividade['motivo'];?></td>
			<td><?php echo $atividade['obs'];?></td>
			<td><?php echo $escalas[$atividade['escala_id']];?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('controller'=> 'afastamentos', 'action'=>'view', $atividade['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('controller'=> 'afastamentos', 'action'=>'edit', $atividade['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir',true), 'border'=> '0', 'title'=>'Excluir')), array('controller'=> 'afastamentos', 'action'=>'delete', $atividade['id']), array('escape'=>false, 'escape'=>false), sprintf(__('Tem certeza que deseja excluir ?', true), $atividade['id']),false); ?>
			<?php //echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir',true), 'border'=> '0', 'title'=>'Excluir')), array('controller'=> 'afastamentos', 'action'=>'delete', $atividade['id']), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir ?', true), $atividade['id']),false); ?>
			<?php //echo $this->Html->image('lixo.gif', array('alt'=> __('Excluir',true), 'border'=> '0', 'title'=>'Excluir','url'=>$this->Html->link(null, array('controller'=> 'afastamentos', 'action'=>'delete', $atividade['id']), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir ?', true), $atividade['id']),false))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
		</ul>
	</div>
</div>
	<div class="related">
	<h3><?php echo 'Quantidade: ( '.count($militar['Paeatsindicado']).' )'; ?><?php __(' Indicações Relacionadas');?></h3>
	<?php if (!empty($militar['Paeatsindicado'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('CodCurso'); ?></th>
		<th><?php __('Vaga'); ?></th>
		<th><?php __('Responsável pela indicação'); ?></th>
		<th><?php __('Data da indicação'); ?></th>
		<th><?php __('Prioridade'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($militar['Paeatsindicado'] as $atividade):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $atividade['codcurso'];?></td>
			<td><?php echo $atividade['referenciavaga'];?></td>
			<td><?php echo $atividade['responsavel'];?></td>
			<td><?php echo $atividade['created'];?></td>
			<td><?php echo $atividade['prioridade'];?></td>
			<td class="actions">
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
		</ul>
	</div>
</div>
<br>
</center>