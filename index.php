<?php 
    include './controllers/contact_controller.php';
   
    $contacts = list_contacts($contact_controller);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Lista de contatos</title>
</head>
<body>
    <div class="container mt-5 w-50">
        <header class="d-flex justify-content-between mb-3">
            <section class="d-flex gap-3">
                <img src="./assets/images/users.svg" width="36" alt="Telefone">
                <h1>Lista de contatos</h1>
            </section>

            <a href="contact.php" class="btn border border-dark d-flex align-items justify-content-center">
                <img src="./assets/images/plus.svg" alt="">
            </a>
        </header>
    </div>

    <main class="container mt-5 w-50">
        <ul style="padding: 0;">
            <?php foreach($contacts as $contact): ?>
                <li class="card mb-3"  style="max-width: 100%; ">
                    <div class="row g-0">
                        <div class="col d-flex" style="max-width: 200px;">
                            <img src=<?php echo "https://ui-avatars.com/api/?background=8ecae6&color=FFF&size=256&name=" . $contact['name'] ?> class="img-fluid rounded" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $contact['name'] ?></h5>
                                
                                <ul style="list-style: none; padding-left: 0;">
                                    <li><strong>N° de telefone: </strong><?php echo $contact['phone_number']?></li>
                                    <li><strong>E-mail: </strong><?php echo $contact['email']?></li>
                                    <li><strong>CPF: </strong><?php echo $contact['CPF']?></li>
                                    <li><strong>Data de Nascimento: </strong><?php echo  date_format(date_create($contact['birth_date']), 'd/m/Y') ?></li>
                                    <li><strong>Idade: </strong><?php echo $contact['age']?> anos</li>
                                </ul>
                            </div>

                            <footer class="d-flex justify-content-between mt-4 mb-4 px-3" > 
                                <a class="btn border border-success"  > <img src="./assets/images/call.svg" alt=""> </a>
                                
                                <form action="contact.php" method="POST">
                                    <input hidden type="text" name="id" value=<?php echo $contact['id'] ?>>
                                    <button class="btn border border-dark">
                                        <img src="./assets/images/edit.svg">
                                    </button>
                                </form>


                                <form action="./controllers/contact_controller.php" method="POST">
                                    <input hidden type="text" name="id" value=<?php echo $contact['id'] ?>>
                                    <button class="btn border border-danger" value="delete" name="action">
                                        <img src="./assets/images/delete.svg" alt=""> 
                                    </button>
                                </form>
                            </footer>
                        </div>
                    </div>
                </li>
            <?php endforeach ?>
        
        </ul>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>