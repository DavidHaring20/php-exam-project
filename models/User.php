<?php


class User {
    private $first_name;
    private $last_name;
    private $email;
    private $username;
    private $password;
    private $image;
    
    function __construct($first_name, $last_name, $email, $username, $password) {
        $this->first_name = $first_name;
        $this->last_naem = $last_name;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }

    function __get($property) {
        if ($property === 'first_name') {
            return $this->get_first_name();
        } elseif ($property === 'last_name') {
            return $this->get_last_name();
        } elseif ($property === 'email') {
            return $this->get_email();
        } elseif ($property === 'username') {
            return $this->get_username();
        } elseif ($property === 'password') {
            return $this->get_password();
        } elseif ($property === 'image') {
            return $this->get_image();
        }
    }

    function __set($property, $value) {
        if ($property === 'first_name') {
            $this->set_first_name($value);
        } elseif ($property === 'last_name') {
            $this->set_last_name($value);
        } elseif ($property === 'email') {
            $this->set_email($value);
        } elseif ($property === 'username') {
            $this->set_username($value);
        } elseif ($property === 'password') {
            $this->set_password($value);
        } elseif ($property === 'image') {
            $this->set_image($value);
        }
    }

    function get_first_name() {
        return $this->first_name;
    }

    function set_first_name($first_name) {
        $this->first_name = $first_name;
    }

    function get_last_name() {
        return $this->last_name;
    }

    function set_last_name($last_name) {
        $this->last_name = $last_name;
    }

    function get_email() {
        return $this->email;
    }

    function set_email($email) {
        $this->email = $email;
    }

    function get_username() {
        return $this->username;
    }

    function set_username($username) {
        $this->username = $username;
    }

    function get_password() {
        return $this->password;
    }

    function set_password($password) {
        $this->password = $password;
    }

    function get_image() {
        return $this->image;
    }

    function set_image($image) {
        $this->image = $image;
    }
}

?>