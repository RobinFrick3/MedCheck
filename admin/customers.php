<?php
error_reporting(E_ERROR | E_PARSE);
include "includes/head.php";
?>

<body>
    <?php
    include "includes/header.php"
    ?>


    <?php
    include "includes/sidebar.php";
    ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <?php
        message();
        ?>
        <div class="container">
            <div class="row align-items-start">
                <div class="col">
                    <br>
                    <h2>Kundendetails</h2>
                    <br>
                </div>
                <div class="col">
                </div>
                <div class="col">
                    <br>
                    <form class="d-flex" method="GET" action="customers.php">
                        <input class="form-control me-2 col" type="search" name="search_user_email" placeholder="Nach Benutzer suchen (E-Mail)" aria-label="Suche">
                        <button class="btn btn-outline-secondary" type="submit" name="search_user" value="search">Suchen</button>
                    </form>
                    <br>
                </div>
            </div>
        </div>
        <?php

        if (isset($_GET['edit'])) {
            $_SESSION['id'] = $_GET['edit'];
            $data = get_user($_SESSION['id']);

        ?>
            <br>
            <h2>Kundendetails bearbeiten</h2>
            <form action="customers.php" method="POST">
                <div class="form-group">
                    <label>Vorname</label>
                    <input pattern="[A-Za-z_]{1,15}" type="text" class="form-control" placeholder="<?php echo $data[0]['vorname'] ?>" name="fname">
                    <div class="form-text">Bitte geben Sie den Vornamen im Bereich von 1 bis 30 Zeichen ein, Sonderzeichen und Zahlen sind nicht erlaubt!</div>
                </div>
                <br>
                <div class="form-group">
                    <label for="validationTooltip01">Nachname</label>
                    <input pattern="[A-Za-z_]{1,15}" id="validationTooltip01" type="text" class="form-control" placeholder="<?php echo $data[0]['nachname'] ?>" name="lname">
                    <div class="form-text">Bitte geben Sie den Nachnamen im Bereich von 1 bis 30 Zeichen ein, Sonderzeichen und Zahlen sind nicht erlaubt!</div>
                </div>
                <br>
                <div class="form-group">
                    <label for="exampleInputEmail1">E-Mail-Adresse</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="<?php echo $data[0]['email'] ?>" name="email">
                    <div class="form-text">Bitte geben Sie die E-Mail-Adresse im Format: beispiel@gmail.com ein.</div>
                </div>
                <br>
                <div class="form-group">
                    <label for="inputAddress2">Adresse</label>
                    <input pattern="^[#.0-9a-zA-Z\s,-]+$" type="text" class="form-control" id="inputAddress2" placeholder="<?php echo $data[0]['adresse'] ?>" name="address">
                    <div class="form-text">Bitte geben Sie die Adresse im Format: #1, Nordstraße, Berlin - 11 ein.</div>
                </div>
                <br>
                <button type="submit" class="btn btn-outline-success" value="update" name="update">Senden</button>
                <button type=" submit" class="btn btn-outline-danger" value="cancel" name="cancel">Abbrechen</button>
                <br> <br>
            </form>

        <?php
        }
        edit_user($_SESSION['id']);

        ?>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Vorname</th>
                        <th scope="col">Nachname</th>
                        <th scope="col">E-Mail</th>
                        <th scope="col">Adresse</th>

                </thead>

                <tbody>
                    <?php
                    $data = all_users();
                    delete_user();
                    if (isset($_GET['search_user'])) {
                        $query = search_user();
                        if (isset($query)) {
                            $data = $query;
                        } else {
                            get_redirect("customers.php");
                        }
                    } elseif (isset($_GET['id'])) {
                        $data = get_user_details();
                    }
                    $num = sizeof($data);
                    for ($i = 0; $i < $num; $i++) {
                    ?>
                        <tr>
                            <td><?php echo $data[$i]['benutzer_id'] ?></td>
                            <td><?php echo $data[$i]['vorname'] ?></td>
                            <td><?php echo $data[$i]['nachname'] ?></td>
                            <td><?php echo $data[$i]['email'] ?></td>
                            <td><?php echo $data[$i]['adresse'] ?></td>
                            <td>
                                <button type="button" class="btn pull-left btn-outline-warning"><a style="text-decoration: none; color:black;" href="customers.php?edit=<?php echo $data[$i]['benutzer_id'] ?>">Bearbeiten</a></button>
                            </td>
                            <td>
                                <button type="button" class="btn pull-left btn-outline-danger"><a style="text-decoration: none; color:black;" href="customers.php?delete=<?php echo $data[$i]['benutzer_id'] ?>">Löschen</a></button>
                            </td>
                        </tr>
                    <?php  }
                    ?>
                </tbody>
            </table>
        </div>

    </main>
    </div>
    </div>
    <?php
    include "includes/footer.php"
    ?>
</body>
