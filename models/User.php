<?php

class User {
    private int $id;
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $username;
    private string $password;
    private string $image;
    
    public function __construct($id, $first_name, $last_name, $email, $username, $password) {
        $this->id = $id;
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
        require __DIR__.'/../services/database-connector.php';

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
            echo json_encode(["error" => "error on line: ".__LINE__]);
        }
    }

    public function create_session() {
        $_SESSION['id'] = $this->id;
        $_SESSION['first_name'] = $this->first_name;
        $_SESSION['email'] = $this->email;
    }

    public function delete_session() {
        unset($_SESSION['first_name']);
        unset($_SESSION['email']); 
        unset($_SESSION['id']); 
        session_destroy();
    }

    public function update_profile($id, $first_name, $last_name, $username, $email) {
        require __DIR__.'/../services/database-connector.php';

        try {
            $query = $database->prepare('UPDATE users SET first_name = :first_name, last_name = :last_name, username = :username, email = :email WHERE id = :id');
            $query->bindValue('first_name', $first_name);
            $query->bindValue('last_name', $last_name);
            $query->bindValue('username', $username);
            $query->bindValue('email', $email);
            $query->bindValue('id', $id);
        
            $query->execute();
            if ($query->rowCount() == 0) {
                echo json_encode(['information' => 'User could not be updated']);
                exit();
            }
        
            $_SESSION['notification'] = 'Password changed.';
            header('Location: ./profile');
            exit();
        } catch (PDOException $exception) {
            http_response_code(500);
            echo json_encode(['error' => 'error on line: '.__LINE__]);
            exit();
        }
    }

    public function delete_profile($id) {
        require(__DIR__.'/../services/database-connector.php');

        try {
            $query = $database->prepare('DELETE FROM users WHERE id = :id');
            $query->bindValue('id', $id);
            $query->execute();
            if ($query->rowCount() == 0) {
                echo json_encode(['error' => 'User could not be deleted']);
                exit();
            }
            // echo json_encode(['information' => 'User deleted with ID: '.$id]);
            header('Location: ./');
            exit();
        
        } catch (PDOException $exception) {
            http_response_code(500);
            echo json_encode(['information' => 'error on line: '.__LINE__]);
            exit();
        }
    }

    public function change_password() {}
    
    public function upload_image($id, $image_data) {
        require(__DIR__.'/../services/database-connector.php');
        
        try {
            $upload_dir = __DIR__."/../images/";
            $upload_file = $upload_dir . $image_data['image_name'];
            if (move_uploaded_file($image_data['image_tmp'], $upload_file)) {
                $query = $database->prepare("UPDATE users SET image = :image WHERE id = :id");
                $query->bindValue('image', $image_data['image_name']);
                $query->bindValue('id', $id);
                $query->execute();
                if ($query->rowCount() == 0) {
                    header('Location: ./update-image');
                    exit();
                }
                header('Location: ./profile');
                exit();
            }
        } catch (PDOException $exception) {
            http_response_code(500);
            echo json_encode(['error' => 'error on line: '.__LINE__]);
            exit();
        }
    }

}

# Local tests 

// $user = new User("David", "Haring", "davidharingri@gmail.com", "davidh22", "mysecurepass123");
// $user->image = "cute_doggo_image";
// echo $user;

?>