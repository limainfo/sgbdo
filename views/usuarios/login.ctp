<?php 
$manutencao = 1;
$aviso = 1;
?>

<style>#wrapper table tr td { border:0px;}</style><br><br>
<div
	style="z-index: 2; position: relative;float:center; margin: auto; top:-60px;   margin: 10px 10px;  padding: 0px;border-color:#000;border: 1px 1px 1px 1px solid #000;float:center;"
	id="login">
<center>

<table cellpadding="0" cellspacing="0" >
	<tr>
			<tr>
				<td colspan="2" style="background-color:#26a4e5;"><img alt="" style="float:left;" src="<?php echo $this->webroot.'webroot/img/cadeadofechado.gif'; ?>" /><center><img alt="" src="<?php echo $this->webroot.'webroot/img/logo.gif'; ?>" /></center></td>
			</tr>
			<tr>
				<td style="background-color:#fff;text-align: right; vertical-align: middle;"><?php echo $this->Form->create('Usuario',array('action'=>'login'));?><b>IDENTIDADE</b></td>
				<td style="background-color:#fff;"><input type="text" id="UsuarioIdentidade" class="formulario" value="" name="data[Usuario][identidade]"/></td>
			</tr>
			<tr>
				<td style="background-color:#fff;text-align: right; vertical-align: middle;"><b>SENHA</b></td>
				<td style="background-color:#fff;"><input type="password" id="UsuarioSenha" class="formulario" value="" name="data[Usuario][senha]"/></td>
			</tr>
			<!----  
			<tr>
				<td><b>PRIVILEGIO:</b></td>
				<td><select id="UsuarioPrivilegioId" class="formulario" name="data[Usuario][privilegio_id]"><option selected="selected" value=""/>INFORME O VALOR DO CAMPO IDENTIDADE</select>
				<?php
 				?></td>

			</tr>
			-->
<!--			<tr>

				<td style="background-color:#fff;text-align: right; vertical-align: middle;"><b>CÓDIGO</b></td>
				<td style="background-color:#fff;"><input type="text" name="data[Usuario][captcha_code]" maxsize="20"
					maxlength="30" value="" class="formulario" />
				</td>
			</tr>
-->
				<div style="color: red;"><?php //echo $error_captcha; ?></div>
				<div style="color: green;"><?php //echo $success_captcha; ?></div>
			<tr>
				<td style="background-color:#fff;"></td>
				<td style="background-color:#fff;"><?php echo $this->Form->end(array('label'=>'Acessar','class'=>'botoes'));?></td>
			</tr>
                        <?php 
                   		$captcha_image_url = $this->webroot.'usuarios/securimage/'.md5(uniqid(time())); //url for the captcha image
                        ?>
			<tr>
                            <td colspan="2" style="text-align: center;background-color: #fff;">
                                  <div style="text-align:center;align:center;"><br>
        <?php 
// echo $captcha->getCaptchaHtml() 
?>
    </div><!-----
                                <br><img src="<?php //echo $captcha_image_url; ?>" id="captcha"
					alt="CAPTCHA Image" />
          ---->
				</td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
                        <tr>
                            <td colspan="2" style="border:1px solid #000;"><a href="<?php echo $this->webroot; ?>manuais/briefing.ppt" target="_blank">
                            <img  title="Slides do SGBDO"  src="<?php echo $this->webroot; ?>img/slide.jpg"></a><br>
                            <a href="<?php echo $this->webroot; ?>manuais/manual_sgbdo.pdf" target="_blank">
                            <img  title="Manual do SGBDO"  src="<?php echo $this->webroot; ?>img/manual.jpg"></a><br>

                            </td>
                        </tr>
			<tr>
                            <th colspan="3" style="background-color:yellow;border:1px solid #000;"><center>Mensagem</center></th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: justify;width:300px;overflow:hidden;background-color: #F2DD8C;border:1px solid #000;" ><center>
 				<?php
				foreach($mensagem as $texto){
				//	echo '<b>'.$texto['biblias']['versiculo'].'</b>&nbsp; '.iconv('ISO-8859-1','UTF-8',$texto['biblias']['palavra']).'<br>';
					echo '<b>'.$texto['biblias']['versiculo'].'</b>&nbsp; '.$texto['biblias']['palavra'].'<br>';
				}
				if($mensagem[0]['biblias']['versiculofim']==$mensagem[0]['biblias']['versiculoinicio']){
				//	echo '<b>('.iconv('ISO-8859-1','UTF-8',$mensagem[0]['biblias']['livro']).' '.$mensagem[0]['biblias']['capitulo'].'.'.$mensagem[0]['biblias']['versiculoinicio'].')</b>&nbsp; ';
					echo '<b>('.iconv('ISO-8859-1','UTF-8',$mensagem[0]['biblias']['livro']).' '.$mensagem[0]['biblias']['capitulo'].'.'.$mensagem[0]['biblias']['versiculoinicio'].')</b>&nbsp; ';
				}else{
				//	echo '<b>('.iconv('ISO-8859-1','UTF-8',$mensagem[0]['biblias']['livro']).' '.$mensagem[0]['biblias']['capitulo'].'.'.$mensagem[0]['biblias']['versiculoinicio'].'-'.$mensagem[0]['biblias']['versiculofim'].')</b>&nbsp; ';
					echo '<b>('.iconv('ISO-8859-1','UTF-8',$mensagem[0]['biblias']['livro']).' '.$mensagem[0]['biblias']['capitulo'].'.'.$mensagem[0]['biblias']['versiculoinicio'].'-'.$mensagem[0]['biblias']['versiculofim'].')</b>&nbsp; ';
				}
 				?></center></td>
			</tr>
        
        
                        </table>

<div class="agenda">


<?php 

foreach($avisos as $aviso){
    echo '<div id="evento_87_small" class="evento evento4"><div class="id">'.date('d-m-Y h:i:s',strtotime($aviso['Aviso']['created'])).'</div><div class="descricao">'.$aviso['Aviso']['mensagem'].'</div><div class="detalhes small detalhes_show">'.$aviso['Aviso']['usuario'].'</div><div class="detalhes small">'.$aviso['Aviso']['tipo'].'</div></div>';
}
//foreach($manutencaos as $aviso){ echo '<div id="evento_87_small" class="evento evento4"><div class="id">'.date('d-m-Y h:i:s',strtotime($aviso['Aviso']['created'])).'</div><div class="descricao">'.$aviso['Aviso']['mensagem'].'</div><div class="detalhes small detalhes_show">'.$aviso['Aviso']['usuario'].'</div><div class="detalhes small">'.$aviso['Aviso']['tipo'].'</div></div>';}
?>    
               
                    
</div>
		
		
		

    
    



		
<?php 
//include '/var/www/sgbdo/webroot/pdf/texto.txt';
?>


<br>
 </center>
</div>


<?php 
//if($manutencao==0){
   	$options = array('url' => 'update','update' => 'UsuarioPrivilegioId');
	//echo $ajax->observeField('UsuarioIdentidade',$options);
	
//}
?>
