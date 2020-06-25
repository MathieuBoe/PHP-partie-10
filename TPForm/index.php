<?php
// input = ce qui est indiquer
$civility = ''; $firstname = ''; $lastname = '';
$usermail = ''; $birthdate = ''; $userpassword = '';
$passwordverification = ''; $sellcondition = '';
$errors = [];
// Validation du formulaire
$issubmitted = false;
$verify = false;
//==== regex date ====//
$regexdate= '/^((?:19|20)[0-9]{2})-((?:0[1-9])|(?:1[0-2]))-((?:0[1-9])|(?:1[0-9])|(?:2[0-9])|(?:3[01]))$/';
//==== regex numéro de téléphone ====//
$regexphone = '/^(?:\+33|0033|0)[1-79]((?:([\-\/\s\.])?[0-9]){2}){4}$/';
//==== regex mot de passe ====//
$regexpassword = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}/';
// validation des champs
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $issubmitted = true;
    // Nettoyage des champs
    $civility = trim(filter_input(INPUT_POST, 'civility', FILTER_SANITIZE_STRING));
    if (empty($_POST['civility'])){
        $errors['civility'] = 'Veuillez cocher la case s\il vous plaît !';
    }
    $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
    if (empty($firstname)){
        $errors['firstname'] = 'Veuillez renseigner votre prénom';
    }
    $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
    if (empty($lastname)){
        $errors['lastname'] = 'Veuillez renseigner votre nom';        
    }
    $usermail = trim(filter_input(INPUT_POST, 'usermail', FILTER_SANITIZE_STRING));
    if (empty($usermail)){
        $errors['usermail'] = 'Veuillez renseigner votre adresse mail';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['usermail'] = 'Le format attendu n\'est pas respecté';
    }
    $userpassword = trim(filter_input(INPUT_POST, 'userpassword', FILTER_SANITIZE_STRING));
    if (empty($_POST['userpassword'])){
        $errors['userpassword'] = 'Veuillez renseigner votre mot de passe';
        } elseif (!preg_match($regexpassword, $userpassword)){
            $errors['userpassword'] = 'Utiliser les caractères je sais pas j\'ai pas tout compris a cette regex';
        }
    $passwordverification = trim(filter_input(INPUT_POST, 'passwordverification', FILTER_SANITIZE_STRING));
    if (empty($_POST['passwordverification'])) {
            $errors['passwordverification'] = 'Veuillez confirmer votre mot de passe';            
        } elseif ($userpassword != $passwordverification){
            $errors ['passwordverification'] = 'Les mots de passe ne correspondent pas';}      
    $sellcondition = trim(filter_input(INPUT_POST,'sellcondition', FILTER_SANITIZE_STRING));
        if (empty($_POST['sellcondition'])){
            $errors['sellcondition'] = 'Veuillez cocher la case s\'il vous plaît';
        }
    $birthdate = trim(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING));
    // Création timestamp today
    $today = strtotime("NOW");
    $convertbirthdate = strtotime($birthdate);
    // Timestamp de input date  
    if (!empty($birthdate)){
        if (!preg_match('/^((?:19|20)[0-9]{2})-((?:0[1-9])|(?:1[0-2]))-((?:0[1-9])|(?:1[0-9])|(?:2[0-9])|(?:3[01]))$/', $birthdate)) {    //il faut seraliser post pour avoir toutes les données en chaine de caractere  
            $errors['birthdate'] = 'Veuillez renseigner une date valide';        
        } elseif ($convertbirthdate > $today) {
        $errors ['birthdate'] = 'Votre date de naissance ne peut pas être supérieur à la date du jour';
        } 
    } else {
        $errors['birthdate'] = 'Veuillez indiquer votre date de naissance';
    }
    if (count($errors) == 0) {
        // transforme le tableau POST en chaine de caractères
        $user = serialize($_POST);
        // créé le cookie avec la chaine des POST
        setcookie('user', $user, time() + 3600, '/', '', false, false);
        header('Location: user.php');
    }  
}

// include titre et header
include 'header.php'; 
$title = 'TP Formulaire';?>
<!-- creation div formulaire -->
<div class="formulaire" >
    <?php if (($issubmitted == false) || $issubmitted && count($errors) != 0) : ?>
    <form action="index.php" class="inscription" style="display: flex; flex-flow: column wrap; width: 40%;" method="POST">
        <!-- Monsieur Madame -->
        <p><label for="Monsieur">Monsieur</label>
            <input type="radio" class="inputform" name="civility" value="Monsieur" id="Monsieur"
                <?= $civility == 'Monsieur' ? 'checked' : '' ?>>
            <label for="Madame">Madame</label>
            <input type="radio" class="inputform" name="civility" value="Madame" id="Madame"
                <?= $civility == 'Madame' ? 'checked' : '' ?>></p>
                <span style="color:red" class="error text-danger"><?= $errors['civility'] ?? '' ?></span>
       
        <!-- firstname -->
        <input type="text" name="firstname" placeholder="Prénom" class="inputform" value="<?= $firstname ?>">
        <span style="color:red" class="error text-danger"><?= $errors['firstname'] ?? '' ?></span>
        <!-- name -->
        <input type="text" name="lastname" placeholder="Nom" class="inputform" value="<?= $lastname ?>">
        <span style="color:red" class="error text-danger"><?= $errors['lastname'] ?? '' ?></span>
        <!-- birthdate -->
        <input type="date" name="birthdate" placeholder="Date de naissance" class="inputform" value="<?= $birthdate?>">
        <span style="color:red" class="error text-danger"><?= $errors['birthdate'] ?? '' ?></span>
        <!-- usermail -->
        <input type="email" name="usermail" placeholder="jeandidier@gmail.com" class="inputform" value="<?= $usermail?>">
        <span style="color:red" class="error text-danger"><?= $errors['usermail'] ?? '' ?></span>
        <!-- userpassword -->
        <input type="password" name="userpassword" placeholder="Mot de passe" class="inputform">
        <span style="color:red" class="error text-danger"><?= $errors['userpassword'] ?? '' ?></span>
        <!-- passwordverification -->
        <input type="password" name="passwordverification" placeholder="Confirmer Mot de passe" class="inputform">
        <span style="color:red" class="error text-danger"><?= $errors['passwordverification'] ?? '' ?></span>
        <!-- sellcondition -->
        <div class="cgu" style="display: flex; flex-flow: row wrap; align-items: center">
        <input type="checkbox" name="sellcondition" class="inputform" style="margin-right: 2vw" value="yes" <?= $sellcondition == 'yes' ? 'checked' : ''?>">
        <label for="sellcondition">J'accepte les Conditions Générales d'Utilisation </label>
        <span style="color:red" class="error text-danger"><?= $errors['sellcondition'] ?? '' ?></span>
        </div>
        
        <a href="user.php"><input type="submit" value="Envoyer" ></a>
        </form>

<?php else: 
?> </div>
<?php  
endif;
include 'footer.php';?>