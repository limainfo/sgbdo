<?
include('../views/funcoes_henrique.ctp');
?>
<br>
<div class="escalas form">
<center>
<?php 

//print_r($data);

$anos = array();
$ano = date('Y')+1;
$anoa = date('Y')-1;
for ($inicio=$anoa; $inicio<=$ano;$inicio++){
    $anos[$inicio]=$inicio;
}

if(empty($this->data['Escala']['mes'])){
    $this->data['Escala']['mes'] = date('n');
    $this->data['Escala']['ano'] = date('Y');
}
//$data['Escala']['mes']}
echo $form->create('Escala',array('action'=>'geraescala'));


if(!empty($data['Escala']['mes'])){
echo $form->select('mes', $mes ,$data['Escala']['mes'] ,array('onChange'=>"",'class'=>'botoes'), false);
}else{
echo $form->select('mes', $mes ,$this->data['Escala']['mes'] ,array('onChange'=>"",'class'=>'botoes'), false);
}
//echo $u[0]['Usuario']['privilegio_id'];
echo $form->select('ano', $anos ,$this->data['Escala']['ano'] ,array('onChange'=>"",'class'=>'botoes'), false);
echo "<input type=\"hidden\" id=\"EscalaMesAtual\" name=\"data[Escala][mesAtual]\" value=\"{$this->data['Escala']['mes']}\">";
echo "<input type=\"hidden\" id=\"EscalaAnoAtual\" name=\"data[Escala][anoAtual]\" value=\"{$this->data['Escala']['ano']}\">";
echo "<input type=\"submit\" value=\"Consultar mês e ano selecionados\" class=\"botoes\" onmousedown=\"$('EscalaGeraescalaForm').action='{$this->webroot}escalas/add';\" />";

echo $form->end();

?>
</center>
<?
Menu_Barra('grupo15','relatorio15','CADASTRAR ESCALA',0);
echo $form->create('Escala',array('onsubmit'=>'return false;', 'inputDefaults' => array('div' => true)));
?>
 <table  cellpadding="0" class="tabelalimpa" cellspacing="0" id="relatorio15" style="align:center;" width="100%" >
                    <tbody>
                    <tr><td width="100%">

<script type="text/javascript">
function clickElement(elementid)
	{
	var e = document.getElementById(elementid);
		if (typeof e == 'object')
		{
			//alert( "type object" );
			if(document.createEventObject)
			{
				//alert('createEventObject');
				e.fireEvent('onclick');
				return false;
			}
			else if(document.createEvent)
			{
				//alert('createEvent');
				var evObj = document.createEvent('MouseEvents');
				evObj.initEvent('click',true,true);
				e.dispatchEvent(evObj);
				return false;
			}else
				{
					//alert('click');
					e.click();
					return false;
				}
			}
		//else
			//alert( "not type object" );
		}
