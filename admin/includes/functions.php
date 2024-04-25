<?php
$connection = mysqli_connect("localhost", "root", "", "MedCheck");  // Aktualisiere den Datenbanknamen

// Query-Funktionen (Start)
function query($query) {
    global $connection;
    $run = mysqli_query($connection, $query);
    $data = [];
    if ($run) {
        while ($row = $run->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    } else {
        return 0;
    }
}

function single_query($query) {
    global $connection;
    $run = mysqli_query($connection, $query);
    return $run ? 1 : 0;
}
// Query-Funktionen (Ende)

// Umleitungs-Funktionen (Start)
function post_redirect($url) {
    ob_start();
    header('Location: ' . $url);
    ob_end_flush();
    die();
}

function get_redirect($url) {
    echo "<script>window.location.href = '$url';</script>";
}
// Umleitungs-Funktionen (Ende)

// Nachrichtenfunktion (Start)
function message() {
    if (isset($_SESSION['message'])) {
        $messages = [
            "loginErr" => "Es existiert kein Konto mit dieser E-Mail-Adresse!",
            "emailErr" => "Die E-Mail-Adresse wird bereits verwendet. Bitte wählen Sie eine andere.",
            "loginErr1" => "Die E-Mail oder das Passwort ist falsch!",
            "noResult" => "Es gibt keinen Benutzer mit dieser E-Mail-Adresse.",
            "itemErr" => "Ein Produkt mit demselben Namen existiert bereits.",
            "noResultOrder" => "Es gibt keine Bestellung mit dieser ID!",
            "noResultItem" => "Es gibt kein Produkt mit diesem Namen!",
            "noResultAdmin" => "Es gibt keinen Administrator mit dieser E-Mail-Adresse!",
            "empty_err" => "Bitte lassen Sie keine Felder leer!"
        ];

        if (array_key_exists($_SESSION['message'], $messages)) {
            echo "<div class='alert alert-danger' role='alert'>" . $messages[$_SESSION['message']] . "</div>";
            unset($_SESSION['message']);
        }
    }
}
// Nachrichtenfunktion (Ende)

// Login-Funktion (Start)
function login() {
    if (isset($_POST['login'])) {
        $adminEmail = trim($_POST['adminEmail']);
        $password = trim(strtolower($_POST['adminPassword']));
        $query = "SELECT email, verwaltung_id, passwort FROM verwaltung WHERE email = '$adminEmail'";
        $data = query($query);
        if (empty($data)) {
            $_SESSION['message'] = "loginErr";
            post_redirect("login.php");
        } elseif ($password == $data[0]['passwort'] && $adminEmail == $data[0]['email']) {
            $_SESSION['admin_id'] = $data[0]['verwaltung_id'];
            post_redirect("index.php");
        } else {
            $_SESSION['message'] = "loginErr1";
            post_redirect("login.php");
        }
    }
}
// Login-Funktion (Ende)
// user functions (start)
function all_users()
{
    $query = "SELECT benutzer_id, vorname, nachname, email, adresse FROM benutzer";
    $data = query($query);
    return $data;
}

function delete_user()
{
    if (isset($_GET['delete'])) {
        $benutzerId = $_GET['delete'];
        $query = "DELETE FROM benutzer WHERE benutzer_id ='$benutzerId'";
        $run = single_query($query);
        get_redirect("customers.php");
    }
}

function edit_user($id)
{
    if (isset($_POST['update'])) {
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $email = trim(strtolower($_POST['email']));
        $adresse = trim($_POST['address']);
        if (empty($email) or empty($adresse) or empty($fname) or empty($lname)) {
            $_SESSION['message'] = "empty_err";
            get_redirect("customers.php");
            return;
        }
        $check = check_email_user($email);
        if ($check == 0) {
            $query = "UPDATE benutzer SET email='$email', vorname='$fname', nachname='$lname', adresse='$adresse' WHERE benutzer_id= '$id'";
            single_query($query);
            get_redirect("customers.php");
        } else {
            $_SESSION['message'] = "emailErr";
            get_redirect("customers.php");
        }
    } elseif (isset($_POST['cancel'])) {
        get_redirect("customers.php");
    }
}

function get_user($id)
{
    $query = "SELECT benutzer_id, vorname, nachname, email, adresse FROM benutzer WHERE benutzer_id=$id";
    $data = query($query);
    return $data;
}

function check_email_user($email)
{
    $query = "SELECT email FROM benutzer WHERE email='$email'";
    $data = query($query);
    if ($data) {
        return 1;
    } else {
        return 0;
    }
}

function search_user()
{
    if (isset($_GET['search_user'])) {
        $email = trim(strtolower($_GET['search_user_email']));
        if (empty($email)) {
            return;
        }
        $query = "SELECT benutzer_id, vorname, nachname, email, adresse FROM benutzer WHERE email='$email'";
        $data = query($query);
        if ($data) {
            return $data;
        } else {
            $_SESSION['message'] = "noResult";
            return;
        }
    }
}

function get_user_details()
{
    if ($_GET['id']) {
        $id = $_GET['id'];
        $query = "SELECT * FROM benutzer WHERE benutzer_id=$id";
        $data = query($query);
        return $data;
    }
}
// user functions (end)
// item functions (start)
function all_items()
{
    $query = "SELECT * FROM produkt";
    $data = query($query);
    return $data;
}

function delete_item()
{
    if (isset($_GET['delete'])) {
        $produktId = $_GET['delete'];
        $query = "DELETE FROM produkt WHERE produkt_id ='$produktId'";
        $run = single_query($query);
        get_redirect("products.php");
    }
}

function edit_item($id)
{
    if (isset($_POST['update'])) {
        $name = trim($_POST['name']);
        $marke = trim($_POST['brand']);
        $kategorie = trim($_POST['cat']);
        $schlagworte = trim($_POST['tags']);
        $bild = trim($_POST['image']);
        $menge = trim($_POST['quantity']);
        $preis = trim($_POST['price']);
        $details = trim($_POST['details']);
        $check = check_name($name);
        if ($check == 0) {
            $query = "UPDATE produkt SET titel='$name', marke='$marke', kategorie='$kategorie',
            details='$details', schlagworte='$schlagworte', 
            bild='$bild', menge='$menge', preis='$preis' WHERE produkt_id= '$id'";
            $run = single_query($query);
            get_redirect("products.php");
        } else {
            $_SESSION['message'] = "itemErr";
            get_redirect("products.php");
        }
    } elseif (isset($_POST['cancel'])) {
        get_redirect("products.php");
    }
}

function get_item($id)
{
    $query = "SELECT * FROM produkt WHERE produkt_id=$id";
    $data = query($query);
    return $data;
}

function check_name($name)
{
    $query = "SELECT titel FROM produkt WHERE titel='$name'";
    $data = query($query);
    if ($data) {
        return 1;
    } else {
        return 0;
    }
}

function search_item()
{
    if (isset($_GET['search_item'])) {
        $name = trim($_GET['search_item_name']);
        $query = "SELECT * FROM produkt WHERE titel LIKE '%$name%'";
        $data = query($query);
        if ($data) {
            return $data;
        } else {
            $_SESSION['message'] = "noResultItem";
            return;
        }
    }
}
function add_item()
{
    if (isset($_POST['add_item'])) {
        $titel = trim($_POST['name']);
        $marke = trim($_POST['brand']);
        $kategorie = trim($_POST['cat']);
        $schlagworte = trim($_POST['tags']);
        $bild = trim($_POST['image']);
        $menge = trim($_POST['quantity']);
        $preis = trim($_POST['price']);
        $details = trim($_POST['details']);
        $verwaltung_id = $_SESSION['admin_id'];
        $check = check_name($titel);
        if (empty($titel) or empty($marke) or empty($kategorie) or
            empty($schlagworte) or empty($bild) or empty($menge) or empty($preis) or empty($details)) {
            $_SESSION['message'] = "empty_err";
            get_redirect("products.php");
            return;
        }
        if ($check == 0) {
            $query = "INSERT INTO produkt (titel, marke, kategorie, details,
            schlagworte, bild, menge, preis, verwaltung_id) VALUES
            ('$titel', '$marke', '$kategorie', '$details', '$schlagworte', '$bild', '$menge', '$preis', '$verwaltung_id')";
            $run = single_query($query);
            get_redirect("products.php");
        } else {
            $_SESSION['message'] = "itemErr";
            get_redirect("products.php");
        }
    } elseif (isset($_POST['cancel'])) {
        get_redirect("products.php");
    }
}

