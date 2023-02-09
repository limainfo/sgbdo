
<div class="especialidades view">
<h2><?php  __('Especialidade');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$especialidade['Especialidade']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$especialidade['Especialidade']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $especialidade['Especialidade']['id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Quadro'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($especialidade['Quadro']['sigla_quadro'], array('controller' => 'quadros', 'action' => 'view', $especialidade['Quadro']['id'])); ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Nm Especialidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $especialidade['Especialidade']['nm_especialidade']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Desc Especialidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $especialidade['Especialidade']['desc_especialidade']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Numeracao'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $especialidade['Especialidade']['numeracao']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Equivalente Drhu'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $especialidade['Especialidade']['equivalente_drhu']; ?>
			&nbsp;
		</dt>
	</dl>
</div>

<div class="related">
	<h3><?php __('Related Militars');?></h3>
	<?php if (!empty($especialidade['Militar'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Unidade Id'); ?></th>
		<th><?php __('Setor Id'); ?></th>
		<th><?php __('Posto Id'); ?></th>
		<th><?php __('Especialidade Id'); ?></th>
		<th><?php __('Identidade'); ?></th>
		<th><?php __('Expedidor'); ?></th>
		<th><?php __('Saram'); ?></th>
		<th><?php __('Rc'); ?></th>
		<th><?php __('Nm Completo'); ?></th>
		<th><?php __('Nm Guerra'); ?></th>
		<th><?php __('Dt Nascimento'); ?></th>
		<th><?php __('Dt Admissao'); ?></th>
		<th><?php __('Dt Apresentacao'); ?></th>
		<th><?php __('Dt Ultima Promocao'); ?></th>
		<th><?php __('Dt Formacao'); ?></th>
		<th><?php __('Dt Desligamento'); ?></th>
		<th><?php __('Dt Apresentacao Area'); ?></th>
		<th><?php __('Codarea'); ?></th>
		<th><?php __('Locatual'); ?></th>
		<th><?php __('Comando'); ?></th>
		<th><?php __('Area'); ?></th>
		<th><?php __('Divisao'); ?></th>
		<th><?php __('Subdivisao'); ?></th>
		<th><?php __('Sexo'); ?></th>
		<th><?php __('Cpf'); ?></th>
		<th><?php __('Pasep'); ?></th>
		<th><?php __('Total Beneficiarios'); ?></th>
		<th><?php __('Num Lesp'); ?></th>
		<th><?php __('Funcao'); ?></th>
		<th><?php __('Obs'); ?></th>
		<th><?php __('Situacao'); ?></th>
		<th><?php __('Local Apresentacao'); ?></th>
		<th><?php __('Om Anterior'); ?></th>
		<th><?php __('Indicativo'); ?></th>
		<th><?php __('Orgao'); ?></th>
		<th><?php __('Banco'); ?></th>
		<th><?php __('Agencia'); ?></th>
		<th><?php __('Conta'); ?></th>
		<th><?php __('Estado Civil'); ?></th>
		<th><?php __('Escolaridade'); ?></th>
		<th><?php __('Cidade Nascimento'); ?></th>
		<th><?php __('Uf Nascimento'); ?></th>
		<th><?php __('Cpf Limpo'); ?></th>
		<th><?php __('Nacionalidade'); ?></th>
		<th><?php __('Nr Licenca'); ?></th>
		<th><?php __('Ativa'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($especialidade['Militar'] as $militar):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $militar['id'];?></td>
			<td><?php echo $militar['unidade_id'];?></td>
			<td><?php echo $militar['setor_id'];?></td>
			<td><?php echo $militar['posto_id'];?></td>
			<td><?php echo $militar['especialidade_id'];?></td>
			<td><?php echo $militar['identidade'];?></td>
			<td><?php echo $militar['expedidor'];?></td>
			<td><?php echo $militar['saram'];?></td>
			<td><?php echo $militar['rc'];?></td>
			<td><?php echo $militar['nm_completo'];?></td>
			<td><?php echo $militar['nm_guerra'];?></td>
			<td><?php echo $militar['dt_nascimento'];?></td>
			<td><?php echo $militar['dt_admissao'];?></td>
			<td><?php echo $militar['dt_apresentacao'];?></td>
			<td><?php echo $militar['dt_ultima_promocao'];?></td>
			<td><?php echo $militar['dt_formacao'];?></td>
			<td><?php echo $militar['dt_desligamento'];?></td>
			<td><?php echo $militar['dt_apresentacao_area'];?></td>
			<td><?php echo $militar['codarea'];?></td>
			<td><?php echo $militar['locatual'];?></td>
			<td><?php echo $militar['comando'];?></td>
			<td><?php echo $militar['area'];?></td>
			<td><?php echo $militar['divisao'];?></td>
			<td><?php echo $militar['subdivisao'];?></td>
			<td><?php echo $militar['sexo'];?></td>
			<td><?php echo $militar['cpf'];?></td>
			<td><?php echo $militar['pasep'];?></td>
			<td><?php echo $militar['total_beneficiarios'];?></td>
			<td><?php echo $militar['num_lesp'];?></td>
			<td><?php echo $militar['funcao'];?></td>
			<td><?php echo $militar['obs'];?></td>
			<td><?php echo $militar['situacao'];?></td>
			<td><?php echo $militar['local_apresentacao'];?></td>
			<td><?php echo $militar['om_anterior'];?></td>
			<td><?php echo $militar['indicativo'];?></td>
			<td><?php echo $militar['orgao'];?></td>
			<td><?php echo $militar['banco'];?></td>
			<td><?php echo $militar['agencia'];?></td>
			<td><?php echo $militar['conta'];?></td>
			<td><?php echo $militar['estado_civil'];?></td>
			<td><?php echo $militar['escolaridade'];?></td>
			<td><?php echo $militar['cidade_nascimento'];?></td>
			<td><?php echo $militar['uf_nascimento'];?></td>
			<td><?php echo $militar['cpf_limpo'];?></td>
			<td><?php echo $militar['nacionalidade'];?></td>
			<td><?php echo $militar['nr_licenca'];?></td>
			<td><?php echo $militar['ativa'];?></td>
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
