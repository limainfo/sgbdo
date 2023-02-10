<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="pt-br">
  <head>
    <title>.:: Calendário table ::.</title>
      <!--META-->
      <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
      <meta name="author"             content="Emiliano">
      <meta name="language"           content="pt-br">
      <!--ESTILOS-->
      <style type="text/css">
        //CSS adiquirido no CSS Table Galery!!!! (http://icant.co.uk/csstablegallery/index.php?css=67)
        table
        {
        border-collapse: collapse;
        border-spacing:0;
        border: 1px solid #BA9;
        font: 90% "Trebuchet MS", Tahoma, Arial, Helvetica, sans-serif;
        }
         caption{
          padding: 0 .4em .4em;
          text-align: left;
          font-size: 110%;
          font-weight: bold;
          text-transform: uppercase;
          color: #453827;
          background: transparent;
          }
        
        tr{
        
        }
        td, th {
          border: 1px solid #BBAA99;
          padding: .3em;
        font-size: 0.9em;
        color: #666;
          }
        thead th, tfoot th, tfoot td {
        border: 1px solid #BA9;
        text-align: left;
        font-weight: bold;
        font-size: 100%;
        background: #BA9 url("http://www.northcircle.com/icant/thbg.gif") repeat-x top left;
        color: #FFF;
        }
         tbody th,thead th,tbody td {
        vertical-align: top;
        text-align: left;
        }
        
        tbody tr:hover td,
        tbody tr:focus td,
        tbody tr:hover th,
        tbody tr:focus th
        {
        background: url("http://www.northcircle.com/icant/shimx.gif")  repeat-x top left;
        color: #000;
        }
        
        tr.odd
        {
        background: url("http://www.northcircle.com/icant/shim.gif")  repeat-x top left;
        }        
      </style>
      <!--SCRIPTS-->
      <script type="text/javascript">
        function MM_jumpMenu(targ,selObj,restore){ //v3.0
          eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
          if (restore) selObj.selectedIndex=0;
        }
      </script>
  </head>
  <body>
    <form name="form1" method="post" action="">
    <fieldset>  
      <table summary="Calendário do mês">
        <caption>
          <select name="menu1" onChange="MM_jumpMenu('parent',this,0)">
  <?php
  //setar idioma
  setlocale(LC_TIME, "portuguese");
    $dia = date("d");
    $mes = isset($_GET["mes"]) ? intval($_GET["mes"]) : date("m");
    $ano = isset($_GET["ano"]) ? intval($_GET["ano"]) : date("Y");
  for($i = 1; $i <= 12; $i++){
    $nome_mes = ucfirst(strftime("%B", mktime(0, 0, 0, $i, 1, 2006)));
    if($i == $mes){
      echo "\t<option value=\"?mes=$i&ano=$ano\" selected=\"selected\">$nome_mes</option>\n";
    }else{
      echo "\t<option value=\"?mes=$i&ano=$ano\">$nome_mes</option>\n";
    }    
  }    
  ?>
          </select>
        </caption>
        <thead>
          <tr>
  <?
    $total_dias = date("t", mktime(0, 0, 0, $mes, 1, $ano));
    for($i = 1; $i <= 7; $i++){
      echo "<th scope=\"cols\">".ucfirst(strftime("%a", mktime(0, 0, 0, 5, $i, 2005)))."</td>\n";
    }    
  ?>
          </tr>
        </thead>
        <tbody>
  <?
  $k=1;
  for ($i = 1; $i <= 6; $i++){
    echo "<tr>";
    for ($j = 0; $j < 7; $j++){
      $dias = date("w", mktime(0, 0, 0, $mes, $k, $ano));
      if($dias == $j and $k <= $total_dias){
        if($k == $dia){
          echo "<th>". sprintf("%02d", $k)."</th> ";
        }else{    
          echo "<td>". sprintf("%02d", $k)."</td> ";
        }    
        $k++;
      }else{
        echo "<td></td> ";
      }
    }
    echo "</tr>\n";
  }
  ?>  
        </tbody>
        <tfoot>
          <tr>
            <td colspan="7">Calendário do Sr. Fabyo</td>
          </tr>  
        </tfoot>
      </table>
    </fieldset>
    </form>
  </body>
</html>