</script> 
        <table><tr><th>ANO</th><th>MÊS</th><th>STATUS</th><th>TIPO</th></tr>
        <tr>
            <td><input type="text" size="4" name="data[Escala][ano]" readonly	value="<?php echo $this->data['Escala']['ano']; ?>" class="formulario"></td>
            <td><input type="text" size="4" name="data[Escala][mes]" readonly	value="<?php echo $this->data['Escala']['mes']; ?>" class="formulario"></td>
            <td><select id="EscalaAtiva" name="data[Escala][ativa]" class="formulario">
                <option value="1" >ATIVA</option><option value="0" >DESATIVADA</option>	</select></td>
            <td><select id="EscalaTipo"  name="data[Escala][tipo]" class="formulario">
                <option value="OPERACIONAL" >OPERACIONAL</option><option value="RISAER" >RISAER</option><option value="TECNICA" >TECNICA</option>
                <option value="<?php echo $data['Escala']['tipo'];?>" selected><?php echo $data['Escala']['tipo']; ?></option></select></td>
        </tr>
        <tr><th colspan="4">SETOR</th></tr>        
        <tr><td colspan="4"><select id="EscalaSetorId" name="data[Escala][setor_id]" class="formulario">
                <?php
		foreach ($setors as $dados){
			if($edit && ($data['Setor']['id']==$dados['Setor']['id'])){
				echo '<option value="'.$dados['Setor']['id'].'" selected>'.$dados[0]['setor'].'</option>';
			}else{
				echo '<option value="'.$dados['Setor']['id'].'" >'.$dados[0]['setor'].'</option>';
			}

		}
                ?>
                </select></td></tr>    
        <tr><th colspan="4">NOME ESCALANTE</th></tr>        
         <tr><td colspan="4"><select id="EscalaNmEscalante" name="data[Escala][nm_escalante]" class="formulario">
                <?php
		echo '<option value="" selected></option>';
		$sinalizador=0;
		foreach ($chefeID as $dados){
			if($edit && ($data['Escala']['nm_escalante']==$dados)){
				$sinalizador=1;
				echo '<option value="'.$dados.'" selected>'.$dados.'</option>';
			}else{
				echo '<option value="'.$dados.'">'.$dados.'</option>';
			}

		}
		echo '<option value="'.$data['Escala']['nm_escalante'].'" selected>'.$data['Escala']['nm_escalante'].'</option>';
                ?>
                </select></td></tr>    
        <tr><th colspan="4">NOME CHEFE ÓRGÃO</th></tr>        
        <tr><td colspan="4"><select id="EscalaNmChefeOrgao" name="data[Escala][nm_chefe_orgao]" class="formulario">
                <?php
		echo '<option value="" selected></option>';
		foreach ($chefe as $dados){
				echo '<option value="'.$dados.'">'.$dados.'</option>';
		}
		echo '<option value="'.$data['Escala']['nm_chefe_orgao'].'" selected>'.$data['Escala']['nm_chefe_orgao'].'</option>';
                ?>
                </select></td></tr>    
        <tr><th colspan="4">CHEFE DA ESCALA</th></tr>        
         <tr><td colspan="4">
                <input type="text" id="EscalaNmComandante" maxlength="60" inputdefaults="" size="40" class="formulario" name="data[Escala][nm_comandante]"> <select id="EscalaNmComandanteComplete" name="EscalaNmComandanteComplete" class="formulario" onchange="$('EscalaNmComandante').value = this.options[this.options.selectedIndex].value;">
                <?php
                        $select1 = '<option value="MARIO LUIS RIBEIRO SANTOS TCEL AV.">MARIO LUIS RIBEIRO SANTOS TCEL AV.</option>';
                        $select1 .= '<option value="GUILHERME RUY ALVES DE SOUZA CEL AV.">GUILHERME RUY ALVES DE SOUZA CEL AV.</option>';
                        $select1 .= '<option value="MARCOS DA SILVA LAURO CEL AV.">MARCOS DA SILVA LAURO CEL AV.</option>';
                        $select1 .= '<option value="'.$data['Escala']['nm_comandante'].'" selected>'.$data['Escala']['nm_comandante'].'</option>';
                        $select1 .= '<option value="" selected="selected"></option>';
                        echo $select1;
                ?></select></td></tr>
        <tr><th colspan="2">DIA LIMITE PREVISTA (Mês anterior)</th><th colspan="2">DIA LIMITE CUMPRIDA (Mês posterior)</th></tr>        
        <tr><td colspan="2">
                <?php
                    for($i=1;$i<=28;$i++){
                            $qtds["$i"]=$i;
                    }
 		echo $form->input('dt_limite_previsao',array('type'=>'select','options'=>array('empty'=>'',$qtds),'selected'=>$data['Escala']['dt_limite_previsao'],'class'=>'formulario','label'=>false));
                ?> 
            </td>
            <td colspan="2">
               <?php
 		echo $form->input('dt_limite_cumprida',array('type'=>'select','options'=>array('empty'=>'',$qtds),'selected'=>$data['Escala']['dt_limite_cumprida'],'class'=>'formulario','label'=>false));
               ?> 
                 
            </td></tr>        

        </table>
                        
                <?php
			
