<?php
include_once '../lib/Database.php';
include_once '../helpers/Format.php';

class Brand
{
    private $db;
    private $format;

    /**
     * Brand constructor.
     */
    public function __construct()
    {
        $this->db = new Database();
        $this->format = new Format();
    }

    /**
     * @param $brandName
     * @return string
     */
    public function brandInsert($brandName)
    {
        $brandName = $this->format->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);

        if (empty($brandName)) {
            $msg = "<span class='error'>Brand field must not be empty!!</span>";

            return $msg;
        } else {
            $query = "INSERT INTO tbl_brand(brandName) VALUES ('$brandName')";
            $catinsert = $this->db->insert($query);

            if ($catinsert)
            {
                $msg = "<span class='success'>Brand Inserted Successfully.</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Brand Not Inserted.</span>";
                return $msg;
            }
        }
    }

    /**
     * @return bool
     */
    public function getAllBrands()
    {
        $query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
        $result = $this->db->select($query);

        return $result;
    }

    /**
     * @param $id
     * @return bool
     */
    public function getBrandById($id)
    {
        $query = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
        $result = $this->db->select($query);

        return $result;
    }

    /**
     * @param $brandName
     * @param $id
     * @return string
     */
    public function brandUpdate($brandName, $id)
    {
        $brandName = $this->format->validation($brandName);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);

        if (empty($brandName)) {
            $msg = "<span class='error'>Brand field must not be empty!!</span>";

            return $msg;
        } else {
            $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$id'";
            $updated_row = $this->db->update($query);

            if ($updated_row)
            {
                $msg = "<span class='success'>Brand Updateed Successfully.</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Brand Not Updated.</span>";
                return $msg;
            }
        }
    }

    /**
     * @param $id
     * @return string
     */
    public function delBrandById($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "DELETE FROM tbl_brand WHERE brandId = '$id'";
        $deldata = $this->db->delete($query);

        if ($deldata)
        {
            $msg = "<span class='success'>Brand Deleted Successfully.</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Brand Not Deleted.</span>";
            return $msg;
        }
    }
}
