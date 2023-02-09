<cfset id=CreateUUID()>
<cfparam name="Form.controller" default="">	


<!-- -------------------Estagiários--------------------------- -->
<cfif Form.controller=='estagiarios' and Form.action=='add'>
<cfinclude template="../view/listestagiarios.cfm">
</cfif>

<cfif Form.controller=='fichas' and Form.action=='lista'>
<cfinclude template="../view/avaliaestagiarioficha.cfm">
</cfif>
<cfif Form.controller=='fichas' and Form.action=='dica'>
<cfinclude template="../view/ajaxdicaanexoc.cfm">
</cfif>

