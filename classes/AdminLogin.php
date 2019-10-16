<?php
include '../lib/Session.php';
Session::checkLogin();
include_once '../lib/Database.php';
include_once '../helpers/Format.php';

class AdminLogin
{
    private $db;
    private $format;

    /**
     * AdminLogin constructor.
     * Instancie les objets Database & Format
     */
    public function __construct()
    {
        $this->db = new Database();
        $this->format = new Format();
    }

    public function adminLogin($adminUser, $adminPass)
    {
        $adminUser = $this->format->validation($adminUser);
        $adminPass = $this->format->validation($adminPass);

        $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

        if (empty($adminUser) || empty($adminPass))
        {
            $loginMsg = "Username or Password must not be empty!!";

            return $loginMsg;
        } else {
            $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass'";
            $result = $this->db->select($query);

            if ($result != false)
            {
                // Récupère un tableau associatif
                $value = $result->fetch_assoc();
                // Récupère les données du tableau
                Session::set("adminlogin", true);
                Session::set("adminId", $value['adminId']);
                Session::set("adminUser", $value['adminUser']);
                Session::set("adminName", $value['adminName']);
                // Redirection
                header("Location: dashboard.php");
            } else {
                $loginMsg = "Username or Password not match!";

                return $loginMsg;
            }
        }
    }
}
