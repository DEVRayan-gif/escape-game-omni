<?php
require_once('/var/www/sae202-event/model/connexion_model.php');

class ConnexionAdminController {

    public function validerConnexion() {
        $mail = $_POST['client_mail'] ?? '';
        $mdp  = $_POST['mot_de_passe'] ?? '';

        // Utilise la fonction du model
        $utilisateur = getUserByEmail($mail);

        if (!$utilisateur) {
            $_SESSION['erreur'] = 'Identifiants incorrects.';
            header('Location: /connexion/admin');
            exit;
        }

        // Vérifie le mot de passe (hashé ou non)
        $mdpValide = password_verify($mdp, $utilisateur['mot_de_passe'])
                     ?: ($mdp === $utilisateur['mot_de_passe']);

        if (!$mdpValide) {
            $_SESSION['erreur'] = 'Identifiants incorrects.';
            header('Location: /connexion/admin');
            exit;
        }

        // Vérifie le rôle admin
        if ($utilisateur['role'] !== 'admin') {
            $_SESSION['erreur'] = 'Accès réservé aux administrateurs.';
            header('Location: /connexion/admin');
            exit;
        }

        // Connexion OK
        $_SESSION['user_id']     = $utilisateur['id_utilisateur'];
        $_SESSION['user_role']   = $utilisateur['role'];
        $_SESSION['user_pseudo'] = $utilisateur['pseudo'];

        header('Location: /gestion/inscrits');
        exit;
    }
}
