<?php 
 
 include_once '../Database/db.conn.php';
 include_once "../Back-end/check_connection.php";
 include_once "../Back-end/check_role.php";
 include_once '../Back-end/get_id.php'; 

  	//include 'app/helpers/user.php';
  	include 'helpers/get_conversations.php';
  //  include 'app/helpers/last_seen.php';
    include 'helpers/last_chat.php';

  	# Getting User data data
  //	$user = getUser($_SESSION['username'], $conn);

  	# Getting User conversations
  	$conversations = getConversation( $conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Chat App - Home</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" 
	      href="css/style.css">
	<link rel="icon" href="../uploads/avatar1.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php include_once "header.php"; ?>
<div class="d-flex
             justify-content-center
             align-items-center
             vh-100">

    <div class="p-2 w-400
                rounded shadow">
			
    	<div>
    		<div class="d-flex
    		            mb-3 p-3 bg-light
			            justify-content-between
			            align-items-center">
    			
    			
    		</div>

    		
    		<ul id="chatList"
    		    class="list-group mvh-50 overflow-auto">
    			<?php if (!empty($conversations)) { ?>
    			    <?php 

    			    foreach ($conversations as $conversation){ ?>
	    			<li class="list-group-item">
	    				<a href="forum_message.php?id_sujet=<?=$conversation['id']?>"
	    				   class="d-flex
	    				          justify-content-between
	    				          align-items-center p-2">
	    					<div class="d-flex
	    					            align-items-center">
	    					    <img src="../uploads/avatar1.png"
	    					         class="w-10 rounded-circle">
	    					    <h3 class="fs-xs m-2">
	    					    	<?=$conversation['intitule']?><br>
                      <small>
                        <?php 
                          echo lastChat( $conversation['id'],  $conn);
                        ?>
                      </small>
	    					    </h3>            	
	    					</div>
	    					
	    				</a>
	    			</li>
    			    <?php } ?>
    			<?php }else{ ?>
    				<div class="alert alert-info 
    				            text-center">
					   <i class="fa fa-comments d-block fs-big"></i>
                       No messages yet, Start the conversation
					</div>
    			<?php } ?>
    		</ul>
    	</div>
    </div>
	  

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<!-- <script>
	$(document).ready(function(){
      
    });
</script> -->
</div>
<?php include_once "footer.php"; ?>

</body>
</html>
<?php
 
 ?>