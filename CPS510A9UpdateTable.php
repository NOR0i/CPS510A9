<html>
<title>
    CPS510: A9
</title>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Instrument+Serif&family=Jomolhari&family=Outfit&display=swap');

    ::-webkit-scrollbar {
        display: none;
    }

    header {
        font-size: 4vw;
        font-family: "Outfit";
    }


    div {
        background-color: rgb(41, 41, 41);
        font-size: 0.3vw;
        box-shadow: 0vw 0vw 0.2vw;
        margin-top: 2vw;
        margin-bottom: 2vw;
        width: 90%;
    }

    p {
        font-family: "Outfit";
        text-shadow: none;
        font-size: 2vw;
        text-shadow: 0vw 0vw 0.1vw;
    }

    table {
        font-family: 'Outfit';
    }

    td, th {
        font-family: "Outfit";
        padding: 4px;

    }
</style>

<body>

<?php
        //Create the connection to the Database with credentials
        $host = "localhost";
        $database = "s43ma";
        $user = "s43ma";
        $password = "Sm1053812!omu";
        //Open the sql connection
        $connect = oci_connect(
            $user,
            $password,
            '(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(Host=oracle.scs.ryerson.ca)(Port=1521))(CONNECT_DATA=(SID=orcl)))'
        );

        //If connection fails, display UI which prints the error
        if (!$connect) {
            $errorMsg = oci_error()['message'];
            print <<<HTMLCODE
<header>
CONNECTION FAILED
</header>
<div>a</div>
<section>
</section>
<p>
$errorMsg
</p>
</section>
</body>
</html>
HTMLCODE;
            return;
        }
?>

    <section>
        <?php 
        //Function for printing the records
        function printTable($connect, $sql)
        {
            //Run the sql command
            $stid = oci_parse($connect, $sql);
            oci_execute($stid);
            echo "<table border='1'>\n";
            //Get the number of columns
            $columnsCount = oci_num_fields($stid);
            echo "<tr>";

            //For each column, print the headers
            for ($i = 1; $i <= $columnsCount; $i++) {
                $colname = oci_field_name($stid, $i);
                echo "  <th><b>" . htmlspecialchars($colname, ENT_QUOTES | ENT_SUBSTITUTE) . "</b></th>";
            }
            echo "</tr>";

            //Get the rows
            while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
                echo "<tr>";

                //Print the attribute for each row
                foreach ($row as $columnName => $columnValue) {
                    //Print one data column
                    echo "<td>" . $columnValue . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>\n";

            oci_free_statement($stid);
        }

           //Get the selected table and search parameter
   $table = $_GET["table"];
   $accountTableMethod = $_GET["accountTableMethod"];
   $selectedTable = "";

   if ($table != "") {
       $selectedTable = substr($table, 7);
   }

    function UpdateTable($connect, $sql) {
        if ($sql == "") {
            return;
        }
        $stid = oci_parse($connect, $sql);
        $res = oci_execute($stid);

        if ($res) {
            print("<p>Successfully updated table</p>");
            } else {
            $errorMsg = oci_error($stid)['message'];
            print("<p>Failed to update table <br>SQL Command: $sql<br>Error: $errorMsg</p>");
            }
    }

    $sql = "";

    if ($selectedTable == "Account") {
        $accountTableEmail = $_GET["accountTableEmail"];
        $accountId = $_GET["accountTableID"];
        switch ($accountTableMethod) {
            case 'update':
                $sql = "UPDATE $selectedTable SET email = '$accountTableEmail' WHERE account_id = $accountId";
                break;
            case 'add':
                $sql = " INSERT INTO account VALUES ($accountId, '$accountTableEmail')";
                break;
            case 'delete':
                $sql = "DELETE FROM $selectedTable WHERE account_id = $accountId";
                break;
            default:
            $sql = "";
        }
    } elseif ($selectedTable == "AccountInfo") {
        $accountId = $_GET["accountTableID"];
        $accountType = $_GET["accountType"];
       $password = $_GET["password"];
       $firstName = $_GET["firstName"];
       $lastName = $_GET["lastName"];
       $address = $_GET["address"];
       $phoneNumber = $_GET["phoneNumber"];
        switch ($accountTableMethod) {
            case 'update':
                $sql = "UPDATE $selectedTable 
                SET 
                account_type = '$accountType', 
                password = '$password', 
                first_name = '$firstName', 
                last_name = '$lastName', 
                phone_number = '$phoneNumber', 
                address = '$address'
                WHERE account_id = $accountId";
                break;
            case 'add':
                $sql = "INSERT INTO $selectedTable VALUES ($accountId, '$accountType','$password','$firstName', '$lastName', '$phoneNumber','$address')";
                break;
            case 'delete':
                $sql = "DELETE FROM $selectedTable WHERE account_id = $accountId";
                break;
            default:
            $sql = "";
        }
    }

    UpdateTable($connect, $sql);

    function printRecords($connect, $tableName) {
            //Print all the records in the Database
            $sql = "SELECT * FROM $tableName";
            print("<div>a</div><section><p>$tableName</p>");
            printTable($connect, $sql);
    }

    printRecords($connect, "Account");
?>

<section>
    <br>
    Manage Account
    <form name="accountTable">
    <select name="accountTableMethod" id="table">
                <option value="">---</option>
                <option value="add">Add</option>
                <option value="delete">Delete</option>
                <option value="update">Update</option>
            </select>
        Account ID
        <input name="accountTableID"  type="text"/>
        Email
        <input name="accountTableEmail" type="text"/>
        <input type="submit" name="table" value="Update Account" >
    </form>
</section>

<?php
printRecords($connect, "AccountInfo");
?>

<section>
    <br>
    Manage AccountInfo
    <form name="accountTable">
    <select name="accountTableMethod" id="table">
                <option value="">---</option>
                <option value="add">Add</option>
                <option value="delete">Delete</option>
                <option value="update">Update</option>
            </select>
        Account ID
        <input name="accountTableID"  type="text"/>
        Account_type
        <input name="accountType" type="text"/>
        Password
        <input name="password" type="text"/>
        First Name
        <input name="firstName" type="text"/>
        Last Name
        <input name="lastName" type="text"/>
        Address
        <input name="address" type="text"/>
        Phone Number
        <input name="phoneNumber" type="text"/>
        <input type="submit" name="table" value="Update AccountInfo" >
    </form>
</section>

<?php
printRecords($connect, "Product");
?>
<section>
    <br>
    Manage Account
    <form name="accountTable">
    <select name="accountTableMethod" id="table">
                <option value="">---</option>
                <option value="add">Add</option>
                <option value="delete">Delete</option>
                <option value="update">Update</option>
            </select>
        Product ID
        <input name="productID"  type="text"/>
        Email
        <input name="accountTableEmail" type="text"/>
        <input type="submit" name="table" value="Update Product" >
    </form>
</section>

<?php
printRecords($connect, "Movie");
?>

<?php
printRecords($connect, "Music");
?>

<?php
//close the sql connection
oci_close($connect);
?>
    </section>
</body>
</html>
