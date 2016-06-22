<?php
	if(session_id()){
	}
	else{
		session_start();
		include "connection.php";
	}

	 //load the tracking details into the table

    	$DBH = connect();
    	//get the number of items in the list
	    $query2 = $DBH->prepare("SELECT `DeliveryDate`,`Status`,`TrackingNum` FROM `packages` WHERE `UserProfileID` = :profileID ;");
	    $query2->bindValue(':profileID',$_SESSION['$profileID']);
	    $query2->execute();
	    $sth2 = $query2->fetchAll(PDO::FETCH_NUM);
	    $radioNum = count($sth2);


	    $query = $DBH->prepare("SELECT `packageName`,`DeliveryDate`,`TrackingNum`,`Status`,`PackageID` FROM `packages` WHERE `UserProfileID` = :profileID ORDER BY `PackageID` DESC LIMIT 1;");
	    $query->bindValue(':profileID',$_SESSION['$profileID']);
	    $query->execute();

	    $sth = $query->fetchAll(PDO::FETCH_NUM);
	   
	    //if there are details to enter to the table
	    if (!empty($sth)){
	    	$x=$radioNum;
		    foreach ($sth as $row){
		    			
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
	     		   <tr  class='tb'> 
	     		   				
	                            <td></td>
	                            <td> <div id='alertNoPack' class='alert alert-info'>
    									<strong>Add a package! </strong> click the Add button to start managing your packages.
  									</div>
  								</td>
	                            <td></td>
	                            </tr> 

	                            ";

	     } 

	     //echo "secon post works!!";*/
	           
?>