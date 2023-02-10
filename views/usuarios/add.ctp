<?php

//print_r($setors);
function Menu_Barra($grupo, $relatorio, $titulo, $fim=1){
	static $id;
	$id++;
	$estiloBarra = "-moz-background-clip: border;-moz-background-origin: padding;-moz-background-size: auto auto;background-attachment: scroll;background-color: #556699;
    background-image: none;background-position: 0 0;background-repeat: repeat;border-left-color-ltr-source: solid;border-left-color-rtl-source: solid;
    border-left-color-value: #000000;border-left-width-ltr-source: physical;border-left-width-rtl-source: physical;visibility:visible;
    border-left-width-value: 6px;color: #FFFFFF;font-size: 1.0em;height: 1.8em;line-height: 1.8;
    margin-left: 0;margin-right: 0;padding-left: 10px;text-align:left;margin-bottom:0px;";
	echo("<div id='{$grupo}' style='background-color:#ffffff;margin:0 0 0 0;padding:0 0 0 0;'>\n");
	echo("<p style='{$estiloBarra}'>");
	echo("<a id='btabrir{$id}' style='display: block;color: #EEEEEE; float: left; border-style: solid; border-color: white; border-width: 1px;'"); 
	echo(" href=\"javascript:HideContent('btabrir{$id}');ShowContent('btfechar{$id}');ShowContent('{$relatorio}');\">&nbsp;+&nbsp;</a>\n");
	echo("<a id='btfechar{$id}' style='display: none;color: #EEEEEE; float: left; border-style: solid; border-color: white; border-width: 1px;'");  
	echo("href=\"javascript:HideContent('btfechar{$id}');ShowContent('btabrir{$id}');HideContent('{$relatorio}');\">&nbsp;-&nbsp;</a>\n&nbsp;&nbsp;{$titulo} </p>\n");
	if($fim){
		echo("<table cellpadding=0 class='tabelalimpa' cellspacing=0 id='{$relatorio}' style='align:center;' width='auto' >\n");
		echo("<tr><td width='auto'>");
	}
}
?>
<style>
<!--
.tooltiptstyle{
 background-color:#333;
 padding: 1px 3px;
 color: #fff;
 font-size:9px;
position: absolute;
}

-->
</style>
<?php

Menu_Barra('grupo15','relatorio15','CADASTRAR USUARIO',0);

?>

 <table  cellpadding="0" class="tabelalimpa" cellspacing="0" id="relatorio15" style="align:center;" width="100%" >
                    <tbody>
                    <tr><td width="100%">
		<?php echo $form->create('Usuario',array('action'=>'add','type'=>'file','onsubmit'=>'return false;'));
		echo '<input type="hidden" id="UsuarioId" value="'.$this->data['Usuario']['id'].'" name="data[Usuario][id]">';
        //echo $form->input('militar_id',array('onchange'=>"$('UsuarioId').value = null;",'class'=>'formulario'));
        echo '<label for="Consultanomes">Nome</label><input class="formulario" type="text" name="nome" id="nomeparaconsulta"><input type="submit" value="Buscar" name="btnConsultaNome" onclick="consultanome();" class="botoes">';
		echo '<select id="MilitarId"  class="formulario" name="data[Usuario][militar_id]"  '.(empty($this->data['Usuario']['id'])?' onchange="registrasaram();"':'').'>';
		echo '<option value="'.$this->data['Usuario']['militar_id'].'">'.$militars[$this->data['Usuario']['militar_id']].'</option>';
		echo '</select>';
		echo("<div id='carregando'>".$this->Html->image('spinner.gif')."</div>");
		echo '<div class="input text"><p>A senha e a confirmação são o SARAM ao selecionar o usuário.</p></div>';
        echo $form->input('login',array('class'=>'formulario'));
        //echo $form->input('email',array('class'=>'formulario'));
        echo $form->input('senha',array('type'=>'password','class'=>'formulario','id'=>'Senha','value'=>''));
        echo $form->input('confirma_senha',array('type'=>'password','class'=>'formulario','id'=>'ConfirmaSenha','value'=>''));
        echo $form->input('privilegio_id',array('class'=>'formulario'));
        $divisoes['']='';
        $divisoes['OPERACIONAL']='OPERACIONAL';
        $divisoes['ADMINISTRATIVA']='ADMINISTRATIVA';
        $divisoes['TÉCNICA']='TÉCNICA';
        $divisoes['COMANDO']='COMANDO';
        echo $form->input('divisao',array('class'=>'formulario','type'=>'select','options'=>$divisoes,'selected'=>$this->data['Usuario']['divisao']));
		//print_r($this->data);
        echo $form->input('Setor',array('size'=>'20','class'=>'formulario'));
        $datacriacao = date('Y-m-d h:i:s');
        echo $form->hidden('updated',array('value'=>$datacriacao));
        echo $form->hidden('created',array('value'=>$datacriacao));
        ?>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes','onmouseover'=>'$(\'find\').value="";','onclick'=>'$("UsuarioAddForm").submit();'));?>
    
    </td></tr>
                </tbody>
    </table>       
