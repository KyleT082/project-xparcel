<?php

	/*This file is responsible for loading in existing package
	details and verifying the existance of the package tracking 
	number*/ 
	
	if(session_id()){

	}
	else{
		session_start();
		include "connection.php";
	}

	//include "connection.php";
	
    //find out the logined users Profile ID and load details
    function getProfileID(){

    	$DBH = connect();

    	$sql = $DBH->prepare("SELECT `ProfileID` FROM `user` WHERE `UserID` = :userID LIMIT 1;");  

    	$sql->bindValue(':userID',$_SESSION['$userID']);
		$sql->execute();

		$result = $sql->fetchAll(PDO::FETCH_ASSOC);

		//store the profileID into session
		foreach($result as $r){

			$_SESSION['$profileID'] = $r['ProfileID'];
		}

		//if the users already has added tracking details load them
		if(!empty($result)){
			
			loadDetails();
		}
		//if there are no details to load
		else{
			echo "
	                          <tr id='table1' class='tb'> 
	     		   				
	                            <td></td>
	                            <td> <div id='alertNoPack' class='alert alert-warning'>
    									<strong>There seems to be a problem</strong> Please contarct site admin to fix the problem.
  									</div>
  								</td>
	                            " ;			
		}
    }

     function loadDetails(){

    	$DBH = connect();
		    
	    $query = $DBH->prepare("SELECT `packageName`,`DeliveryDate`,`TrackingNum`,`Status`,`PackageID` FROM `packages` WHERE `UserProfileID` = :profileID ;");
	    $query->bindValue(':profileID',$_SESSION['$profileID']);
	    $query->execute();
	    $sth = $query->fetchAll(PDO::FETCH_NUM);
	 
	    //if there are details to enter to the table
	    if (!empty($sth)){
	    	$x=0;
		    foreach ($sth as $row){
		    			$x++;
		    			//get  the delivery address add it to the table
		    			$query2 = $DBH->prepare("SELECT `Address` FROM `pdestination` WHERE `PackageID` = :packageid;");
		    			$query2->bindValue(':packageid',$row[4]);
		    			$query2->execute();
		    			$sth2=$query2->fetchAll(PDO::FETCH_NUM);

		    			if(!empty($sth2)){
		    				foreach($sth2 as $row2){
		    					$row[4] = $row2[0];
		    				}
		    			}
		    			else{
		    				$row[4] = "Error loading destination address!";
		    			}

                        echo "<tr id ='row".$x."' class='tb'>
                        	
                   			<td id='delName".$x."'>".$row[0]."</td>
                            <td id='delDate".$x."'>$row[1]</td>
                            <td id='tracNum".$x."'>$row[2]</td>
                            <td id='tracSta".$x."'>$row[3]</td>
                            <td id='address".$x."'>$row[4]</td>
                            </tr>  ";  
	        }
	     }
	     //if there are not details to enter into the table
	     else{
	     	echo "
	     		   <tr id='table1' class='tb'> 
	     		   				
	                            <td></td>
	                            <td> <div id='alertNoPack' class='alert alert-info'>
    									<strong>Add a package! </strong> click the Add button to start managing your packages.
  									</div>
  								</td>
	                            <td></td>
	                            <td></td>
	                            <td></td>
	                            </tr>";
	     } 
	}           
?>