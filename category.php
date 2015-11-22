<?php
/**
 * Created by PhpStorm.
 * User: Gordondalos
 * Date: 22.11.2015
 * Time: 13:20
 */

$mysql_host = "localhost";
$dbname = "parser";
$mysql_user = "root";
$dbpasswd = "";
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET 'utf8'");
mysql_query("SET SESSION collation_connection = 'utf8_general_ci'");


// Код соединения с базой данных
$link = mysql_connect($mysql_host, $mysql_user, $dbpasswd) or die('Не удалось соединиться: '. mysql_error());
mysql_set_charset('utf8');
echo 'Соединение успешно установлено';
mysql_select_db($dbname) or die('Не удалось выбрать базу данных');


include 'lib/simple_html_dom.php';
// получим страничку
$page = file_get_html('https://www.avito.ru/additem');


//для всех элементов найдём элементы img
//    foreach($page->find('span[class=form-category-item__label]') as $a){
//        //выведем данный элемент
//        echo $a->innertext;
//        echo "<br>";
//    }

$form = $page->find('label[class=form-category-item] input');

foreach ($form as $item) {

    $arr = $item->getAllAttributes();


    foreach ($arr as $key => $value) {
        if ($key == 'title') {
            $title = $value;
            echo $value;

        }
        if ($key == "data-parent-id") {
            if (!empty($value)) {
                echo "- родительская категория - ".$value;
               $parent_id = $value;
                $parent = 0;
            }
            else {
                echo " Это Родительская категория";
                $parent = 1;
                $parent_id = 0;
            }
        }
        if($key == "data-id"){
            echo " - Айдишник категории ". $value;
            $id = $value;
        }
    }

    $query = "INSERT INTO category (`id`,`title`,`parent_id`,`parent`) VALUE ($id,'$title',$parent_id,$parent)";
    mysql_query($query) or die($query);
    echo "<br>";
    echo $query;
    echo "<br>";

echo "<br>";

}


// почистим за собой
$page = file_get_html('https://www.avito.ru/additem');
$page->clear();