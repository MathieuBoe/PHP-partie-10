<?php 
$title = 'TP3';
include 'header.php';
$portrait1 = array('name'=>'Victor ', 'firstname'=>'Hugo ', 'portrait'=>'http://upload.wikimedia.org/wikipedia/commons/5/5a/Bonnat_Hugo001z.jpg');
$portrait2 = array('name'=>'Jean ', 'firstname'=>'de La Fontaine ', 'portrait'=>'http://upload.wikimedia.org/wikipedia/commons/e/e1/La_Fontaine_par_Rigaud.jpg');
$portrait3 = array('name'=>'Pierre ', 'firstname'=>'Corneille ', 'portrait'=>'http://upload.wikimedia.org/wikipedia/commons/2/2a/Pierre_Corneille_2.jpg');
$portrait4 = array('name'=>'Jean ', 'firstname'=>'Racine ', 'portrait'=>'http://upload.wikimedia.org/wikipedia/commons/d/d5/Jean_racine.jpg');
function displayall(...$portraits){
    foreach ($portraits as $portrait):?>
        <div style="text-align: center;"><p style="font-size: 28px; font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', cursive;"><?= $portrait['name'].' '.$portrait['firstname']?></p>   
        <img src="<?= $portrait['portrait'];?>" alt="" width="210px" height="210px" style="border-radius: 50%"></div> 
    <?php endforeach;
}; ?>
<p><?= displayall($portrait1, $portrait2, $portrait3, $portrait4)?></p>
<?php include 'footer.php';?>