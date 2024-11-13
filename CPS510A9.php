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
</style>

<body>
    <section>
        <header style="text-align: center;">
            MUSIC AND MOVIE RENTAL DBMS
        </header>
    </section>

    <section>
        <form target="_blank" action="CPS510A9CreateTable.php" method="post">
            <input type="submit" name="createTables" value="Create Tables">
        </form>

        <form target="_blank" action="CPS510A9PopulateTable.php" method="post">
            <input type="submit" name="populateTables" value="Populate Tables">
        </form>

        <form target="_blank" action="CPS510A9DropTable.php" method="post">
            <input type="submit" name="deleteTables" value="Delete Tables">
        </form>

        <form action="" method="get">
            <input type="submit" name="queryTables" value="Query Table">
        </form>

    </section>


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

        $sql = "SELECT * FROM account";

        $stid = oci_parse($connect, $sql);
        oci_execute($stid);
        $nrows = oci_fetch_all($stid, $res);

        echo "<table border='1'>\n";
        foreach ($res as $col) {
            echo "<tr>\n";
            foreach ($col as $item) {
                echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "") . "</td>\n";
            }
            echo "</tr>\n";
        }
        echo "</table>\n";

        oci_free_statement($stid);
        oci_close($conn);

        oci_close($connect);
        ?>
    </section>
</body>


</html>