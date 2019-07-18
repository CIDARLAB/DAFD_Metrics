<?php

$orifice_size=$_POST['orifice-size'];
$aspect_ratio=$_POST['aspect-ratio'];
$expansion_ratio=$_POST['expansion-ratio'];
$normalized_orifice_length=$_POST['normalized-orifice-length'];
$normalized_water_inlet=$_POST['normalized-water-inlet'];
$normalized_oil_inlet=$_POST['normalized-oil-inlet'];
$flow_rate_ratio=$_POST['flow-rate-ratio'];
$capillary_number=$_POST['capillary-number'];

$constraints = array($orifice_size, $aspect_ratio, $expansion_ratio, $normalized_orifice_length, $normalized_water_inlet, $normalized_oil_inlet, $flow_rate_ratio, $capillary_number);
$constraint_names = array("orifice_size", "aspect_ratio", "expansion_ratio", "normalized_orifice_length",
			"normalized_water_inlet", "normalized_oil_inlet", "flow_rate_ratio", "capillary_number");

$DAFD_location = "/home/chris/Work/DAFD/DAFD/";
$file = $DAFD_location . "cmd_inputs.txt";
file_put_contents($file, "FORWARD\n");

for($i=0; $i<sizeof($constraints); $i++)
{
	$value = $constraints[$i];
	$current = $constraint_names[$i] . "=" . $value . "\n";
	file_put_contents($file, $current, FILE_APPEND);
}


$outputs = shell_exec($DAFD_location . "venv/bin/python3 " . $DAFD_location . "DAFD_CMD.py");
$arr_outs = explode("|",explode("BEGIN:",$outputs)[1]);
?>


<div style="text-align: center">
<div class="div_float">
    <h1>Forward Model Inputs</h1>

    Orifice Width (um):
    <?php
    echo $orifice_size;
    ?>
    <br>

    Aspect Ratio (Channel Depth Divided By Orifice Width):
    <?php
    echo $aspect_ratio;
    ?>
    <br>

    Expansion Ratio (Outlet Channel Width Divided By Orifice Width):
    <?php
    echo $expansion_ratio;
    ?>
    <br>

    Normalized Orifice Length (Orifice Length Divided By Orifice Width):
    <?php
    echo $normalized_orifice_length;
    ?>
    <br>

    Normalized Water Inlet Width (Water Inlet Width Divided By Orifice Width):
    <?php
    echo $normalized_water_inlet;
    ?>
    <br>

    Normalized Oil Inlet Width (Oil Inlet Width Divided By Orifice Width):
    <?php
    echo $normalized_oil_inlet;
    ?>
    <br>

    Flow Rate Ratio (Oil Flow Rate Divided By Water Flow Rate):
    <?php
    echo $flow_rate_ratio;
    ?>
    <br>

    Capillary Number:
    <?php
    echo $capillary_number;
    ?>
    <br>

</div>

<br>
<br>

<div class="div_float">
    <h1>Forward Model Results</h1>

    Generation Rate (Hz):
    <?php
    echo $arr_outs[0];
    ?>
    <br>

    Droplet Diameter (um):
    <?php
    echo $arr_outs[1];
    ?>
    <br>

    Regime:
    <?php
    echo $arr_outs[2];
    ?>
    <br>

</div>

<br>
<br>

<div class="div_float">
    <h1>Calculated Values</h1>

    Oil Flow Rate (ml/hr):
    <?php
    echo $arr_outs[3];
    ?>
    <br>

    Water Flow Rate (ul/min):
    <?php
    echo $arr_outs[4];
    ?>
    <br>

    Droplet Inferred Size (um):
    <?php
    echo $arr_outs[5];
    ?>
    <br>

</div>
</div>
