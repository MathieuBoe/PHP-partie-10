<?php
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// image téléchargé sans erreur
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
        $allowedextension = ['jpg', 'jpeg', 'png', 'gif'];
        $maxsize = 1024 * 1024 * 1;
        $filename = $_FILES['picture']['name'];
        $filesize = $_FILES['picture']['size'];
        $tmp = $_FILES['picture']['tmp_name'];
        $fileextension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
        // Vérification de l'extension
        if (!in_array($fileextension, $allowedextension)) {
            $error = 'Le format du fichier téléchargé n\'est pas autorisé !';
        } elseif ($maxsize < $filesize) {
            $error = 'Le fichier téléchargé depasse la taille max autorisée !';
        }

        if (empty($error)) {
            if (move_uploaded_file($tmp, 'assets/img/' . $filename)) {
                setcookie('picture', $filename, time() + 3600);
                header('Location: index.php?picture=' . $filename);
                exit();
            }
        }

    }
}
include 'header.php';
?>
<form action="" method="post" enctype="multipart/form-data">
    <label for="picture">Téléchager une image de profile</label>
    <input type="file" name="picture" id="picture">
    <p>formats acceptés (jpg, jpeg, png, gif), taille max 2M</p>
    <p class="text-danger"><?=$error?></p>
    <input type="submit" value="Envoyer">
</form>

<?php
include 'footer.php';