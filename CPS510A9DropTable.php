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

        //Function for dropping a table, takes in the connection, the sql statement and the table name (for visuals)
        function DropTable($connect, $del, $tableName)
        {

            //Parse the sql statement and execute
            $stid = oci_parse($connect, $del);
            $res = oci_execute($stid);

            //If success, print success message, otherwise print error message
            if ($res) {
print <<<HTMLCODE
<div>a</div>
<section>
<p>
SUCCESSFULLY REMOVED ACCOUNT
</p>
HTMLCODE;
            } else {
                $errorMsg = oci_error($stid)['message'];
print <<<HTMLCODE
<div>a</div>
<section>
<p>
FAILED TO REMOVE ACCOUNT
</p>
<p>FAILED TO REMOVE: $del<br>$errorMsg</p>
HTMLCODE;
            }
        }

        //Dropping tables are all the same so we can iterate through the same statement, only changing the table name
        $tables = array('ACCOUNT', 'ACCOUNTINFO', 'PRODUCT', 'MUSIC', 'MOVIE', 'CART_ITEM', 'REVIEW', 'CUSTOMER_ORDER', 'ORDER_ITEM');
        foreach ($tables as $tableName) {
            $del = "DROP TABLE $tableName CASCADE CONSTRAINTS";
            DropTable($connect, $del, $tableName);
        }


        //Close the connection
        oci_close($connect);
        ?>
    </section>
    </section>
</body>

</html>