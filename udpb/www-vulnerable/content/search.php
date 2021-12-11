<?php
include_once(__DIR__.DIRECTORY_SEPARATOR.'../include/db.php');
?>
<?php
error_reporting(0);
// A1 - uplne najlepsie http://php.net/manual/en/mysqli-stmt.get-result.php 
// A1 - pripade treba pozriet na real_escape_string() a whitelistovat vyhladavanie teda povolit len znaky a cisla napriklad regexom ;)
// A5 minimalne treba povypinat error message no najlepsie je osetrit cyklus try catchom a v pripade chyby presmerovanie na error_page.php
$stmt = $db->prepare('SELECT * FROM articles WHERE title LIKE ? OR content LIKE ?');
$search = $_POST['search'];
$stmt->bind_param('ss',$search ,$search);
$stmt->execute();
$search= $stmt->get_result();
?>

<!--Co tak dat vysledky vyhladavania a data[title] do htmlspecialchars? -->
<h1> Výsledky vyhľadavania: <?=$_POST['search']?></h1>

<div>
    <?php
    try {
      while($data = $dd->fetch_array()){
	  echo 'Article: <a href=/index.php?id='.$data["id"].'>'.$data["title"].'</a><br />';
    }
    } catch (Exception $e) {
      header("LOCATION: error_page.php");
     } 
    ?>
</div>
