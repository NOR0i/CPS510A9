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

        $del = "DROP TABLE ACCOUNT CASCADE CONSTRAINTS";



        $stid = oci_parse($connect, $del);
        $res = oci_execute($stid);


        if ($res) {
print <<<HTMLCODE
<p>
SUCCESSFULLY REMOVED Tables

        DROP TABLE PRODUCT CASCADE CONSTRAINTS;
        DROP TABLE MUSIC CASCADE CONSTRAINTS;
        DROP TABLE MOVIE CASCADE CONSTRAINTS;
        DROP TABLE CART_ITEM CASCADE CONSTRAINTS;
        DROP TABLE REVIEW CASCADE CONSTRAINTS;
        DROP TABLE CUSTOMER_ORDER CASCADE CONSTRAINTS;
        DROP TABLE ORDER_ITEM CASCADE CONSTRAINTS;
</p>
<div>a</div>
<section>
HTMLCODE;
        } else {
$errorMsg = oci_error($stid)['message'];
print <<<HTMLCODE
<header>
FAILED TO REMOVE TABLES
</header>
<div>a</div>
<section>
<p>FAILED TO REMOVE: $del<br>$errorMsg</p>
HTMLCODE;
}

        oci_close($connect);
        ?>
    </section>
    </section>
</body>

</html>