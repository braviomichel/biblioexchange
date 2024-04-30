<?php  

function getUser($id, $conn){
   $sql = "SELECT * FROM utilisateurs 
           WHERE id_utilisateurs=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]);

   if ($stmt->rowCount() === 1) {
   	 $user = $stmt->fetch();
   	 return $user;
   }else {
   	$user = [];
   	return $user;
   }
}