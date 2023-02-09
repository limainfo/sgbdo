<?php
/* Define fieldnames: */
$fieldnames= array('fieldname1', 'fieldname2');
/* Set default font styles: */
$excel->font = 'Tahoma';
$excel->size = 8;
$excel->initFormats(); // initialize default formats
/* Add style for heading: */
$heading_format = $excel->AddFormat(array('bold' => 1, 'align' => 'center'));
/* Change TIME_FORMAT: */
$excel->formats[TIME_FORMAT]->setNumFormat('hh:mm'); // direct library call
/* Create Excel sheets: */
$sheet1 =& $excel->AddWorksheet('Sheet Name');
/* Define layout of worksheet for applications: */
$sheet1->setColumn(0, 0, 5);
$sheet1->setColumn(7, 10, 8);
$sheet1->setColumn(0, 28, 18);
$sheet1->freezePanes(array(1, 1)); // Freeze sheet at 1st row and 1st column
/* Write headings: */
$excel->write($sheet1, 0, 0, $fieldnames, $heading_format);
/* Write data for applications: */

$i=0;
$k=0;
  foreach($data[0]['Militar'] as $fieldname => $fieldvalue) {
      $excel->write($sheet1, $i, $k, $fieldname, TEXT_FORMAT);
      $k++;
      //print($fieldvalue);
  }
  
$i++;
  
foreach($data as $key => $value) {
	$k=0;
	
  foreach($value['Militar'] as $fieldname => $fieldvalue) {
      $excel->write($sheet1, $i, $k, $fieldvalue, TEXT_FORMAT);
      //print($fieldvalue);
      $k++;
  }
      $i++;
}
/* Output temporary file to the browser: */
$excel->OutputFile();
?>
