<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>

<?php


//ini_set('upload_max_filesize', '5M'); //ограничение в 5 мб
//if ($_SERVER['REQUEST_METHOD'] == "POST" ) {
//    if ($_FILES['inputfile']['error'] == UPLOAD_ERR_OK && $_FILES['inputfile']['type'] == 'image/jpeg') { //проверка на наличие ошибок
//        if (move_uploaded_file($_FILES['inputfile']['tmp_name'], 'testdir/'.$_FILES['inputfile']['name'] )) { //перемещение в желаемую директорию
//            echo 'File Uploaded'; //оповещаем пользователя об успешной загрузке файла
//
//        } else {
//            echo 'File not uploaded';
//        }
//    } else {
//        switch ($_FILES['inputfile']['error']) {
//            case UPLOAD_ERR_FORM_SIZE:
//            case UPLOAD_ERR_INI_SIZE:
//                echo 'File Size exceed';
//                break;
//            case UPLOAD_ERR_NO_FILE:
//                echo 'FIle Not selected';
//                break;
//            default:
//                echo 'Something is wrong';
//        }
//    }
//}
//?>

<?php
//Задали массив в котором храним 3 типа поддерживаемых картинок (image_type_to_mime_type)
$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);

//Записали директорию в переменную
$upload_dir = './testdir/';

//Создаем директорию если её нет
if (!is_dir($upload_dir)) {  //is_dir - проверяет, является ли переменная директорией
$is_make_dir = mkdir($upload_dir);    //Создаем директорию

//    $is_make_dir = mkdir(iconv('utf-8', 'windows-1251', $upload_dir));  //Если не является(не создана директория, тогда создаем директорию и конвертирует в нужную кодировку
    if ($is_make_dir == false) {
        echo "<p>Не удалось создать папку</p>";
        //exit();
    }
}




// Считает количество загружннных файлов в массиве
$total = count($_FILES['upload']['name']);
//Перебираем в цикле все полученные файлы
for($i=0; $i<$total; $i++) {
    $detectedType = exif_imagetype($_FILES['upload']['tmp_name'][$i]);  //функция exif_imagetype проверяет изображение
    // ли это и возвращает либо true либо false на основе массива $allowedTypes
    echo "detectedType =".$detectedType;
    echo "<br>";

if ($error = in_array($detectedType, $allowedTypes)){  //in_array - возвращает false ЕСЛИ: 1 аргумент равен нулю ИЛИ 2 аргумент пусстой массив

//   echo "error =";
//    var_dump($error);
//    echo "<br>";

    echo " name =".$_FILES['upload']['name'][$i];
    echo "<br>";
    echo " type =".$_FILES['upload']['type'][$i];
    echo "<br>";
    echo " tmp_name =".$_FILES['upload']['tmp_name'][$i];
    echo "<br>";
    echo "<br>";

    //Записали в переменную переданный файл, на текущей итерации цикла
    $tmpFilePath = $_FILES['upload']['tmp_name'][$i];
//    echo "tmpfilepath =".$tmpFilePath;

    //Если временная переменная не пустая
        if ($tmpFilePath != ""){
            //Начинаем переносить файл из временной директории, в постоянную нами созданную
            $newFilePath = $upload_dir . $_FILES['upload']['name'][$i];
            //Отправляли файлы в кодировке utf-8, но, чтобы киррилица отображалась нормально, на выходе нам нужна 1251
            $newFilePath = iconv('utf-8','windows-1251',$newFilePath);

            //Перемещаем файлы из временной директории в нашу постоянную
            if(move_uploaded_file($tmpFilePath, $newFilePath)) {
//                echo 'Успешно загружен файл';
            }
        }
    }
    else echo "Файл = ".$_FILES['upload']['name'][$i]." - должен быть jpeg, png или gif"."<br>";
//    echo "error2 =  ";
//    var_dump($error);
//    echo "<br>";
}

?>

