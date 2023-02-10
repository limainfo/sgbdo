<option value="0" selected="selected">Selecione um nome</option>
<?php foreach($nomes as $chave=>$valor){ ?>
<option value="<?php echo $chave; ?>"><?php echo $valor; ?></option>
<?php } ?>
