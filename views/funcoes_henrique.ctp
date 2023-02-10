<?php

function Menu_Barra($grupo, $relatorio, $titulo, $fim=1){
	static $id;
	$id++;
	$estiloBarra = "-moz-background-clip: border;-moz-background-origin: padding;-moz-background-size: auto auto;background-attachment: scroll;background-color: #556699;
    background-image: none;background-position: 0 0;background-repeat: repeat;border-left-color-ltr-source: solid;border-left-color-rtl-source: solid;
    border-left-color-value: #000000;border-left-width-ltr-source: physical;border-left-width-rtl-source: physical;visibility:visible;
    border-left-width-value: 6px;color: #FFFFFF;font-size: 1.0em;height: 1.8em;line-height: 1.8;
    margin-left: 0;margin-right: 0;padding-left: 10px;text-align:left;margin-bottom:0px;";
	echo("<div id='{$grupo}' style='background-color:#ffffff;margin:0 0 0 0;padding:0 0 0 0;'>\n");
	echo("<p style='{$estiloBarra}'>");
	echo("<a id='btabrir{$id}' style='display: block;color: #EEEEEE; float: left; border-style: solid; border-color: white; border-width: 1px;'"); 
	echo(" href=\"javascript:HideContent('btabrir{$id}');ShowContent('btfechar{$id}');ShowContent('{$relatorio}');\">&nbsp;+&nbsp;</a>\n");
	echo("<a id='btfechar{$id}' style='display: none;color: #EEEEEE; float: left; border-style: solid; border-color: white; border-width: 1px;'");  
	echo("href=\"javascript:HideContent('btfechar{$id}');ShowContent('btabrir{$id}');HideContent('{$relatorio}');\">&nbsp;-&nbsp;</a>\n&nbsp;&nbsp;{$titulo} </p>\n");
	if($fim){
		echo("<table cellpadding=0 class='tabelalimpa' cellspacing=0 id='{$relatorio}' style='align:center;' width='auto' >\n");
		echo("<tr><td width='auto'>");
	}
}

?>