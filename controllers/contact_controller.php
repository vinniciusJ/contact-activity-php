<?php
    session_start(); 

    include __DIR__ . '/../services/connection.php';
    include __DIR__ . '/../utils/get_age_by_birth_date.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>

<?php 
    class ContactController{
        private $connection;

        function __construct($connection){
            $this->connection = $connection;
        }

        private function execute_query($query, $error_message = "Um erro ocorreu ao executar a ação"){
            $result = $this->connection->query($query);

            if(!$result){
                throw new Exception($error_message);
            }

            return $result;
        }

        function create($name, $phone_number, $email, $cpf, $birth_date){
            $age = get_age_by_bday($birth_date);

            $string_query = "INSERT INTO contacts (name, phone_number, email, CPF, age, birth_date) VALUES ('$name', '$phone_number', '$email', '$cpf', '$age', '$birth_date')";

            return $this->execute_query($string_query);
        }

        function update($id, $name, $phone_number, $email, $cpf, $birth_date){
            $age = get_age_by_bday($birth_date);

            $string_query = "UPDATE contacts SET `name` = '$name', `phone_number` = '$phone_number', `email` = '$email', `CPF` = '$cpf', `age` = $age, `birth_date` = '$birth_date' WHERE `id` = $id";

            echo $string_query;

            return $this->execute_query($string_query);
        }

        function index(){
            $string_query = "SELECT * FROM contacts";
            $result = $this->execute_query($string_query);

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        function get($id){
            $string_query = "SELECT * FROM contacts WHERE id = $id";
            $result = $this->execute_query($string_query);

            return $result->fetch_array();
        }

        function delete($id){
            $string_query = "DELETE FROM contacts WHERE id = $id";
            $result = $this->execute_query($string_query);

            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

    function create_contact($controller){
        $name = $_POST['name'];
        $phone_number = $_POST['phone_number'];
        $email = $_POST['email'];
        $cpf = $_POST['CPF'];
        $birth_date = $_POST['birth_date'];

        try{
            $controller->create($name, $phone_number, $email, $cpf, $birth_date);
        }
        catch(Exception $e){
            $_SESSION['error-message'] = $e->getMessage();
        }

        header('Location: ../index.php');
    }

    function get_contact($controller, $id){
        try{
            $contact = $controller->get($id);
        }
        catch(Exception $e){
            return $e->getMessage();
        }

        return $contact;
    }

    function list_contacts($controller){
        $contacts = [];

        try{
            $contacts = $controller->index();  
        }
        catch(Exception $e){
            return $e->getMessage();
        }

        return $contacts;
    }

    function update_contact($controller){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $phone_number = $_POST['phone_number'];
        $email = $_POST['email'];
        $cpf = $_POST['CPF'];
        $birth_date = $_POST['birth_date'];

        try{
            echo var_dump($controller->update($id, $name, $phone_number, $email, $cpf, $birth_date));
        }
        catch(Exception $e){
            $_SESSION['error-message'] = $e->getMessage();
        }

        header('Location: ../index.php');
    }

    function delete_contact($controller){
        $id = $_POST['id'];

        try{
            $controller->delete($id);
        }
        catch(Exception $e){
            $_SESSION['error-message'] = $e->getMessage();
        }

        header('Location: ../index.php');
    }

    $contact_controller = new ContactController($connection);

    if(!empty($_POST['action'])){
        $action = $_POST['action'];

        

        switch($action){
            case 'create':
                create_contact($contact_controller);
                break;
            case 'delete':
                delete_contact($contact_controller);
                break;
            case 'update':
                update_contact($contact_controller);
                break;
        }
    } 
?>