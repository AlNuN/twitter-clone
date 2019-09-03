<?php

namespace App;

class Connection {

	public static function getDb() {
		try {

			$conn = new \PDO(
				'mysql:host=localhost;dbname=twitter_clone;charset=utf8',
				'root',
				'password'  //insert your db password here 
			);

			return $conn;

		} catch (\PDOException $e) {
            //.. handle error ..//
            // redirect to front page and alert that we could not connet to the db
		}
	}
}

?>