echo $form->end(array('onmousedown'=>$script,'label'=>'Cadastrar','class'=>'botoes'));
		

		
		echo '<hr>';
		
		
$raiz = $this->webroot;
	


		echo $ajax->div('opcoes');
		
		echo $ajax->divEnd('opcoes');
                

		


//echo $jscript;
?>

   </td></tr>
                </tbody>
    </table>       
</div></div>
<?php 

//print_r($data);

Menu_Barra('grupo40','relatorio40','ATUALIZAR CHEFES',0);
?>
 <table  cellpadding="0" class="tabelalimpa" cellspacing="0" id="relatorio40" style="align:center;" width="100%" ><tr><td>
<?php
//$data['Escala']['mes']}
//$tipo[0]='SELECIONE O TIPO';
$tipo['OPERACIONAL']='OPERACIONAL';
$tipo['RISAER']='RISAER';
$tipo['TECNICA']='TECNICA';
echo $form->create('Escala',array('action'=>'','onsubmit'=>'return false;','type'=>'file', 'id'=>'EscalaChefes'));
echo $form->input('tipo_escala', array('type'=>"select",'class'=>'formulario','options'=>$tipo, 'id'=>'EscalaChefesTipoEscala'), false);
echo $form->input('nome_chefe', array('onChange'=>"",'class'=>'formulario', 'size'=>'100', 'id'=>'EscalaChefesNomeChefe'), false);
echo "<input type=\"submit\" value=\"Ajustar nomes dos chefes\" class=\"botoes\" onclick=\"enviaChefe();\" />";

echo $form->end();

?>
         </td></tr></table>
<script>
    function enviaChefe() {
	if($('EscalaChefesNomeChefe').value==''){
            $('mensagemerro').innerHTML  = '<p style="background-color:#e0c000;margin:0px;color:#800000;text-align:center;">Campo não preenchido corretamente:<br></p><p style="background-color:#d0d0f0;padding:0px;color:#800000;text-align:center;margin:0px;">Deve ser informado o nome do Chefe!</p>';
            ShowContent('mensagemtela');
            return false;
	}
	var dados = $('EscalaChefes').serialize();
	new Ajax.Request('<?php echo $this->webroot; ?>escalas/externochefes', {
            method: 'post',
            postBody: dados,
            onSuccess: function(transport) {
                var resultado = transport.responseText.evalJSON(true);
                if (resultado.ok==0){
                    $('mensagemerro').innerHTML = "<p>Registro não atualizado!</p>";
                    ShowContent('mensagemtela');
                }else{
                   // $(id).innerHTML = unescape(resultado.mensagem);
                    $('mensagemerro').innerHTML = "<p>Registros atualizados!</p>";
                    ShowContent('mensagemtela');
                }
            }})
        
        
        return false;
    }
    HideContent('relatorio40');
    
<?php 
if(empty($temID)){ 
//echo "HideContent('relatorio15');";
 }else{
echo "ShowContent('relatorio15');";
 }  
?>
</script>   
<BR>
<?php 

?>
<div class="escalas index">
<?php 
					$caminhop = $this->webroot.'escalas/externoPdf/'.$this->data['Escala']['ano'].'/'.$this->data['Escala']['mes'];

