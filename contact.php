<?php 
    include './controllers/contact_controller.php';

    $contact = null;

    if(!empty($_POST['id'])){
        $contact = get_contact($contact_controller, $_POST['id']);
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Cadastrar novo contato</title>
</head>
<body>
    <div class="container mt-5 w-50">
        <header class="d-flex gap-3 mb-3">
            <img src="./assets/images/phone.svg" width="36" alt="Telefone">
            <h1>Adicionar novo contato</h1>
        </header>

        <main>
            <form action="./controllers/contact_controller.php" method="POST">
                <fieldset class="mb-3">
                    <label for="name" class="form-label">Nome: </label>
                    <input type="text" class="form-control" value="<?php echo $contact['name'] ?? '' ?>" id="name" name="name" aria-describedby="name">
                </fieldset>
                <fieldset class="mb-3">
                    <label for="phone_number" class="form-label">N° de telefone: </label>
                    <input type="tel"  class="form-control" value="<?php echo $contact['phone_number'] ?? '' ?>" id="phone_number" name="phone_number" aria-describedby="phone_number">
                    <div id="phone_number" class="form-text">Exemplo: (00) 90000-0000</div>
                </fieldset>
                <fieldset class="mb-3">
                    <label for="email" class="form-label">E-mail: </label>
                    <input type="text" class="form-control" value="<?php echo $contact['email'] ?? '' ?>" id="email" name="email" aria-describedby="email">
                </fieldset>

                <input hidden value=<?php echo isset($_POST['id']) ? $_POST['id'] : '' ?> name="id" type="text">

                <div class="d-flex justify-content-sm-between">
                    <fieldset class="mb-3 column w-75" >
                        <label for="CPF" class="form-label">N° de CPF: </label>
                        <input type="text" class="form-control" value="<?php echo $contact['CPF'] ?? '' ?>" id="CPF" name="CPF" aria-describedby="CPF">
                    </fieldset>
                    <fieldset class="mb-3 column">
                        <label for="birth_date" class="form-label">Data de Nascimento: </label>
                        <input type="date" class="form-control" value=<?php echo $contact['birth_date'] ?? '' ?> id="birth_date" name="birth_date" aria-describedby="birth_date">
                    </fieldset>
                </div>
                <fieldset class="d-flex gap-3 mt-3">

                    <button class="btn btn-primary" type="submit" value=<?php echo isset($contact) ? 'update' : 'create' ?> name="action">Salvar</button>
                    <button class="btn btn-light">Cancelar</button>
                </fieldset>
            </form>
        </main>
    </div> 


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>