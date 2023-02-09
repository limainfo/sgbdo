<div id="detalhes" style="display: block; position: absolute; background-color: white; padding: 0px; width: 20%; border: 2px solid rgb(0, 0, 0); z-index: 1000; left: 423px; top: 365px;">
<p style="padding: 0px; height: 20px; background-color: rgb(160, 171, 188); color: rgb(255, 255, 255); margin: 0px; vertical-align: top; text-align: center; border: 2px none rgb(0, 0, 0);" id="campo">Descrição<a href="javascript:HideContent('detalhes');" onclick="HideContent('detalhes');" style="float: right; margin: 0px;"><img border="0" width="15" height="15" src="/operacional/img/lixo.gif" alt="Excluir" title="Excluir"> </a></p>
<p style="margin: 0px; background-color: rgb(255, 255, 0); border: 1px solid rgb(0, 0, 0);"></p><div id="detalhe">publicações: o rotaer, a aip-brasil, a aip-map e as cartas (erc) expostas nos murais existentes na sala estão atualizados, porém as publicações previstas no anexo c da ica 53-2 como necessárias a uma sala ais, estão incompletas, muitas estão desatualizadas e não estão colecionadas em pastas distintas por tema ou assunto (ais, ats, com, met, sar, etc...), conforme previsto no item 4.2.1 da ica 53-2. os operadores foram orientados a solicitar, via mensagem rádio, diretamente ao pame, todas as publicações que necessitem.   </div>
<script type="text/javascript">
&lt;!--
new Draggable('detalhes');
//--&gt;
</script>
</div>
<?php 
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

//$privilegioAtivo = 'EXECUTANTE';

$privilegio['EXECUTANTE'] = 'EXECUTANTE';
$privilegio['GERENTE LOCAL'] = 'GERENTE LOCAL';
$privilegio['GERENTE REGIONAL'] = 'GERENTE REGIONAL';

echo $form->create('Escala',array('action'=>'externoindex'));
echo $form->select('mes', $mes ,$this->data['Escala']['mes'] ,array('onChange'=>"",'class'=>'formulario'), false);
echo $form->select('ano', $anos ,$this->data['Escala']['ano'] ,array('onChange'=>"",'class'=>'formulario'), false);
echo "<input type=\"submit\" value=\"Consultar mês e ano selecionados\" class=\"botoes\" onmousedown=\"$('EscalaExternoindexForm').action='{$this->webroot}ocorrencias/externoindex';\" />";
//echo $form->select('privilegio', $privilegio ,$this->data['Escala']['privilegio'] ,array('onChange'=>"",'class'=>'formulario','label'=>'Privilegio'), false);
echo $form->end();

echo $form->create('Escala',array('onsubmit'=>'return false;'));

?>

<table cellpadding="0" cellspacing="0">
	<tr>
		<td style="background-color: #000099;"><b><font size="2"
				color="#ffff00">LIVRO DE REGISTRO DE OCORRÊNCIAS</font></b></td>
	</tr>
	<tr>
		<td style="font-size:1.1em;align:center;float:center;">
		<p><?php
		$raiz = $this->webroot;
		$i = 0;
		
		foreach ($ocorrencias as $ocorrencia):
		?> <?php
$link=<<<TEXTO
<a onclick="var x=screen.height;var y=screen.width;window.open('{$raiz}escalas/escala/{$ocorrencia['Setor']['id']}/09/2009','','height=x,width=y,toolbar=0,scrollbars=1,directories=0,status=0');" href="#" style="padding: 1px; font-size: 0.8em;">
				<img border="0" src="/operacional/img/zerar.png" alt="Exibir" title="Editar"/></a>
TEXTO;
		
	//echo $link.$this->Html->link('|'.$ocorrencia[0]['Setor'].'|<br>', array('action'=>'externoescala/'.$ocorrencia['Setor']['id'], null),array('id'=>$ocorrencia['Setor']['id'], 'escape'=>false), null,false);
		?> <?php endforeach;

 ?></p>