//$this->data['Escala']['ano']?>
<div id="grupo16" style="background-color:#ffffff;margin:0 0 0 0;padding:0 0 0 0;">
<p style="-moz-background-clip: border;-moz-background-origin: padding;-moz-background-size: auto auto;background-attachment: scroll;background-color: #7080b0;
    background-image: none;background-position: 0 0;background-repeat: repeat;border-left-color-ltr-source: solid;border-left-color-rtl-source: solid;
    border-left-color-value: #000000;border-left-width-ltr-source: physical;border-left-width-rtl-source: physical;visibility:visible;
    border-left-width-value: 6px;color: #000000;font-size: 1.0em;height: 1.8em;line-height: 1.8;
    margin:0 0 0 0;padding-top: 0px;padding-left: 10px;text-shadow: 1px 1px 1px #FFFFFF;text-align:left;margin-botton:0px;">
   ESCALAS CADASTRADAS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('broffice.png', array('alt'=> __('BROffice', true), 'border'=> '0', 'title'=>'Dados em planilha BROffice')), array('action'=>'indexExcel/'.$this->data['Escala']['ano'].'/'.$this->data['Escala']['mes']), array('id'=>'broffice', 'escape'=>false), null,false); ?>
                <a  onclick="window.open('<?php echo $caminhop; ?>','','');"><?php echo $this->Html->image('pdf2p.gif', array('alt'=> __('PDF', true), 'border'=> '0', 'title'=>'Gerar PDF das Escalas', 'id'=>'pdfp')); ?>
                </a>
</p>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="50%">
<?php 

//print_r($data);

$anos = array();
$ano = date('Y')+1;
$anoa = date('Y')-1;
for ($inicio=$anoa; $inicio<=$ano;$inicio++){
    $anos[$inicio]=$inicio;
}

if(empty($this->data['Escala']['mes'])){
    $this->data['Escala']['mes'] = date('n');
    $this->data['Escala']['ano'] = date('Y');
}
echo $form->create('Escala',array('action'=>'delete','onsubmit'=>'return false;', 'type'=>'file','id'=>'Exclusao'));
echo $form->hidden('mes',array('value'=>$this->data['Escala']['mes']));
echo $form->hidden('ano',array('value'=>$this->data['Escala']['ano']));
echo "<input type=\"hidden\" id=\"EscalaMesAtual\" name=\"data[Escala][mesAtual]\" value=\"{$this->data['Escala']['mes']}\">";
echo "<input type=\"hidden\" id=\"EscalaAnoAtual\" name=\"data[Escala][anoAtual]\" value=\"{$this->data['Escala']['ano']}\">";
echo "<input type=\"submit\" value=\"Excluir escalas selecionadas\" class=\"botoesalerta\"  onClick=\"submitForm('excluir');return false;\"  />";

echo $form->end();


?>
<script type="text/javascript">
function mensagem(texto){
    Dialogs.confirm(
                texto,
                function(){
                        return true;
                        Dialogs.close();
                },
                function(){
                        return false;
                        Dialogs.close();
                }
        );
}    
    
function submitForm(acao) {
    /*
    usa método request() da classe Form da prototype, que serializa os campos
    do formulário e submete (por POST como default) para a action especificada no form
    */

    if(acao=='excluir'){
        Dialogs.confirm(
                'TEM CERTEZA QUE DESEJA EXCLUIR AS ESCALAS SELECIONAS DE <?php echo $this->data['Escala']['mes'].'/'.$this->data['Escala']['ano']; ?> ???',
                function(){
                    var formulario01= $('Exclusao');       
                    var formulario02= $('EscalaAcoes');       
                    var destino = 'delete';
                    var dados01 = Form.serialize(formulario01);
                    var dados02 = Form.serialize(formulario02);
                    var dados = dados01+dados02.gsub('_method=POST','');
                        new Ajax.Request('<?php echo $this->webroot; ?>escalas/'+destino, {
                                method: 'post',
                                postBody: dados,
                                onSuccess: function(transport) {

                                var resultado = transport.responseText.evalJSON(true);
                                $('alertaSistema').innerHTML = resultado.mensagem;
                                ShowContent('mensagem');

                        }})
                    Dialogs.close();
                },
                function(){
                        return false;
                        Dialogs.close();
                }
        );
                    
        }
    if(acao=='duplicar'){
        Dialogs.confirm(
                'QUER REALMENTE TENTAR DUPLICAR OS REGISTROS SELECIONADOS ?',
                function(){        
                    var formulario01= $('Duplicacao');       
                    var formulario02= $('EscalaAcoes');       
                    var destino = 'geraescala';
                    var dados01 = Form.serialize(formulario01);
                    var dados02 = Form.serialize(formulario02);
                    var dados = dados01+dados02.gsub('_method=POST','');
                        new Ajax.Request('<?php echo $this->webroot; ?>escalas/'+destino, {
                                method: 'post',
                                postBody: dados,
                                onSuccess: function(transport) {

                                var resultado = transport.responseText.evalJSON(true);
                                $('alertaSistema').innerHTML = resultado.mensagem;
                                ShowContent('mensagem');

                        }})
                    Dialogs.close();
                },
                function(){
                        return false;
                        Dialogs.close();
                }
        );
       }
    
        
        return false;
    }

