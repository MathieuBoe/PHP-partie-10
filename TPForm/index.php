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
    $sellcondition = trim(filter_input(INPUT_POST, 'sellcondition', FILTER_SANITIZE_STRING));
    if (!isset($sellcondition)){
        $errors['sellcondition'] = 'Veuillez cocher la case s\il vous plaît !';
    }
    $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
    if (empty('firstname')){
        $errors['firstname'] = 'Veuillez renseigner votre prénom';
    }
    $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
    if (empty('lastname')){
        $errors['lastname'] = 'Veuillez renseigner votre nom';
    }
    $usermail = trim(filter_input(INPUT_POST, 'usermail', FILTER_SANITIZE_EMAIL));
    if (empty('usermail')){
        $errors['usermail'] = 'Veuillez renseigner votre adresse mail';
    }
    $userpassword = trim(filter_input(INPUT_POST, 'userpassword', FILTER_SANITIZE_STRING));
    if (empty('userpassword')){
        $errors['userpassword'] = 'Veuillez renseigner votre mot de passe';
        } elseif (!preg_match($regexpassword, $userpassword)){
            $errors['userpassword'] = 'Utiliser les caractères je sais pas j\'ai pas tout compris a cette regex';
        }
    $passwordverification = trim(filter_input(INPUT_POST, 'passwordverification', FILTER_SANITIZE_STRING));
    if (empty('passwordverification')) {
            $errors['passwordverification'] = 'Veuillez confirmer votre mot de passe';            
        } else if (!preg_match($userpassword, $passwordverification)){
            $errors ['passwordverification'] = 'Les mots de passe ne correspondent pas';
        } else ($passwordverification == $userpassword ? $verify = true : $errors); 
        $sellcondition = trim(filter_input(INPUT_POST,'sellcondition', FILTER_SANITIZE_STRING));
        if (!isset($sellcondition)){
            $errors['sellcondition'] = 'Veuillez cocher la case s\'il vous plaît';
        }
        var_dump($errors);
}


// include titre et header
include 'header.php'; 
$title = 'TP Formulaire';?>
<!-- creation div formulaire -->
<div class="formulaire" style="display: flex; flex-flow: row wrap; width : 100%; justify-content: center;">
    <?php if (($issubmitted == false) || $verify && $issubmitted && count($errors) != 0) : ?>
    <form action="" class="inscription" style="width: 40%;" method="POST">
        <!-- Monsieur Madame -->
        <p><label for="monsieur">Monsieur</label>
            <input type="radio" class="inputform" name="civility" value="monsieur" id="monsieur"
                <?= $civility == 'monsieur' ? 'checked' : '' ?>>
            <label for="madame">Madame</label>
            <input type="radio" class="inputform" name="civility" value="madame" id="madame"
                <?= $civility == 'madame' ? 'checked' : '' ?>></p>
        <!-- firstname -->
        <input type="text" name="firstname" placeholder="Prénom" class="inputform" value="<?= $firstname ?>">
        <span class="error text-danger"><?= $errors['firstname'] ?? '' ?></span>
        <!-- name -->
        <input type="text" name="lastname" placeholder="Nom" class="inputform" value="<?= $lastname ?>">
        <span class="error text-danger"><?= $errors['lastname'] ?? '' ?></span>
        <!-- birthdate -->
        <input type="date" name="birthdate" placeholder="Date de naissance" class="inputform" value="<?= $birthdate?>">
        <span class="error text-danger"><?= $errors['birthdate'] ?? '' ?></span>
        <!-- usermail -->
        <input type="mail" name="usermail" placeholder="jeandidier@gmail.com" class="inputform" value="<?= $usermail?>">
        <span class="error text-danger"><?= $errors['usermail'] ?? '' ?></span>
        <!-- userpassword -->
        <input type="password" name="userpassword" placeholder="*******" class="inputform" value="<?= $userpassword?>">
        <span class="error text-danger"><?= $errors['userpassword'] ?? '' ?></span>
        <!-- passwordverification -->
        <input type="password" name="passwordverification" class="inputform" value="<?= $passwordverification?>">
        <span class="error text-danger"><?= $errors['passwordverification'] ?? '' ?></span>
        <!-- sellcondition -->
        <input type="checkbox" name="sellcondition" class="inputform" value="<?= $sellcondition ?>">
        <span class="error text-danger"><?= $errors['sellcondition'] ?? '' ?></span>
        
        <input type="submit" value="Envoyer">
        </form>

<?php else: ?>
    <div>
        <p><?= $civility ?></p>
        <p><?= $firstname ?></p>
        <p><?= $lastname ?></p>
        <p><?= $birthdate ?></p>
        <p><a href="<?= $usermail ?>"><?= $usermail ?></a></p>
        <p><?= $userpassword ?></p>
        <p><?= $passwordverification ?></p>   
    </div>
</div>

    


<?php  
endif;
include 'footer.php';?>