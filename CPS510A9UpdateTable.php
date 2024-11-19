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

    td,
    th {
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

        //Get the table selected
        if ($table != "") {
            $selectedTable = substr($table, 7);
        }

        //Runs the SQL statement to update, add, or delete a table
        function UpdateTable($connect, $sql)
        {
            //Do nothing if the user chose nothing
            if ($sql == "") {
                return;
            }

            //Execute the statement
            $stid = oci_parse($connect, $sql);
            $res = oci_execute($stid);

            //Print success message or error
            if ($res) {
                print("<p>Successfully updated table</p>");
            } else {
                $errorMsg = oci_error($stid)['message'];
                print("<p>Failed to update table <br>SQL Command: $sql<br>Error: $errorMsg</p>");
            }
        }

        //Returns the SQL statement based on the method the user chooses on a table
        function getSQLStatement($update, $add, $delete)
        {
            $accountTableMethod = $_GET["accountTableMethod"];
            switch ($accountTableMethod) {
                case 'update':
                    $sql = $update;
                    break;
                case 'add':
                    $sql = $add;
                    break;
                case 'delete':
                    $sql = $delete;
                    break;
                default:
                    $sql = "";
            }
            return $sql;
        }

        //Init sql statement
        $sql = "";

        //Handle SQL statements different depending on the table that was selected
        if ($selectedTable == "Account") {
            $accountTableEmail = $_GET["accountTableEmail"];
            $accountId = $_GET["accountTableID"];
            $update = "UPDATE $selectedTable SET email = '$accountTableEmail' WHERE account_id = $accountId";
            $add = "INSERT INTO account VALUES ($accountId, '$accountTableEmail')";
            $delete = "DELETE FROM $selectedTable WHERE account_id = $accountId";

            $sql = getSQLStatement($update, $add, $delete);
        } elseif ($selectedTable == "AccountInfo") {
            $accountId = $_GET["accountTableID"];
            $accountType = $_GET["accountType"];
            $password = $_GET["password"];
            $firstName = $_GET["firstName"];
            $lastName = $_GET["lastName"];
            $address = $_GET["address"];
            $phoneNumber = $_GET["phoneNumber"];

            $update = "UPDATE $selectedTable 
        SET 
        account_type = '$accountType', 
        password = '$password', 
        first_name = '$firstName', 
        last_name = '$lastName', 
        phone_number = '$phoneNumber', 
        address = '$address'
        WHERE account_id = $accountId";
            $add = "INSERT INTO $selectedTable VALUES ($accountId, '$accountType','$password','$firstName', '$lastName', '$phoneNumber','$address')";
            $delete = "DELETE FROM $selectedTable WHERE account_id = $accountId";

            $sql = getSQLStatement($update, $add, $delete);
        } elseif ($selectedTable == "Product") {
            $productID = $_GET["productID"];
            $name = $_GET["name"];
            $year = $_GET["year"];
            $image = $_GET["image"];
            $price = $_GET["price"];
            $stock = $_GET["stock"];
            $message = $_GET["message"];

            $update = "UPDATE $selectedTable 
        SET 
        name = '$name', 
        year = $year, 
        image = '$image', 
        price = $price, 
        stock = $stock,
        message = '$message'
        WHERE product_id = $productID";
            $add = "INSERT INTO $selectedTable VALUES ($productID, '$name',$year,'$image', $price, $stock,'$message')";
            $delete = "DELETE FROM $selectedTable WHERE product_id = $productID";

            $sql = getSQLStatement($update, $add, $delete);
        } elseif ($selectedTable == "Movie") {
            $product_id = $_GET["product_id"];
            $Director = $_GET["Director"];
            $Genre = $_GET["Genre"];

            $update = "UPDATE $selectedTable 
        SET 
        Director = '$Director', 
        Genre = '$Genre'
        WHERE product_id = $product_id";
            $add = "INSERT INTO $selectedTable VALUES ($product_id, '$Director','$Genre')";
            $delete = "DELETE FROM $selectedTable WHERE product_id = $product_id";

            $sql = getSQLStatement($update, $add, $delete);
        } elseif ($selectedTable == "Music") {
            $productID = $_GET["productID"];
            $Artist = $_GET["Artist"];
            $Genre = $_GET["Genre"];

            $update = "UPDATE $selectedTable 
        SET 
        Artist = '$Artist', 
        Genre = '$Genre'
        WHERE product_id = $productID";
            $add = "INSERT INTO $selectedTable VALUES ($productID, '$Artist','$Genre')";
            $delete = "DELETE FROM $selectedTable WHERE product_id = $productID";

            $sql = getSQLStatement($update, $add, $delete);
        } elseif ($selectedTable == "Review") {
            $product_id = $_GET['product_id'];
            $account_id = $_GET['account_id'];
            $Rating = $_GET['Rating'];
            $Message = $_GET['Message'];

            $update = "UPDATE $selectedTable 
        SET 
        Rating = $Rating, 
        Message = '$Message'
        WHERE product_id = $product_id AND account_id = $account_id";
            $add = "INSERT INTO $selectedTable VALUES ($product_id, $account_id, $Rating,'$Message')";
            $delete = "DELETE FROM $selectedTable WHERE product_id = $product_id AND account_id = $account_id";

            $sql = getSQLStatement($update, $add, $delete);
        } elseif ($selectedTable == "Cart_Item") {
            $product_id = $_GET['product_id'];
            $account_id = $_GET['account_id'];
            $Quantity = $_GET['Quantity'];

            $update = "UPDATE $selectedTable SET Quantity = '$Quantity'
        WHERE product_id = $product_id AND account_id = $account_id";
            $add = "INSERT INTO $selectedTable VALUES ($product_id, $account_id, $Quantity)";
            $delete = "DELETE FROM $selectedTable WHERE product_id = $product_id AND account_id = $account_id";

            $sql = getSQLStatement($update, $add, $delete);
        } elseif ($selectedTable == "Customer_Order") {
            $order_id = $_GET['order_id'];
            $account_id = $_GET['account_id'];
            $Order_Method = $_GET['Order_Method'];
            $Status = $_GET['Status'];

            $update = "UPDATE $selectedTable SET account_id = $account_id, Order_Method = '$Order_Method', Status = '$Status' WHERE order_id = $order_id";
            $add = "INSERT INTO $selectedTable VALUES ($order_id, $account_id, '$Order_Method','$Status')";
            $delete = "DELETE FROM $selectedTable WHERE order_id = $order_id";

            $sql = getSQLStatement($update, $add, $delete);
        } elseif ($selectedTable == "Order_Item") {
            $product_id = $_GET['product_id'];
            $order_id = $_GET['order_id'];
            $Quantity = $_GET['Quantity'];

            $update = "UPDATE $selectedTable SET Quantity = '$Quantity'
        WHERE product_id = $product_id AND order_id = $order_id";
            $add = "INSERT INTO $selectedTable VALUES ($product_id, $order_id, $Quantity)";
            $delete = "DELETE FROM $selectedTable WHERE product_id = $product_id AND order_id = $order_id";

            $sql = getSQLStatement($update, $add, $delete);
        }

        //From the previous if condition, run the selected SQL statement
        UpdateTable($connect, $sql);

        //A function that prints all the records in the specified table
        function printRecords($connect, $tableName)
        {   
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
                <input name="accountTableID" type="text" />
                Email
                <input name="accountTableEmail" type="text" />
                <input type="submit" name="table" value="Update Account">
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
                <input name="accountTableID" type="text" />
                Account_type
                <input name="accountType" type="text" />
                Password
                <input name="password" type="text" />
                First Name
                <input name="firstName" type="text" />
                Last Name
                <input name="lastName" type="text" />
                Address
                <input name="address" type="text" />
                Phone Number
                <input name="phoneNumber" type="text" />
                <input type="submit" name="table" value="Update AccountInfo">
            </form>
        </section>

        <?php
        printRecords($connect, "Product");
        ?>
        <section>
            <br>
            Manage Product
            <form name="accountTable">
                <select name="accountTableMethod" id="table">
                    <option value="">---</option>
                    <option value="add">Add</option>
                    <option value="delete">Delete</option>
                    <option value="update">Update</option>
                </select>
                Product ID
                <input name="productID" type="text" />
                Name
                <input name="name" type="text" />
                Year
                <input name="year" type="text" />
                Image
                <input name="image" type="text" />
                Price
                <input name="price" type="text" />
                Stock
                <input name="stock" type="text" />
                Message
                <input name="message" type="text" />
                <input type="submit" name="table" value="Update Product">
            </form>
        </section>

        <?php
        printRecords($connect, "Movie");
        ?>

        <section>
            <br>
            Manage Movie
            <form name="accountTable">
                <select name="accountTableMethod" id="table">
                    <option value="">---</option>
                    <option value="add">Add</option>
                    <option value="delete">Delete</option>
                    <option value="update">Update</option>
                </select>
                Product ID
                <input name="product_id" type="text" />
                Director
                <input name="Director" type="text" />
                Genre
                <input name="Genre" type="text" />
                <input type="submit" name="table" value="Update Movie">
            </form>
        </section>

        <?php
        printRecords($connect, "Music");
        ?>
        <section>
            <br>
            Manage Music
            <form name="accountTable">
                <select name="accountTableMethod" id="table">
                    <option value="">---</option>
                    <option value="add">Add</option>
                    <option value="delete">Delete</option>
                    <option value="update">Update</option>
                </select>
                Product ID
                <input name="productID" type="text" />
                Artist
                <input name="Artist" type="text" />
                Genre
                <input name="Genre" type="text" />
                <input type="submit" name="table" value="Update Music">
            </form>
        </section>


        <?php
        printRecords($connect, "Review");
        ?>

        <section>
            <br>
            Manage Review
            <form name="accountTable">
                <select name="accountTableMethod" id="table">
                    <option value="">---</option>
                    <option value="add">Add</option>
                    <option value="delete">Delete</option>
                    <option value="update">Update</option>
                </select>
                Product ID
                <input name="product_id" type="text" />
                Account ID
                <input name="account_id" type="text" />
                Rating
                <input name="Rating" type="text" />
                Message
                <input name="Message" type="text" />
                <input type="submit" name="table" value="Update Review">
            </form>
        </section>

        <?php
        printRecords($connect, "Cart_Item");
        ?>
        <section>
            <br>
            Manage Cart_Item
            <form name="accountTable">
                <select name="accountTableMethod" id="table">
                    <option value="">---</option>
                    <option value="add">Add</option>
                    <option value="delete">Delete</option>
                    <option value="update">Update</option>
                </select>
                Product ID
                <input name="product_id" type="text" />
                Account ID
                <input name="account_id" type="text" />
                Quantity
                <input name="Quantity" type="text" />
                <input type="submit" name="table" value="Update Cart_Item">
            </form>
        </section>

        <?php
        printRecords($connect, "Customer_Order");
        ?>
        <section>
            <br>
            Manage Customer_Order
            <form name="accountTable">
                <select name="accountTableMethod" id="table">
                    <option value="">---</option>
                    <option value="add">Add</option>
                    <option value="delete">Delete</option>
                    <option value="update">Update</option>
                </select>
                Order ID
                <input name="order_id" type="text" />
                Account ID
                <input name="account_id" type="text" />
                Order_Method
                <input name="Order_Method" type="text" />
                Status
                <input name="Status" type="text" />
                <input type="submit" name="table" value="Update Customer_Order">
            </form>
        </section>

        <?php
        printRecords($connect, "Order_Item");
        ?>
        <section>
            <br>
            Manage Order_Item
            <form name="accountTable">
                <select name="accountTableMethod" id="table">
                    <option value="">---</option>
                    <option value="add">Add</option>
                    <option value="delete">Delete</option>
                    <option value="update">Update</option>
                </select>
                Product ID
                <input name="product_id" type="text" />
                Order ID
                <input name="order_id" type="text" />
                Quantity
                <input name="Quantity" type="text" />
                <input type="submit" name="table" value="Update Order_Item">
            </form>
        </section>

        <?php
        //close the sql connection
        oci_close($connect);
        ?>
    </section>
</body>

</html>