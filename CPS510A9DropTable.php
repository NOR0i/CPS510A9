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
$password = "mykjPExW";
$connect = mysqli_connect($host, $user, $password, $database);

if (!$connect) {
print <<<HTMLCODE
<header>
CONNECTION FAILED
</header>
<div>a</div>
<section>
</section>
</section>
</body>
</html>
HTMLCODE;
return;
}

$del = "DROP TABLE ACCOUNT CASCADE CONSTRAINTS;";
$del .= "DROP TABLE PRODUCT CASCADE CONSTRAINTS;";
$del .= "DROP TABLE MUSIC CASCADE CONSTRAINTS;";
$del .= "DROP TABLE MOVIE CASCADE CONSTRAINTS;";
$del .= "DROP TABLE CART_ITEM CASCADE CONSTRAINTS;";
$del .= "DROP TABLE REVIEW CASCADE CONSTRAINTS;";
$del .= "DROP TABLE CUSTOMER_ORDER CASCADE CONSTRAINTS;";
$del .= "DROP TABLE ORDER_ITEM CASCADE CONSTRAINTS;";


if (mysqli_multi_query($connect, $del)) {
print <<<HTMLCODE
<header>
SUCCESSFULLY REMOVED Tables
</header>
<div>a</div>
<section>
HTMLCODE;
} else {
$errorMsg = mysqli_error($connect);
print <<<HTMLCODE
<header>
FAILED TO REMOVE TABLES
</header>
<div>a</div>
<section>
<p>FAILED TO REMOVE: $del<br>$errorMsg</p>
HTMLCODE;
}
mysqli_close($connect);
?>
    </section>
</section>
</body>
</html>