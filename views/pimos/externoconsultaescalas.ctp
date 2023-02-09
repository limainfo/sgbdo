<?php
$selected = "";
foreach($escalas as $chave=>$valor){
	if($chave=='0'){$selected="";}else{$selected="selected='selected'";}
?>
<option value="<?php echo $chave; ?>" <?php echo $selected; ?>><?php echo $valor; ?></option>
<?php
}
?>