function get_item_details()
{
    if ($_GET['id']) {
        $id = $_GET['id'];
        $query = "SELECT * FROM produkt WHERE produkt_id=$id";
        $data = query($query);
        return $data;
    }
}
function all_admins()
{
    $query = "SELECT verwaltung_id, vorname, nachname, email FROM verwaltung";
    $data = query($query);
    return $data;
}

function get_admin($id)
{
    $query = "SELECT verwaltung_id, vorname, nachname, email FROM verwaltung WHERE verwaltung_id=$id";
    $data = query($query);
    return $data;
}

function edit_admin($id)
{
    if (isset($_POST['admin_update'])) {
        $fname = trim($_POST['admin_fname']);
        $lname = trim($_POST['admin_lname']);
        $email = trim(strtolower($_POST['admin_email']));
        $password = trim($_POST['admin_password']);
        $check = check_email_admin($email);
        if ($check == 0) {
            $query = "UPDATE verwaltung SET email='$email', vorname='$fname', nachname='$lname', passwort='$password' WHERE verwaltung_id= '$id'";
            single_query($query);
            get_redirect("admin.php");
        } else {
            $_SESSION['message'] = "emailErr";
            get_redirect("admin.php");
        }
    } elseif (isset($_POST['admin_cancel'])) {
        get_redirect("admin.php");
    }
}

