<center>
<div class="postos view">
<h2><?php  __('Posto');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$posto['Posto']['sigla_posto']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$posto['Posto']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>

		<dt  class="altrow"><?php __('Descricao'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $posto['Posto']['descricao']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Sigla Posto'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $posto['Posto']['sigla_posto']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Sigla Compativel'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $posto['Posto']['sigla_compativel']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Antiguidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $posto['Posto']['antiguidade']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Situacao'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $posto['Posto']['situacao']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Situacaocompleta'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $posto['Posto']['situacaocompleta']; ?>
			&nbsp;
		</dt>
	</dl>
</div>

<div class="related">
	<h3><?php __('Related Militars');?></h3>
	<?php if (!empty($posto['Militar'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Identidade'); ?></th>
		<th><?php __('Rc'); ?></th>
		<th><?php __('Expedidor'); ?></th>
		<th><?php __('Posto Id'); ?></th>
		<th><?php __('Especialidade Id'); ?></th>
		<th><?php __('Nm Completo'); ?></th>
		<th><?php __('Nm Guerra'); ?></th>
		<th><?php __('Dt Admissao'); ?></th>
		<th><?php __('Codarea'); ?></th>
		<th><?php __('Locatual'); ?></th>
		<th><?php __('Unidade Id'); ?></th>
		<th><?php __('Setor Id'); ?></th>
		<th><?php __('Comando'); ?></th>
		<th><?php __('Area'); ?></th>
		<th><?php __('Divisao'); ?></th>
		<th><?php __('Subdivisao'); ?></th>
		<th><?php __('Indicativo Operacional'); ?></th>
		<th><?php __('Dt Nascimento'); ?></th>
		<th><?php __('Sexo'); ?></th>
		<th><?php __('Cpf'); ?></th>
		<th><?php __('Pasep'); ?></th>
		<th><?php __('Total Beneficiarios'); ?></th>
		<th><?php __('Num Lesp'); ?></th>
		<th><?php __('Funcao'); ?></th>
		<th><?php __('Obs'); ?></th>
		<th><?php __('Saram'); ?></th>
		<th><?php __('Situacao'); ?></th>
		<th><?php __('Dt Apresentacao'); ?></th>
		<th><?php __('Dt Formacao'); ?></th>
		<th><?php __('Dt Ultima Promocao'); ?></th>
		<th><?php __('Dt Ultima Inspecao'); ?></th>
		<th><?php __('Tipo Inspecao'); ?></th>
		<th><?php __('Local Apresentacao'); ?></th>
		<th><?php __('Om Anterior'); ?></th>
		<th><?php __('Nr Licenca'); ?></th>
		<th><?php __('Comissionavel'); ?></th>
		<th><?php __('Ativa'); ?></th>
		<th><?php __('Dt Desligamento'); ?></th>
		<th><?php __('Instrutor'); ?></th>
		<th><?php __('Supervisor'); ?></th>
		<th><?php __('Avaliacao Teorica'); ?></th>
		<th><?php __('Avaliacao Pratica'); ?></th>
		<th><?php __('Dt Avaliacao Teorica'); ?></th>
		<th><?php __('Dt Avaliacao Pratica'); ?></th>
		<th><?php __('Validade Cht'); ?></th>
		<th><?php __('Validade Inspsau'); ?></th>
		<th><?php __('Validade Habilitacao'); ?></th>
		<th><?php __('Habilitacao'); ?></th>
		<th><?php __('Orgao'); ?></th>
		<th><?php __('Dt Apresentacao Orgao'); ?></th>
		<th><?php __('Dt Apresentacao Area'); ?></th>
		<th><?php __('Banco'); ?></th>
		<th><?php __('Agencia'); ?></th>
		<th><?php __('Conta'); ?></th>
		<th><?php __('Estado Civil'); ?></th>
		<th><?php __('Escolaridade'); ?></th>
		<th><?php __('Cidade Nascimento'); ?></th>
		<th><?php __('Uf Nascimento'); ?></th>
		<th><?php __('Cpf Limpo'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($posto['Militar'] as $militar):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $militar['id'];?></td>
			<td><?php echo $militar['identidade'];?></td>
			<td><?php echo $militar['rc'];?></td>
			<td><?php echo $militar['expedidor'];?></td>
			<td><?php echo $militar['posto_id'];?></td>
			<td><?php echo $militar['especialidade_id'];?></td>
			<td><?php echo $militar['nm_completo'];?></td>
			<td><?php echo $militar['nm_guerra'];?></td>
			<td><?php echo $militar['dt_admissao'];?></td>
			<td><?php echo $militar['codarea'];?></td>
			<td><?php echo $militar['locatual'];?></td>
			<td><?php echo $militar['unidade_id'];?></td>
			<td><?php echo $militar['setor_id'];?></td>
			<td><?php echo $militar['comando'];?></td>
			<td><?php echo $militar['area'];?></td>
			<td><?php echo $militar['divisao'];?></td>
			<td><?php echo $militar['subdivisao'];?></td>
			<td><?php echo $militar['indicativo'];?></td>
			<td><?php echo $militar['dt_nascimento'];?></td>
			<td><?php echo $militar['sexo'];?></td>
			<td><?php echo $militar['cpf'];?></td>
			<td><?php echo $militar['pasep'];?></td>
			<td><?php echo $militar['total_beneficiarios'];?></td>
			<td><?php echo $militar['num_lesp'];?></td>
			<td><?php echo $militar['funcao'];?></td>
			<td><?php echo $militar['obs'];?></td>
			<td><?php echo $militar['saram'];?></td>
			<td><?php echo $militar['situacao'];?></td>
			<td><?php echo $militar['dt_apresentacao'];?></td>
			<td><?php echo $militar['dt_formacao'];?></td>
			<td><?php echo $militar['dt_ultima_promocao'];?></td>
			<td><?php echo $militar['dt_ultima_inspecao'];?></td>
			<td><?php echo $militar['tipo_inspecao'];?></td>
			<td><?php echo $militar['local_apresentacao'];?></td>
			<td><?php echo $militar['om_anterior'];?></td>
			<td><?php echo $militar['nr_licenca'];?></td>
			<td><?php echo $militar['comissionavel'];?></td>
			<td><?php echo $militar['ativa'];?></td>
			<td><?php echo $militar['dt_desligamento'];?></td>
			<td><?php echo $militar['instrutor'];?></td>
			<td><?php echo $militar['supervisor'];?></td>
			<td><?php echo $militar['avaliacao_teorica'];?></td>
			<td><?php echo $militar['avaliacao_pratica'];?></td>
			<td><?php echo $militar['dt_avaliacao_teorica'];?></td>
			<td><?php echo $militar['dt_avaliacao_pratica'];?></td>
			<td><?php echo $militar['validade_cht'];?></td>
			<td><?php echo $militar['validade_inspsau'];?></td>
			<td><?php echo $militar['validade_habilitacao'];?></td>
			<td><?php echo $militar['habilitacao'];?></td>
			<td><?php echo $militar['orgao'];?></td>
			<td><?php echo $militar['dt_apresentacao_orgao'];?></td>
			<td><?php echo $militar['dt_apresentacao_area'];?></td>
			<td><?php echo $militar['banco'];?></td>
			<td><?php echo $militar['agencia'];?></td>
			<td><?php echo $militar['conta'];?></td>
			<td><?php echo $militar['estado_civil'];?></td>
			<td><?php echo $militar['escolaridade'];?></td>
			<td><?php echo $militar['cidade_nascimento'];?></td>
			<td><?php echo $militar['uf_nascimento'];?></td>
			<td><?php echo $militar['cpf_limpo'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'militars', 'action' => 'view', $militar['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'militars', 'action' => 'edit', $militar['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'militars', 'action' => 'delete', $militar['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $militar['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Militar', true), array('controller' => 'militars', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
</center>