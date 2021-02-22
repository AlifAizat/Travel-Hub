<?php


function tronquer_texte($texte, $longueur_max = 150)
{
    if(strlen($texte) > $longueur_max)
    {
        $texte = substr($texte, 0, $longueur_max);
        $texte .= "...";
    }

    return $texte;
}