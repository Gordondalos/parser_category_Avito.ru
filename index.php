<?php
/**
 * Created by PhpStorm.
 * User: Gordondalos
 * Date: 22.11.2015
 * Time: 13:20
 */


include 'lib/simple_html_dom.php';
// ������� ���������
$page = file_get_html('https://www.avito.ru/additem');




    //��� ���� ��������� ����� �������� img
//    foreach($page->find('span[class=form-category-item__label]') as $a){
//        //������� ������ �������
//        echo $a->innertext;
//        echo "<br>";
//    }

$form = $page->find('label[class=form-category-item] input');

foreach($form as $item)
{

   $arr = $item->getAllAttributes() ;





}




// �������� �� �����
$page = file_get_html('https://www.avito.ru/additem');
$page->clear();