<?php
class User_models extends CI_Model
{
    public function get_user($username, $password)
    {
        $query = $this->db->get_where('users', array('username' => $username, 'password' => $password));
        return $query->row_array(); // Return user data as an array
    }
}
