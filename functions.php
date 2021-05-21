<?php

function enregistrerFichierEnvoye(array $infoFichier): string
{
    // On enregistre la date sous forme de string:
    $timestamp = strval(time()); 
    // On enregistre une string contenant des informations sur le chemin système de info fichier:
    //  le nom du fichier et son extension.
    $extension = pathinfo(basename($infoFichier["name"]), PATHINFO_EXTENSION);
    // On concatène puis stocke le nom du fichier 
    $nomDuFichier = 'produit_' . $timestamp . '.' . $extension;
    // On definit le chemin du dossier de stockage
    $dossierStockage = __DIR__ . '/uploads/';

    // Si le dossier de stockage n'existe pas ,
    if (file_exists($dossierStockage) === false)
    {
        // alors le créer.
        mkdir($dossierStockage);
    }

    // On enregistre Le fichier dans le dossier
    move_uploaded_file($infoFichier["tmp_name"], $dossierStockage . $nomDuFichier);
    // On retourne le chemin du nouveau fichier
    return '/uploads/' . $nomDuFichier;
}

function onVaRediriger(string $path)
{
    // On renvoi vers une route 
    header('LOCATION: /produit-crud/router.php' . $path);
    // On arrête l'exécution du script
    die();
}