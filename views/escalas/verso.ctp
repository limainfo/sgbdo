<div 	style="z-index: 2; width: 100%;height:100%; position: fixed; top: 0%; left: 0%; padding: 0px;"
	id="login">
<table width="754" border="1">
  <tr>
    <td colspan="2"><div align="center"><?php echo $form->create('Escala', array('controller'=> 'Escala', 'action'=>'zera'));?><strong>OBSERVAÇÕES ESCALA </strong></div></td>
  </tr>
  <tr>
    <td width="254">Não conformidades:</td>
    <td width="484"><textarea name="naoconformidade" id="naoconformidade" cols="80"></textarea></td>
  </tr>
  <tr>
    <td>Observações:</td>
    <td>

        <textarea name="obs" id="obs" cols="80"></textarea>

      </td>
  </tr>
  <tr>
    <td colspan="2">Escalante:</td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"><strong>ALTERAÇÕES NA ESCALA </strong></div></td>
  </tr>
  <tr>
    <td colspan="2">

      <textarea name="alteracoes"  id="alteracoes" cols="120" rows="20"></textarea>
<?php
 $jscript=<<<SCRIPT
		<script type="text/javascript">
		//<![CDATA[

		Event.observe('alteracoes', 'change', function(event) {
		var mes = $('EscalaMes').value;
		var ano = $('EscalaAno').value;
		var prevista = $('EscalaPrevista').value;
		new Ajax.Request('{$this->webroot}escalas/versos/{$escala['Escala']['id']}/'+mes+'/'+ano+'/'+prevista, {
			method: 'get',
			onSuccess: function(transport) {

			var antes = \$('anterior').value;
			var resultado = transport.responseText.evalJSON(true);

			if (resultado.ok==0){
				alert('Registro não atualizado! \\n'+resultado.mensagem);
			}else{}
		}
				})
		}, false
		);
		//]]>

</script>
SCRIPT;

		echo $jscript;
       ?>
    </td>
  </tr>
  <tr>
    <td colspan="2">Chefe Órgão: </td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"><strong>OBSERVAÇÕES COMANDANTE </strong></div></td>
  </tr>
  <tr>
    <td colspan="2"><textarea name="obscmt" id="obscmt" cols="120" rows="20"></textarea>		<?php echo $form->end();?></td>
  </tr>
</table>
</div>