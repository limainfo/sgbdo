<div style="background-color: #FFFFFF; display: none; z-index: 1030; position: fixed; top: 30%; left: 30%; float: center; border-top-width: thin; border-right-width: thin; border-bottom-width: thin; border-left-width: thin; border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: #000000; border-right-color: #000000; border-bottom-color: #000000; border-left-color: #000000;" id="spinner"><img width="15" height="15" alt="" src="<cfoutput>#caminho#</cfoutput>images/ajax-loader.gif"> Carregando ...</div>	

<div  id="manipulacao"  style="width:100%;"></div>
			
			<div id="footer">
			
				<p class="left"><a href="#"><b>SGPO</b> <i>versão <b>1.1</b></i></a></p>
				<p class="right"><a href="mailto:limainfo@gmail.com">limainfo@gmail.com</a></p>
				
			</div>
		
		
		</div>						<!-- wrapper ends -->
		
	</div>		<!-- #hld ends -->
	
	

<script>
	/* jQuery */
jQuery(document).ready(function($) {

	 $( ".Datepicker" ).datepicker();
	 $( ".Datepicker" ).datepicker( $.datepicker.regional[ "pt-BR" ] ); 
	 $( ".Datepicker" ).datepicker("option","dateFormat","yy-mm-dd"); 
	 $( ".Datepicker" ).datepicker({
		 showOn: "button",
		 buttonImage: "../images/calendario.png",
		 showButtonPanel: true,
		 buttonImageOnly: true
		}); 
  });	
	
	jQuery.ready(function() {
	  jQuery('a.minibutton').bind({
		mousedown: function() {
		  jQuery(this).addClass('mousedown');
		},
		blur: function() {
		  jQuery(this).removeClass('mousedown');
		},
		mouseup: function() {
		  jQuery(this).removeClass('mousedown');
		}
	  });
	});
	</script>
<script>
	$('.show').click(function() {
      $('#hide').show('slow', function() {
        // Animation complete.
      });
    });
	$('.hide').click(function() {
      $('#hide').hide('slow', function() {
        // Animation complete.
      });
    });
	</script>
</html>

			