function check_email_admin($email)
{
    $query = "SELECT email FROM verwaltung WHERE email='$email'";
    $data = query($query);
    if ($data) {
        return $data;
    } else {
        return 0;
    }
}

function add_admin()
{
    if (isset($_POST['add_admin'])) {
        $fname = trim($_POST['admin_fname']);
        $lname = trim($_POST['admin_lname']);
        $email = trim(strtolower($_POST['admin_email']));
        $password = trim($_POST['admin_password']);
        $check = check_email_admin($email);
        if ($check == 0) {
            $query = "INSERT INTO verwaltung (vorname, nachname, email, passwort) VALUES ('$fname','$lname','$email','$password')";
            single_query($query);
            get_redirect("admin.php");
        } else {
            $_SESSION['message'] = "emailErr";
            get_redirect("admin.php");
        }
    } elseif (isset($_POST['admin_cancel'])) {
        get_redirect("admin.php");
    }
}

function delete_admin()
{
    if (isset($_GET['delete'])) {
        $adminId = $_GET['delete'];
        $query = "DELETE FROM verwaltung WHERE verwaltung_id ='$adminId'";
        $run = single_query($query);
        get_redirect("admin.php");
    }
}

function search_admin()
{
    if (isset($_GET['search_admin'])) {
        $email = trim(strtolower($_GET['search_admin_email']));
        if (empty($email)) {
            return;
        }
        $query = "SELECT verwaltung_id, vorname, nachname, email FROM verwaltung WHERE email='$email'";
        $data = query($query);
        if ($data) {
            return $data;
        } else {
            $_SESSION['message'] = "noResultAdmin";
            return;
        }
    }
}

function check_admin($id)
{
    $query = "SELECT verwaltung_id FROM verwaltung where verwaltung_id='$id'";
    $row = query($query);
    if (empty($row)) {
        return 0;
    } else {
        return 1;
    }
}

// order functions (start)
function all_orders()
{
    $query = "SELECT * FROM bestellungen";
    $data = query($query);
    return $data;
}

function search_order()
{
    if (isset($_GET['search_order'])) {
        $id = trim($_GET['search_order_id']);
        if (empty($id)) {
            return;
        }
        $query = "SELECT * FROM bestellungen WHERE bestell_id='$id'";
        $data = query($query);
        if ($data) {
            return $data;
        } else {
            $_SESSION['message'] = "noResultOrder";
            return;
        }
    }
}

function delete_order()
{
    if (isset($_GET['delete'])) {
        $order_id = $_GET['delete'];
        $query = "DELETE FROM bestellungen WHERE bestell_id ='$order_id'";
        $run = single_query($query);
        get_redirect("orders.php");
    } elseif (isset($_GET['done'])) {
        $order_id = $_GET['done'];
        $query = "UPDATE bestellungen SET status = 1 WHERE bestell_id='$order_id'";
        single_query($query);
        get_redirect("orders.php");
    } elseif (isset($_GET['undo'])) {
        $order_id = $_GET['undo'];
        $query = "UPDATE bestellungen SET status = 0 WHERE bestell_id='$order_id'";
        single_query($query);
        get_redirect("orders.php");
    }
}
// order functions (end)
