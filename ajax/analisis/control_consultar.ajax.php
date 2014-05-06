<?php
	require_once "../../models/amenaza.model.php";
    $objAmenaza = new Amenaza();

    $amenaza = $_GET["amenaza"];

    $query = $objAmenaza->getControles($amenaza);

    $i = 1;
    while($reg = $query->fetchObject()){
    	echo '<tr>
                	<td><input type="checkbox" name="chkControl" id="chkControl'.$i.'" value="'.$reg->idcontrol.'" /></td>
                	<td>'.$i.'</td>
                	<td>'.$reg->control.'</td>
                	<td class="center">'.$reg->fechaInicio.'</td>
                	<td class="center">'.$reg->fechaFin.'</td>
                	<td style="text-align:right">'.$reg->costo.'</td>
                	<td>'.$reg->empleado.'</td>
              </tr>';
        $i++;
    }