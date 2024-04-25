<?php
$connection = mysqli_connect("localhost", "root", "", "MedCheck");

function post_redirect($url) {
    ob_start();
    header('Location: ' . $url);
    ob_end_flush();
    die();
}

function get_redirect($url) {
    echo "<script> 
    window.location.href = '" . $url . "'; 
    </script>";
}

function query($query) {
    global $connection;
    $run = mysqli_query($connection, $query);
    if ($run) {
        while ($row = $run->fetch_assoc()) {
            $data[] = $row;
        }
        if (!empty($data)) {
            return $data;
        } else {
            return "";
        }
    } else {
        return 0;
    }
}

function single_query($query) {
    global $connection;
    if (mysqli_query($connection, $query)) {
        return "done";
    } else {
        die("no data" . mysqli_connect_error($connection));
    }
}

function login() {
    if (isset($_POST['login'])) {
        $userEmail = trim(strtolower($_POST['userEmail']));
        $password = trim($_POST['password']);
        if (empty($userEmail) or empty($password)) {
            $_SESSION['message'] = "empty_err";
            post_redirect("login.php");
        }
        $query = "SELECT email, benutzer_id, passwort FROM benutzer WHERE email= '$userEmail'";
        $data = query($query);
        if (empty($data)) {
            $_SESSION['message'] = "loginErr";
            post_redirect("login.php");
        } elseif ($password == $data[0]['passwort'] and $userEmail == $data[0]['email']) {
            $_SESSION['user_id'] = $data[0]['benutzer_id'];
            post_redirect("index.php");
        } else {
            $_SESSION['message'] = "loginErr";
            post_redirect("login.php");
        }
    }
}

function signUp() {
    if (isset($_POST['singUp'])) {
        $email = trim(strtolower($_POST['email']));
        $fname = trim($_POST['Fname']);
        $lname = trim($_POST['Lname']);
        $address = trim($_POST['address']);
        $passwd = trim($_POST['passwd']);
        if (empty($email) or empty($passwd) or empty($address) or empty($fname) or empty($lname)) {
            $_SESSION['message'] = "empty_err";
            post_redirect("signUp.php");
        } elseif (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) {
            $_SESSION['message'] = "signup_err_email";
            post_redirect("signUp.php");
        } elseif (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,30}$/', $passwd)) {
            $_SESSION['message'] = "signup_err_password";
            post_redirect("signUp.php");
        }
        $query = "SELECT email FROM benutzer";
        $data = query($query);
        $count = sizeof($data);
        for ($i = 0; $i < $count; $i++) {
            if ($email == $data[$i]['email']) {
                $_SESSION['message'] = "usedEmail";
                post_redirect("signUp.php");
            }
        }
        $query = "INSERT INTO benutzer (email, vorname, nachname, adresse, passwort) VALUES('$email', '$fname', '$lname', '$address', '$passwd')";
        $queryStatus = single_query($query);
        $query = "SELECT benutzer_id FROM benutzer WHERE email='$email'";
        $data = query($query);
        $_SESSION['benutzer_id'] = $data[0]['benutzer_id'];
        if ($queryStatus == "done") {
            post_redirect("index.php");
        } else {
            $_SESSION['message'] = "wentWrong";
            post_redirect("signUp.php");
        }
    }
}
function message()
{
    if (isset($_SESSION['message'])) {
        if ($_SESSION['message'] == "signup_err_password") {
            echo "   <div class='alert alert-danger' role='alert'>
        please enter the password in correct form !!!
      </div>";
            unset($_SESSION['message']);
        } elseif ($_SESSION['message'] == "loginErr") {
            echo "   <div class='alert alert-danger' role='alert'>
        The email or the password is incorrect !!!
      </div>";
            unset($_SESSION['message']);
        } elseif ($_SESSION['message'] == "usedEmail") {
            echo "   <div class='alert alert-danger' role='alert'>
        This email is already used !!!
      </div>";
            unset($_SESSION['message']);
        } elseif ($_SESSION['message'] == "wentWrong") {
            echo "   <div class='alert alert-danger' role='alert'>
        Something went wrong !!!
      </div>";
            unset($_SESSION['message']);
        } elseif ($_SESSION['message'] == "empty_err") {
            echo "   <div class='alert alert-danger' role='alert'>
        please don't leave anything empty !!!
      </div>";
            unset($_SESSION['message']);
        } elseif ($_SESSION['message'] == "signup_err_email") {
            echo "   <div class='alert alert-danger' role='alert'>
        please enter the email in the correct form !!!
      </div>";
            unset($_SESSION['message']);
        }
    }
}

