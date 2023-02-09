<?php 

//print_r($vetor);
//exit();
//$easyzip->gera();
$this->data['Escala']['etapa']=str_replace(',','.',$this->data['Escala']['etapa']);
$z = new EasyZIP('EscalasOpenOffice');
$conteudo=file_get_contents("EscalasOpenOffice/referencia.xml");
$conteudo=str_replace('11111',$vetor['01']['total'],$conteudo);
$conteudo=str_replace('22222',$vetor['02']['total'],$conteudo);
$conteudo=str_replace('33333',$vetor['03']['total'],$conteudo);
$conteudo=str_replace('44444',$vetor['04']['total'],$conteudo);
$conteudo=str_replace('55555',$vetor['05']['total'],$conteudo);
$conteudo=str_replace('66666',$vetor['06']['total'],$conteudo);
$conteudo=str_replace('77777',$vetor['07']['total'],$conteudo);
$conteudo=str_replace('88888',$vetor['08']['total'],$conteudo);
$conteudo=str_replace('99999',$vetor['09']['total'],$conteudo);
$conteudo=str_replace('212121',$vetor['10']['total'],$conteudo);
$conteudo=str_replace('313131',$vetor['11']['total'],$conteudo);
$conteudo=str_replace('414141',$vetor['12']['total'],$conteudo);
$conteudo=str_replace('ZZZZZ',$this->data['Escala']['etapa'],$conteudo);
$conteudo=str_replace('XXXXX',$this->data['Escala']['ano'],$conteudo);
file_put_contents("EscalasOpenOffice/content.xml",$conteudo);
$z -> addFile("content.xml","EscalasOpenOffice/");
$z -> addFile("meta.xml","EscalasOpenOffice/");
$z -> addFile("mimetype","EscalasOpenOffice/");
$z -> addFile("settings.xml","EscalasOpenOffice/");
$z -> addFile("styles.xml","EscalasOpenOffice/");
$z -> addDir("EscalasOpenOffice/","Configurations2");



$z -> addDir("EscalasOpenOffice/","Configurations2/accelerator");
$z -> addFile("floater","EscalasOpenOffice/Configurations2/");
$z -> addDir("EscalasOpenOffice/","Configurations2/images");
$z -> addFile("Bitmaps","EscalasOpenOffice/Configurations2/images/");
$z -> addFile("menubar","EscalasOpenOffice/Configurations2/");
$z -> addFile("popupmenu","EscalasOpenOffice/Configurations2/");
$z -> addFile("progressbar","EscalasOpenOffice/Configurations2/");
$z -> addFile("statusbar","EscalasOpenOffice/Configurations2/");
$z -> addFile("toolbar","EscalasOpenOffice/Configurations2/");

$z -> addFile("current.xml","EscalasOpenOffice/Configurations2/accelerator/");

$z -> addDir("EscalasOpenOffice/","META-INF");
$z -> addFile("manifest.xml","EscalasOpenOffice/META-INF/");

$z -> addDir("EscalasOpenOffice/","Object 1");
$conteudo=file_get_contents("EscalasOpenOffice/Object 1/referencia.xml");
$conteudo=str_replace('11111',$vetor['01']['total'],$conteudo);
$conteudo=str_replace('22222',$vetor['02']['total'],$conteudo);
$conteudo=str_replace('33333',$vetor['03']['total'],$conteudo);
$conteudo=str_replace('44444',$vetor['04']['total'],$conteudo);
$conteudo=str_replace('55555',$vetor['05']['total'],$conteudo);
$conteudo=str_replace('66666',$vetor['06']['total'],$conteudo);
$conteudo=str_replace('77777',$vetor['07']['total'],$conteudo);
$conteudo=str_replace('88888',$vetor['08']['total'],$conteudo);
$conteudo=str_replace('99999',$vetor['09']['total'],$conteudo);
$conteudo=str_replace('212121',$vetor['10']['total'],$conteudo);
$conteudo=str_replace('313131',$vetor['11']['total'],$conteudo);
$conteudo=str_replace('414141',$vetor['12']['total'],$conteudo);
$conteudo=str_replace('ZZZZZ',$this->data['Escala']['etapa'],$conteudo);
$conteudo=str_replace('XXXXX',$this->data['Escala']['ano'],$conteudo);
file_put_contents("EscalasOpenOffice/Object 1/content.xml",$conteudo);

$z -> addFile("content.xml","EscalasOpenOffice/Object 1/");
$z -> addFile("meta.xml","EscalasOpenOffice/Object 1/");
$z -> addFile("styles.xml","EscalasOpenOffice/Object 1/");

$z -> addDir("EscalasOpenOffice/","ObjectReplacements");
$z -> addFile("Object 1","EscalasOpenOffice/ObjectReplacements/");
$z -> addDir("EscalasOpenOffice/","Thumbnails");
$z -> addFile("thumbnail.png","EscalasOpenOffice/Thumbnails/");
/*
$z -> addFile("Object 1","EscalasOpenOffice/ObjectReplacements/");
*/
$zipname='teste.ods';

$z -> zipFile($zipname);

header("Content-type: application/vnd.oasis.opendocument.spreadsheet");
header("Content-Disposition: attachment; filename=$zipname");
//header('Cache-control: no-store, no-cache, must-revalidate');
//header('Pragma: no-cache');
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Expires: 0');

readfile($zipname);
//$z -> zipDelete($zipname);
?>