$('mensagem').observe('mensagem:fechada', function(event){
    if(event.memo.mensagemId==0){
        location.reload();
     }
});

</script>
</td>
<td width="50%">
<?php 

//print_r($data);

$anos = array();
$ano = date('Y')+1;
$anoa = date('Y')-1;
for ($inicio=$anoa; $inicio<=$ano;$inicio++){
    $anos[$inicio]=$inicio;
}

if(empty($this->data['Escala']['mes'])){
    $this->data['Escala']['mes'] = date('n');
    $this->data['Escala']['ano'] = date('Y');
}
echo $form->create('Escala',array('action'=>'geraescala','onsubmit'=>'return false;', 'type'=>'file','id'=>'Duplicacao'));
   echo $form->hidden('mes',array('value'=>$this->data['Escala']['mes']));
   echo $form->hidden('ano',array('value'=>$this->data['Escala']['ano']));
   if($u[0]['Usuario']['privilegio_id']!=12){
   echo "<input type=\"submit\" value=\"Duplicar escalas do mês selecionado para o mês ->\" class=\"botoes\"   onClick=\"submitForm('duplicar');return false;\"  style=\"float:none;\" />";
   echo $form->select('mesdestino', $mes ,$this->data['Escala']['mes'] ,array('class'=>'botoes'), false);
   echo $form->select('anodestino', $anos ,$this->data['Escala']['ano'] ,array('class'=>'botoes'), false);
   }
echo $form->end();


?>

</td>
</tr>
</table>

</div>
<?php
echo $form->create('Escala', array('controller'=> 'Escala', 'action'=>'null','id'=>'EscalaAcoes'));

