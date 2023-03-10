<?php 
//print_r($_SERVER);
//exit();
//print_r($vetor);
//exit();
//$easyzip->gera();
// Report all PHP errors
//error_reporting(E_ALL);

// Same as error_reporting(E_ALL);
//ini_set('error_reporting', E_ALL);

$z = new EasyZIP('compensacao');

$cabecalho = <<<CAB
<?xml version="1.0" encoding="UTF-8"?>
<office:document-content xmlns:office="urn:oasis:names:tc:opendocument:xmlns:office:1.0" xmlns:style="urn:oasis:names:tc:opendocument:xmlns:style:1.0" xmlns:text="urn:oasis:names:tc:opendocument:xmlns:text:1.0" xmlns:table="urn:oasis:names:tc:opendocument:xmlns:table:1.0" xmlns:draw="urn:oasis:names:tc:opendocument:xmlns:drawing:1.0" xmlns:fo="urn:oasis:names:tc:opendocument:xmlns:xsl-fo-compatible:1.0" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:meta="urn:oasis:names:tc:opendocument:xmlns:meta:1.0" xmlns:number="urn:oasis:names:tc:opendocument:xmlns:datastyle:1.0" xmlns:presentation="urn:oasis:names:tc:opendocument:xmlns:presentation:1.0" xmlns:svg="urn:oasis:names:tc:opendocument:xmlns:svg-compatible:1.0" xmlns:chart="urn:oasis:names:tc:opendocument:xmlns:chart:1.0" xmlns:dr3d="urn:oasis:names:tc:opendocument:xmlns:dr3d:1.0" xmlns:math="http://www.w3.org/1998/Math/MathML" xmlns:form="urn:oasis:names:tc:opendocument:xmlns:form:1.0" xmlns:script="urn:oasis:names:tc:opendocument:xmlns:script:1.0" xmlns:ooo="http://openoffice.org/2004/office" xmlns:ooow="http://openoffice.org/2004/writer" xmlns:oooc="http://openoffice.org/2004/calc" xmlns:dom="http://www.w3.org/2001/xml-events" xmlns:xforms="http://www.w3.org/2002/xforms" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:rpt="http://openoffice.org/2005/report" xmlns:of="urn:oasis:names:tc:opendocument:xmlns:of:1.2" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:grddl="http://www.w3.org/2003/g/data-view#" xmlns:tableooo="http://openoffice.org/2009/table" xmlns:field="urn:openoffice:names:experimental:ooo-ms-interop:xmlns:field:1.0" xmlns:formx="urn:openoffice:names:experimental:ooxml-odf-interop:xmlns:form:1.0" xmlns:css3t="http://www.w3.org/TR/css3-text/" office:version="1.2"><office:scripts/><office:font-face-decls><style:font-face style:name="Times New Roman" svg:font-family="&apos;Times New Roman&apos;" style:font-family-generic="roman"/><style:font-face style:name="Arial1" svg:font-family="Arial" style:font-family-generic="swiss"/><style:font-face style:name="Tahoma" svg:font-family="Tahoma" style:font-family-generic="swiss"/><style:font-face style:name="Verdana" svg:font-family="Verdana" style:font-family-generic="swiss"/><style:font-face style:name="Arial" svg:font-family="Arial" style:font-family-generic="swiss" style:font-pitch="variable"/><style:font-face style:name="AR PL KaitiM GB" svg:font-family="&apos;AR PL KaitiM GB&apos;" style:font-family-generic="system" style:font-pitch="variable"/><style:font-face style:name="DejaVu Sans" svg:font-family="&apos;DejaVu Sans&apos;" style:font-family-generic="system" style:font-pitch="variable"/><style:font-face style:name="Lohit Hindi" svg:font-family="&apos;Lohit Hindi&apos;" style:font-family-generic="system" style:font-pitch="variable"/></office:font-face-decls><office:automatic-styles><style:style style:name="co1" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="0.998cm"/></style:style><style:style style:name="co2" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="1.916cm"/></style:style><style:style style:name="co3" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="1.78cm"/></style:style><style:style style:name="co4" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="3.755cm"/></style:style><style:style style:name="co5" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="6.701cm"/></style:style><style:style style:name="co6" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="2.776cm"/></style:style><style:style style:name="co7" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="2.494cm"/></style:style><style:style style:name="co8" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="2.104cm"/></style:style><style:style style:name="co9" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="2.02cm"/></style:style><style:style style:name="co10" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="1.741cm"/></style:style><style:style style:name="co11" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="2.048cm"/></style:style><style:style style:name="co12" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="1.88cm"/></style:style><style:style style:name="co13" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="0.863cm"/></style:style><style:style style:name="co14" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="1.349cm"/></style:style><style:style style:name="co15" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="1.132cm"/></style:style><style:style style:name="co16" style:family="table-column"><style:table-column-properties fo:break-before="auto" style:column-width="2.374cm"/></style:style><style:style style:name="ro1" style:family="table-row"><style:table-row-properties style:row-height="1.5cm" fo:break-before="auto" style:use-optimal-row-height="false"/></style:style><style:style style:name="ro2" style:family="table-row"><style:table-row-properties style:row-height="0.37cm" fo:break-before="auto" style:use-optimal-row-height="false"/></style:style><style:style style:name="ro3" style:family="table-row"><style:table-row-properties style:row-height="0.45cm" fo:break-before="auto" style:use-optimal-row-height="true"/></style:style><style:style style:name="ta1" style:family="table" style:master-page-name="PageStyle_5f_ACC-AO_20_"><style:table-properties table:display="true" style:writing-mode="lr-tb"/></style:style><number:number-style style:name="N1"><number:number number:decimal-places="0" number:min-integer-digits="1"/></number:number-style><number:date-style style:name="N36" number:automatic-order="true"><number:day number:style="long"/><number:text>/</number:text><number:month number:style="long"/><number:text>/</number:text><number:year number:style="long"/></number:date-style><style:style style:name="ce1" style:family="table-cell" style:parent-style-name="Default"><style:table-cell-properties fo:padding="0.071cm"/><style:text-properties style:use-window-font-color="true" style:text-outline="false" style:text-line-through-style="none" style:font-name="Verdana" fo:font-size="8pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="normal" style:font-size-asian="8pt" style:font-style-asian="normal" style:font-weight-asian="normal" style:font-size-complex="8pt" style:font-style-complex="normal" style:font-weight-complex="normal"/></style:style><style:style style:name="ce2" style:family="table-cell" style:parent-style-name="Default"><style:table-cell-properties style:glyph-orientation-vertical="0" style:diagonal-bl-tr="none" style:diagonal-tl-br="none" style:text-align-source="fix" style:repeat-content="false" fo:wrap-option="no-wrap" fo:border="0.06pt solid #000000" style:direction="ltr" fo:padding="0.071cm" style:rotation-angle="0" style:rotation-align="none" style:shrink-to-fit="false" style:vertical-align="automatic" style:vertical-justify="auto"/><style:paragraph-properties fo:text-align="center" css3t:text-justify="auto" fo:margin-left="0cm" style:writing-mode="page"/><style:text-properties fo:color="#000000" style:text-outline="false" style:text-line-through-style="none" style:font-name="Tahoma" fo:font-size="8pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="normal" style:font-size-asian="8pt" style:font-style-asian="normal" style:font-weight-asian="normal" style:font-name-complex="Tahoma" style:font-size-complex="8pt" style:font-style-complex="normal" style:font-weight-complex="normal"/></style:style><style:style style:name="ce3" style:family="table-cell" style:parent-style-name="Default"><style:table-cell-properties style:glyph-orientation-vertical="0" style:text-align-source="fix" style:repeat-content="false" fo:wrap-option="no-wrap" style:direction="ltr" fo:padding="0.071cm" style:rotation-angle="0" style:rotation-align="none" style:shrink-to-fit="false" style:vertical-align="automatic" style:vertical-justify="auto"/><style:paragraph-properties fo:text-align="center" css3t:text-justify="auto" fo:margin-left="0cm" style:writing-mode="page"/><style:text-properties style:use-window-font-color="true" style:text-outline="false" style:text-line-through-style="none" style:font-name="Tahoma" fo:font-size="8pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="normal" style:font-size-asian="8pt" style:font-style-asian="normal" style:font-weight-asian="normal" style:font-name-complex="Tahoma" style:font-size-complex="8pt" style:font-style-complex="normal" style:font-weight-complex="normal"/></style:style><style:style style:name="ce4" style:family="table-cell" style:parent-style-name="Default"><style:table-cell-properties style:glyph-orientation-vertical="0" style:text-align-source="fix" style:repeat-content="false" fo:wrap-option="no-wrap" style:direction="ltr" fo:padding="0.071cm" style:rotation-angle="0" style:rotation-align="none" style:shrink-to-fit="false" style:vertical-align="automatic" style:vertical-justify="auto"/><style:paragraph-properties fo:text-align="center" css3t:text-justify="auto" fo:margin-left="0cm" style:writing-mode="page"/><style:text-properties fo:color="#000000" style:text-outline="false" style:text-line-through-style="none" style:font-name="Tahoma" fo:font-size="8pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="normal" style:font-size-asian="8pt" style:font-style-asian="normal" style:font-weight-asian="normal" style:font-name-complex="Tahoma" style:font-size-complex="8pt" style:font-style-complex="normal" style:font-weight-complex="normal"/></style:style><style:style style:name="ce5" style:family="table-cell" style:parent-style-name="Default"><style:table-cell-properties style:glyph-orientation-vertical="0" style:diagonal-bl-tr="none" style:diagonal-tl-br="none" style:text-align-source="fix" style:repeat-content="false" fo:wrap-option="no-wrap" fo:border="none" style:direction="ltr" fo:padding="0.071cm" style:rotation-angle="0" style:rotation-align="none" style:shrink-to-fit="false" style:vertical-align="middle" style:vertical-justify="auto"/><style:paragraph-properties fo:text-align="center" css3t:text-justify="auto" fo:margin-left="0cm" style:writing-mode="page"/><style:text-properties fo:color="#0000ff" style:text-outline="false" style:text-line-through-style="none" style:font-name="Tahoma" fo:font-size="18pt" fo:font-style="italic" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="bold" style:font-size-asian="18pt" style:font-style-asian="italic" style:font-weight-asian="bold" style:font-name-complex="Tahoma" style:font-size-complex="18pt" style:font-style-complex="italic" style:font-weight-complex="bold"/></style:style><style:style style:name="ce6" style:family="table-cell" style:parent-style-name="Default"><style:table-cell-properties fo:padding="0.071cm"/><style:text-properties fo:color="#000000" style:text-outline="false" style:text-line-through-style="none" style:font-name="Tahoma" fo:font-size="8pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="normal" style:font-size-asian="8pt" style:font-style-asian="normal" style:font-weight-asian="normal" style:font-name-complex="Tahoma" style:font-size-complex="8pt" style:font-style-complex="normal" style:font-weight-complex="normal"/></style:style><style:style style:name="ce7" style:family="table-cell" style:parent-style-name="Default"><style:table-cell-properties fo:padding="0.071cm"/><style:text-properties style:use-window-font-color="true" style:text-outline="false" style:text-line-through-style="none" style:font-name="Tahoma" fo:font-size="8pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="normal" style:font-size-asian="8pt" style:font-style-asian="normal" style:font-weight-asian="normal" style:font-name-complex="Tahoma" style:font-size-complex="8pt" style:font-style-complex="normal" style:font-weight-complex="normal"/></style:style><style:style style:name="ce8" style:family="table-cell" style:parent-style-name="Default"><style:table-cell-properties style:glyph-orientation-vertical="0" style:diagonal-bl-tr="none" style:diagonal-tl-br="none" style:text-align-source="fix" style:repeat-content="false" fo:wrap-option="no-wrap" fo:border="none" style:direction="ltr" fo:padding="0.071cm" style:rotation-angle="0" style:rotation-align="none" style:shrink-to-fit="false" style:vertical-align="automatic" style:vertical-justify="auto"/><style:paragraph-properties fo:text-align="start" css3t:text-justify="auto" fo:margin-left="0cm" style:writing-mode="page"/><style:text-properties fo:color="#000000" style:text-outline="false" style:text-line-through-style="none" style:font-name="Tahoma" fo:font-size="8pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="normal" style:font-size-asian="8pt" style:font-style-asian="normal" style:font-weight-asian="normal" style:font-name-complex="Tahoma" style:font-size-complex="8pt" style:font-style-complex="normal" style:font-weight-complex="normal"/></style:style><style:style style:name="ce9" style:family="table-cell" style:parent-style-name="Default" style:data-style-name="N36"><style:table-cell-properties style:glyph-orientation-vertical="0" style:diagonal-bl-tr="none" style:diagonal-tl-br="none" style:text-align-source="fix" style:repeat-content="false" fo:wrap-option="no-wrap" fo:border="none" style:direction="ltr" fo:padding="0.071cm" style:rotation-angle="0" style:rotation-align="none" style:shrink-to-fit="false" style:vertical-align="middle" style:vertical-justify="auto"/><style:paragraph-properties fo:text-align="center" css3t:text-justify="auto" fo:margin-left="0cm" style:writing-mode="page"/><style:text-properties fo:color="#0000ff" style:text-outline="false" style:text-line-through-style="none" style:font-name="Tahoma" fo:font-size="18pt" fo:font-style="italic" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="bold" style:font-size-asian="18pt" style:font-style-asian="italic" style:font-weight-asian="bold" style:font-name-complex="Tahoma" style:font-size-complex="18pt" style:font-style-complex="italic" style:font-weight-complex="bold"/></style:style><style:style style:name="ce10" style:family="table-cell" style:parent-style-name="Default" style:data-style-name="N36"><style:table-cell-properties style:glyph-orientation-vertical="0" style:diagonal-bl-tr="none" style:diagonal-tl-br="none" style:text-align-source="fix" style:repeat-content="false" fo:wrap-option="no-wrap" fo:border="0.06pt solid #000000" style:direction="ltr" fo:padding="0.071cm" style:rotation-angle="0" style:rotation-align="none" style:shrink-to-fit="false" style:vertical-align="automatic" style:vertical-justify="auto"/><style:paragraph-properties fo:text-align="center" css3t:text-justify="auto" fo:margin-left="0cm" style:writing-mode="page"/><style:text-properties fo:color="#000000" style:text-outline="false" style:text-line-through-style="none" style:font-name="Tahoma" fo:font-size="8pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="normal" style:font-size-asian="8pt" style:font-style-asian="normal" style:font-weight-asian="normal" style:font-name-complex="Tahoma" style:font-size-complex="8pt" style:font-style-complex="normal" style:font-weight-complex="normal"/></style:style><style:style style:name="ce11" style:family="table-cell" style:parent-style-name="Default"><style:table-cell-properties style:glyph-orientation-vertical="0" style:diagonal-bl-tr="none" style:diagonal-tl-br="none" style:text-align-source="fix" style:repeat-content="false" fo:wrap-option="wrap" fo:border="none" style:direction="ltr" fo:padding="0.071cm" style:rotation-angle="0" style:rotation-align="none" style:shrink-to-fit="false" style:vertical-align="top" style:vertical-justify="auto"/><style:paragraph-properties fo:text-align="center" css3t:text-justify="auto" fo:margin-left="0cm" style:writing-mode="page"/><style:text-properties fo:color="#ff0000" style:text-outline="false" style:text-line-through-style="none" style:font-name="Verdana" fo:font-size="20pt" fo:font-style="italic" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="bold" style:font-size-asian="20pt" style:font-style-asian="italic" style:font-weight-asian="bold" style:font-size-complex="20pt" style:font-style-complex="italic" style:font-weight-complex="bold"/></style:style><style:style style:name="ce12" style:family="table-cell" style:parent-style-name="Default" style:data-style-name="N0"><style:table-cell-properties style:glyph-orientation-vertical="0" fo:border-bottom="none" fo:background-color="#33cccc" style:diagonal-bl-tr="none" style:diagonal-tl-br="none" style:text-align-source="fix" style:repeat-content="false" fo:wrap-option="no-wrap" fo:border-left="0.31pt solid #000000" style:direction="ltr" fo:padding="0.071cm" fo:border-right="0.31pt solid #000000" style:rotation-angle="0" style:rotation-align="none" style:shrink-to-fit="false" fo:border-top="none" style:vertical-align="automatic" style:vertical-justify="auto"/><style:paragraph-properties fo:text-align="center" css3t:text-justify="auto" fo:margin-left="0cm" style:writing-mode="page"/><style:text-properties fo:color="#000000" style:text-outline="false" style:text-line-through-style="none" style:font-name="Arial1" fo:font-size="8pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="bold" style:font-size-asian="8pt" style:font-style-asian="normal" style:font-weight-asian="bold" style:font-name-complex="Arial1" style:font-size-complex="8pt" style:font-style-complex="normal" style:font-weight-complex="bold"/></style:style><style:style style:name="ce13" style:family="table-cell" style:parent-style-name="Default" style:data-style-name="N0"><style:table-cell-properties style:glyph-orientation-vertical="0" style:diagonal-bl-tr="none" style:diagonal-tl-br="none" style:text-align-source="fix" style:repeat-content="false" fo:background-color="transparent" fo:wrap-option="no-wrap" fo:border="0.06pt solid #000000" style:direction="ltr" fo:padding="0.071cm" style:rotation-angle="0" style:rotation-align="none" style:shrink-to-fit="false" style:vertical-align="automatic" style:vertical-justify="auto"/><style:paragraph-properties fo:text-align="center" css3t:text-justify="auto" fo:margin-left="0cm" style:writing-mode="page"/><style:text-properties fo:color="#000000" style:text-outline="false" style:text-line-through-style="none" style:font-name="Arial1" fo:font-size="9pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="normal" style:font-size-asian="9pt" style:font-style-asian="normal" style:font-weight-asian="normal" style:font-name-complex="Arial1" style:font-size-complex="9pt" style:font-style-complex="normal" style:font-weight-complex="normal"/></style:style><style:style style:name="ce14" style:family="table-cell" style:parent-style-name="Default"><style:table-cell-properties fo:background-color="transparent" fo:padding="0.071cm"/><style:text-properties style:use-window-font-color="true" style:text-outline="false" style:text-line-through-style="none" style:font-name="Verdana" fo:font-size="8pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="normal" style:font-size-asian="8pt" style:font-style-asian="normal" style:font-weight-asian="normal" style:font-size-complex="8pt" style:font-style-complex="normal" style:font-weight-complex="normal"/></style:style><style:style style:name="ce15" style:family="table-cell" style:parent-style-name="Default" style:data-style-name="N1"><style:table-cell-properties style:glyph-orientation-vertical="0" style:diagonal-bl-tr="none" style:diagonal-tl-br="none" style:text-align-source="fix" style:repeat-content="false" fo:background-color="transparent" fo:wrap-option="wrap" fo:border="0.06pt solid #000000" style:direction="ltr" fo:padding="0.071cm" style:rotation-angle="0" style:rotation-align="none" style:shrink-to-fit="false" style:vertical-align="top" style:vertical-justify="auto"/><style:paragraph-properties fo:text-align="center" css3t:text-justify="auto" fo:margin-left="0cm" style:writing-mode="page"/><style:text-properties style:use-window-font-color="true" style:text-outline="false" style:text-line-through-style="none" style:font-name="Arial1" fo:font-size="9pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="normal" style:font-size-asian="9pt" style:font-style-asian="normal" style:font-weight-asian="normal" style:font-name-complex="Arial1" style:font-size-complex="9pt" style:font-style-complex="normal" style:font-weight-complex="normal"/></style:style><style:style style:name="ce16" style:family="table-cell" style:parent-style-name="Default"><style:table-cell-properties fo:background-color="transparent" fo:padding="0.071cm"/><style:text-properties style:use-window-font-color="true" style:text-outline="false" style:text-line-through-style="none" style:font-name="Verdana" fo:font-size="9pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="normal" style:font-size-asian="9pt" style:font-style-asian="normal" style:font-weight-asian="normal" style:font-size-complex="9pt" style:font-style-complex="normal" style:font-weight-complex="normal"/></style:style><style:style style:name="ce17" style:family="table-cell" style:parent-style-name="Default" style:data-style-name="N0"><style:table-cell-properties style:glyph-orientation-vertical="0" style:diagonal-bl-tr="none" style:diagonal-tl-br="none" style:text-align-source="fix" style:repeat-content="false" fo:background-color="transparent" fo:wrap-option="no-wrap" fo:border="0.06pt solid #000000" style:direction="ltr" fo:padding="0.071cm" style:rotation-angle="0" style:rotation-align="none" style:shrink-to-fit="false" style:vertical-align="automatic" style:vertical-justify="auto"/><style:paragraph-properties fo:text-align="center" css3t:text-justify="auto" fo:margin-left="0cm" style:writing-mode="page"/><style:text-properties fo:color="#000000" style:text-outline="false" style:text-line-through-style="none" style:font-name="Arial1" fo:font-size="8pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="normal" style:font-size-asian="8pt" style:font-style-asian="normal" style:font-weight-asian="normal" style:font-name-complex="Arial1" style:font-size-complex="8pt" style:font-style-complex="normal" style:font-weight-complex="normal"/></style:style><style:style style:name="ce18" style:family="table-cell" style:parent-style-name="Default"><style:table-cell-properties fo:padding="0.071cm"/><style:text-properties style:use-window-font-color="true" style:text-outline="false" style:text-line-through-style="none" style:font-name="Verdana" fo:font-size="9pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="normal" style:font-size-asian="9pt" style:font-style-asian="normal" style:font-weight-asian="normal" style:font-size-complex="9pt" style:font-style-complex="normal" style:font-weight-complex="normal"/></style:style><style:style style:name="ce19" style:family="table-cell" style:parent-style-name="Default" style:data-style-name="N0"><style:table-cell-properties style:glyph-orientation-vertical="0" fo:border-bottom="none" fo:background-color="#ccffcc" style:diagonal-bl-tr="none" style:diagonal-tl-br="none" style:text-align-source="fix" style:repeat-content="false" fo:wrap-option="no-wrap" fo:border-left="0.31pt solid #000000" style:direction="ltr" fo:padding="0.071cm" fo:border-right="0.31pt solid #000000" style:rotation-angle="0" style:rotation-align="none" style:shrink-to-fit="false" fo:border-top="0.31pt solid #000000" style:vertical-align="automatic" style:vertical-justify="auto"/><style:paragraph-properties fo:text-align="center" css3t:text-justify="auto" fo:margin-left="0cm" style:writing-mode="page"/><style:text-properties fo:color="#000000" style:text-outline="false" style:text-line-through-style="none" style:font-name="Arial1" fo:font-size="8pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="normal" style:font-size-asian="8pt" style:font-style-asian="normal" style:font-weight-asian="normal" style:font-name-complex="Arial1" style:font-size-complex="8pt" style:font-style-complex="normal" style:font-weight-complex="normal"/></style:style><style:style style:name="ce20" style:family="table-cell" style:parent-style-name="Default" style:data-style-name="N0"><style:table-cell-properties style:glyph-orientation-vertical="0" fo:border-bottom="none" fo:background-color="#ffcc99" style:diagonal-bl-tr="none" style:diagonal-tl-br="none" style:text-align-source="fix" style:repeat-content="false" fo:wrap-option="no-wrap" fo:border-left="0.31pt solid #000000" style:direction="ltr" fo:padding="0.071cm" fo:border-right="0.31pt solid #000000" style:rotation-angle="0" style:rotation-align="none" style:shrink-to-fit="false" fo:border-top="0.31pt solid #000000" style:vertical-align="automatic" style:vertical-justify="auto"/><style:paragraph-properties fo:text-align="center" css3t:text-justify="auto" fo:margin-left="0cm" style:writing-mode="page"/><style:text-properties fo:color="#000000" style:text-outline="false" style:text-line-through-style="none" style:font-name="Arial1" fo:font-size="8pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="normal" style:font-size-asian="8pt" style:font-style-asian="normal" style:font-weight-asian="normal" style:font-name-complex="Arial1" style:font-size-complex="8pt" style:font-style-complex="normal" style:font-weight-complex="normal"/></style:style><style:style style:name="ce21" style:family="table-cell" style:parent-style-name="Default" style:data-style-name="N0"><style:table-cell-properties style:glyph-orientation-vertical="0" fo:background-color="#ccffff" style:diagonal-bl-tr="none" style:diagonal-tl-br="none" style:text-align-source="fix" style:repeat-content="false" fo:wrap-option="no-wrap" fo:border="0.31pt solid #000000" style:direction="ltr" fo:padding="0.071cm" style:rotation-angle="0" style:rotation-align="none" style:shrink-to-fit="false" style:vertical-align="automatic" style:vertical-justify="auto"/><style:paragraph-properties fo:text-align="center" css3t:text-justify="auto" fo:margin-left="0cm" style:writing-mode="page"/><style:text-properties fo:color="#000000" style:text-outline="false" style:text-line-through-style="none" style:font-name="Arial1" fo:font-size="9pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="normal" style:font-size-asian="9pt" style:font-style-asian="normal" style:font-weight-asian="normal" style:font-name-complex="Arial1" style:font-size-complex="9pt" style:font-style-complex="normal" style:font-weight-complex="normal"/><style:map style:condition="cell-content()=&quot;SIM&quot;" style:apply-style-name="Excel_5f_CondFormat_5f_1_5f_1_5f_1" style:base-cell-address="&apos;ACC-AO &apos;.AI2"/><style:map style:condition="cell-content()=&quot;N??O&quot;" style:apply-style-name="Excel_5f_CondFormat_5f_1_5f_1_5f_2" style:base-cell-address="&apos;ACC-AO &apos;.AI2"/></style:style><style:style style:name="gr1" style:family="graphic"><style:graphic-properties draw:stroke="solid" svg:stroke-width="0.026cm" svg:stroke-color="#000000" draw:marker-start="msArrowEnd_20_5" draw:marker-start-width="0.21cm" draw:marker-start-center="false" draw:stroke-linejoin="miter" draw:fill="solid" draw:fill-color="#ffffe0" draw:textarea-horizontal-align="justify" draw:textarea-vertical-align="top" draw:auto-grow-height="false" draw:auto-grow-width="false" fo:padding-top="0.056cm" fo:padding-bottom="0.056cm" fo:padding-left="0.056cm" fo:padding-right="0.056cm" fo:wrap-option="no-wrap" draw:shadow="hidden" draw:shadow-offset-x="0.1cm" draw:shadow-offset-y="0.1cm" draw:shadow-color="#000000" draw:caption-escape-direction="auto"/></style:style><style:style style:name="P1" style:family="paragraph"><style:paragraph-properties fo:text-align="start" style:text-autospace="none" style:line-break="normal" style:writing-mode="lr-tb"/><style:text-properties style:text-outline="false" style:text-line-through-style="none" style:font-name="Verdana" fo:font-size="12pt" fo:language="pt" fo:country="BR" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="normal" style:text-underline-mode="continuous" style:text-overline-mode="continuous" style:text-line-through-mode="continuous" style:font-name-asian="AR PL KaitiM GB" style:font-size-asian="12pt" style:language-asian="zh" style:country-asian="CN" style:font-style-asian="normal" style:font-weight-asian="normal" style:font-name-complex="Lohit Hindi" style:font-size-complex="12pt" style:language-complex="hi" style:country-complex="IN" style:font-style-complex="normal" style:font-weight-complex="normal" style:text-emphasize="none" style:font-relief="none" style:text-overline-style="none" style:text-overline-color="font-color" fo:hyphenate="false"/></style:style><style:style style:name="T1" style:family="text"><style:text-properties fo:color="#000000" style:text-outline="false" style:text-line-through-style="none" style:text-position="0% 100%" style:font-name="Times New Roman" fo:font-size="8pt" fo:font-style="normal" fo:text-shadow="none" style:text-underline-style="none" fo:font-weight="bold" style:font-size-asian="8pt" style:font-style-asian="normal" style:font-weight-asian="bold" style:font-name-complex="Times New Roman" style:font-size-complex="8pt" style:font-style-complex="normal" style:font-weight-complex="bold"/></style:style></office:automatic-styles><office:body><office:spreadsheet><table:calculation-settings table:case-sensitive="false" table:automatic-find-labels="false" table:use-regular-expressions="false"/><table:table table:name="ACC-AO " table:style-name="ta1"><office:forms form:automatic-focus="false" form:apply-design-mode="false"/><table:table-column table:style-name="co1" table:default-cell-style-name="ce1"/><table:table-column table:style-name="co2" table:default-cell-style-name="ce3"/><table:table-column table:style-name="co3" table:number-columns-repeated="3" table:default-cell-style-name="ce3"/><table:table-column table:style-name="co4" table:default-cell-style-name="ce7"/><table:table-column table:style-name="co5" table:default-cell-style-name="ce7"/><table:table-column table:style-name="co6" table:default-cell-style-name="ce7"/><table:table-column table:style-name="co7" table:default-cell-style-name="ce7"/><table:table-column table:style-name="co8" table:default-cell-style-name="ce3"/><table:table-column table:style-name="co9" table:default-cell-style-name="ce3"/><table:table-column table:style-name="co10" table:default-cell-style-name="ce3"/><table:table-column table:style-name="co11" table:default-cell-style-name="ce3"/><table:table-column table:style-name="co6" table:default-cell-style-name="ce3"/><table:table-column table:style-name="co12" table:default-cell-style-name="ce3"/><table:table-column table:style-name="co13" table:number-columns-repeated="9" table:default-cell-style-name="ce1"/><table:table-column table:style-name="co14" table:default-cell-style-name="ce1"/><table:table-column table:style-name="co13" table:number-columns-repeated="9" table:default-cell-style-name="ce1"/><table:table-column table:style-name="co15" table:default-cell-style-name="ce1"/><table:table-column table:style-name="co13" table:number-columns-repeated="3" table:default-cell-style-name="ce1"/><table:table-column table:style-name="co16" table:number-columns-repeated="219" table:default-cell-style-name="ce1"/><table:table-column table:style-name="co16" table:number-columns-repeated="767" table:default-cell-style-name="Default"/><table:table-row table:style-name="ro1"><table:table-cell/><table:table-cell table:style-name="ce2" office:value-type="string"><text:p>Licen??a</text:p></table:table-cell><table:table-cell table:style-name="ce4" office:value-type="string"><text:p>Saram</text:p></table:table-cell><table:table-cell table:style-name="ce4" office:value-type="string"><text:p>Posto</text:p></table:table-cell><table:table-cell table:style-name="ce4" office:value-type="string"><text:p>Quadro</text:p></table:table-cell><table:table-cell table:style-name="ce6" office:value-type="string"><text:p>Nome de Guerra</text:p></table:table-cell><table:table-cell table:style-name="ce8" office:value-type="string" table:number-columns-spanned="3" table:number-rows-spanned="1"><text:p>Setor</text:p></table:table-cell><table:covered-table-cell table:number-columns-repeated="2" table:style-name="ce8"/><table:table-cell table:style-name="ce4" office:value-type="string"><text:p>Indicativo</text:p></table:table-cell><table:table-cell table:style-name="ce4" office:value-type="string"><text:p>Unidade</text:p></table:table-cell><table:table-cell table:style-name="ce4" office:value-type="string"><text:p>Org??o</text:p></table:table-cell><table:table-cell table:style-name="ce4" office:value-type="string"><text:p>CHT</text:p></table:table-cell><table:table-cell table:style-name="ce4" office:value-type="string"><text:p>Validade CHT</text:p></table:table-cell><table:table-cell table:style-name="ce4" office:value-type="string"><text:p>Val <text:s/></text:p></table:table-cell><table:table-cell table:style-name="ce12" office:value-type="string"><text:p>JAN </text:p></table:table-cell><table:table-cell table:style-name="ce12" office:value-type="string"><text:p>FEV</text:p></table:table-cell><table:table-cell table:style-name="ce12" office:value-type="string"><text:p>MAR</text:p></table:table-cell><table:table-cell table:style-name="ce12" office:value-type="string"><text:p>ABR</text:p></table:table-cell><table:table-cell table:style-name="ce12" office:value-type="string"><text:p>MAI</text:p></table:table-cell><table:table-cell table:style-name="ce12" office:value-type="string"><text:p>JUN</text:p></table:table-cell><table:table-cell table:style-name="ce12" office:value-type="string"><text:p>JUL</text:p></table:table-cell><table:table-cell table:style-name="ce12" office:value-type="string"><text:p>AGO</text:p></table:table-cell><table:table-cell table:style-name="ce12" office:value-type="string"><text:p>SET</text:p></table:table-cell><table:table-cell table:style-name="ce12" office:value-type="string"><text:p>OUT</text:p></table:table-cell><table:table-cell table:style-name="ce12" office:value-type="string"><text:p>NOV</text:p></table:table-cell><table:table-cell table:style-name="ce12" office:value-type="string"><text:p>DEZ</text:p></table:table-cell><table:table-cell table:style-name="ce19" office:value-type="string"><office:annotation draw:style-name="gr1" draw:text-style-name="P1" svg:width="3.403cm" svg:height="1.455cm" svg:x="52.319cm" svg:y="0cm" draw:caption-point-x="-4.08cm" draw:caption-point-y="0.01cm"><dc:date>2013-10-11T00:00:00</dc:date><text:p text:style-name="P1"><text:span text:style-name="T1">Preeencher a carga hor??ria trabalhada no m??s pelo ATCO.</text:span></text:p><text:p text:style-name="P1"><text:span text:style-name="T1"/></text:p></office:annotation><text:p>OP</text:p></table:table-cell><table:table-cell table:style-name="ce19" office:value-type="string"><office:annotation draw:style-name="gr1" draw:text-style-name="P1" svg:width="3.378cm" svg:height="1.323cm" svg:x="53.558cm" svg:y="0cm" draw:caption-point-x="-4.457cm" draw:caption-point-y="0.01cm"><dc:date>2013-10-11T00:00:00</dc:date><text:p text:style-name="P1"><text:span text:style-name="T1">Preencher LP caso o ATCO esteja de LESP no m??s.</text:span></text:p></office:annotation><text:p>LP</text:p></table:table-cell><table:table-cell table:style-name="ce19" office:value-type="string"><office:annotation draw:style-name="gr1" draw:text-style-name="P1" svg:width="6.008cm" svg:height="1.693cm" svg:x="54.77cm" svg:y="0cm" draw:caption-point-x="-4.806cm" draw:caption-point-y="0.01cm"><dc:date>2013-10-11T00:00:00</dc:date><text:p text:style-name="P1"><text:span text:style-name="T1">Preencher F caso o ATCO esteja de f??rias durante todo o m??s, caso contr??rio preencher a quantidade de horas trabalhadas na escala.</text:span></text:p><text:p text:style-name="P1"><text:span text:style-name="T1"/></text:p></office:annotation><text:p>F</text:p></table:table-cell><table:table-cell table:style-name="ce19" office:value-type="string"><office:annotation draw:style-name="gr1" draw:text-style-name="P1" svg:width="5.467cm" svg:height="2.886cm" svg:x="56.013cm" svg:y="0cm" draw:caption-point-x="-5.186cm" draw:caption-point-y="0.01cm"><dc:date>2013-10-11T00:00:00</dc:date><text:p text:style-name="P1"><text:span text:style-name="T1">Preencher S caso o ATCO esteja afastado da opera????o por motivo de sa??de em consequencia do trabalho ATC (ver Decreto e Portaria que regulamentam a profiss??o ATC).</text:span></text:p></office:annotation><text:p>S</text:p></table:table-cell><table:table-cell table:style-name="ce19" office:value-type="string"><office:annotation draw:style-name="gr1" draw:text-style-name="P1" svg:width="5.309cm" svg:height="2.489cm" svg:x="57.224cm" svg:y="0cm" draw:caption-point-x="-5.535cm" draw:caption-point-y="0.01cm"><dc:date>2013-10-11T00:00:00</dc:date><text:p text:style-name="P1"><text:span text:style-name="T1">Preencher OU caso o ATCO n??o tenha cumprido escala operacional e/ou n??o se enquadre em nenhum dos itens ao lado.</text:span></text:p><text:p text:style-name="P1"><text:span text:style-name="T1"/></text:p></office:annotation><text:p>OU</text:p></table:table-cell><table:table-cell table:style-name="ce19" office:value-type="string"><office:annotation draw:style-name="gr1" draw:text-style-name="P1" svg:width="4.602cm" svg:height="2.175cm" svg:x="58.469cm" svg:y="0cm" draw:caption-point-x="-5.917cm" draw:caption-point-y="0.01cm"><dc:date>2013-10-11T00:00:00</dc:date><text:p text:style-name="P1"><text:span text:style-name="T1">Preencher CS quando o ATCO estiver afastado durante todo o m??s em curso como aluno ou instrutor.</text:span></text:p><text:p text:style-name="P1"><text:span text:style-name="T1"/></text:p></office:annotation><text:p>CS</text:p></table:table-cell><table:table-cell table:style-name="ce19" office:value-type="string"><text:p>Faz jus a CO</text:p></table:table-cell><table:table-cell table:style-name="ce20" office:value-type="string"><text:p>CO</text:p></table:table-cell><table:table-cell table:number-columns-repeated="989"/></table:table-row>
CAB;


