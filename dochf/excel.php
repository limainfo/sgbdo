<?php



	Class ExcelWriter
	{
			
		var $fp=null;
		var $error;
		var $state="CLOSED";
		var $linha = '';
		/*
		* @Params : $file  : file name of excel file to be created.
		* @Return : On Success Valid File Pointer to file
		* 			On Failure return false	 
		*/
		 
		function ExcelWriter($file="")
		{
			return $this->open($file);
		}
		
		/*
		* @Params : $file  : file name of excel file to be created.
		* 			if you are using file name with directory i.e. test/myFile.xls
		* 			then the directory must be existed on the system and have permissioned properly
		* 			to write the file.
		* @Return : On Success Valid File Pointer to file
		* 			On Failure return false	 
		*/
		function open($file)
		{
			if($this->state!="CLOSED")
			{
				$this->error="Error : Another file is opend .Close it to save the file";
				return false;
			}	
			
			if(!empty($file))
			{
				$this->fp=@fopen($file,"w+b");
			}
			else
			{
				$this->error="Usage : New ExcelWriter('fileName')";
				return false;
			}	
			if($this->fp==false)
			{
				$this->error="Error: Unable to open/create File.You may not have permmsion to write the file.";
				return false;
			}
			$this->state="OPENED";
			fwrite($this->fp,$this->lePlanilha());
			fclose($this->fp);
		}
		function lePlanilha(){
				$caminho=str_replace("excel.php","",$_SERVER["SCRIPT_FILENAME"]);
				$arquivo=($caminho."planilha.ods");			
				return file_get_contents($arquivo);
		}
		
		function close()
		{
			if($this->state!="OPENED")
			{
				$this->error="Error : Please open the file.";
				return false;
			}	
			
			//fwrite($this->fp,$this->GetFooter());
			//fclose($this->fp);
			$this->state="CLOSED";
			return ;
		}
		/* @Params : Void
		*  @return : Void
		* This function write the header of Excel file.
		*/
		 							
		function GetHeader()
		{
			$header = <<<EOH
<?xml version="1.0" encoding="UTF-8"?>
<office:document-content xmlns:office="urn:oasis:names:tc:opendocument:xmlns:office:1.0" xmlns:style="urn:oasis:names:tc:opendocument:xmlns:style:1.0" xmlns:text="urn:oasis:names:tc:opendocument:xmlns:text:1.0" xmlns:table="urn:oasis:names:tc:opendocument:xmlns:table:1.0" xmlns:draw="urn:oasis:names:tc:opendocument:xmlns:drawing:1.0" xmlns:fo="urn:oasis:names:tc:opendocument:xmlns:xsl-fo-compatible:1.0" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:meta="urn:oasis:names:tc:opendocument:xmlns:meta:1.0" xmlns:number="urn:oasis:names:tc:opendocument:xmlns:datastyle:1.0" xmlns:presentation="urn:oasis:names:tc:opendocument:xmlns:presentation:1.0" xmlns:svg="urn:oasis:names:tc:opendocument:xmlns:svg-compatible:1.0" xmlns:chart="urn:oasis:names:tc:opendocument:xmlns:chart:1.0" xmlns:dr3d="urn:oasis:names:tc:opendocument:xmlns:dr3d:1.0" xmlns:math="http://www.w3.org/1998/Math/MathML" xmlns:form="urn:oasis:names:tc:opendocument:xmlns:form:1.0" xmlns:script="urn:oasis:names:tc:opendocument:xmlns:script:1.0" xmlns:ooo="http://openoffice.org/2004/office" xmlns:ooow="http://openoffice.org/2004/writer" xmlns:oooc="http://openoffice.org/2004/calc" xmlns:dom="http://www.w3.org/2001/xml-events" xmlns:xforms="http://www.w3.org/2002/xforms" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:rpt="http://openoffice.org/2005/report" xmlns:of="urn:oasis:names:tc:opendocument:xmlns:of:1.2" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:grddl="http://www.w3.org/2003/g/data-view#" xmlns:tableooo="http://openoffice.org/2009/table" xmlns:field="urn:openoffice:names:experimental:ooo-ms-interop:xmlns:field:1.0" xmlns:formx="urn:openoffice:names:experimental:ooxml-odf-interop:xmlns:form:1.0" xmlns:css3t="http://www.w3.org/TR/css3-text/" office:version="1.2"><office:scripts/><office:font-face-decls><style:font-face style:name="Arial1" svg:font-family="Arial" style:font-family-generic="swiss"/><style:font-face style:name="Times New Roman" svg:font-family="&apos;Times New Roman&apos;" style:font-family-generic="swiss"/><style:font-face style:name="Arial" svg:font-family="Arial" style:font-family-generic="swiss" style:font-pitch="variable"/><style:font-face style:name="DejaVu Sans Light" svg:font-family="&apos;DejaVu Sans Light&apos;" style:font-family-generic="system" style:font-pitch="variable"/><style:font-face style:name="Droid Sans" svg:font-family="&apos;Droid Sans&apos;" style:font-family-generic="system" style:font-pitch="variable"/></office:font-face-decls><office:automatic-styles><style:style style:name="co1" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="1.335cm"/></style:style><style:style style:name="co2" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="1.552cm"/></style:style><style:style style:name="co3" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="2.441cm"/></style:style><style:style style:name="co4" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="2.053cm"/></style:style><style:style style:name="co5" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="3.011cm"/></style:style><style:style style:name="co6" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="6.604cm"/></style:style><style:style style:name="co7" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="1.498cm"/></style:style><style:style style:name="co8" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="1.415cm"/></style:style><style:style style:name="co9" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="1.637cm"/></style:style><style:style style:name="co10" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="1.663cm"/></style:style><style:style style:name="co11" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="2.267cm"/></style:style><style:style style:name="ro1" style:family="table-row"><style:table-row-properties style:row-height="0.452cm" fo:break-before="auto" style:use-optimal-row-height="true"/></style:style><style:style style:name="ro2" style:family="table-row"><style:table-row-properties style:row-height="0.45cm" fo:break-before="auto" style:use-optimal-row-height="true"/></style:style><style:style style:name="ta1" style:family="table" style:master-page-name="PageStyle_5f_LISTA"><style:table-properties table:display="true" style:writing-mode="lr-tb"/></style:style><style:style style:name="ce1" style:family="table-cell" style:parent-style-name="Default"><style:table-cell-properties style:glyph-orientation-vertical="0" fo:background-color="#ffff99" style:diagonal-bl-tr="none" style:diagonal-tl-br="none" style:text-align-source="fix" style:repeat-content="false" fo:wrap-option="no-wrap" fo:border="0.06pt solid #000000" style:direction="ltr" fo:padding="0.071cm" style:rotation-angle="0" style:rotation-align="none" style:shrink-to-fit="false" style:vertical-align="middle" style:vertical-justify="auto"/><style:paragraph-properties fo:text-align="center" css3t:text-justify="auto" fo:margin-left="0cm" style:writing-mode="page"/><style:text-properties style:use-window-font-color="true" style:text-outline="false" style:text-line-through-style="none" style:font-name="Arial1" fo:font-size="10pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="bold" style:font-size-asian="10pt" style:font-style-asian="normal" style:font-weight-asian="bold" style:font-name-complex="Arial1" style:font-size-complex="10pt" style:font-style-complex="normal" style:font-weight-complex="bold"/></style:style><style:style style:name="ce2" style:family="table-cell" style:parent-style-name="Default"><style:table-cell-properties style:glyph-orientation-vertical="0" fo:background-color="#99ccff" style:diagonal-bl-tr="none" style:diagonal-tl-br="none" style:text-align-source="fix" style:repeat-content="false" fo:wrap-option="no-wrap" fo:border="0.06pt solid #000000" style:direction="ltr" fo:padding="0.071cm" style:rotation-angle="0" style:rotation-align="none" style:shrink-to-fit="false" style:vertical-align="middle" style:vertical-justify="auto"/><style:paragraph-properties fo:text-align="center" css3t:text-justify="auto" fo:margin-left="0cm" style:writing-mode="page"/><style:text-properties style:use-window-font-color="true" style:text-outline="false" style:text-line-through-style="none" style:font-name="Arial1" fo:font-size="8pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="bold" style:font-size-asian="8pt" style:font-style-asian="normal" style:font-weight-asian="bold" style:font-name-complex="Arial1" style:font-size-complex="8pt" style:font-style-complex="normal" style:font-weight-complex="bold"/></style:style><style:style style:name="ce3" style:family="table-cell" style:parent-style-name="Default"><style:table-cell-properties fo:border-bottom="0.06pt solid #000000" style:diagonal-bl-tr="none" style:diagonal-tl-br="none" fo:border-left="0.06pt solid #000000" fo:padding="0.071cm" fo:border-right="none" style:rotation-align="none" fo:border-top="0.06pt solid #000000"/><style:text-properties style:use-window-font-color="true" style:text-outline="false" style:text-line-through-style="none" style:font-name="Arial1" fo:font-size="8pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="normal" style:font-size-asian="8pt" style:font-style-asian="normal" style:font-weight-asian="normal" style:font-name-complex="Arial1" style:font-size-complex="8pt" style:font-style-complex="normal" style:font-weight-complex="normal"/></style:style><style:style style:name="ce4" style:family="table-cell" style:parent-style-name="Default"><style:table-cell-properties fo:border-bottom="0.06pt solid #000000" style:diagonal-bl-tr="none" style:diagonal-tl-br="none" fo:border-left="none" fo:padding="0.071cm" fo:border-right="none" style:rotation-align="none" fo:border-top="0.06pt solid #000000"/><style:text-properties style:use-window-font-color="true" style:text-outline="false" style:text-line-through-style="none" style:font-name="Arial1" fo:font-size="8pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="normal" style:font-size-asian="8pt" style:font-style-asian="normal" style:font-weight-asian="normal" style:font-name-complex="Arial1" style:font-size-complex="8pt" style:font-style-complex="normal" style:font-weight-complex="normal"/></style:style><style:style style:name="ce5" style:family="table-cell" style:parent-style-name="Default"><style:table-cell-properties style:glyph-orientation-vertical="0" fo:background-color="#99ccff" style:diagonal-bl-tr="none" style:diagonal-tl-br="none" style:text-align-source="fix" style:repeat-content="false" fo:wrap-option="no-wrap" fo:border="0.06pt solid #000000" style:direction="ltr" fo:padding="0.071cm" style:rotation-angle="0" style:rotation-align="none" style:shrink-to-fit="false" style:vertical-align="automatic" style:vertical-justify="auto"/><style:paragraph-properties fo:text-align="center" css3t:text-justify="auto" fo:margin-left="0cm" style:writing-mode="page"/><style:text-properties style:use-window-font-color="true" style:text-outline="false" style:text-line-through-style="none" style:font-name="Arial1" fo:font-size="8pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="bold" style:font-size-asian="8pt" style:font-style-asian="normal" style:font-weight-asian="bold" style:font-name-complex="Arial1" style:font-size-complex="8pt" style:font-style-complex="normal" style:font-weight-complex="bold"/></style:style><style:style style:name="ce6" style:family="table-cell" style:parent-style-name="Default"><style:table-cell-properties style:glyph-orientation-vertical="0" fo:border-bottom="0.06pt solid #000000" style:diagonal-bl-tr="none" style:diagonal-tl-br="none" style:text-align-source="fix" style:repeat-content="false" fo:wrap-option="no-wrap" fo:border-left="none" style:direction="ltr" fo:padding="0.071cm" fo:border-right="none" style:rotation-angle="0" style:rotation-align="none" style:shrink-to-fit="false" fo:border-top="0.06pt solid #000000" style:vertical-align="automatic" style:vertical-justify="auto"/><style:paragraph-properties fo:text-align="center" css3t:text-justify="auto" fo:margin-left="0cm" style:writing-mode="page"/><style:text-properties style:use-window-font-color="true" style:text-outline="false" style:text-line-through-style="none" style:font-name="Arial1" fo:font-size="8pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="normal" style:font-size-asian="8pt" style:font-style-asian="normal" style:font-weight-asian="normal" style:font-name-complex="Arial1" style:font-size-complex="8pt" style:font-style-complex="normal" style:font-weight-complex="normal"/></style:style><style:style style:name="ce7" style:family="table-cell" style:parent-style-name="Default"><style:table-cell-properties style:glyph-orientation-vertical="0" style:diagonal-bl-tr="none" style:diagonal-tl-br="none" style:text-align-source="fix" style:repeat-content="false" fo:background-color="transparent" fo:wrap-option="wrap" fo:border="none" style:direction="ltr" fo:padding="0.071cm" style:rotation-angle="0" style:rotation-align="none" style:shrink-to-fit="false" style:vertical-align="middle" style:vertical-justify="auto"/><style:paragraph-properties fo:text-align="center" css3t:text-justify="auto" fo:margin-left="0cm" style:writing-mode="page"/><style:text-properties style:use-window-font-color="true" style:text-outline="false" style:text-line-through-style="none" style:font-name="Arial1" fo:font-size="8pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="bold" style:font-size-asian="8pt" style:font-style-asian="normal" style:font-weight-asian="bold" style:font-name-complex="Arial1" style:font-size-complex="8pt" style:font-style-complex="normal" style:font-weight-complex="bold"/></style:style><style:style style:name="ce8" style:family="table-cell" style:parent-style-name="Default"><style:table-cell-properties style:glyph-orientation-vertical="0" fo:border-bottom="0.06pt solid #000000" style:diagonal-bl-tr="none" style:diagonal-tl-br="none" style:text-align-source="fix" style:repeat-content="false" fo:wrap-option="no-wrap" fo:border-left="none" style:direction="ltr" fo:padding="0.071cm" fo:border-right="0.06pt solid #000000" style:rotation-angle="0" style:rotation-align="none" style:shrink-to-fit="false" fo:border-top="0.06pt solid #000000" style:vertical-align="automatic" style:vertical-justify="auto"/><style:paragraph-properties fo:text-align="center" css3t:text-justify="auto" fo:margin-left="0cm" style:writing-mode="page"/><style:text-properties style:use-window-font-color="true" style:text-outline="false" style:text-line-through-style="none" style:font-name="Arial1" fo:font-size="8pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="normal" style:font-size-asian="8pt" style:font-style-asian="normal" style:font-weight-asian="normal" style:font-name-complex="Arial1" style:font-size-complex="8pt" style:font-style-complex="normal" style:font-weight-complex="normal"/></style:style></office:automatic-styles><office:body><office:spreadsheet><table:calculation-settings table:case-sensitive="false" table:use-regular-expressions="false"/><table:table table:name="LISTA" table:style-name="ta1"><office:forms form:automatic-focus="false" form:apply-design-mode="false"/><table:table-column table:style-name="co1" table:default-cell-style-name="Default"/><table:table-column table:style-name="co2" table:default-cell-style-name="Default"/><table:table-column table:style-name="co3" table:default-cell-style-name="Default"/><table:table-column table:style-name="co4" table:default-cell-style-name="Default"/><table:table-column table:style-name="co5" table:default-cell-style-name="Default"/><table:table-column table:style-name="co6" table:default-cell-style-name="Default"/><table:table-column table:style-name="co7" table:default-cell-style-name="Default"/><table:table-column table:style-name="co8" table:default-cell-style-name="Default"/><table:table-column table:style-name="co9" table:default-cell-style-name="Default"/><table:table-column table:style-name="co10" table:default-cell-style-name="Default"/><table:table-row table:style-name="ro1"><table:table-cell table:style-name="ce1" office:value-type="string" table:number-columns-spanned="10" table:number-rows-spanned="1"><text:p><text:s/>INDICAÇÃO DE MILITARES PARA INSTRUÇÃO, COORDENAÇÃO E COMISSIONAMENTO </text:p></table:table-cell><table:covered-table-cell table:number-columns-repeated="9" table:style-name="ce1"/></table:table-row><table:table-row table:style-name="ro1"><table:table-cell table:number-columns-repeated="6"/><table:table-cell table:style-name="ce2" office:value-type="string" table:number-columns-spanned="2" table:number-rows-spanned="1"><text:p>INSTRUTOR</text:p></table:table-cell><table:covered-table-cell table:style-name="ce2"/><table:table-cell table:style-name="ce7" table:number-columns-repeated="2"/></table:table-row><table:table-row table:style-name="ro1"><table:table-cell table:style-name="ce2" office:value-type="string"><text:p>POSTO</text:p></table:table-cell><table:table-cell table:style-name="ce2" office:value-type="string"><text:p>ESP</text:p></table:table-cell><table:table-cell table:style-name="ce2" office:value-type="string"><text:p>UNIDADE</text:p></table:table-cell><table:table-cell table:style-name="ce2" office:value-type="string"><text:p>SETOR</text:p></table:table-cell><table:table-cell table:style-name="ce2" office:value-type="string"><text:p>NOME GUERRA</text:p></table:table-cell><table:table-cell table:style-name="ce2" office:value-type="string"><text:p>NOME COMPLETO</text:p></table:table-cell><table:table-cell table:style-name="ce5" office:value-type="string"><text:p>EEAR</text:p></table:table-cell><table:table-cell table:style-name="ce5" office:value-type="string"><text:p>ICEA</text:p></table:table-cell><table:table-cell table:style-name="ce5" office:value-type="string"><text:p>COORD.</text:p></table:table-cell><table:table-cell table:style-name="ce5" office:value-type="string"><text:p>COMISS.</text:p></table:table-cell></table:table-row>
EOH;
			return $header;
		}

		function GetFooter($total=0)
		{
			return '<table:table-row table:style-name="ro2" table:number-rows-repeated="1048571"><table:table-cell table:number-columns-repeated="10"/></table:table-row><table:table-row table:style-name="ro2"><table:table-cell table:number-columns-repeated="10"/></table:table-row><table:named-expressions><table:named-expression table:name="Excel_BuiltIn__FilterDatabase" table:base-cell-address="$LISTA.$A$1" table:expression="[$LISTA.$A$'.($total+3).':.$J$'.($total+4).']"/></table:named-expressions></table:table><table:database-ranges><table:database-range table:name="__Anonymous_Sheet_DB__0" table:target-range-address="LISTA.A3:LISTA.J4" table:display-filter-buttons="true"/></table:database-ranges></office:spreadsheet></office:body></office:document-content>';
		}
		
		/*
		* @Params : $line_arr: An valid array 
		* @Return : Void
		*/
		 
		function writeLine($dados)
		{

			if(!is_array($dados))
			{
				$this->error="Error : Argument is not valid. Supply an valid Array.";
				return false;
			}
			if(!empty($dados)){
$this->linha .='<table:table-row table:style-name="ro1"><table:table-cell table:style-name="ce3" office:value-type="string"><text:p>'.$dados['posto'].'</text:p></table:table-cell><table:table-cell table:style-name="ce4" office:value-type="string"><text:p>'.$dados['quadro'].' '.$dados['especialidade'].'</text:p></table:table-cell><table:table-cell table:style-name="ce4" office:value-type="string"><text:p>'.$dados['unidade'].'</text:p></table:table-cell><table:table-cell table:style-name="ce4" office:value-type="string"><text:p>'.$dados['setor'].'</text:p></table:table-cell><table:table-cell table:style-name="ce4" office:value-type="string"><text:p>'.$dados['nmguerra'].'</text:p></table:table-cell><table:table-cell table:style-name="ce4" office:value-type="string"><text:p>'.$dados['nmcompleto'].'</text:p></table:table-cell><table:table-cell table:number-columns-repeated="3" table:style-name="ce6" office:value-type="float" office:value="'.$dados['eear'].'"><text:p>'.$dados['icea'].'</text:p></table:table-cell><table:table-cell table:style-name="ce8" office:value-type="float" office:value="'.$dados['coordenador'].'"><text:p>'.$dados['comissionamento'].'</text:p></table:table-cell></table:table-row>';			
		}
				
			}
	

		function output($file='', $total=0){
			$saida = '';
				if(!empty($file))
				{
					$saida .= file_get_contents($file);
				}
			$arquivo=str_replace("excel.php","",$_SERVER["SCRIPT_FILENAME"]);
			$arquivo=str_replace($arquivo,"",$file);


			header("Content-type: application/vnd.oasis.opendocument.spreadsheet");
			header("Content-Disposition: attachment; filename={$arquivo}" );
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
			header("Pragma: public");				
			
			$zip = new ZipArchive();	
			
			if ($zip->open("{$file}")) {
				$zip->deleteName('content.xml');
				$zip->addFromString('content.xml', $this->GetHeader().$this->linha.$this->GetFooter($total));
			}
			
			$zip->close();	
			
					
			
			return file_get_contents($file);
		
		}
	}
	
	include('conn.inc');
	$sql= "select Posto.sigla_posto posto, Quadro.sigla_quadro quadro, Especialidade.nm_especialidade especialidade,
	Unidade.sigla_unidade unidade, Setor.sigla_setor setor, Militar.nm_guerra nmguerra, Militar.nm_completo nmcompleto,
	Militar.instrutor_eear eear, Militar.instrutor_icea icea, Militar.coordenador coordenador, Militar.comissionamento comissionamento from militars Militar 
			left join postos Posto on (Posto.id=Militar.posto_id)
			left join especialidades Especialidade on (Especialidade.id=Militar.especialidade_id)
			left join quadros Quadro on (Quadro.id=Especialidade.quadro_id)
			left join setors Setor on (Setor.id=Militar.setor_id)
			left join unidades Unidade on (Unidade.id=Militar.unidade_id and Unidade.id=Setor.unidade_id)
			where 1=1 and (
			Militar.especialidade_id like '%BCO%'
			or Militar.especialidade_id like '%BMT%'
			or Militar.especialidade_id like '%BCT%'
			or Militar.especialidade_id like '%SAI%'
			
			)
			and Militar.ativa>0 order by Posto.antiguidade asc, Militar.nm_completo asc";
	$consulta = mysql_query($sql);
	
			
	$id = date('Ymdhis');

	$caminho=str_replace("excel.php","",$_SERVER["SCRIPT_FILENAME"]);
	
	$excel=new ExcelWriter($caminho.$id.".ods");
	//echo ($caminho.$id.".xls");
	if($excel==false)	
		echo $excel->error;
		
//$registro=mysql_fetch_array($consulta);		$excel->writeLine($registro);
	$total = mysql_num_rows($consulta);
	$conta=0;
	while($registro=mysql_fetch_array($consulta)){
		foreach($registro as $chave=>$valor){
			$registro[$chave] = iconv('ISO-8859-1','UTF-8',$valor);
		}
		$excel->writeLine($registro);	
		//if($conta==40){break;}
		$conta++;
		}

	
	$excel->close();

//echo $excel->linha;

	echo $excel->output($caminho.$id.".ods", $conta);
	unlink($caminho.$id.".ods");

?>
