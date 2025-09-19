<?php

/**
 * Méthode pour nettoyer (sanitize) les entrées utilisateurs
 * @param string $str chaine de caractères à nettoyer
 * @return string $str retourne la chaine nettoyée (sanitize)
 */
function sanitize(string $str): string
{
    return htmlspecialchars(
        strip_tags(
            trim($str)
        ),
        ENT_NOQUOTES
    );
}