function search() {
    if (isset($_GET['search'])) {
        $search_text = $_GET['search_text'];
        if ($search_text == "") {
            return;
        }
        // Anpassung an die neue Tabelle `produkt` und die Spalte `schlagworte`
        $query = "SELECT * FROM produkt WHERE schlagworte LIKE '%$search_text%' GROUP BY titel, marke, kategorie, details, preis, verwaltung_id";
        $data = query($query);
        return $data;
    } elseif (isset($_GET['cat'])) {
        $cat = $_GET['cat'];
        // Anpassung an die neue Tabelle `produkt` und die Spalte `kategorie`
        $query = "SELECT * FROM produkt WHERE kategorie='$cat' ORDER BY RAND()";
        $data = query($query);
        return $data;
    }
}

function all_products() {
    // Anpassung an die neue Tabelle `produkt`
    $query = "SELECT * FROM produkt GROUP BY titel, marke, kategorie, details, preis, verwaltung_id ORDER BY RAND()";
    $data = query($query);
    return $data;
}

function total_price($data) {
    $sum = 0;
    $num = sizeof($data);
    for ($i = 0; $i < $num; $i++) {
        // Anpassung an die neue Tabelle `produkt` und die Spalte `preis`
        $sum += ($data[$i]['preis'] * $_SESSION['cart'][$i]['quantity']);
    }
    return $sum;
}

function get_item() {
    if (isset($_GET['product_id'])) {
        $_SESSION['product_id'] = $_GET['product_id'];
        $id = $_GET['product_id'];
        // Anpassung an die neue Tabelle `produkt`
        $query = "SELECT * FROM produkt WHERE produkt_id='$id'";
        $data = query($query);
        return $data;
    }
}

function get_user($id) {
    // Anpassung an die neue Tabelle `benutzer` und ihre Spaltennamen
    $query = "SELECT benutzer_id, vorname, nachname, email, adresse FROM benutzer WHERE benutzer_id=$id";
    $data = query($query);
    return $data;
}

function add_cart($produkt_id) {
    $benutzer_id = $_SESSION['user_id'];
    $quantity = $_POST['quantity'];
    $pharmacy_id = $_POST['pharmacy'];
    if (empty($benutzer_id)) {
        get_redirect("login.php");
    } else {
        if (isset($_POST['cart'])) {
            if (empty($pharmacy_id)) {
                get_redirect("product.php?product_id=" . $produkt_id);
            }
            if (isset($_SESSION['cart'])) {
                $num = sizeof($_SESSION['cart']);
                $_SESSION['cart'][$num]['user_id'] = $benutzer_id;
                $_SESSION['cart'][$num]['product_id'] = $produkt_id;
                $_SESSION['cart'][$num]['quantity'] = $quantity;
                get_redirect("product.php?product_id=" . $produkt_id);
            } else {
                $_SESSION['cart'][0]['user_id'] = $benutzer_id;
                $_SESSION['cart'][0]['product_id'] = $produkt_id;
                $_SESSION['cart'][0]['quantity'] = $quantity;
                get_redirect("product.php?product_id=" . $produkt_id);
            }
        } elseif (isset($_POST['buy'])) {
            if (empty($pharmacy_id)) {
                get_redirect("product.php?product_id=" . $produkt_id);
            }
            if (isset($_SESSION['cart'])) {
                $num = sizeof($_SESSION['cart']);
                $_SESSION['cart'][$num]['user_id'] = $benutzer_id;
                $_SESSION['cart'][$num]['product_id'] = $produkt_id;
                $_SESSION['cart'][$num]['quantity'] = $quantity;
                get_redirect("cart.php");
            } else {
                $_SESSION['cart'][0]['user_id'] = $benutzer_id;
                $_SESSION['cart'][0]['product_id'] = $produkt_id;
                $_SESSION['cart'][0]['quantity'] = $quantity;
                get_redirect("cart.php");
            }
        }
    }
}

