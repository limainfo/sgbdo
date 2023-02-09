<br>

<?php
echo $form->create('Escala', array('controller'=> 'Escala', 'action'=>'externozip'));
$anos = array();
$ano = date('Y')+1;
$anoa = date('Y')-1;
for ($inicio=$anoa; $inicio<=$ano;$inicio++){
	$anos[$inicio]=$inicio;
}

echo '<b>VALOR DA ETAPA:</b><input type="text" class="formulario" value="18.2" size="4" name="data[Escala][etapa]" id="EscalaEtapa"><br><b>INFORME O ANO:</b>'.$form->select('ano', $anos ,$this->data['Escala']['ano'] ,array('onChange'=>" $('EscalaExternozipForm').submit();",'class'=>'formulario'), false);

echo $form->end();

?>