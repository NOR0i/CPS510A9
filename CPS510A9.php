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

    input {
        font-family: "Outfit";
        background-color: white;
        border-style: none;
        font-size: 1vw;
        padding: 15px;
        border: solid 4px black;
        border-radius: 15px;
        transition: color ease-in 0.2s, border-color ease-in 0.2s;
    }

    input:hover{
        border-color: grey;
        color: grey;
    }

    .buttons {
        display:flex;
        align-items: center;
        justify-content: center;    
        column-gap: 1.5vw;    
        margin-top: 2vw;
    }
</style>

<body>
    <section>
        <header style="text-align: center;">
            MUSIC AND MOVIE RENTAL DBMS
        </header>
    </section>

    <section class="buttons">
        <form target="_blank" action="CPS510A9CreateTable.php" method="post">
            <input type="submit" name="createTables" value="Create Tables">
        </form>

        <form target="_blank" action="CPS510A9PopulateTable.php" method="post">
            <input type="submit" name="populateTables" value="Populate Tables">
        </form>

        <form target="_blank" action="CPS510A9DropTable.php" method="post">
            <input type="submit" name="deleteTables" value="Delete Tables">
        </form>

        <form target="_blank" action="CPS510A9QueryTable.php" method="get">
            <input type="submit" name="queryTables" value="Query Table">
        </form>

        <form target="_blank" action="CPS510A9UpdateTable.php" method="get">
            <input type="submit" name="updateTables" value="Manage Table">
        </form>

    </section>
</body>


</html>