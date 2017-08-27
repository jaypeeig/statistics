<?php


$check = "select * from tbstats";
mysql_connect('localhost','root','root');
mysql_select_db("dbstats");

$run = mysql_query($check) or die(mysql_error());

if(mysql_num_rows($run) >= 1){
exit();
}else{

$insert = "INSERT INTO tbstats (name, mon, tue, wed, thu, fri, sat, sun) VALUES
('Aglobo, Leah May', 360, 120, 120, 0, 0, 0, 480),
('Arevalo, Novemberlyn', 10, 10, 10, 10, 10, 10, 0),
('Belgira, Paula Joy', 90, 60, 70, 0, 60, 260, 260),
('Bravante, Mark John', 5, 5, 5, 5, 5, 60, 120),
('Cabauatan, John Benneth', 200, 120, 240, 210, 240, 240, 120),
('Chica, Nhel ', 60, 60, 120, 60, 60, 120, 240),
('Felecia, Grace', 120, 240, 180, 120, 60, 60, 360),
('Fernandez, LA', 240, 240, 240, 240, 240, 120, 120),
('Fernando, Gilmore', 230, 230, 230, 230, 230, 300, 350),
('Galang, Sophiya Mae', 300, 240, 180, 120, 120, 120, 360),
('Gales, Dionel', 60, 120, 60, 0, 60, 240, 60),
('Gallardo, Lily Mae', 120, 180, 120, 240, 120, 300, 360),
('Igcasan, Albert', 10, 15, 11, 10, 9, 10, 10),
('Ignacio, Jaypee', 60, 45, 48, 30, 60, 60, 60),
('Libre, Allan Dave', 30, 15, 30, 15, 30, 120, 60),
('Luces, Lei Marie', 120, 120, 120, 120, 120, 30, 240),
('Manalo, Reginald', 45, 45, 45, 45, 120, 120, 100),
('Oseo, Nolie', 480, 480, 480, 480, 480, 180, 300),
('Paiton, Stephanie ', 60, 60, 60, 60, 60, 120, 120),
('Paredes, Jelette', 240, 240, 240, 240, 240, 60, 240),
('Petalio, Mary Rose', 120, 120, 60, 60, 30, 60, 60),
('Quindoza, Mark Jason', 240, 240, 240, 240, 200, 240, 480),
('Regencia, Reymark', 60, 30, 30, 30, 0, 60, 120),
('Reyno, Raphael', 240, 240, 240, 240, 240, 300, 360),
('Rico, Cler', 60, 60, 60, 60, 60, 60, 300),
('Romulo, Joyce Anne', 300, 360, 360, 180, 180, 180, 120),
('Santos, Jaycee Ross', 120, 120, 120, 120, 120, 0, 300),
('Tabernero, Marikris', 110, 20, 30, 45, 30, 10, 120),
('Tabernilla, Arvin', 60, 120, 120, 60, 120, 60, 240),
('Tending, Zenaida', 120, 120, 120, 120, 120, 240, 120),
('Tenoso, Lee John', 60, 60, 120, 60, 120, 240, 240),
('Ventura, Annamarie Roxanane', 120, 0, 30, 0, 0, 120, 300),
('Yasa, Alexis', 630, 780, 540, 540, 540, 300, 360),
('Celestino, Aloja', 200, 200, 200, 200, 200, 200, 200),
('Matitu, Ruel', 120, 120, 180, 120, 120, 240, 240)";

mysql_query($insert) or die(mysql_error());

}


?>