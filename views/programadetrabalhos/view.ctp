
<div class="programadetrabalhos view">
<h2><?php  __('Programadetrabalho');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$programadetrabalho['Programadetrabalho']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$programadetrabalho['Programadetrabalho']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt  class="altrow"><?php __('Id'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['id']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Meta Decea'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['meta_decea']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Origem'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['origem']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Stat'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['stat']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Meta Unidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['meta_unidade']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Etapa Unidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['etapa_unidade']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Descricao Meta Geral'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['descricao_meta_geral']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Descricao Etapa Especifica'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['descricao_etapa_especifica']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Descricao Meta Div Oper'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['descricao_meta_div_oper']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Projeto Basico'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['projeto_basico']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Naj'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['naj']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Pam'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['pam']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Pag'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['pag']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Licitacao'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['licitacao']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Divisao Responsavel'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['divisao_responsavel']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Setor Responsavel'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['setor_responsavel']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Ed14'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['ed14']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Ed15'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['ed15']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Ed30'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['ed30']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Ed39'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['ed39']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Ed39spub'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['ed39spub']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Ed39can'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['ed39can']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Ed51'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['ed51']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Ed52'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['ed52']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Total Meta'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['total_meta']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Providencia'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['providencia']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Status'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $programadetrabalho['Programadetrabalho']['status']; ?>
			&nbsp;
		</dt>
	</dl>
</div>

