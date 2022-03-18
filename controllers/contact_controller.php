<?php
    session_start(); 

    include('../services/connection.php');
    include('../utils/get_age_by_birth_date.php');
?>

<?php 
    class ContactController{
        private $connection;

        function __construct($connection){
            $this->connection = $connection;
        }

        function create($name, $phone_number, $email, $cpf, $birth_date){
            $age = get_age_by_bday($birth_date);

            $string_query = "INSERT INTO contacts (name, phone_number, email, cpf, age, birth_date) VALUES ('$name', '$phone_number', '$email', '$cpf', '$age', '$birth_date')";

            $result = $this->connection->query($string_query);

            if(!$result){
                throw new Exception("An error ocurred while creating the new contact");
            }
        }
    }

    function create_contact($contact_controller){
        $name = $_POST['name'];
        $phone_number = $_POST['phone_number'];
        $email = $_POST['email'];
        $cpf = $_POST['CPF'];
        $birth_date = $_POST['birth_date'];

        try{
            $contact_controller->create($name, $phone_number, $email, $cpf, $birth_date);

            $_SESSION['creation-sucecced'] = true;
        }
        catch(Exception $e){
            $_SESSION['creation-sucecced'] = false;
        }

        header('Location: ../contact.php');
    }

    $contact_controller = new ContactController($connection);
    $action = $_POST['action'];

    switch($action){
        case 'create':
            create_contact($contact_controller);
            break;
    }
?>