$data = date('d-m-Y h:i:s');
$datai = date('Y-m-d');
$rodape = <<<RODA
<table:table-row table:style-name="ro2"><table:table-cell table:number-columns-repeated="3"/><table:table-cell table:style-name="ce5" office:value-type="string" table:number-columns-spanned="7" table:number-rows-spanned="2"><text:p>DATA DA ATUALIZA????O:</text:p></table:table-cell><table:covered-table-cell table:number-columns-repeated="6" table:style-name="ce5"/><table:table-cell table:style-name="ce9" office:value-type="date" office:date-value="{$datai}" table:number-columns-spanned="3" table:number-rows-spanned="2"><text:p>{$data}</text:p></table:table-cell><table:covered-table-cell table:number-columns-repeated="2" table:style-name="ce9"/><table:table-cell table:style-name="ce11" office:value-type="string" table:number-columns-spanned="2" table:number-rows-spanned="2"><text:p></text:p></table:table-cell><table:covered-table-cell table:style-name="ce11"/><table:table-cell table:style-name="ce14" table:number-columns-repeated="8"/><table:table-cell table:style-name="ce16" table:number-columns-repeated="3"/><table:table-cell table:style-name="ce18" table:number-columns-repeated="9"/><table:table-cell table:number-columns-repeated="989"/></table:table-row><table:table-row table:style-name="ro2"><table:table-cell table:number-columns-repeated="3"/><table:covered-table-cell table:number-columns-repeated="12"/><table:table-cell table:number-columns-repeated="1009"/></table:table-row><table:table-row table:style-name="ro2" table:number-rows-repeated="65532"><table:table-cell table:number-columns-repeated="1024"/></table:table-row><table:table-row table:style-name="ro3" table:number-rows-repeated="983039"><table:table-cell table:number-columns-repeated="1024"/></table:table-row><table:table-row table:style-name="ro3"><table:table-cell table:number-columns-repeated="1024"/></table:table-row><table:named-expressions><table:named-range table:name="Excel_BuiltIn__FilterDatabase" table:base-cell-address="$&apos;ACC-AO &apos;.$A$1" table:cell-range-address="#REF!"/></table:named-expressions></table:table><table:named-expressions><table:named-range table:name="Excel_BuiltIn__FilterDatabase_1" table:base-cell-address="$&apos;ACC-AO &apos;.$A$1" table:cell-range-address="#REF!"/><table:named-range table:name="Excel_BuiltIn__FilterDatabase_10" table:base-cell-address="$&apos;ACC-AO &apos;.$A$1" table:cell-range-address="#REF!"/><table:named-range table:name="Excel_BuiltIn__FilterDatabase_11" table:base-cell-address="$&apos;ACC-AO &apos;.$A$1" table:cell-range-address="#REF!"/><table:named-range table:name="Excel_BuiltIn__FilterDatabase_2" table:base-cell-address="$&apos;ACC-AO &apos;.$A$1" table:cell-range-address="#REF!"/><table:named-range table:name="Excel_BuiltIn__FilterDatabase_4_1" table:base-cell-address="$&apos;ACC-AO &apos;.$A$1" table:cell-range-address="#REF!"/><table:named-range table:name="Excel_BuiltIn__FilterDatabase_9" table:base-cell-address="$&apos;ACC-AO &apos;.$A$1" table:cell-range-address="#REF!"/></table:named-expressions><table:database-ranges><table:database-range table:name="__Anonymous_Sheet_DB__0" table:target-range-address="&apos;ACC-AO &apos;.B1:&apos;ACC-AO &apos;.O3" table:display-filter-buttons="true"/></table:database-ranges></office:spreadsheet></office:body></office:document-content>
RODA;
/*
echo '<pre>';
print_r($resultado);
echo '</pre>';
exit();
*/
foreach($resultado as $registro){
	
	$licenca = $registro['licenca'];
	$setor = $registro['setor'];
	$indicativo = $registro['indicativo'];
	$nome = $registro['nome'];
	$guerra = $registro['guerra'];
	$posto = $registro['posto'];
	$quadro = $registro['quadro'];
	$saram = $registro['saram'];
	$cpf = $registro['cpf'];
	$identidade = $registro['identidade'];
	
	
	if(!empty($registro[1])){
		$jan = '';
		$jant = 0;
		foreach($registro[1]['nomeescala'] as $chave=>$nomeescala){
			//$jan .= $nomeescala.':'.$registro[1]['horas'][$chave]."\n";
			$jan .= "\n".$nomeescala.'='.$registro[1]['horas'][$chave];
			$jant += $registro[1]['horas'][$chave];
		}
	}else{
		$jan = '';	
		$jant = '';	
	}
	
	
	if(!empty($registro[2])){
		$fev = '';
		$fevt = 0;
		foreach($registro[2]['nomeescala'] as $chave=>$nomeescala){
			//$jan .= $nomeescala.':'.$registro[1]['horas'][$chave]."\n";
			$fev .= "\n".$nomeescala.'='.$registro[2]['horas'][$chave];
			$fevt += $registro[2]['horas'][$chave];
		}
	}else{
		$fev = '';	
		$fevt = '';	
	}
	if(!empty($registro[3])){
		$mar = '';
		$mart = 0;
		foreach($registro[3]['nomeescala'] as $chave=>$nomeescala){
			//$jan .= $nomeescala.':'.$registro[1]['horas'][$chave]."\n";
			$mar .= "\n".$nomeescala.'='.$registro[3]['horas'][$chave];
			$mart += $registro[3]['horas'][$chave];
		}
	}else{
		$mar = '';	
		$mart = '';	
	}
	if(!empty($registro[4])){
		$abr = '';
		$abrt = 0;
		foreach($registro[4]['nomeescala'] as $chave=>$nomeescala){
			//$jan .= $nomeescala.':'.$registro[1]['horas'][$chave]."\n";
			$abr .= "\n".$nomeescala.'='.$registro[4]['horas'][$chave];
			$abrt += $registro[4]['horas'][$chave];
		}
	}else{
		$abr = '';	
		$abrt = '';	
	}
	if(!empty($registro[5])){
		$mai = '';
		$mait = 0;
		foreach($registro[5]['nomeescala'] as $chave=>$nomeescala){
			//$jan .= $nomeescala.':'.$registro[1]['horas'][$chave]."\n";
			$mai .= "\n".$nomeescala.'='.$registro[5]['horas'][$chave];
			$mait += $registro[5]['horas'][$chave];
		}
	}else{
		$mai = '';	
		$mait = '';	
	}
	if(!empty($registro[6])){
		$jun = '';
		$junt = 0;
		foreach($registro[6]['nomeescala'] as $chave=>$nomeescala){
			//$jan .= $nomeescala.':'.$registro[1]['horas'][$chave]."\n";
			$jun .= "\n".$nomeescala.'='.$registro[6]['horas'][$chave];
			$junt += $registro[6]['horas'][$chave];
		}
	}else{
		$jun = '';	
		$junt = '';	
	}
	if(!empty($registro[7])){
		$jul = '';
		$jult = 0;
		foreach($registro[7]['nomeescala'] as $chave=>$nomeescala){
			//$jan .= $nomeescala.':'.$registro[1]['horas'][$chave]."\n";
			$jul .= "\n".$nomeescala.'='.$registro[7]['horas'][$chave];
			$jult += $registro[7]['horas'][$chave];
		}
	}else{
		$jul = '';	
		$jult = '';	
	}
	if(!empty($registro[8])){
		$ago = '';
		$agot = 0;
		foreach($registro[8]['nomeescala'] as $chave=>$nomeescala){
			//$jan .= $nomeescala.':'.$registro[1]['horas'][$chave]."\n";
			$ago .= "\n".$nomeescala.'='.$registro[8]['horas'][$chave];
			$agot += $registro[8]['horas'][$chave];
		}
	}else{
		$ago = '';	
		$agot = '';	
	}
	if(!empty($registro[9])){
		$set = '';
		$sett = 0;
		foreach($registro[9]['nomeescala'] as $chave=>$nomeescala){
			//$jan .= $nomeescala.':'.$registro[1]['horas'][$chave]."\n";
			$set .= "\n".$nomeescala.'='.$registro[9]['horas'][$chave];
			$set += $registro[9]['horas'][$chave];
		}
	}else{
		$set = '';	
		$sett = '';	
	}
	if(!empty($registro[10])){
		$out = '';
		$outt = 0;
		foreach($registro[10]['nomeescala'] as $chave=>$nomeescala){
			//$jan .= $nomeescala.':'.$registro[1]['horas'][$chave]."\n";
			$out .= "\n".$nomeescala.'='.$registro[10]['horas'][$chave];
			$outt += $registro[10]['horas'][$chave];
		}
	}else{
		$out = '';	
		$outt = '';	
	}
	if(!empty($registro[11])){
		$nov = '';
		$novt = 0;
		foreach($registro[11]['nomeescala'] as $chave=>$nomeescala){
			//$jan .= $nomeescala.':'.$registro[1]['horas'][$chave]."\n";
			$nov .= "\n".$nomeescala.'='.$registro[11]['horas'][$chave];
			$novt += $registro[11]['horas'][$chave];
		}
	}else{
		$nov = '';	
		$novt = '';	
	}
	if(!empty($registro[12])){
		$dez = '';
		$dezt = 0;
		foreach($registro[12]['nomeescala'] as $chave=>$nomeescala){
			//$jan .= $nomeescala.':'.$registro[1]['horas'][$chave]."\n";
			$dez .= "\n".$nomeescala.'='.$registro[12]['horas'][$chave];
			$dezt += $registro[12]['horas'][$chave];
		}
	}else{
		$dez = '';	
		$dezt = '';	
	}

	
	
	//<table:table-cell table:style-name="ce12" table:number-columns-repeated="2"/><table:table-cell table:style-name="ce15"/>
	
$corpo .= <<<CORPO
<table:table-row table:style-name="ro1"><table:table-cell table:style-name="ce1" office:value-type="float" office:value=""><text:p></text:p></table:table-cell><table:table-cell table:style-name="ce1" office:value-type="float" office:value="{$licenca}"><text:p>{$licenca}</text:p></table:table-cell><table:table-cell table:style-name="ce3" office:value-type="float" office:value="{$saram}"><text:p>{$saram}</text:p></table:table-cell><table:table-cell table:style-name="ce3" office:value-type="string"><text:p>{$posto}</text:p></table:table-cell><table:table-cell table:style-name="ce3" office:value-type="string"><text:p>{$quadro}</text:p></table:table-cell><table:table-cell table:style-name="ce3" office:value-type="string"><text:p>{$guerra}</text:p></table:table-cell><table:table-cell table:style-name="ce3" office:value-type="string" table:number-columns-spanned="3" table:number-rows-spanned="1"><text:p>{$setor}</text:p></table:table-cell><table:covered-table-cell table:number-columns-repeated="2" table:style-name="ce3"/><table:table-cell table:style-name="ce3" office:value-type="string"><text:p>{$indicativo}</text:p></table:table-cell><table:table-cell table:style-name="ce3" office:value-type="string"><text:p></text:p></table:table-cell><table:table-cell table:style-name="ce3" office:value-type="string"><text:p></text:p></table:table-cell><table:table-cell table:style-name="ce3" office:value-type="string"><text:p></text:p></table:table-cell><table:table-cell table:style-name="ce3" office:value-type="string"><text:p></text:p></table:table-cell><table:table-cell table:style-name="ce3" office:value-type="string"><text:p></text:p></table:table-cell>
<table:table-cell table:style-name="ce15" office:value-type="string"><text:p>{$jan}\n total={$jant}</text:p></table:table-cell><table:table-cell table:style-name="ce15" office:value-type="string"><text:p>{$fev}\n total={$fevt}</text:p></table:table-cell><table:table-cell table:style-name="ce15" office:value-type="string"><text:p>{$mar}\n total={$mart}</text:p></table:table-cell><table:table-cell table:style-name="ce15" office:value-type="string"><text:p>{$abr}\n total={$abrt}</text:p></table:table-cell><table:table-cell table:style-name="ce15" office:value-type="string"><text:p>{$mai}\n total={$mait}</text:p></table:table-cell><table:table-cell table:style-name="ce15" office:value-type="string"><text:p>{$jun}\n total={$junt}</text:p></table:table-cell><table:table-cell table:style-name="ce15" office:value-type="string"><text:p>{$jul}\n total={$jult}</text:p></table:table-cell><table:table-cell table:style-name="ce15" office:value-type="string"><text:p>{$ago}\n total={$agot}</text:p></table:table-cell><table:table-cell table:style-name="ce15" office:value-type="string"><text:p>{$set}\n total={$sett}</text:p></table:table-cell><table:table-cell table:style-name="ce15" office:value-type="string"><text:p>{$out}\n total={$outt}</text:p></table:table-cell><table:table-cell table:style-name="ce15" office:value-type="string"><text:p>{$nov}\n total={$novt}</text:p></table:table-cell><table:table-cell table:style-name="ce15" office:value-type="string"><text:p>{$dez}\n total={$dezt}</text:p></table:table-cell><table:table-cell table:style-name="ce3" office:value-type="string"><text:p></text:p></table:table-cell><table:table-cell table:style-name="ce3" office:value-type="string"><text:p></text:p></table:table-cell><table:table-cell table:style-name="ce3" office:value-type="string"><text:p></text:p></table:table-cell><table:table-cell table:style-name="ce3" office:value-type="string"><text:p></text:p></table:table-cell><table:table-cell table:style-name="ce3" office:value-type="string"><text:p></text:p></table:table-cell><table:table-cell table:style-name="ce3" office:value-type="string"><text:p></text:p></table:table-cell><table:table-cell table:style-name="ce3" office:value-type="string"><text:p></text:p></table:table-cell><table:table-cell table:style-name="ce21" table:formula="of:=IF([.AG2]&gt;6;&quot;SIM&quot;;&quot;N??O&quot;)" office:value-type="string" office:string-value="SIM"><text:p>SIM</text:p></table:table-cell><table:table-cell table:number-columns-repeated="990"/></table:table-row>
CORPO;

}
$conteudo = $cabecalho.$corpo.$rodape;


