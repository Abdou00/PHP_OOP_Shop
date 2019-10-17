<?php
include_once '../lib/Database.php';
include_once '../helpers/Format.php';

class Category
{
    private $db;
    private $format;

    /**
     * Category constructor.
     */
    public function __construct()
    {
        $this->db = new Database();
        $this->format = new Format();
    }

    /**
     * @param $catName
     * @return string
     */
    public function catInsert($catName)
    {
        $catName = $this->format->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);

        if (empty($catName)) {
            $msg = "<span class='error'>Category field must not be empty!!</span>";

            return $msg;
        } else {
            $query = "INSERT INTO tbl_category(catName) VALUES ('$catName')";
            $catinsert = $this->db->insert($query);

            if ($catinsert)
            {
                $msg = "<span class='success'>Category Inserted Successfully.</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Category Not Inserted.</span>";
                return $msg;
            }
        }
    }

    /**
     * @return bool
     */
    public function getAllCat()
    {
        $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
        $result = $this->db->select($query);

        return $result;
    }

    /**
     * @param $id
     * @return bool
     */
    public function getCatById($id)
    {
        $query = "SELECT * FROM tbl_category WHERE catId = '$id'";
        $result = $this->db->select($query);

        return $result;
    }

    /**
     * @param $catName
     * @param $id
     * @return string
     */
    public function catUpdate($catName, $id)
    {
        $catName = $this->format->validation($catName);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $catName = mysqli_real_escape_string($this->db->link, $catName);

        if (empty($catName)) {
            $msg = "<span class='error'>Category field must not be empty!!</span>";

            return $msg;
        } else {
            $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id'";
            $updated_row = $this->db->update($query);

            if ($updated_row)
            {
                $msg = "<span class='success'>Category Updateed Successfully.</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Category Not Updated.</span>";
                return $msg;
            }
        }
    }

    /**
     * @param $id
     * @return string
     */
    public function delCatById($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "DELETE FROM tbl_category WHERE catId = '$id'";
        $deldata = $this->db->delete($query);

        if ($deldata)
        {
            $msg = "<span class='success'>Category Deleted Successfully.</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Category Not Deleted.</span>";
            return $msg;
        }
    }
}
