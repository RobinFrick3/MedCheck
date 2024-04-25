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
                    <h2>Admin-Details</h2>
                    <br>
                </div>
                <div class="col">
                </div>
                <div class="col">
                    <br>
                    <form class="d-flex" method="GET" action="admin.php">
                        <input class="form-control me-2 col" type="search" name="search_admin_email" placeholder="Suche nach Admin (E-Mail)" aria-label="Suche">
                        <button class="btn btn-outline-secondary" type="submit" name="search_admin" value="search">Suchen</button>
                    </form>
                    <br>
                </div>
            </div>
        </div>
        <?php
        edit_admin($_SESSION['admin_id']);
        if (isset($_GET['edit'])) {
            $_SESSION['admin_id'] = $_GET['edit'];
            $data = get_admin($_SESSION['admin_id']);

        ?>
            <br>
            <h2>Admin-Daten bearbeiten</h2>
            <form action="admin.php" method="POST">
                <div class="form-group">
                    <label>Vorname</label>
                    <input pattern="[A-Za-z_]{1,15}" type="text" class="form-control" placeholder="<?php echo $data[0]['vorname'] ?>" name="admin_fname">
                    <div class="form-text">Bitte geben Sie den Vornamen im Bereich von 1 bis 30 Zeichen ein, Sonderzeichen und Zahlen sind nicht erlaubt!</div>
                </div>
                <br>
                <div class="form-group">
                    <label>Nachname</label>
                    <input pattern="[A-Za-z_]{1,15}" id="validationTooltip01" type="text" class="form-control" placeholder="<?php echo $data[0]['nachname'] ?>" name="admin_lname">
                    <div class="form-text">Bitte geben Sie den Nachnamen im Bereich von 1 bis 30 Zeichen ein, Sonderzeichen und Zahlen sind nicht erlaubt!</div>
                </div>
                <br>
                <div class="form-group">
                    <label for="exampleInputEmail1">E-Mail-Adresse</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="<?php echo $data[0]['email'] ?>" name="admin_email">
                    <div class="form-text">Bitte geben Sie die E-Mail-Adresse im Format: beispiel@gmail.com ein.</div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Passwort</label>
                    <input type="password" pattern="^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$" class="form-control" placeholder="Passwort" name="admin_password">
                    <div class="form-text">
                        <ul>
                            <li>Muss mindestens 8 Zeichen lang sein</li>
                            <li>Muss mindestens 1 Zahl enthalten</li>
                            <li>Muss mindestens ein Großbuchstabe enthalten</li>
                            <li>Muss mindestens ein Kleinbuchstabe enthalten</li>
                        </ul>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-outline-primary" value="update" name="admin_update">Senden</button>
                <button type=" submit" class="btn btn-outline-danger" value="cancel" name="admin_cancel">Abbrechen</button>
                <br> <br>
            </form>

        <?php
        }
        add_admin();
        if (isset($_GET['add'])) {

        ?>
            <h2>Neuen Admin hinzufügen</h2>
            <form action="admin.php" method="POST">
                <div class="form-group">
                    <label>Vorname</label>
                    <input pattern="[A-Za-z_]{1,15}" type="text" class="form-control" placeholder="Vorname" name="admin_fname">
                    <div class="form-text">Bitte geben Sie den Vornamen im Bereich von 1 bis 30 Zeichen ein, Sonderzeichen und Zahlen sind nicht erlaubt!</div>
                </div>
                <br>
                <div class="form-group">
                    <label for="validationTooltip01">Nachname</label>
                    <input pattern="[A-Za-z_]{1,15}" id="validationTooltip01" type="text" class="form-control" placeholder="Nachname" name="admin_lname">
                    <div class="form-text">Bitte geben Sie den Nachnamen im Bereich von 1 bis 30 Zeichen ein, Sonderzeichen und Zahlen sind nicht erlaubt!</div>
                </div>
                <br>
                <div class="form-group">
                    <label for="exampleInputEmail1">E-Mail-Adresse</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-Mail-Adresse" name="admin_email">
                    <div class="form-text">Bitte geben Sie die E-Mail-Adresse im Format: beispiel@gmail.com ein.</div>
                </div><br>
                <div class="form-group">
                    <label for="exampleInputPassword1">Passwort</label>
                    <input type="password" pattern="^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$" class="form-control" placeholder="Passwort" name="admin_password">
                    <div class="form-text">
                        <ul>
                            <li>Muss mindestens 8 Zeichen lang sein</li>
                            <li>Muss mindestens 1 Zahl enthalten</li>
                            <li>Muss mindestens ein Großbuchstabe enthalten</li>
                            <li>Muss mindestens ein Kleinbuchstabe enthalten</li>
                        </ul>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-outline-primary" value="update" name="add_admin">Senden</button>
                <button type=" submit" class="btn btn-outline-danger" value="cancel" name="admin_cancel">Abbrechen</button>
                <br> <br>
            </form>

        <?php
        }

        ?>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Vorname</th>
                        <th scope="col">Nachname</th>
                        <th scope="col">E-Mail</th>
                        <th scope="col">
                        <th scope="col">
                            <button type="button" class="btn btn-outline-primary "><a style="text-decoration: none; color:black;" href="admin.php?add=1"> &nbsp;&nbsp;Hinzufügen&nbsp;&nbsp;</a></button>
                        </th>
                        </th>

                </thead>

                <tbody>
                    <?php
                    $data = all_admins();
                    delete_admin();
                    if (isset($_GET['search_admin'])) {
                        $query = search_admin();
                        if (!empty($query)) {
                            $data = $query;
                        } else {
                            get_redirect("admin.php");
                        }
                    }
                    $num = sizeof($data);
                    for ($i = 0; $i < $num; $i++) {
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $data[$i]['verwaltung_id'] ?></td>
                            <td><?php echo $data[$i]['vorname'] ?></td>
                            <td><?php echo $data[$i]['nachname'] ?></td>
                            <td><?php echo $data[$i]['email'] ?></td>
                            <td>
                                <button type="button" class="btn pull-left btn-outline-warning"><a style="text-decoration: none; color:black;" href="admin.php?edit=<?php echo $data[$i]['verwaltung_id'] ?>">Bearbeiten</a></button>
                            </td>
                            <?php
                            if ($data[$i]['verwaltung_id'] != $_SESSION['admin_id']) {
                            ?>
                                <td>
                                    <button type="button" class="btn pull-left btn-outline-danger"><a style="text-decoration: none; color:black;" href="admin.php?delete=<?php echo $data[$i]['verwaltung_id'] ?>">Löschen</a></button>
                                </td>
                            <?php
                            } else {
                            ?>
                                <td></td>
                            <?php
                            }
                            ?>
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
