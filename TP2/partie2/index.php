<?php
$civility = $lastname = $firstname = $company = "";
$age = 0;
$errors = [];
$isSubmitted = false;
$regexNames = '/^[a-zéèîïêëç]+((?:\-|\s)[a-zéèéîïêëç]+)?$/i';

$photo = $_COOKIE['picture'] ?? 'default.jpg';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isSubmitted = true;
    $civility = filter_input(INPUT_POST, 'civility', FILTER_SANITIZE_NUMBER_INT);
    $filtercivility = filter_var($civility, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1, "max_range" => 2]]);
    if (empty($civility)) {
        $errors['civility'] = 'Veuillez sélectionner un genre!';

    } else if (!$filtercivility) { // équivaut écrire $filterCivility == 'false'
        $errors['civility'] = 'Veuillez renseigner le champs!';
    }
    // valider l'âge
    $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);
    $filterAge = filter_var($age, FILTER_VALIDATE_INT, ["options" => ["min_range" => 14, "max_range" => 70]]);
    if (empty($age)) {
        $errors['age'] = 'Veuillez sélectionner un âge!';

    } else if (!$filterAge) { //
        $errors['age'] = 'Veuillez renseigner un âge valide!';
    }

    // validation du firstname

    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    // vérifier la validité de la valeur
    if (empty($firstname)) {
        $errors['firstname'] = 'Veuillez renseigner votre prenom';
    } else if (!preg_match($regexNames, $firstname)) {
        $errors['firstname'] = 'La valeur renseignée ne correspond pas au format attendu';
    }

    // validation du firstname

    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
    // vérifier la validité de la valeur
    if (empty($lastname)) {
        $errors['lastname'] = 'Veuillez renseigner votre nom';
    } else if (!preg_match($regexNames, $lastname)) {
        $errors['lastname'] = 'La valeur renseignée ne correspond pas au format attendu';
    }
    $company = filter_input(INPUT_POST, 'company', FILTER_SANITIZE_STRING);
    if (empty($company)) {
        $errors['company'] = 'Veuillez renseigner votre société';
    }

}

include 'header.php';
?>

<div class="container">
    <form method="post" action="">
        <div class="row justify-content-center mt-5 ">
            <div class="col-7 bg-dark text-white p-3 ">
                <div class="form-group">
                    <label for="civility">Civilité</label>
                    <select name="civility" class="form-control <?=$isSubmitted && isset($errors['civility']) ? 'is-invalid' : ''?>" id="
                        civility">
                        <option>Sélectionner votre civilité</option>
                        <option <?=$civility == 1 ? 'selected' : ''?> value="1">Monsieur</option>
                        <option <?=$civility == 2 ? 'selected' : ''?> value="2">Madame</option>
                    </select>
                    <div class="invalid-feedback"><?=$errors['civility'] ?? ""?></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="lastname">Nom</label>
                    <input class="form-control <?=$isSubmitted && isset($errors['lastname']) ? 'is-invalid' : ''?>" value="<?=$lastname?>" id="lastname" name="lastname" type="text" placeholder="Lauper">
                    <div class="invalid-feedback"><?=$errors['lastname'] ?? ""?></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="firstname">Prénom</label>
                    <input class="form-control <?=$isSubmitted && isset($errors['firstname']) ? 'is-invalid' : ''?>" value="<?=$firstname?>" id="firstname" type="text" name="firstname" placeholder="Dave">
                    <div class="invalid-feedback"><?=$errors['firstname'] ?? ""?></div>
                </div>
                <div class="form-group has-success">
                    <label class="form-control-label " for="age">Age</label>
                    <input type="number" value="<?=$age?>" name="age" class="form-control <?=$isSubmitted && isset($errors['age']) ? 'is-invalid' : ''?>" id=" age">
                    <div class="invalid-feedback"><?=$errors['age'] ?? ""?></div>
                </div>
                <div class="form-group has-danger">
                    <label class="form-control-label" for="company">Société</label>
                    <input type="text" value="<?=$company?>" class="form-control <?=$isSubmitted && isset($errors['company']) ? 'is-invalid' : ''?>" name="company" id="company">
                    <div class="invalid-feedback"><?=$errors['company'] ?? ""?></div>
                </div>
                <div class="text-center"> <button type="submit" class="btn btn-warning ">Envoyer!</button></div>
            </div>
        </div>
    </form>
</div>
<?php if ($isSubmitted && count($errors) == 0): ?>
<div class="row justify-content-center mt-3">
    <div class="col-md-6">
        <div class="jumbotron">
            <div class="row">
                <div class="col">
                    <p>Civilité : <?=$civility == 1 ? 'Monsieur' : 'Madame'?></p>
                    <p>Nom : <?=$lastname?></p>
                    <p>Prenom : <?=$firstname?></p>
                    <p>Age : <?=$age?></p>
                    <p>Société : <?=$company?></p>
                </div>
                <div class="col ">
                    <img class="img-fluid rounded" src="assets/img/<?=$photo?>" alt="<?=$photo?>">
                    <p><a class="btn btn-outline-primary mt-2" href="upload.php">Télécharger une image de profile</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
endif;
include 'footer.php';?>