<p>
<a onclick="$('dialog-overlay').hide();" id="ACCAZ" href="<?php echo $this->webroot; ?>ocorrencias/externoescala/ACCAZ/0/EXECUTANTE">|ACC AZ EXECUTANTE|</a><BR>
<a onclick="$('dialog-overlay').hide();" id="ACCAZ" href="<?php echo $this->webroot; ?>ocorrencias/externoescala/ACCAZ/0/GERLOCAL">|ACC AZ GERENTE LOCAL|</a><BR>
<a onclick="$('dialog-overlay').hide();" id="ACCAZ" href="<?php echo $this->webroot; ?>ocorrencias/externoescala/ACCAZ/0/GERREGIONAL">|ACC AZ GERENTE REGIONAL|</a><BR>
 <?php
		$raiz = $this->webroot;
		$i = 0;
		
		
		
		$referencia = $livros[0]['Escala']['livro'];
		foreach ($livros as $livro){
		$t01 = $livro['Escala']['livro'];
			if($t01!='ACCAZ'){
				if(($referencia==$livro['Escala']['livro'])){
					echo $this->Html->link('|'.$livro['Setor']['sigla_setor'].'|', array('action'=>'externoescala/'.$livro['Escala']['setor_id'].'/0/'.$privilegioAtivo, null),array('id'=>$livro['Escala']['setor_id'],'onclick'=>'$(\'dialog-overlay\').hide();', 'escape'=>false), null,false);
				}else{
$link=<<<TEXTO
<a onclick="$('dialog-overlay').show();//var x=screen.height;var y=screen.width;window.open('{$raiz}escalas/escala/{$livro['Escala']['setor_id']}/09/2009','','height=x,width=y,toolbar=0,scrollbars=1,directories=0,status=0');" href="#" style="padding: 1px; font-size: 0.8em;">
				<img border="0" src="/operacional/img/zerar.png" alt="Exibir" title="Editar"/></a>
TEXTO;
		
					echo $this->Html->link('<br>|'.$livro['Setor']['sigla_setor'].'|', array('action'=>'externoescala/'.$livro['Escala']['setor_id'].'/0/'.$privilegioAtivo, null),array('id'=>$livro['Escala']['setor_id'],'onclick'=>'$(\'dialog-overlay\').hide();', 'escape'=>false), null,false);
					$referencia = $livro['Escala']['livro'];
			
				}
			}
		$referencia = $livro['Escala']['livro'];
		}
 
 ?>
 
 </p>
		</td>
	</tr>
</table>
</div>
<br>
<hr>

<div  style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; opacity: 0.75; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial;" id="dialog-overlay" class="fixed"/>
<div style="margin: -44px 0pt 0pt -169px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; left: 50%; top: 20%; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial; width: auto; height: auto;" id="dialog-container" class="fixed">
<div style="display: none;" id="dialog-top">
<span style="display: none; float: left;" id="dialog-title"/><a style="display: true; float: right;" id="dialog-close" href="#" > × </a>
</div>
<div style="padding: 4px; overflow: hidden; width: auto; height: auto;" id="dialog-content" class="confirm">
<table cellpadding="0" cellspacing="0" id="login">
	<tr>
		<td align="center" valign="center">
		<table cellpadding="0" cellspacing="0" border="0" border-color="#FFFFFF" id="login">
		
			<tr>
				<td colspan="2" style="background:#999;border:1px solid #fff;"><a style="display: true; float: right;" id="dialog-close" href="#" onclick="$('dialog-overlay').hide();"> × </a></td>
			</tr>
			<tr>
				<td><?php  echo $form->create('Usuario',array('action'=>'login','onsubmit'=>'window.open(\'http://localhost'.$this->webroot.'ocorrencias/externoescala/88\'); return false;','type'=>'file'));?><b>IDENTIDADE:</b></td>
				<td><input type="text" id="UsuarioIdentidade" class="formulario" value="" name="data[Usuario][identidade]"/></td>
			</tr>
			<tr>
				<td><b>SENHA:</b></td>
				<td><input type="password" id="UsuarioSenha" class="formulario" value="" name="data[Usuario][senha]"/></td>
			</tr>
			<div id='privilegio'></div>
			<tr>
				<td><b>PRIVILEGIO:</b></td>
				<td><select id="UsuarioPrivilegioId" class="formulario" name="data[Usuario][privilegio_id]"><option selected="selected" value=""/>INFORME O VALOR DO CAMPO IDENTIDADE</select>
				<?php
    $options = array('url' => 'update','update' => 'UsuarioPrivilegioId');
	echo $ajax->observeField('UsuarioIdentidade',$options);
 
				?></td>

			</tr>
			<tr>
				<td><b>CÓDIGO:</b></td>
				<td><input type="text" name="data[Usuario][captcha_code]" size="10"
					maxlength="6" value="" class="formulario" />
				<div style="color: red;"><?php echo $error_captcha; ?></div>
				<div style="color: green;"><?php echo $success_captcha; ?></div>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><?php echo $form->end(array('label'=>'Acessar','class'=>'botoes','onsubmit'=>'return false;'));?></td>
			</tr>
			<tr>
				<td></td>
				<td><img src="<?php echo $captcha_image_url; ?>" id="captcha"
					alt="CAPTCHA Image" />
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</div>
<div style="display:  none;" id="dialog-bottom">
<a style="display:  none;" class="prev" href="javascript:;">« Previous</a>
<span style="display:  none;" class="curr"/>
<a style="display:  none;" class="next" href="javascript:;">Next »</a>
</div>
</div>
<script language="javascript">
$('dialog-overlay').hide();</script>