//echo $paginator->counter(array('format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start%, até %end%', true)));
?></h3>
<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php __('cidade_id');?></th>
		<th><?php __('unidade_id');?></th>
		<th><?php __('setor_id');?></th>
		<th><?php __('nm_escalante');?></th>
		<th><?php __('nm_chefe_orgao');?></th>
		<th><?php __('mes');?></th>
		<!-- 	<th><?php __('dt_limite_cumprida');?></th>
		<th><?php __('dt_limite_previsao');?></th>
 -->
        <th class="actions">Modificar</th>
        <th>SELECIONAR<a  style="padding: 1px; font-size: 0.8em;"><img border="0" id="todos01" title="" alt="" src="<?php echo $this->webroot; ?>img/accept.png"/></a></th>
	</tr>
	<?php
	$i = 0;
	echo '<pre>';
	//print_r($setors);
	echo '</pre>';

	foreach ($escalas as $escala):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	if($escala['Escala']['ativa']==0){
		$td = ' style="background-color:#F0D0D0;" ';
	}else{
		$td='';
	}
	?>
	<tr <?php echo $class;?>>
		<td<?php echo $td;?>><?php echo $this->Html->link($escala['Cidade']['nome'], array('controller'=> 'estados', 'action'=>'view', $escala['Estado']['id'])); ?>
		</td>
		<td<?php echo $td;?>><?php echo $this->Html->link($escala['Unidade']['sigla_unidade'], array('controller'=> 'unidades', 'action'=>'view', $escala['Unidade']['id'])); ?>
		</td>
		<td<?php echo $td;?>><?php echo $this->Html->link($escala['Setor']['sigla_setor'], array('controller'=> 'setors', 'action'=>'view', $escala['Setor']['id'])); ?>
		</td>
		<td<?php echo $td;?>><?php echo $escala['Escala']['nm_escalante']; ?></td>
		<td<?php echo $td;?>><?php echo $escala['Escala']['nm_chefe_orgao']; ?></td>
		<td<?php echo $td;?>><?php echo $escala['Escala']['mes'].'/'.$escala['Escala']['ano']; ?></td>
		<!-- 		
		<td<?php echo $td;?>><?php echo $escala['Escala']['dt_limite_previsao']; ?></td>
		<td<?php echo $td;?>><?php echo $escala['Escala']['dt_limite_cumprida']; ?></td>
 -->
		<td class="actions"><?php //echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $escala['Escala']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'add', $escala['Escala']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php
	//	echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$escala['Setor']['sigla_setor']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$escala['Escala']['id']."');",'onclick'=>"return false;",'escape'=>false, 'escape'=>false), null,false); 
		?><?php //echo "<input type=\"image\" id='imgturno' border=1 src=\"{$this->webroot}webroot/img/duplicar.gif\" onmousedown=\"$('idEscala').value=".$escala['Escala']['id'].";$('login').show();\"  onkeydown=\"$('idEscala').value=".$escala['Escala']['id'].";$('login').show();\" title=\"Duplicar\"/>"; ?>
		</td>
        <td>
            <input type="checkbox" name="data[Escala][ids][]" id="ids<?php echo $escala['Escala']['id']; ?>" value="<?php echo $escala['Escala']['id']; ?>">
        </td>
	</tr>
	<?php endforeach; ?>
</table>
<?php
echo $form->hidden('statusid',array('value'=>'0', 'id'=>'statusid')); 
echo $form->end();
?>
</div>
<!-- 
<div class="paging"><?php //echo $paginator->prev('<< '.__('Anterior', true), array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
| <?php //echo $paginator->numbers(array('modulus'=>200,'onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"));?> <?php //echo $paginator->next(__('Próxima', true).' >>', array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
</div>
 -->
<?php 


/*
 * 
 echo '<hr><div class="input select required"><label for="EscalaSelectMilitares">Selecione a Escala</label><select id="EscalaSelectEscalas"  class="formulario">';
		foreach ($escalas as $escala){
			echo '<option value="'.$escala['Escala']['id'].'">'.$escala['Cidade']['nome'].'-'.$escala['Unidade']['sigla_unidade'].'-'.$escala['Setor']['sigla_setor'].'-'.$escala['Escala']['mes'].'/'.$escala['Escala']['ano'].'</option>';

		}
		echo '</select></div>';
		*/	
?>
<script type="text/javascript">
    Event.observe('todos01', 'click', function(event) {
    var status = $('statusid').value;    
    var formulario = $('EscalaAcoes');
    var x =formulario.getInputs('checkbox');
    for(i=0;i<x.size();i++){
           nome = x[i].id; 
           if(nome.startsWith('ids')){
               if(status==1){
               x[i].checked = false;
               }else{
                x[i].checked = true;
               }
           }
        }
    if(status==0){
    	$('statusid').value = 1;
     }else{
         $('statusid').value = 0;
     }
    }
    
    
     );
     //, false          

     //, false          
</script>
<div style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 20%; border: 2px solid rgb(0, 0, 0); z-index: 1010" id="mensagemtela">
<p  style="padding:0px;height:20px;background-color: #800000; color: #fff; margin: 0px; vertical-align: top;text-align:center; border: 2px; border-color: #000;">MENSAGEM DO SISTEMA<a href="javascript:HideContent('mensagemtela');"  style="float:right;background-color:#ffffff;" id="msgfechar">X</a></p>
<div id='mensagemerro'>
</div>