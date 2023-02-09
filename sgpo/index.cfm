<cfif not StructKeyExists(session,"id") >
	<cflocation addtoken='no' url="../../../../../id/?i=logout&appID=#app.appID#">
</cfif>

  <cfset caminho='' >

<cfinclude template="view/cabecalho.cfm">			
  
<cfif conteudo eq ''>
<cfinclude template="view/inicio.cfm">			
<cfelse>
<cfinclude template=#conteudo# >
</cfif>		
			
			
			
			
<cfinclude template="view/rodape.cfm">			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			

			
			
			
			
			
			
			
			
			
			
			
			
			
