		<div class="block">
			<div class="block_content">
	<div id="accordion" >
	<h3>Perfil</h3>
	<div>
		<p><cfoutput>#conteudoconsulta.perfilID#</cfoutput></p>
		<p><b>Tipo:</b><cfoutput>#conteudoconsulta.tipo#</cfoutput></p>
		<p><b>Responsável:</b><cfoutput>#conteudoconsulta.nomeunidade#</cfoutput></p>
	</div>
	<h3>Unidades</h3>
	<div>
		<cfquery datasource="lpna" name="conteudoconsulta">
		select ur.*, u.*, ur.nome regional, u.nome unidade from unidades_regionais ur 
		inner join unidades u on (ur.unidadeID=u.unidadeID #fverUnidadeID# #fverRegionalID#)
		</cfquery>
		<cfloop query="conteudoconsulta">
		<cfoutput>#conteudoconsulta.regional#-#conteudoconsulta.unidade#<br></cfoutput>
		</cfloop>
		</p>
	</div>
	<h3>Habilitações</h3>
	<div>
		<cfquery datasource="lpna" name="conteudoconsulta">
		select * from habilitacoes_select hs 
		where 1=1 #fverHabilitacao#
		</cfquery>
		<cfloop query="conteudoconsulta">
		<cfoutput>#conteudoconsulta.habilitacao#<br></cfoutput>
		</cfloop>
		</p>
	</div>
</div>
	<script>
	$(function() {
		var icons = {
			header: "ui-icon-circle-arrow-e",
			activeHeader: "ui-icon-circle-arrow-s"
		};
		$( "#accordion" ).accordion({
			icons: icons,
			heightStyle: "content",
			collapsible: true
		});
		$( "#toggle" ).button().click(function() {
			if ( $( "#accordion" ).accordion( "option", "icons" ) ) {
				$( "#accordion" ).accordion( "option", "icons", null );
			} else {
				$( "#accordion" ).accordion( "option", "icons", icons );
			}
		});
	});
</script>
<br><br><br><br>

			</div>		<!-- .block_content ends -->
			<div class="bendl"></div>
			<div class="bendr"></div>
					
		</div>		<!-- .block ends -->
