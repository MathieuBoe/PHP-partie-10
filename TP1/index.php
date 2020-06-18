<?php 
$title = 'TP1';
$input=['name','firstname','birthday','countrybirth','nationality','adress','email','phone','penumber','badgenumber'];
include 'header.php';?>
<form action="" method="get">
<label for="text">Name
<input type="text" name="text">
</label>
</form>
<?php 
echo "<form action=\"\" method=\"POST\">";
echo "<table style=\">";
    echo "<tr>";
        echo "<td colspan=\"2\">$display</td>";
    echo "</tr>";
    foreach(array_chunk($input,2) as $chunk){
        echo "<tr>";
            foreach($chunk as $input){
                echo "<td",(sizeof($chunk)!=2?" colspan=\"4\"":""),"><input name=\"pressed\" value=\"$input\" ></input></td>";
            }
        echo "</tr>";
    }
echo "</table>";
echo "</form>";
?>



<?php include 'footer.php';?>