<?php 

// PRISE EN MAINDU SUJET
//EXERCICE 01 ET 02



/** 
* @param array un tableau associatif avec name (nom du fichier) et "tmp_name" nom du fichier telecharger par POST
*@return string 'uploads' avec le nom du fichier
*/
function enregistrerFichierEnvoye(array $infoFichier): string
{
// recupere la valeur de l'heure courante a la seconde près et la convertir en string
    $timestamp = strval(time());

        // LOGIQUE POUR TRADUIRE
        // pathinfo(basename($infoFichier["name"]), PATHINFO_EXTENSION);
        //  pathinfo(... , ....) // ... basename($infoFichier["name"]), ... : PATHINFO_EXTENSION
        // pathinfo(... ) // ... : infoFichier['name']
        // FIN LOGIQUE POUR TRADUIRE
// on recupere l'extantion du fichier de chemin $infoFichier['name']
    $extension = pathinfo(basename($infoFichier["name"]), PATHINFO_EXTENSION);

//On creer un string commencant par 'produit_' suivi de l'heure courante a la seconde en chaine, suivi de l'extansion
    $nomDuFichier = 'produit_' . $timestamp . '.' . $extension;

//On cree un string commancant par le dossier dans lequels se trouve "function.php" suivi de '/uploads/'
    $dossierStockage = __DIR__ . '/uploads/';
// On verifie si le dossier upload existe pas 
    if (file_exists($dossierStockage) === false)
    {
        // mkdir = cree un dossier
        mkdir($dossierStockage);
    }
// on verifie que $infoFichier["tmp_name"] correspond a un fichier telecharger par POST
// on deplace ce fichier vers $dossierStockage.$nomDuFichier
    move_uploaded_file($infoFichier["tmp_name"], $dossierStockage . $nomDuFichier);
    return '/uploads/' . $nomDuFichier;
}
/**
 * @param string quelque chose a mettre apres router.php
 * @return void rien du tout
 */
function onVaRediriger(string $path)
{
    // rediriger ver la page router.php
    //Envoi une en-tete avec Location (une redirection)
    header('LOCATION: /PHP-Cours/produit-crud/router.php' . $path);

    //Termine le script courant
    die();
}