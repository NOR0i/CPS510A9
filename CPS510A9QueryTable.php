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

    <section>
        Query Search
        <form>
            <select name="table" id="table">
                <option value="">Query All Tables</option>
                <option value="Account">Account</option>
                <option value="Product">Products</option>
                <option value="Review">Reviews</option>
                <option value="Customer_Order">Orders</option>
            </select>
            <input name="search" type="search" value="">
            <input type="submit">
        </form>
    </section>

    <section>
        Update Value
        <form>
            <select name="updateTable" id="updateTable">
                <option value="Account">Account</option>
                <option value="AccountInfo">AccountInfo</option>
                <option value="Music">Music</option>
                <option value="Music">Movie</option>
                <option value="Review">Review</option>
                <option value="Customer_Order">Customer_Order</option>
                <option value="order_item">Order_item</option>
            </select>
            <input name="search" type="search" value="">
            <input type="submit">
        </form>
    </section>

    <section>
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
        $search = $_GET["search"];

        
        if ($table == "") {
            //Print all the records in the Database
            $sql = "SELECT * FROM account";
            print("<div>a</div><section><p>ACCOUNT</p>");
            printTable($connect, $sql);

            $sql = "SELECT * FROM accountInfo";
            print("<div>a</div><section><p>ACCOUNTINFO</p>");
            printTable($connect, $sql);

            $sql = "SELECT * FROM product";
            print("<div>a</div><section><p>PRODUCT</p>");
            printTable($connect, $sql);

            $sql = "SELECT * FROM music";
            print("<div>a</div><section><p>MUSIC</p>");
            printTable($connect, $sql);

            $sql = "SELECT * FROM movie";
            print("<div>a</div><section><p>MOVIE</p>");
            printTable($connect, $sql);

            $sql = "SELECT * FROM review";
            print("<div>a</div><section><p>REVIEW</p>");
            printTable($connect, $sql);

            $sql = "SELECT * FROM cart_item";
            print("<div>a</div><section><p>CART_ITEM</p>");
            printTable($connect, $sql);

            $sql = "SELECT * FROM customer_order";
            print("<div>a</div><section><p>CUSTOMER_ORDER</p>");
            printTable($connect, $sql);

            $sql = "SELECT * FROM order_item";
            print("<div>a</div><section><p>ORDER_ITEM</p>");
            printTable($connect, $sql);

        } elseif ($table == "Account") {
            //Print all the Accounts in the Database
            //Or find an Account based on the specified account_id
            if ($search == "") {
                $sql = "SELECT account.account_id, account.email, accountinfo.account_type, accountInfo.first_name, accountInfo.last_name, accountInfo.phone_number, accountInfo.address
                FROM account INNER JOIN accountinfo ON account.ACCOUNT_ID=accountinfo.ACCOUNT_ID";
            } else {
                $sql = "SELECT account.account_id, account.email, accountinfo.account_type, accountInfo.first_name, accountInfo.last_name, accountInfo.phone_number, accountInfo.address
                FROM account INNER JOIN accountinfo ON account.ACCOUNT_ID=accountinfo.ACCOUNT_ID WHERE account.account_id = " . $search;                
            }
            
            print("<div>a</div><section><p>ACCOUNT & ACCOUNT INFO</p>");
            printTable($connect, $sql);

        } elseif ($table == "Product") {
            //Print all the music products in the Database
            //Or find an music product based on the specified product name
            if ($search == "") {
                $sql = "SELECT product.product_id, product.name, music.artist, product.message, product.year, music.genre, product.price, product.stock
                FROM product INNER JOIN music ON product.product_id = music.product_id";
            } else {
                $sql = "SELECT product.product_id, product.name, music.artist, product.message, product.year, music.genre, product.price, product.stock
                FROM product INNER JOIN music ON product.product_id = music.product_id WHERE product.name LIKE '" . $search . "%'";                  
            }
            
            print("<div>a</div><section><p>MUSIC PRODUCTS</p>");
            printTable($connect, $sql);

            //Print all the music products in the Database
            //Or find an movie product based on the specified product name
            if ($search == "") {
                $sql = "SELECT product.product_id, product.name, movie.director, product.message, product.year, movie.genre, product.price, product.stock
                FROM product INNER JOIN movie ON product.product_id = movie.product_id";
            } else {
                $sql = "SELECT product.product_id, product.name, movie.director, product.message, product.year, movie.genre, product.price, product.stock
                FROM product INNER JOIN movie ON product.product_id = movie.product_id WHERE product.name LIKE '" . $search . "%'";                  
            }

            print("<div>a</div><section><p>MOVIE PRODUCTS</p>");
            printTable($connect, $sql);

        } elseif ($table == "Review") {
            //Print all the reviews in the Database with the product name
            //Or find a review based on the specified product name
            if ($search == "") {
                $sql = "SELECT product.product_id, product.name, review.account_id, review.rating, review.message
                FROM product INNER JOIN review ON product.product_id = review.product_id";
            } else {
                $sql = "SELECT product.product_id, product.name, review.account_id, review.rating, review.message
                FROM product INNER JOIN review ON product.product_id = review.product_id WHERE product.name LIKE '" . $search . "%'";
            }
            
            print("<div>a</div><section><p>REVIEWED PRODUCTS</p>");
            printTable($connect, $sql);

        } elseif ($table == "Customer_Order") {
            //Print all the customer orders with their order items in the database
            //Or find a customer order based on the specified order_id
            if ($search == "") {
                $sql = "SELECT customer_order.order_id, customer_order.account_id, customer_order.order_method, customer_order.status, order_item.product_id, order_item.quantity
                FROM customer_order INNER JOIN order_item ON customer_order.order_id = order_item.order_id ORDER BY customer_order.order_id ASC";
            } else {
                $sql = "SELECT customer_order.order_id, customer_order.account_id, customer_order.order_method, customer_order.status, order_item.product_id, order_item.quantity
                FROM customer_order INNER JOIN order_item ON customer_order.order_id = order_item.order_id WHERE customer_order.order_id LIKE '" . $search . "%' ORDER BY customer_order.order_id ASC";
            }
            
            print("<div>a</div><section><p>ORDERS</p>");
            printTable($connect, $sql);
        }

        //close the sql connection
        oci_close($connect);
        ?>
    </section>
</body>
</html>
