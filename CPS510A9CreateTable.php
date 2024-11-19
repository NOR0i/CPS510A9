<html>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Archivo&family=Instrument+Serif&family=Jomolhari&family=Outfit&display=swap');

    ::-webkit-scrollbar {
        display: none;
    }

    body {
        background-color: rgb(234, 234, 234);
        color: rgb(41, 41, 41);
        text-shadow: 0vw 0vw 0.2vw;
        margin: 0;
    }

    header {
        font-size: 6vw;
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
</style>

<body>
    <section style="margin: 2vw;">

        <?php
        //Create a connection
        $host = "localhost";
        $database = "s43ma";
        $user = "s43ma";
        $password = "Sm1053812!omu";
        $connect = oci_connect(
            $user,
            $password,
            '(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(Host=oracle.scs.ryerson.ca)(Port=1521))(CONNECT_DATA=(SID=orcl)))'
        );

        //If the connection fails, display error message 
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

        //Function for creating a table, it takes in the sql statement, the connection, and the name of the table (for visuals)
        function CreateTable($connect, $sql, $tableName)
        {
            $stid = oci_parse($connect, $sql);
            $res = oci_execute($stid);
            if ($res) {
print <<<HTMLCODE
<div>a</div>
<section>
<p>
SUCCESSFULLY CREATED TABLE $tableName
</p>
HTMLCODE;
            } else {
                $errorMsg = oci_error($stid)['message'];
                print <<<HTMLCODE
<div>a</div>
<section>
<p>
FAILED TO CREATE TABLE $tableName
</p>
<p>FAILED TO ADD: $sql<br>$errorMsg</p>
HTMLCODE;
            }
        }

        //Write SQL statement and create ACCOUNT table
        $sql = "CREATE TABLE account(
    account_id INT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE)";

        CreateTable($connect, $sql, 'ACCOUNT');

        //Write SQL statement and create ACCOUNTINFO table
        $sql = "CREATE TABLE accountInfo(
    account_id INT REFERENCES account(account_id),
    account_type VARCHAR2(10) DEFAULT 'CUSTOMER' NOT NULL CHECK (account_type IN ('CUSTOMER', 'MANAGER')),
    password VARCHAR2(25) NOT NULL,
    first_name VARCHAR2(25) NOT NULL,
    last_name VARCHAR2(25) NOT NULL,
    phone_number VARCHAR2(20),
    address VARCHAR2(100))";

        CreateTable($connect, $sql, 'ACCOUNTINFO');

        //Write SQL statement and create PRODUCT table
        $sql = "CREATE TABLE product(
    product_ID INT PRIMARY KEY,
    name VARCHAR2(50) NOT NULL,
    year INT NOT NULL CHECK (year > 0), 
    image VARCHAR2(25),
    price FLOAT NOT NULL,
    stock INT NOT NULL CHECK (stock > 0),
    message VARCHAR2(200))";

        CreateTable($connect, $sql, 'PRODUCT');

        //Write SQL statement and create MUSIC table
        $sql = "CREATE TABLE music(
    product_ID INT REFERENCES product(product_ID),
    artist VARCHAR2(100) NOT NULL,
    genre VARCHAR2(25) NOT NULL CHECK (genre IN ('Classical', 'Country', 'Jazz', 'Pop', 'Rock', 'Electronic', 'RnB', 'Hip-Hop', 'Folk', 'Blues', 'World', 'Metal', 'Reggae')),
    PRIMARY KEY (product_ID))";

        CreateTable($connect, $sql, 'MUSIC');

        //Write SQL statement and create MOVIE table
        $sql = "CREATE TABLE movie(
    product_ID INT REFERENCES product(product_ID),
    director VARCHAR2(100) NOT NULL,
    genre VARCHAR2(25) NOT NULL CHECK (genre IN ('Drama', 'Romance', 'Horror', 'Comedy', 'Action', 'Thriller', 'Animation', 'Sci-Fi', 'Fantasy', 'Adventure', 'Mystery', 'Documentary', 'Musical')),
    PRIMARY KEY (product_ID))";

        CreateTable($connect, $sql, 'MOVIE');

        //Write SQL statement and create CART_ITEM table
        $sql = "CREATE TABLE cart_item(
    account_ID INT REFERENCES account(account_ID),
    product_ID INT REFERENCES product(product_ID),
    quantity INT NOT NULL CHECK (quantity > 0),    
    PRIMARY KEY (account_ID, product_ID))";

        CreateTable($connect, $sql, 'CART_ITEM');

        //Write SQL statement and create REVIEW table
        $sql = "CREATE TABLE review(
    product_ID INT REFERENCES product(product_ID), 
    account_ID INT REFERENCES account(account_ID), 
    rating INT NOT NULL CHECK (rating IN (1,2,3,4,5)),
    message VARCHAR2(400))";

        CreateTable($connect, $sql, 'REVIEW');

        //Write SQL statement and create CUSTOMER_ORDER table
        $sql = "CREATE TABLE customer_order(
    order_ID INT PRIMARY KEY,
    account_ID INT REFERENCES account(account_ID), 
    order_method VARCHAR2(25) NOT NULL CHECK (order_method IN ('Pickup', 'Delivery')),
    status VARCHAR2(25) NOT NULL CHECK (status IN ('Delivering', 'Ready for Pickup', 'Preparing Order')))";

        CreateTable($connect, $sql, 'CUSTOMER_ORDER');

        //Write SQL statement and create ORDER_ITEM table
        $sql = "CREATE TABLE order_item(
    product_ID INT REFERENCES product(product_ID), 
    order_ID INT REFERENCES customer_order(order_ID),
    quantity INT CHECK (quantity > 0),
    PRIMARY KEY (order_ID, product_ID))";

        CreateTable($connect, $sql, 'ORDER_ITEM');

        //Close the connection
        oci_close($connect);
        ?>
    </section>
    </section>
</body>

</html>