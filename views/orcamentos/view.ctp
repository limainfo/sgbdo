<div class="habilitacaos view">
<h2><?php  __('Habilitação');?>&nbsp;&nbsp;&nbsp;
		<?php echo $html->link($html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
 		</h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Militar'); ?>:&nbsp;&nbsp;&nbsp;
			<?php echo $html->link($habilitacao['Militar']['Posto']['sigla_posto'].' '.$habilitacao['Militar']['Especialidade']['nm_especialidade'].' '.$habilitacao['Militar']['nm_completo'], array('controller'=> 'militars', 'action'=>'view', $habilitacao['Militar']['id'])); ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cht Anterior'); ?>:&nbsp;&nbsp;&nbsp;
			<?php echo $habilitacao['Habilitacao']['cht_anterior']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cht Atual'); ?>:&nbsp;&nbsp;&nbsp;
			<?php echo $habilitacao['Habilitacao']['cht_atual']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Validade Cht Anterior'); ?>:&nbsp;&nbsp;&nbsp;
			<?php echo $habilitacao['Habilitacao']['validade_cht_anterior']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Validade Cht Atual'); ?>:&nbsp;&nbsp;&nbsp;
			<?php echo $habilitacao['Habilitacao']['validade_cht_atual']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Funcao'); ?>:&nbsp;&nbsp;&nbsp;
			<?php echo $habilitacao['Habilitacao']['funcao']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Setor'); ?>:&nbsp;&nbsp;&nbsp;
			<?php echo $habilitacao['Habilitacao']['setor']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dt Designacao'); ?>:&nbsp;&nbsp;&nbsp;
			<?php echo $habilitacao['Habilitacao']['dt_designacao']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Condicao Operacional'); ?>:&nbsp;&nbsp;&nbsp;
			<?php echo $habilitacao['Habilitacao']['condicao_operacional']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Conceito Operacional'); ?>:&nbsp;&nbsp;&nbsp;
			<?php echo $habilitacao['Habilitacao']['conceito_operacional']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Grau Teorico'); ?>:&nbsp;&nbsp;&nbsp;
			<?php echo $habilitacao['Habilitacao']['grau_teorico']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Dt Teste Fisico'); ?>:&nbsp;&nbsp;&nbsp;
			<?php echo $habilitacao['Habilitacao']['dt_teste_fisico']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nivel Ingles'); ?>:&nbsp;&nbsp;&nbsp;
			<?php echo $habilitacao['Habilitacao']['nivel_ingles']; ?>
		</dt>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Indicativo'); ?>:&nbsp;&nbsp;&nbsp;
			<?php echo $habilitacao['Habilitacao']['indicativo']; ?>
		</dt>
	</dl>
</div>
<br>
