<?php
include 'header.php'; 
// <!-- Il faut unserialize pour transformer la chaine de caractere en tableau -->
if (isset($_COOKIE['user'])){
    // reforme la chaine de caractere en tableau
    $user = unserialize($_COOKIE['user']);
    // Transformer la date en EU format
    setlocale(LC_TIME, "fr_FR.UTF-8");
    $newDate = strftime("%A %d %B %G", strtotime($user['birthdate']));
    $user['birthdate'] = $newDate;
    var_dump($user); ?>
    <div class="card p-3">
        <!-- bouc
        afficher tout le tableau -->
    <?php foreach ($user as $value){
        // Faire en sorte que checkbox affiche Monsieur ou Madame plutot que 1 et 2
        if ($key == 'civility'){
            // Si le genre est 1 on affiche Monsieur sinon Madame
            $value = $value == 1 ? 'Monsieur' : 'Madame';
        }        
        ?>
        
        <p><?= $value; ?> </p>
    <?php } ?>
    </div>
<?php } else { ?>
    <p style="color:red;">Aucun utilisateur n'est inscrit</p>
    <a href="index.php">Retour a l'accueil</a>

<?php }
include 'footer.php';?>