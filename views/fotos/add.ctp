<script name="Zoom Browser Window" language="javascript">
<!--
var zBox,zStep=0,zLink

function doZoom() {
    zStep+=1;zPct=(10-zStep)/10
if (document.layers) {
	zBox.moveTo(toX+zPct*(fromX-toX),toY+zPct*(fromY-toY));
	zBox.document.open();
	zBox.document.write("<table width='"+maxW*(1-zPct)+"' height="+maxH*(1-zPct)+" border=2 cellspacing=0><tr><td></td></tr></table>");
	zBox.document.close();
  }else{
	zBox.style.border="2px solid #999999";
	zBox.style.left=toX+zPct*(fromX-toX);
	zBox.style.top=toY+zPct*(fromY-toY);
	zBox.style.width=maxW*(1-zPct);
	zBox.style.height=maxH*(1-zPct);
	}
zBox.style.visibility="visible";
  if  (zStep < 10) setTimeout("doZoom("+fromX+","+fromY+","+toX+","+toY+")",30);
  else{zBox.style.visibility='hidden';zStep=0;
  if (zLink) {
  var w=window.open(''+ zLink + '','zWindow','width='+maxW+',height='+maxH+',left='+adjX+',top='+adjY+','+ScllBr+',resizable');
  }
 }
}

function Lvl_Zoom(evt,zlink,maxw,maxh,tox,toy,scr) {
  if (arguments.length > 2)
  scrollH=(window.pageYOffset!=null)?window.pageYOffset:document.body.scrollTop;
     maxW=maxw?maxw:window.innerWidth?innerWidth:document.body.clientWidth;
     maxH=maxh?maxh:window.innerHeight?innerHeight:document.body.clientHeight;
      toX=tox?tox:0;
      toY=(toy?toy:0)+scrollH;
    fromX=evt.pageX?evt.pageX:evt.clientX;
    fromY=(evt.pageY?evt.pageY:evt.clientY)+(document.all?scrollH:0);
     adjX=toX+evt.screenX-fromX;
     adjY=toY+evt.screenY-fromY;
 if (document.createElement && document.body.appendChild && !zBox) {
	zBox=document.createElement("div");
	zBox.style.position="absolute";
	document.body.appendChild(zBox);
 }else if (document.all && !zBox) {
	document.all[document.all.length-1].outerHTML+='<div id="zBoxDiv" style="position:absolute"></div>';
	zBox=document.all.zBoxDiv;
 }else if (document.layers && !zBox) {
	zBox=new Layer(maxW);zBox.style=zBox;
 }if (scr == 'y'){ ScllBr = 'scrollbars=yes'}else{ScllBr = 'scrollbars=no'}
    zLink=zlink;
    doZoom();
}
//-->
</script>

<div class="fotos form">
<?php echo $form->create('Foto',array('type'=>'file'));?>
	<fieldset>
 		<legend><?php __('Cadastrar Foto');?>&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false), null,false); ?>
 		</legend>
	<?php
	
	//echo '<pre>'.print_r($militars).'</pre>';
	
$select ='<div class="input select required"><label>Militar:</label><select id="FotoMilitarId" class="formulario" name="data[Foto][militar_id]">';
	foreach($militars as $key=>$value){
		if($key==$id){
			$selecionado = '<option value="'.$key.'" selected>'.$value.'</option>';
		}
		$select .= '<option value="'.$key.'" >'.$value.'</option>';
	}
$select = $select.$selecionado.'</select></div>';
	
echo $select;
	

		echo '<label>Arquivo:</label>'.$form->file('dados',array('class'=>'formulario','onchange'=>"document.getElementById('camada').style.visibility='visible';loadFile(event)"));
	?>
	</fieldset>
<?php echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>
                
                <script>
 var loadFile = function(event) {
    var output = document.getElementById('visualizacao');
    output.src = URL.createObjectURL(event.target.files[0]);
  };                    
                </script>
                <br><br>
                <table>
                    <tr>
                        <th>FOTO ATUAL</th>                         
                        <th>SUBSTITUTA</th>                         
                    </tr>
                    <tr>
                        <td><?php
		if(isset($fotoid)){
			$img = $fotoid;
		    echo '<a href="javascript:;">'.$this->Html->image(array('controller'=> 'fotos', 'action'=>'externostream',$img), array( 'border'=> '0','onclick'=>"Lvl_Zoom(event,'',500,400,100,100,'n')" )).'</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; //  
		}else{
			$img = 'sem_imagem.png';
		    echo $this->Html->image('sem_imagem.png', array( 'border'=> '0', 'width'=>'40', 'height'=>'30' )); 
		}
		?></td>                         
                        <td><a href="javascript:;"><img src="<?php echo $this->webroot; ?>img/transparente.gif" name="visualizacao" width="150" height="90" border="0" id="visualizacao" onClick="Lvl_Zoom(event,'',500,400,100,100,'n')"></a></td>                         
                    </tr>
                </table>


<div name="camada" id="camada"  style="width:160; height:100; z-index:1000;">
</div>
