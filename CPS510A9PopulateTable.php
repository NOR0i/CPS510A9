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
$connect = oci_connect($user, $password,
'(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(Host=oracle.scs.ryerson.ca)(Port=1521))(CONNECT_DATA=(SID=orcl)))');

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
$info = "BEGIN
 INSERT INTO account VALUES (1, 'john.doe@torontomu.ca');   
 INSERT INTO account VALUES (2, 'store.manager@gmail.com');   
 INSERT INTO account VALUES (3, 'lieu.pwa@torontomu.ca');  
 INSERT INTO account VALUES (4, 'samba.jn@torontomu.ca');  
 INSERT INTO account VALUES (5, 'slavabyrlev@gesthedu.com');  
 INSERT INTO account VALUES (6, 'iceburg561@googl.win');  
 INSERT INTO account VALUES (7, 'edupost@gmail.com');  
 INSERT INTO account VALUES (8, 'roin.jkd@torontomu.ca');  
 INSERT INTO account VALUES (9, 'sarah.rsd@torontomu.ca');  
 INSERT INTO account VALUES (10, 'rlhubbl@nicnic.pro');   

 INSERT INTO accountInfo VALUES (1, 'CUSTOMER','abc123','John', 'Doe', '555-555-5553','55 Hope Street');  
 INSERT INTO accountInfo VALUES (2, 'MANAGER','123Owner','Jane', 'Doe', '111-123-1111','32 House Apt');  
 INSERT INTO accountInfo VALUES (3, 'CUSTOMER','neighbour232','Lieu', 'Ben', '555-923-5545','49 Pond Street');  
 INSERT INTO accountInfo VALUES (4, 'CUSTOMER','cardinal555','Samba', 'Jean', '491-923-5545','37 Lodge Street');  
 INSERT INTO accountInfo VALUES (5, 'CUSTOMER','geklkdh12','Reenie', 'Dip', '484-736-0247','21 Plane Drive');  
 INSERT INTO accountInfo VALUES (6, 'CUSTOMER','123457923s','George', 'Greep', '477-326-1710','11 Jane Apt');  
 INSERT INTO accountInfo VALUES (7, 'MANAGER','aaabbbccc','Dean', 'Blunt', '930-350-1642','34 Dundas West');  
 INSERT INTO accountInfo VALUES (8, 'CUSTOMER','robin23','Noah', 'Lennox', '491-283-2344','4 Edgar Drive');  
 INSERT INTO accountInfo VALUES (9, 'CUSTOMER','cat3444','Sarah', 'Mili', '809-659-5135','10 Eldway Drive');  
 INSERT INTO accountInfo VALUES (10, 'CUSTOMER','934829dog','Derek', 'White', '898-338-5439','51 West Ave');  

 INSERT INTO product VALUES (2, 'Nemo', 2003, 'Nemo.png', 10.75, 80, 'An animated classic.');  
 INSERT INTO product VALUES (1, 'The Shining', 2001, 'TS.png', 20.50, 70, 'A horror movie by Kubrick.');  
 INSERT INTO product VALUES (3, 'Fight Club', 1999, 'FC.png', 6.99, 5, 'A 1999 action film.');  
 INSERT INTO product VALUES (4, 'Fallen Angels', 1995, 'FA.png', 8.75, 9, '');  
 INSERT INTO product VALUES (5, 'No Country for Old Men', 2007, 'NCFOM.png', 15.50, 32, 'A drama film.');  
 INSERT INTO product VALUES (6, '2001: A Space Odyssey', 1968, '2001.png', 14.75, 16, 'A Sci-Fi film');  
 INSERT INTO product VALUES (7, 'The Notebook', 2004, 'TNBK.png', 4.50, 22, 'A romance film.');  
 INSERT INTO product VALUES (8, 'The Hangover', 2009, 'THO.png', 8.75, 41, 'A comedy film.');  
 INSERT INTO product VALUES (9, 'Dead Poets Society', 1989, 'DPS.png', 11.50, 27, 'A drama film');  
 INSERT INTO product VALUES (10, 'Psycho', 1960, 'PSYH.png', 12.75, 64, 'A horror film.');  

 INSERT INTO movie VALUES (1, 'Stanley Kubrick', 'Horror');  
 INSERT INTO movie VALUES (2, 'David Fincher', 'Animation');  
 INSERT INTO movie VALUES (3, 'Stanley Kubrick', 'Action');  
 INSERT INTO movie VALUES (4, 'Wong Kar-wai', 'Drama');  
 INSERT INTO movie VALUES (5, 'Ethan Coen', 'Drama');  
 INSERT INTO movie VALUES (6, 'Stanley Kubrick', 'Sci-Fi');  
 INSERT INTO movie VALUES (7, 'Nick Cassavetes', 'Romance');  
 INSERT INTO movie VALUES (8, 'Todd Phillips', 'Comedy');  
 INSERT INTO movie VALUES (9, 'Peter Weir', 'Drama');  
 INSERT INTO movie VALUES (10, 'Alfred Hitchcock', 'Horror');  

 INSERT INTO product VALUES (11, 'Sung Tongs', 2004, 'SnTng.png', 10.50, 50, 'A folk album.');  
 INSERT INTO product VALUES (12, 'Powders', 2023, 'Pwdrs.png', 13.75, 12, 'An electronic album by Eartheater.');  
 INSERT INTO product VALUES (13, 'Nevermind', 1991, 'NVM.png', 10.50, 32, 'A rock album.');  
 INSERT INTO product VALUES (14, 'Grace', 1994, 'Grace.png', 6.50, 11, 'A rock album.');  
 INSERT INTO product VALUES (15, 'Strawberry Jam', 2007, 'STRJ.png', 17.99, 15, 'A pop album.');  
 INSERT INTO product VALUES (16, 'Heartleap', 2014, 'HL.png', 25.00, 83, 'A folk album.');  
 INSERT INTO product VALUES (17, 'Bleach', 1989, 'BLCH.png', 8.35, 42, 'A rock album.');  
 INSERT INTO product VALUES (18, 'Testing', 2018, 'TsTng.png', 32.50, 29, 'A hip-hop album.');  
 INSERT INTO product VALUES (19, 'Sound Sun Pleasure', 1959, 'SSP.png', 12.50, 6, 'A jazz album.');  
 INSERT INTO product VALUES (20, '12 Golden Country Greats', 1996, '12CGs.png', 20.70, 14, 'A country album.');  

 INSERT INTO music VALUES (11, 'Animal Collective', 'Folk');  
 INSERT INTO music VALUES (12, 'Eartheater', 'Electronic');  
 INSERT INTO music VALUES (13, 'Nirvana', 'Rock');  
 INSERT INTO music VALUES (14, 'Jeff Buckley', 'Rock');  
 INSERT INTO music VALUES (15, 'Animal Collective', 'Pop');  
 INSERT INTO music VALUES (16, 'Vashti Bunyan', 'Folk');  
 INSERT INTO music VALUES (17, 'Nirvana', 'Rock');  
 INSERT INTO music VALUES (18, 'A\$AP Rocky', 'Hip-Hop');
 INSERT INTO music VALUES (19, 'Sun Ra', 'Jazz'); 
 INSERT INTO music VALUES (20, 'Ween', 'Country'); 

 INSERT INTO review VALUES (3, 1, 5, 'I need more!');
 INSERT INTO review VALUES (4, 1, 4, 'Great product');
 INSERT INTO review VALUES (8, 1, 3, 'Ok product');
 INSERT INTO review VALUES (14, 1, 4, 'Good product');
 INSERT INTO review VALUES (17, 1, 3, 'Satisfactory product');
 INSERT INTO review VALUES (16, 2, 3, 'Satisfactory product');

 INSERT INTO cart_item VALUES (1, 3, 5);
 INSERT INTO cart_item VALUES (1, 4, 1);
 INSERT INTO cart_item VALUES (1, 8, 3);
 INSERT INTO cart_item VALUES (1, 14, 2);
 INSERT INTO cart_item VALUES (1, 17, 1);
 INSERT INTO cart_item VALUES (2, 16, 2);

 INSERT INTO customer_order VALUES (1, 1, 'Pickup', 'Ready for Pickup');
 INSERT INTO customer_order VALUES (2, 2, 'Delivery', 'Preparing Order');
 INSERT INTO customer_order VALUES (3, 3, 'Delivery', 'Delivering');
 INSERT INTO customer_order VALUES (4, 4, 'Pickup', 'Ready for Pickup');
 INSERT INTO customer_order VALUES (5, 5, 'Pickup', 'Preparing Order');
 INSERT INTO customer_order VALUES (6, 6, 'Pickup', 'Ready for Pickup');
 INSERT INTO customer_order VALUES (7, 7, 'Delivery', 'Delivering');
 INSERT INTO customer_order VALUES (8, 8, 'Pickup', 'Ready for Pickup');
 INSERT INTO customer_order VALUES (9, 9, 'Delivery', 'Delivering');
 INSERT INTO customer_order VALUES (10, 10, 'Pickup', 'Ready for Pickup');

 INSERT INTO order_item VALUES (2, 1, 1);
 INSERT INTO order_item VALUES (3, 2, 5);
 INSERT INTO order_item VALUES (4, 1, 2);
 INSERT INTO order_item VALUES (5, 7, 3);
 INSERT INTO order_item VALUES (6, 1, 2);
 INSERT INTO order_item VALUES (7, 1, 6);
 INSERT INTO order_item VALUES (8, 9, 4);
 INSERT INTO order_item VALUES (9, 3, 8);
 INSERT INTO order_item VALUES (10, 1, 2);
 INSERT INTO order_item VALUES (11, 1, 1);
 END;";

$stid = oci_parse($connect, $info);
$res = oci_execute($stid);

if ($res) {
print <<<HTMLCODE
<header>
SUCCESSFULLY POPULATED TABLE
</header>
<div>a</div>
<section>
HTMLCODE;
} else {
$errorMsg = oci_error($stid)["message"];
print <<<HTMLCODE
<header>
FAILED TO POPULATE TABLE
</header>
<div>a</div>
<section>
<p>FAILED TO ADD: $info<br>$errorMsg</p>
HTMLCODE;
}
oci_close($connect);
?>
    </section>
</section>
</body>
</html>