//echo $conteudo;exit();
//$dirbase = str_replace("index.php","modelo/",$_SERVER["SCRIPT_FILENAME"]);
//$_SERVER["SCRIPT_FILENAME"] = str_replace("index.php","modelo",$_SERVER["SCRIPT_FILENAME"]);
//$dirbase = str_replace("index.php","modelo",$_SERVER["SCRIPT_FILENAME"]);
$dirbase = 'modelo_compensacao/';


file_put_contents("{$dirbase}content.xml",$conteudo);
$z -> addFile("content.xml","{$dirbase}");

$z -> addFile("Configurations2/accelerator/current.xml","{$dirbase}");
$z -> addFile("META-INF/manifest.xml","{$dirbase}");
//$z -> addFile("Pictures/10000201000000D50000006466F285B0.png","{$dirbase}");
$z -> addFile("Thumbnails/thumbnail.png","{$dirbase}");

$z -> addFile("Configurations2/floater/","{$dirbase}");
$z -> addFile("Configurations2/images/Bitmaps/","{$dirbase}");
$z -> addFile("Configurations2/menubar/","{$dirbase}");
$z -> addFile("Configurations2/popupmenu/","{$dirbase}");
$z -> addFile("Configurations2/progressbar/","{$dirbase}");
$z -> addFile("Configurations2/statusbar/","{$dirbase}");
$z -> addFile("Configurations2/toolbar/","{$dirbase}");
$z -> addFile("Configurations2/toolpanel/","{$dirbase}");

