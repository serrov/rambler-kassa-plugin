<?php
/**
* Plugin Name: Мой супер плагин
* Plugin URI: https://szart.ru/
* Description: Этот плагин делает мир лучше!
* Version: 1.0.0
* Author: serrov
* Author URI: https://szart.ru/
* License: GPL2
*/

function create_table() {
  global $wpdb;
  // задаем название таблицы
  $table_name = $wpdb->get_blog_prefix() . 'rambler-kassa-plugin';
  // проверяем есть ли в базе таблица с таким же именем, если нет - создаем.
  if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
    // устанавливаем кодировку
    $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";
    // подключаем файл нужный для работы с bd
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    // запрос на создание
    $sql = "CREATE TABLE {$table_name} (
      id int NOT NULL primary key AUTO_INCREMENT,
      SessionID INT,
      DateTime DATETIME,
      MovieID INT,
      HallName VARCHAR(15),
      MinPrice INT,
      MaxPrice INT,
      Format VARCHAR(2),
      IsSaleAvailable BOOL NOT NULL DEFAULT "0"
    ) {$charset_collate};";
    // Создать таблицу.
    dbDelta($sql);
  }
}


// создание таблицы в базе данных при активации плагина(если еще не создана).
register_activation_hook(__FILE__, 'create_table');
?>
