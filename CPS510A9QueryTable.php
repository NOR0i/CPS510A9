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
        <?php
        $host = "localhost";
        $database = "s43ma";
        $user = "s43ma";
        $password = "Sm1053812!omu";
        $connect = oci_connect(
            $user,
            $password,
            '(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(Host=oracle.scs.ryerson.ca)(Port=1521))(CONNECT_DATA=(SID=orcl)))'
        );

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

        function printTable($connect, $sql)
        {
            $stid = oci_parse($connect, $sql);
            oci_execute($stid);
            echo "<table border='1'>\n";
            $columnsCount = oci_num_fields($stid);
            echo "<tr>";
            for ($i = 1; $i <= $columnsCount; $i++) {
                $colname = oci_field_name($stid, $i);
                echo "  <th><b>" . htmlspecialchars($colname, ENT_QUOTES | ENT_SUBSTITUTE) . "</b></th>";
            }
            echo "</tr>";

            while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
                echo "<tr>";

                //you can now print out all relevant columns of one line (if you know the column name) 
                //or automatically all columns you have selected
                foreach ($row as $columnName => $columnValue) {
                    //print one data column
                    echo "<td>" . $columnValue . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>\n";

            oci_free_statement($stid);
        }

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
        print("<div>a</div><section><p>ACCOUNTINFO</p>");
        printTable($connect, $sql);

        $sql = "SELECT * FROM order_item";
        print("<div>a</div><section><p>ORDER_ITEM</p>");
        printTable($connect, $sql);

        oci_close($connect);
        ?>
    </section>
</body>
</html>
