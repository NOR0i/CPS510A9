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
        $password = "mykjPExW";
        $connect = mysqli_connect($host, $user, $password, $database);

        $sql = "SELECT * FROM account; ";
        $sql .= "SELECT * FROM accountInfo;";

        // Execute multi query
        if (mysqli_multi_query($connect, $sql)) {
            do {
                print("waaaa");
                // Store first result set
                if ($result = mysqli_store_result($connect)) {
                    $fields_num = mysqli_num_fields($result);

                    print("<table border='1'><tr>");
                    // printing table headers
                    for ($i = 0; $i < $fields_num; $i++) {
                        $field = mysqli_fetch_field($result);
                        print("<td>{$field->name}</td>");
                    }
                    print("</tr>\n");
                    // printing table rows
                    while ($row = mysqli_fetch_row($result)) {
                        print("<tr>");

                        foreach ($row as $cell)
                            print("<td>$cell</td>");

                        print("</tr>\n");
                    }
                    print("</table>");

                    if (mysqli_more_results($connect)) {
                        printf("-------------\n");
                    }

                    // Free result set
                    mysqli_free_result($result);
                    print("befree");
                }
            } while (mysqli_next_result($connect));
        } else {
            $errorMsg = mysqli_error($connect);
            print($errorMsg);
        }

        mysqli_close($connect);
        ?>
    </section>
</body>


</html>