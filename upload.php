<?php
ini_set('upload_max_filesize', '5M'); //ограничение в 5 мб
if ($_SERVER['REQUEST_METHOD'] == "POST" ) {
    if ($_FILES['inputfile']['error'] == UPLOAD_ERR_OK && $_FILES['inputfile']['type'] == 'image/jpeg') { //проверка на наличие ошибок
        if (move_uploaded_file($_FILES['inputfile']['tmp_name'], 'testdir/'.$_FILES['inputfile']['name'] )) { //перемещение в желаемую директорию
            echo 'File Uploaded'; //оповещаем пользователя об успешной загрузке файла

        } else {
            echo 'File not uploaded';
        }
    } else {
        switch ($_FILES['inputfile']['error']) {
            case UPLOAD_ERR_FORM_SIZE:
            case UPLOAD_ERR_INI_SIZE:
                echo 'File Size exceed';
                brake;
            case UPLOAD_ERR_NO_FILE:
                echo 'FIle Not selected';
                break;
            default:
                echo 'Something is wrong';
        }
    }
}
?>