function get_cart() {
    $num = sizeof($_SESSION['cart']);
    if ($num > 0) {
        for ($i = 0; $i < $num; $i++) {
            // Anpassung der Variablennamen und der Datenbanktabelle
            $product_id = $_SESSION['cart'][$i]['product_id'];
            $query = "SELECT produkt_id, bild, titel, menge, preis, marke FROM produkt WHERE produkt_id='$product_id'";
            $data[$i] = query($query);
        }
        return $data;
    }
}

function get_pharmacies_for_product($produkt_titel) {
    global $connection;
    $query = "SELECT titel, verwaltung_id, menge, produkt_id
              FROM produkt
              WHERE titel='$produkt_titel'";
    $data = query($query);
    
    foreach ($data as $item) {
        $verwaltung_id = $item['verwaltung_id'];
        $query = "SELECT name, adresse, link FROM verwaltung WHERE verwaltung_id='$verwaltung_id'";
        $result = query($query);
        if (!empty($result)) {
            $pharmacy_info = [
                "name" => $result[0]['name'],
                "adresse" => $result[0]['adresse'],
                "link" => $result[0]['link'],
                "menge" => $item['menge'],
                "produkt" => $item['produkt_id']
            ];
            $pharmacies[] = $pharmacy_info;
        }
    }

    return $pharmacies;
}

function delete_from_cart() {
    if (isset($_GET['delete'])) {
        $produkt_id = $_GET['delete'];
        $num = sizeof($_SESSION['cart']);
        for ($i = 0; $i < $num; $i++) {
            if ($_SESSION['cart'][$i]['product_id'] == $produkt_id) {
                unset($_SESSION['cart'][$i]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                break;
            }
        }
        get_redirect("cart.php");
    } elseif (isset($_GET['delete_all'])) {
        unset($_SESSION['cart']);
        get_redirect("cart.php");
    }
}

function add_order() {
    if (isset($_GET['order'])) {
        $num = sizeof($_SESSION['cart']);
        date_default_timezone_set("Europe/Berlin");
        $date = date("Y-m-d");
        for ($i = 0; $i < $num; $i++) {
            $produkt_id = $_SESSION['cart'][$i]['product_id'];
            $benutzer_id = $_SESSION['cart'][$i]['user_id'];
            $quantity = $_SESSION['cart'][$i]['quantity'];
            print_r($produkt_id);
            print_r($quantity);
            if ($quantity == 0) {
                continue;
            } else {
                $query = "INSERT INTO bestellungen (benutzer_id, produkt_id, menge, bestelldatum) VALUES('$benutzer_id', '$produkt_id', '$quantity', '$date')";
                single_query($query);
                $item = get_item_id($produkt_id);
                $new_quantity = $item[0]['menge'] - $quantity;
                $query = "UPDATE produkt SET menge='$new_quantity' WHERE produkt_id = '$produkt_id'";
                single_query($query);
            }
        }
        unset($_SESSION['cart']);
        get_redirect("final.php");
    }
}

function check_user($id) {
    $query = "SELECT benutzer_id FROM benutzer WHERE benutzer_id='$id'";
    $row = query($query);
    return !empty($row);
}

function get_item_id($id) {
    $query = "SELECT * FROM produkt WHERE produkt_id= '$id'";
    $data = query($query);
    return $data;
}
