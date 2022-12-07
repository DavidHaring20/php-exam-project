<?php

class User {
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $username;
    private string $password;
    private string $image;
    
    public function __construct($first_name, $last_name, $email, $username, $password) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->image = '';
    }

    public function __get($property) {
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

    public function __set($property, $value) {
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

    public function __toString() {
        return <<<USER
            <b>User</b><br>
            &nbsp;&nbsp;&nbsp;&nbsp; First Name: $this->first_name<br>
            &nbsp;&nbsp;&nbsp;&nbsp; Last Name: $this->last_name<br>
            &nbsp;&nbsp;&nbsp;&nbsp; Email: $this->email<br>
            &nbsp;&nbsp;&nbsp;&nbsp; Username: $this->username<br>
            &nbsp;&nbsp;&nbsp;&nbsp; Password: $this->password<br> 
            &nbsp;&nbsp;&nbsp;&nbsp; Image: $this->image<br>
        USER;
    }

    public function get_first_name() {
        return $this->first_name;
    }

    public function set_first_name($first_name) {
        $this->first_name = $first_name;
    }

    public function get_last_name() {
        return $this->last_name;
    }

    public function set_last_name($last_name) {
        $this->last_name = $last_name;
    }

    public function get_email() {
        return $this->email;
    }

    public function set_email($email) {
        $this->email = $email;
    }

    public function get_username() {
        return $this->username;
    }

    public function set_username($username) {
        $this->username = $username;
    }

    public function get_password() {
        return $this->password;
    }

    public function set_password($password) {
        $this->password = $password;
    }

    public function get_image() {
        return $this->image;
    }

    public function set_image($image) {
        $this->image = $image;
    }

    public function create_user() {
        require_once(__DIR__.'/../services/database-connector.php');

        try {
            $query = $database->prepare('INSERT INTO users(first_name, last_name, email, username, password) VALUES(:first_name, :last_name, :email, :username, :password)');
        
            $query->bindValue(':first_name', $this->get_first_name());
            $query->bindValue(':last_name', $this->get_last_name());
            $query->bindValue(':email', $this->get_email());
            $query->bindValue(':username', $this->get_username());
            $query->bindValue(':password', $this->get_password());

            $query->execute();
            $id = $database->lastInsertId();
            echo "Added user successfully with ID: ".$id;
        } catch (PDOException $exception) {
            echo $exception;
        }
    }
}

# Local tests 

// $user = new User("David", "Haring", "davidharingri@gmail.com", "davidh22", "mysecurepass123");
// $user->image = "cute_doggo_image";
// echo $user;

?>