/*
$z -> addDir("{$dirbase}","Configurations2");
$z -> addDir("{$dirbase}","META-INF");
$z -> addDir("{$dirbase}","Thumbnails");
$z -> addDir("{$dirbase}","Configurations2");
$z -> addDir("{$dirbase}","Configurations2/accelerator");
$z -> addFile("Configurations2/accelerator/current.xml","{$dirbase}");
$z -> addDir("{$dirbase}","Configurations2/floater");
$z -> addDir("{$dirbase}","Configurations2/images");
$z -> addDir("{$dirbase}","Configurations2/images/Bitmaps");
$z -> addDir("{$dirbase}","Configurations2/menubar");
$z -> addDir("{$dirbase}","Configurations2/popupmenu");
$z -> addDir("{$dirbase}","Configurations2/progressbar");
$z -> addDir("{$dirbase}","Configurations2/statusbar");
$z -> addDir("{$dirbase}","Configurations2/toolbar");
$z -> addDir("{$dirbase}","Configurations2/toolpanel");



*/

$z -> addFile("mimetype","{$dirbase}");
$z -> addFile("settings.xml","{$dirbase}");
$z -> addFile("styles.xml","{$dirbase}");
$z -> addFile("meta.xml","{$dirbase}");

//echo date('h:i:s');exit();

$complemento = date('Ymd_his');
$zipname='compensacao'.$complemento.'.ods';
//$zipname='indicacoes'.$complemento.'.zip';


//$z -> zipFile($zipname);
$saida = $z -> zipFileEvaldo();

header('Cache-control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Expires: 0');
header("Content-type: application/vnd.oasis.opendocument.spreadsheet");
//header("Content-type: application/octet-stream"); 
header("Content-Disposition: attachment; filename=$zipname");

echo $saida;

//readfile($zipname);

?>
