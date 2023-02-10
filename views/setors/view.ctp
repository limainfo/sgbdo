
<div class="setors view">
<h2><?php  __('Setor');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$setor['Setor']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$setor['Setor']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $setor['Setor']['id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Unidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($setor['Unidade']['sigla_unidade'], array('controller' => 'unidades', 'action' => 'view', $setor['Unidade']['id'])); ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Nm Setor'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $setor['Setor']['nm_setor']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Sigla Setor'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $setor['Setor']['sigla_setor']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Nm Chefe Setor'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $setor['Setor']['nm_chefe_setor']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Tel Setor'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $setor['Setor']['tel_setor']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Efetivo Previsto'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $setor['Setor']['efetivo_previsto']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Tipo'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $setor['Setor']['tipo']; ?>
			&nbsp;
		</dt>
                <dt  class="altrow">Reponsável:&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php echo $setor['Setor']['parent_id']; ?>
                </dt>
                </div>

<div class="related">
	<h3><?php __('Related Militars');?></h3>
	<?php if (!empty($setor['Militar'])):?>
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
		foreach ($setor['Militar'] as $militar):
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
<div class="related">
	<h3><?php __('Related Setoresassociados');?></h3>
	<?php if (!empty($setor['Setoresassociado'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Setor Id'); ?></th>
		<th><?php __('Setorassociado'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($setor['Setoresassociado'] as $setoresassociado):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $setoresassociado['id'];?></td>
			<td><?php echo $setoresassociado['setor_id'];?></td>
			<td><?php echo $setoresassociado['setorassociado'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'setoresassociados', 'action' => 'view', $setoresassociado['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'setoresassociados', 'action' => 'edit', $setoresassociado['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'setoresassociados', 'action' => 'delete', $setoresassociado['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $setoresassociado['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Setoresassociado', true), array('controller' => 'setoresassociados', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Escalas');?></h3>
	<?php if (!empty($setor['Escala'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Setor Id'); ?></th>
		<th><?php __('Nm Escalante'); ?></th>
		<th><?php __('Nm Chefe Orgao'); ?></th>
		<th><?php __('Nm Comandante'); ?></th>
		<th><?php __('Efetivo Total'); ?></th>
		<th><?php __('Dt Limite Cumprida'); ?></th>
		<th><?php __('Dt Limite Previsao'); ?></th>
		<th><?php __('Ativa'); ?></th>
		<th><?php __('Mes'); ?></th>
		<th><?php __('Ano'); ?></th>
		<th><?php __('Livro'); ?></th>
		<th><?php __('Supervisor Geral'); ?></th>
		<th><?php __('Supervisor Regional'); ?></th>
		<th><?php __('Chefe Equipe'); ?></th>
		<th><?php __('Executante Livro'); ?></th>
		<th><?php __('Gerentelocal Livro'); ?></th>
		<th><?php __('Gerenteregional Livro'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Tipo'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($setor['Escala'] as $escala):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $escala['id'];?></td>
			<td><?php echo $escala['setor_id'];?></td>
			<td><?php echo $escala['nm_escalante'];?></td>
			<td><?php echo $escala['nm_chefe_orgao'];?></td>
			<td><?php echo $escala['nm_comandante'];?></td>
			<td><?php echo $escala['efetivo_total'];?></td>
			<td><?php echo $escala['dt_limite_cumprida'];?></td>
			<td><?php echo $escala['dt_limite_previsao'];?></td>
			<td><?php echo $escala['ativa'];?></td>
			<td><?php echo $escala['mes'];?></td>
			<td><?php echo $escala['ano'];?></td>
			<td><?php echo $escala['livro'];?></td>
			<td><?php echo $escala['supervisor_geral'];?></td>
			<td><?php echo $escala['supervisor_regional'];?></td>
			<td><?php echo $escala['chefe_equipe'];?></td>
			<td><?php echo $escala['executante_livro'];?></td>
			<td><?php echo $escala['gerentelocal_livro'];?></td>
			<td><?php echo $escala['gerenteregional_livro'];?></td>
			<td><?php echo $escala['created'];?></td>
			<td><?php echo $escala['tipo'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'escalas', 'action' => 'view', $escala['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'escalas', 'action' => 'edit', $escala['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'escalas', 'action' => 'delete', $escala['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $escala['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Escala', true), array('controller' => 'escalas', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