</div>
<script>
//<![CDATA[
function consultanome(){
	new Ajax.Updater($('MilitarId'),'<?php echo $this->webroot; ?>usuarios/externoconsultanomes', {asynchronous:false, evalScripts:false,parameters:Form.serialize($('UsuarioAddForm')), onCreate:function(request, xhr) {ShowContent('carregando');}, onComplete:function(request) {HideContent('carregando');}, requestHeaders:['X-Update', $('MilitarId')]})
}

function registrasaram(){
	if($('MilitarId').value!=''){
		var dados = Form.serialize($('UsuarioAddForm'));
	
		new Ajax.Request('<?php echo $this->webroot; ?>usuarios/externoconsultasaram', {
					method: 'post',
					postBody: dados,
					onSuccess: function(transport) {
		
					var resultado = transport.responseText.evalJSON(true);
					$('UsuarioLogin').value=resultado.identidade;
					$('Senha').value=resultado.saram;
					$('ConfirmaSenha').value=resultado.saram;

				}
		})
	}
}	
HideContent('carregando');

<?php 
if(empty($temID)){ 
echo "HideContent('relatorio15');";
 }else{
echo "ShowContent('relatorio15');";
 }  
?>
</script>   

<br>
<br>
<div class="usuarios index">
<h2>Usuários atualmente cadastrados</h2>
<?php
echo $form->create('formFind', array('url' => 'add','id'=>'busca'));

echo $form->input('find', array('value' => $findUrlNotCleaned, 'label'
=> '', 'type' => 'text', 'id' => 'find', 'class' => 'teste',
'size' => '30', 'maxlength' => '100','class'=>'formulario'));

echo $form->end(array('label'=>'Buscar','class'=>'botoes'));
?>
<h3>
<?php
//echo $paginator->counter(array('format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start%, até %end%', true)));
?></h3>
<script language="javascript">
function ExibeDica(mensagem){

	$('alertaSistemaTitulo').setStyle('tooltiptstyle');
	$('alertaSistemaTitulo').setStyle({
		backgroundColor: '#90a000',
		fontSize: '12px',
		width: '20%'
		});
	$('mensagem').setStyle('tooltipstyle');
	$('mensagem').setStyle({
		backgroundColor: '#90a000',
		fontSize: '12px',
		width: '20%'
		});
 	$('alertaSistemaTitulo').innerHTML = '<b>Setores</b>';
 	$('alertaSistema').innerHTML = mensagem;
	ShowContent('mensagem');
	
}
function EscondeDica(){
	HideContent('mensagem');
}
</script>

<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('militar_id');?></th>
	<th><?php echo $paginator->sort('privilegio_id');?></th>
		<th><?php echo $paginator->sort('divisao');?></th>
		<th class="actions"><?php __('Ações');?></th>
</tr>
<?php
$i = 0;
$qtd = 0;
foreach ($usuarios as $usuario):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
<?php
$flag = 0;
$conteudo = '';
	//print_r($usuario['Setor']);
	//print_r($dicas);exit();
foreach($dicas as $dica){
	$conteudo = '';
	if(($dica['usuarios']['militar_id']==$usuario['Militar']['id']) && ($dica['usuarios']['privilegio_id']==$usuario['Privilegio']['id'])){
		$qtd++;
$conteudo =<<<CONTEUDO
<tr  $class onmouseover='EscondeDica();ExibeDica("{$dica[0]['setores']}")'  ">
<td>{$this->Html->link($militars[$usuario['Militar']['id']], array('controller'=> 'militars', 'action'=>'view', $usuario['Militar']['id']))}</td>
<td>{$this->Html->link($usuario['Privilegio']['descricao'], array('controller'=> 'usuarios', 'action'=>'view', $usuario['Usuario']['id']))}</td>
<td>{$usuario['Privilegio']['divisao']}</td>
<td class="actions">{$this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'add', $usuario['Usuario']['id']),array('escape'=>false, 'escape'=>false), null,false)}
{$this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$usuario['Militar']['nm_completo']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$usuario['Usuario']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false)}
</td>
CONTEUDO;
	
		break;
	}
}

echo $conteudo; 	


?>
	</tr>
<?php endforeach; ?>
<tr>
<td></td>
<td></td>
<td>Total:</td>
<td><b><?php echo $qtd; ?></b></td>
</tr>
</table>
</div>
<div class="paging"><?php echo $paginator->prev('<< '.__('Anterior', true), array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
| <?php echo $paginator->numbers(array('modulus'=>200,'onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"));?> <?php echo $paginator->next(__('Próxima', true).' >>', array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
</div>
<br></br>
<br></br>
