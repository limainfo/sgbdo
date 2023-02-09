<script>
		YAHOO.namespace("example.container"); 
v
		function init() {
			// Instantiate a Panel from markup
			YAHOO.example.container.panel1 = new YAHOO.widget.Panel("painel_especialidades", { width:"320px", visible:false, draggable:true, constraintoviewport:true } );
			YAHOO.example.container.panel1.render();
			
			YAHOO.example.container.panel2 = new YAHOO.widget.Panel("painel_quadros", { width:"320px", visible:false, draggable:true, constraintoviewport:true } );
			YAHOO.example.container.panel2.render();
			
			YAHOO.example.container.panel3 = new YAHOO.widget.Panel("painel_setores", { width:"320px", visible:false, draggable:true, constraintoviewport:true } );
			YAHOO.example.container.panel3.render();
			
			YAHOO.example.container.panel4 = new YAHOO.widget.Panel("painel_unidades", { width:"320px", visible:false, draggable:true, constraintoviewport:true } );
			YAHOO.example.container.panel4.render();

			YAHOO.example.container.panel5 = new YAHOO.widget.Panel("painel_localidades", { width:"320px", visible:false, draggable:true, constraintoviewport:true } );
			YAHOO.example.container.panel5.render();

			YAHOO.example.container.panel6 = new YAHOO.widget.Panel("painel_escalas", { width:"320px", visible:false, draggable:true, constraintoviewport:true } );
			YAHOO.example.container.panel6.render();


			YAHOO.util.Event.addListener("especialidades", "click", YAHOO.example.container.panel1.show, YAHOO.example.container.panel1, true);
			YAHOO.util.Event.addListener("quadros", "click", YAHOO.example.container.panel2.show, YAHOO.example.container.panel2, true);
			YAHOO.util.Event.addListener("setores", "click", YAHOO.example.container.panel3.show, YAHOO.example.container.panel3, true);
			YAHOO.util.Event.addListener("unidades", "click", YAHOO.example.container.panel4.show, YAHOO.example.container.panel4, true);
			YAHOO.util.Event.addListener("localidades", "click", YAHOO.example.container.panel5.show, YAHOO.example.container.panel5, true);
			YAHOO.util.Event.addListener("escalas", "click", YAHOO.example.container.panel6.show, YAHOO.example.container.panel6, true);
		}

		YAHOO.util.Event.addListener(window, "load", init);
</script>

<div>
	<button id="escalas" class="yui-button yui-push-button" style="width:320px;">Escalas</button> 
</div>
<div class="yui-panel-container shadow" id="panel6_c" style="z-index: 2;">
<div id="painel_escalas" class="yui-module yui-overlay yui-panel" style="visibility: inherit; width: 320px;">
		<div class="hd" style="cursor: move;" id="panel4_h">Opções disponíveis:</div>
		<div class="bd">
		<?php echo $this->Html->link(__('Cadastrar Escalas', true), array('controller'=> 'escalas','action'=>'add'),array('class'=>'button')); ?>
		<br>
		</div>
<span class="container-close"> </span></div></div>



<div>
	<button id="especialidades" class="yui-button yui-push-button" style="width:320px;">Especialidades</button> 
</div>
<div class="yui-panel-container shadow" id="panel1_c" style="z-index: 2;">
<div id="painel_especialidades" class="yui-module yui-overlay yui-panel" style="visibility: inherit; width: 320px;">
		<div class="hd" style="cursor: move;" id="panel1_h">Opções disponíveis:</div>
		<div class="bd">
		<?php echo $this->Html->link(__('Cadastrar Especialidades', true), array('controller'=> 'especialidades','action'=>'add'),array('class'=>'button')); ?>
		<br>
		<?php echo $this->Html->link(__('Consultar Especialidades', true), array('controller'=> 'especialidades','action'=>'index'),array('class'=>'button')); ?>
		</div>
<span class="container-close"> </span></div></div>


<div>
	<button id="localidades" class="yui-button yui-push-button" style="width:320px;">Localidades</button> 
</div>
<div class="yui-panel-container shadow" id="panel5_c" style="z-index: 2;">
<div id="painel_localidades" class="yui-module yui-overlay yui-panel" style="visibility: inherit; width: 320px;">
		<div class="hd" style="cursor: move;" id="panel5_h">Opções disponíveis:</div>
		<div class="bd">
		<?php echo $this->Html->link(__('Cadastrar Localidades', true), array('controller'=> 'localidades','action'=>'add'),array('class'=>'button')); ?>
		<br>
		<?php echo $this->Html->link(__('Consultar Localidades', true), array('controller'=> 'localidades','action'=>'index'),array('class'=>'button')); ?>
		</div>
<span class="container-close"> </span></div></div>




<div>
	<button id="quadros" class="yui-button yui-push-button" style="width:320px;">Quadros</button> 
</div>
<div class="yui-panel-container shadow" id="panel2_c" style="z-index: 2;">
<div id="painel_quadros" class="yui-module yui-overlay yui-panel" style="visibility: inherit; width: 320px;">
		<div class="hd" style="cursor: move;" id="panel2_h">Opções disponíveis:</div>
		<div class="bd">
		<?php echo $this->Html->link(__('Cadastrar Quadros', true), array('controller'=> 'quadros','action'=>'add'),array('class'=>'button')); ?>
		<br>
		<?php echo $this->Html->link(__('Consultar Quadros', true), array('controller'=> 'quadros','action'=>'index'),array('class'=>'button')); ?>
		</div>
<span class="container-close"> </span></div></div>

<div>
	<button id="setores" class="yui-button yui-push-button" style="width:320px;">Setores</button> 
</div>
<div class="yui-panel-container shadow" id="panel3_c" style="z-index: 2;">
<div id="painel_setores" class="yui-module yui-overlay yui-panel" style="visibility: inherit; width: 320px;">
		<div class="hd" style="cursor: move;" id="panel3_h">Opções disponíveis:</div>
		<div class="bd">
		<?php echo $this->Html->link(__('Cadastrar Setores', true), array('controller'=> 'setors','action'=>'add'),array('class'=>'button')); ?>
		<br>
		<?php echo $this->Html->link(__('Consultar Setores', true), array('controller'=> 'setors','action'=>'index'),array('class'=>'button')); ?>
		</div>
<span class="container-close"> </span></div></div>

<div>
	<button id="unidades" class="yui-button yui-push-button" style="width:320px;">Unidades</button> 
</div>
<div class="yui-panel-container shadow" id="panel4_c" style="z-index: 2;">
<div id="painel_unidades" class="yui-module yui-overlay yui-panel" style="visibility: inherit; width: 320px;">
		<div class="hd" style="cursor: move;" id="panel4_h">Opções disponíveis:</div>
		<div class="bd">
		<?php echo $this->Html->link(__('Cadastrar Unidades', true), array('controller'=> 'unidades','action'=>'add'),array('class'=>'button')); ?>
		<br>
		<?php echo $this->Html->link(__('Consultar Unidades', true), array('controller'=> 'unidades','action'=>'index'),array('class'=>'button')); ?>
		</div>
<span class="container-close"> </span></div></div>
