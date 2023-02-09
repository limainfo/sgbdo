<?php	
if (empty($vetor)) {
    $csv->setFilename($nome);
    $csv->addGrid($conteudo);
    echo $csv->render(true, 'latin1', 'UTF-8');
} else {
?>

<STYLE type="text/css">
	.tableTd {
	   	border-width: 0.5pt; 
		border: solid; 
	}
	.tableTdContent{
		border-width: 0.5pt; 
		border: solid;
	}
	#titles{
		font-weight: bolder;
	}
   
</STYLE>
<table>
	<tr>
		<th colspan="<?php echo count($camposplanos); ?>" align="left"><b><?php echo $titulo; ?><b></th>
	</tr>
	<tr>
		<td><b>Date:</b></td>
		<td><?php echo date("d/m/Y h:i "); ?></td>
	</tr>
	<tr>
		<td></td>
	</tr>
		<tr id="titles">
                    <?php 
                    foreach($camposplanos as $campos){
                        echo '<th class="tableTd">'.$campos.'</th>';
                    }
                    ?>
		</tr>		
		<?php 
                foreach($vetor as $row):
                    echo '<tr>';
                    foreach($camposplanos as $campos){
			echo '<td class="tableTdContent">'.$row[$campos].'</td>';
                    }
                    echo '</tr>';
		endforeach;
		?>
</table>
<?php } ?>
