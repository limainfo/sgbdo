<center>
<div class="licencas index">



	<table cellpadding="0" cellspacing="0">
 <tr><td colspan="15">
	<h1><?php __('LICENÇAS');?>    &nbsp;<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add','controller'=>'licencas', null),array('escape'=>false, 'escape'=>false), null,false); ?>	</h1>
 	<?php echo $form->create('formFind', array('url' => 'index','id'=>'busca'));
		?>	<h3>
 <?php
		echo $paginator->counter(array('format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start% até %end%', true)));?>  </h3>             
                </td></tr>
                            <tr><td colspan="15">
<?php
		echo '<div id="boxsearch" ><div class="input select" style="align:right;">QTD REGISTROS:<select id="FindPaginas" name="data[formFind][paginas]" class="formulario" onchange="$(\'busca\').submit();">';
		for($i=$min_registros;$i<=$max_registros;$i+=$passo){
		echo '<option value="'.$i.'">'.$i.'</option>';
		}
		echo '<option value="TODAS">TODAS</option>';
		if(!empty($this->data['formFind']['paginas'])){
			echo '<option value="'.$this->data['formFind']['paginas'].'" selected="selected">'.$this->data['formFind']['paginas'].'</option>';
		}
		echo '</select></div>';
		echo '<div class="input text">PESQUISA<input type="text" maxlength="100" size="30" class="formulario" id="find" value="'.$this->data['formFind']['find'].'" name="data[formFind][find]"/>
		<input type="submit" value="Buscar" class="botoes"/></div></div>';
?><?php echo $form->end(); ?>
                
                        </td></tr>            
	<tr>
			<th><?php echo $this->Paginator->sort('unidade_id');?></th>
			<th><?php echo $this->Paginator->sort('militar_id');?></th>
			<th><?php echo $this->Paginator->sort('nr_licenca');?></th>
			<th><?php echo $this->Paginator->sort('indicativo');?></th>
			<th><?php echo $this->Paginator->sort('codigo_barra');?></th>
			<th><?php echo $this->Paginator->sort('tipo_licenca');?></th>
			<th><?php echo $this->Paginator->sort('documento_comprobatorio');?></th>
			<th><?php echo $this->Paginator->sort('expedicao');?></th>
			<th><?php echo $this->Paginator->sort('validade');?></th>
			<th><?php echo $this->Paginator->sort('ticket');?></th>
			<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($licencas as $licenca):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->Html->link($licenca['Unidade']['sigla_unidade'], array('controller' => 'unidades','controller'=>'licencas', 'action' => 'view', $licenca['Unidade']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($licenca['Militar']['nm_completo'], array('controller' => 'militars','controller'=>'licencas', 'action' => 'view', $licenca['Militar']['id'])); ?>
		</td>
		<td><?php echo $licenca['Licenca']['nr_licenca']; ?>&nbsp;</td>
		<td><?php echo $licenca['Licenca']['indicativo']; ?>&nbsp;</td>
		<td><?php echo $licenca['Licenca']['codigo_barra']; ?>&nbsp;</td>
		<td><?php echo $licenca['Licenca']['tipo_licenca']; ?>&nbsp;</td>
		<td><?php echo $licenca['Licenca']['documento_comprobatorio']; ?>&nbsp;</td>
		<td><?php echo $licenca['Licenca']['expedicao']; ?>&nbsp;</td>
		<td><?php echo $licenca['Licenca']['validade']; ?>&nbsp;</td>
		<td><?php echo $licenca['Licenca']['ticket']; ?>&nbsp;</td>
		<!-- 
		<td>
			<?php echo $this->Html->link($licenca['Ata']['numero'], array('controller' => 'atas', 'action' => 'view', $licenca['Ata']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($licenca['Boletiminterno']['numero'], array('controller' => 'boletiminternos', 'action' => 'view', $licenca['Boletiminterno']['id'])); ?>
		</td>
		 -->
		<td class="actions">

		<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', 'controller'=>'licencas',$licenca['Licenca']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>

		<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', 'controller'=>'licencas',$licenca['Licenca']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>

		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$licenca['Licenca']['id']." ?' ,'licencas".'/delete/'.$licenca['Licenca']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false); ?>
		
		<?php echo $this->Html->link($this->Html->image('pdf2.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>'PDF')), array('action'=>'indexPdf', $licenca['Licenca']['id']), array('escape'=>false), null,false); ?>

				</td>
	</tr>
<?php endforeach; ?>
	</table>

	<div class="paging">
<div class="paging"><?php echo $paginator->prev('<< '.__('Anterior', true), array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
| <?php echo $paginator->numbers(array('modulus'=>200,'onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"));?> <?php echo $paginator->next(__('Próxima', true).' >>', array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
</div>
	</div>
	
	
	
	
	
	
	
</div>
</center>