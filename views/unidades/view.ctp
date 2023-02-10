<center>
<div class="unidades view">
<h2><?php  __('Unidade');?>
		&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$unidade['Unidade']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$unidade['Unidade']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);?>
				
</h2>


	<dl style="text-align:left;"><?php $i = 0; $class = ' class="altrow"';?>

		<dt  class="altrow"><?php __('Comando'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $unidade['Unidade']['comando']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Codarea'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $unidade['Unidade']['codarea']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Area'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $unidade['Unidade']['area']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Estado'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->Html->link($unidade['Cidade']['nome'], array('controller' => 'cidades', 'action' => 'view', $unidade['Cidade']['id'])); ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Nm Unidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $unidade['Unidade']['nm_unidade']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Sigla Unidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $unidade['Unidade']['sigla_unidade']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Nm Cmt Unidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $unidade['Unidade']['nm_cmt_unidade']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Tel Unidade'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $unidade['Unidade']['tel_unidade']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Inicio Numero Licenca'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $unidade['Unidade']['inicio_numero_licenca']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Fim Numero Licenca'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $unidade['Unidade']['fim_numero_licenca']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Numero Licenca Atual'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $unidade['Unidade']['numero_licenca_atual']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Letra Licenca Atual'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $unidade['Unidade']['letra_licenca_atual']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Nv Manutencao'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $unidade['Unidade']['nv_manutencao']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Numero Replicacao'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $unidade['Unidade']['numero_replicacao']; ?>
			&nbsp;
		</dt>
		<dt  class="altrow"><?php __('Militar Sn'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $unidade['Unidade']['militar_sn']; ?>
			&nbsp;
		</dt>
	</dl>
</div>

    
    
<center>
<div class="atas index">
	<table cellpadding="0" cellspacing="0">
                    <tr><td colspan="8">
	<h1><?php __('ATA');?>    &nbsp;<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add','controller'=>'atas', null),array('escape'=>false, 'escape'=>false), null,false); ?>	<p style="margin:0px;float:right;font-size: 10px;">  <b>Registros: <?php echo count($unidade['Ata']); ?></b></p> 	</h1>
 	<?php echo $form->create('formFind', array('url' => 'index','id'=>'busca'));
		?>	          
                </td></tr>
            
	<tr>
			<th><?php __('numero');?></th>
			<th><?php __('observacao');?></th>
			<th><?php __('data_reuniao');?></th>
			<th><?php __('boletiminterno_id');?></th>
			<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($unidade['Ata'] as $ata):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $ata['numero']; ?>&nbsp;</td>
		<td><?php echo $ata['observacao']; ?>&nbsp;</td>
		<td><?php echo $ata['data_reuniao']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($ata['Boletiminterno']['numero'], array('controller' => 'boletiminternos', 'action' => 'view','controller'=>'boletiminternos', $ata['Boletiminterno']['id'])); ?>
		</td>
		<td class="actions">

		<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view','controller'=>'atas', $ata['id']),array('escape'=>false, 'escape'=>false), null,false); ?>

		<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit','controller'=>'atas', $ata['id']),array('escape'=>false, 'escape'=>false), null,false); ?>

		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$ata['id']." ?' ,'atas".'/delete/'.$ata['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false); ?>

				</td>
	</tr>
<?php endforeach; ?>
	</table>
    <br>
	

	
</div>
</center>    
    
    
    
<center>

<div class="boletiminternos index">
	<table cellpadding="0" cellspacing="0">
                    <tr><td colspan="8">
	<h1><?php __('Boletins Internos');?>    &nbsp;<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add','controller' => 'boletiminternos', null),array('escape'=>false, 'escape'=>false), null,false); ?>	<p style="margin:0px;float:right;font-size: 10px;">  <b>Registros: <?php echo count($unidade['Boletiminterno']); ?></b></p> 	</h1>
 	<?php echo $form->create('formFind', array('url' => 'index','id'=>'busca'));
		?>
                </td></tr>
                           
            
	<tr>
			<th><?php __('numero');?></th>
			<th><?php __('data_publicacao');?></th>
			<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($unidade['Boletiminterno'] as $boletiminterno):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $boletiminterno['numero']; ?>&nbsp;</td>
		<td><?php echo $boletiminterno['data_publicacao']; ?>&nbsp;</td>
		<td class="actions">

		<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', 'controller' => 'boletiminternos', $boletiminterno['id']),array('escape'=>false, 'escape'=>false), null,false); ?>

		<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', 'controller' => 'boletiminternos', $boletiminterno['id']),array('escape'=>false, 'escape'=>false), null,false); ?>

		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$boletiminterno['id']." ?' ,'boletiminternos".'/delete/'.$boletiminterno['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false); ?>

				</td>
	</tr>
<?php endforeach; ?>
	</table>
    <br>
	
	
	
	
</div>
</center>
    
    

<center>
<div class="licencas index">



	<table cellpadding="0" cellspacing="0">
 <tr><td colspan="15">
         <h1><?php __('LICENÇAS');?>    &nbsp;<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add','controller'=>'licencas', null),array('escape'=>false, 'escape'=>false), null,false); ?>	<p style="margin:0px;float:right;font-size: 10px;"> <b>Registros: <?php echo count($unidade['Licenca']); ?></b></p> </h1>
 	<?php echo $form->create('formFind', array('url' => 'index','id'=>'busca'));
		?>	
        
                </td></tr>
	<tr>
			<th><?php __('unidade_id');?></th>
			<th><?php __('militar_id');?></th>
			<th><?php __('nr_licenca');?></th>
			<th><?php __('indicativo');?></th>
			<th><?php __('codigo_barra');?></th>
			<th><?php __('tipo_licenca');?></th>
			<th><?php __('documento_comprobatorio');?></th>
			<th><?php __('expedicao');?></th>
			<th><?php __('validade');?></th>
			<th><?php __('ticket');?></th>
			<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($unidade['Licenca'] as $licenca):
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
		<td><?php echo $licenca['nr_licenca']; ?>&nbsp;</td>
		<td><?php echo $licenca['indicativo']; ?>&nbsp;</td>
		<td><?php echo $licenca['codigo_barra']; ?>&nbsp;</td>
		<td><?php echo $licenca['tipo_licenca']; ?>&nbsp;</td>
		<td><?php echo $licenca['documento_comprobatorio']; ?>&nbsp;</td>
		<td><?php echo $licenca['expedicao']; ?>&nbsp;</td>
		<td><?php echo $licenca['validade']; ?>&nbsp;</td>
		<td><?php echo $licenca['ticket']; ?>&nbsp;</td>
		<!-- 
		<td>
			<?php echo $this->Html->link($licenca['Ata']['numero'], array('controller' => 'atas', 'action' => 'view', $licenca['Ata']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($licenca['Boletiminterno']['numero'], array('controller' => 'boletiminternos', 'action' => 'view', $licenca['Boletiminterno']['id'])); ?>
		</td>
		 -->
		<td class="actions">

		<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', 'controller'=>'licencas',$licenca['id']),array('escape'=>false, 'escape'=>false), null,false); ?>

		<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', 'controller'=>'licencas',$licenca['id']),array('escape'=>false, 'escape'=>false), null,false); ?>

		<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$licenca['id']." ?' ,'licencas".'/delete/'.$licenca['Licenca']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false); ?>
		
		<?php echo $this->Html->link($this->Html->image('pdf2.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>'PDF')), array('action'=>'indexPdf', $licenca['id']), array('escape'=>false), null,false); ?>

				</td>
	</tr>
<?php endforeach; ?>
	</table>

    <br>	
	
</div>
</center>
    
    
    
    
    
    <center>   
    <div class="Militares">
<table cellspacing="0">
        <tr><td colspan="30">
<h1><?php __('Efetivo');?><?php $script = "var x=(\$('find').value);x =encodeURI(x);if(x.blank()){\$('broffice').href='".$this->webroot."militars/indexExcel/';}else{\$('broffice').href='".$this->webroot."militars/indexExcel/'+x;}";

?>
&nbsp;<?php echo $this->Html->link($this->Html->image('broffice.png', array('alt'=> __('BROffice', true), 'border'=> '0', 'title'=>'Dados em planilha BROffice', 'onmouseover'=>$script )), array('action'=>'indexExcel'), array('id'=>'broffice','escape'=>false), null,false); ?>
&nbsp;<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false); ?><p style="margin:0px;float:right;font-size: 10px;"> <b>Registros: <?php echo count($unidade['Militar']); ?></b></p> </h1>
	<?php echo $form->create('formFind', array('url' => 'index','type'=>'file','action' => 'index','controller' => 'militars','id'=>'busca','onsubmit'=>'sql();')); ?>	
               </td></tr>
                            <tr><td colspan="30">
            
                        </td></tr>
	<tr>
		<th><?php echo 'Foto';?></th>
		<th><?php echo __('identidade');?></th>
		<th><?php echo __('rc');?></th>
		<th><?php echo __('Quadro','quadro_id');?></th>
		<th><?php echo __('Esp','especialidade_id');?></th>
		<th>Unidade</th>
		<th><?php echo __('setor_id');?></th>
		<th><?php echo __('posto_id');?></th>
		<th><?php echo __('saram');?></th>
<?php if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)){ ?>
		<th><?php echo __('cpf');?></th>
<?php } ?>	<th><?php echo __('nm_completo');?></th>
		<th><?php echo __('nm_guerra');?></th>
		<th><?php echo __('nr_licenca');?></th>
		<th><?php echo __('indicativo');?></th>
		<th><?php echo __('eplis_nota');?></th>
		<th><?php echo __('dt_licenciamento');?></th>
		<th><?php echo __('obs');?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
			//print_r($quadros);
	
	$i = 0;
	$conta = 0;
	
	foreach ($unidade['Militar'] as $militar):
	
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
		if($militar['Militar']['ativa']==0){
		$td = ' style="background-color:#F0D0D0;" ';
	}else{
		$td='';
	}
	?>
	<tr   <?php echo $class.' id='.$conta; ?>>
		<td<?php echo $td;?>><?php
		if(isset($militar['Foto']['id'])){
			$img = $militar['Foto']['id'];
		    echo $this->Html->image(array('controller'=> 'fotos', 'action'=>'externodownload',$img), array( 'border'=> '0' ,'width'=>'40', 'height'=>'30')); //  
		}else{
			$img = 'sem_imagem.png';
		    echo $this->Html->image('sem_imagem.png', array( 'border'=> '0', 'width'=>'40', 'height'=>'30' )); 
		}
		?>
		</td>
		<td<?php echo $td;?>><?php echo $militar['identidade']; ?>
		</td>
		<td<?php echo $td;?>><?php echo $militar['rc']; ?>
		</td>
		<td<?php echo $td;?>><?php echo $militar['Quadro']['sigla_quadro']; ?>
		</td>
		<td<?php echo $td;?>><?php echo $this->Html->link($militar['Especialidade']['nm_especialidade'], array('controller'=> 'especialidades', 'action'=>'view', $militar['Especialidade']['id'])); ?>
		</td>
		<td<?php echo $td;?>><?php echo $this->Html->link($militar['Unidade']['sigla_unidade'], array('controller'=> 'unidades', 'action'=>'view', $militar['unidade_id'])); ?>
		</td>
		<td<?php echo $td;?>><?php echo $this->Html->link($militar['Setor']['sigla_setor'], array('controller'=> 'setors', 'action'=>'view', $militar['Setor']['id'])); ?>
		</td>
		<td<?php echo $td;?>><?php echo $this->Html->link($militar['Posto']['sigla_posto'], array('controller'=> 'postos', 'action'=>'view', $militar['Posto']['id'])); ?>
		</td>
		<td<?php echo $td;?>><?php echo $militar['saram']; ?></td>
<?php if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)){ ?>
		<td<?php echo $td;?>><?php echo str_pad($militar['cpf'], 11, "0", STR_PAD_LEFT); ?></td>
<?php } ?>	<td<?php echo $td;?>><?php echo $militar['nm_completo']; ?></td>
		<td<?php echo $td;?>><?php echo $militar['nm_guerra']; ?></td>
		<td<?php echo $td;?>><?php echo $militar['nr_licenca']; ?></td>
		<td<?php echo $td;?>><?php echo $militar['indicativo']; ?></td>
		<td<?php echo $td;?>><?php echo $militar['eplis_nota'].' - '.$militar['eplis_ano']; ?></td>
		<!-- <td<?php echo $td;?>><?php echo $militar['situacao']; ?></td> -->
		<td<?php echo $td;?>><?php echo $militar['dt_licenciamento']; ?></td>
		<td<?php echo $td;?>><?php echo $militar['obs']; ?></td>
		<td class="actions"<?php echo $td;?>>
		<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('controller'=> 'militars','action'=>'view', $militar['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('controller'=> 'militars','action'=>'edit', $militar['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		
		<?php 
			if($militar['ativa']>0){
			$mdown = "dialogo('Deseja realmente excluir o registro #".$militar['nm_completo']." ?' ,'".$this->webroot.'militars/delete/'.$militar['id']."');"; 
			 echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>$mdown,'onclick'=>"this.href='#';return false;", 'escape'=>false), null,false); 
			}
		?>
		<?php echo $this->Html->link($this->Html->image('pdf2.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>'PDF')), array('action'=>'indexPdf', $militar['id']), array('escape'=>false), null,false); ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>        
        <br>
</div>
    </center>
    
    
<div class="related">
	<h3><?php __('Órgãos');?></h3>
	<?php if (!empty($unidade['Orgao'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Unidade Id'); ?></th>
		<th><?php __('Descricao Orgao'); ?></th>
		<th><?php __('Chefe Orgao'); ?></th>
		<th><?php __('Sigla Orgao'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($unidade['Orgao'] as $orgao):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $orgao['id'];?></td>
			<td><?php echo $orgao['unidade_id'];?></td>
			<td><?php echo $orgao['descricao_orgao'];?></td>
			<td><?php echo $orgao['chefe_orgao'];?></td>
			<td><?php echo $orgao['sigla_orgao'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'orgaos', 'action' => 'view', $orgao['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'orgaos', 'action' => 'edit', $orgao['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'orgaos', 'action' => 'delete', $orgao['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $orgao['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Orgao', true), array('controller' => 'orgaos', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Setores');?></h3>
	<?php if (!empty($unidade['Setor'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Unidade Id'); ?></th>
		<th><?php __('Nm Setor'); ?></th>
		<th><?php __('Sigla Setor'); ?></th>
		<th><?php __('Nm Chefe Setor'); ?></th>
		<th><?php __('Tel Setor'); ?></th>
		<th><?php __('Efetivo Previsto'); ?></th>
		<th><?php __('Setor Valido'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($unidade['Setor'] as $setor):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $setor['id'];?></td>
			<td><?php echo $setor['unidade_id'];?></td>
			<td><?php echo $setor['nm_setor'];?></td>
			<td><?php echo $setor['sigla_setor'];?></td>
			<td><?php echo $setor['nm_chefe_setor'];?></td>
			<td><?php echo $setor['tel_setor'];?></td>
			<td><?php echo $setor['efetivo_previsto'];?></td>
			<td><?php echo $setor['setor_valido'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'setors', 'action' => 'view', $setor['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'setors', 'action' => 'edit', $setor['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'setors', 'action' => 'delete', $setor['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $setor['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Setor', true), array('controller' => 'setors', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Testeop candidatos');?></h3>
	<?php if (!empty($unidade['Testeopcandidato'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Unidade Id'); ?></th>
		<th><?php __('Setor Id'); ?></th>
		<th><?php __('Testeopprovasagendada Id'); ?></th>
		<th><?php __('Militar Id'); ?></th>
		<th><?php __('Nm Candidato'); ?></th>
		<th><?php __('Nota01'); ?></th>
		<th><?php __('Nota02'); ?></th>
		<th><?php __('Nota03'); ?></th>
		<th><?php __('Nota04'); ?></th>
		<th><?php __('Status01'); ?></th>
		<th><?php __('Status02'); ?></th>
		<th><?php __('Status03'); ?></th>
		<th><?php __('Status04'); ?></th>
		<th><?php __('Obs01'); ?></th>
		<th><?php __('Obs02'); ?></th>
		<th><?php __('Obs03'); ?></th>
		<th><?php __('Obs04'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($unidade['Testeopcandidato'] as $testeopcandidato):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $testeopcandidato['id'];?></td>
			<td><?php echo $testeopcandidato['unidade_id'];?></td>
			<td><?php echo $testeopcandidato['setor_id'];?></td>
			<td><?php echo $testeopcandidato['testeopprovasagendada_id'];?></td>
			<td><?php echo $testeopcandidato['militar_id'];?></td>
			<td><?php echo $testeopcandidato['nm_candidato'];?></td>
			<td><?php echo $testeopcandidato['nota01'];?></td>
			<td><?php echo $testeopcandidato['nota02'];?></td>
			<td><?php echo $testeopcandidato['nota03'];?></td>
			<td><?php echo $testeopcandidato['nota04'];?></td>
			<td><?php echo $testeopcandidato['status01'];?></td>
			<td><?php echo $testeopcandidato['status02'];?></td>
			<td><?php echo $testeopcandidato['status03'];?></td>
			<td><?php echo $testeopcandidato['status04'];?></td>
			<td><?php echo $testeopcandidato['obs01'];?></td>
			<td><?php echo $testeopcandidato['obs02'];?></td>
			<td><?php echo $testeopcandidato['obs03'];?></td>
			<td><?php echo $testeopcandidato['obs04'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'testeopcandidatos', 'action' => 'view', $testeopcandidato['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'testeopcandidatos', 'action' => 'edit', $testeopcandidato['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'testeopcandidatos', 'action' => 'delete', $testeopcandidato['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $testeopcandidato['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Testeopcandidato', true), array('controller' => 'testeopcandidatos', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
</center>