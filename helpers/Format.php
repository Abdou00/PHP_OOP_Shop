<?php
/**
 * Class Format
 */
class Format
{
    /**
     * Défini le format de la date
     * @param $date
     * @return false|string
     */
    public function formatDate($date){
        return date('F j, Y, g:i a', strtotime($date));
    }

    /**
     * Défini la longueur de l'extrait
     * @param $text
     * @param int $limit
     * @return false|string
     */
    public function textShorten($text, $limit = 400){
        $text = $text. " ";
        $text = substr($text, 0, $limit);
        $text = substr($text, 0, strrpos($text, ' '));
        $text = $text.".....";
        return $text;
    }

    /**
     * Vérifie la validité des données
     * @param $data
     * @return string
     */
    public function validation($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /**
     * Défini le titre à afficher
     * @return string
     */
    public function title(){
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path, '.php');
        //$title = str_replace('_', ' ', $title);
        if ($title == 'index') {
            $title = 'home';
        }elseif ($title == 'contact') {
            $title = 'contact';
        }
        return $title = ucfirst($title);
    }
}
