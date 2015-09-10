<?php
//To check if the value of URL is set from the form
if(isset($_REQUEST['url'])) {
	$url = $_REQUEST["url"];
	//decoding the url to normal string, since special characters may have been replaced with encoded values
	$url = urldecode($url);	
	//Identifying if the URL given by the user is valid
	preg_match("#https://www.github.com/[a-zA-Z0-9]*/[a-zA-Z0-9\-\._]*$#",$url,$m);
	//Creating new issues array to store all the created time of all open issues
	$issues =	array();
	$result;
	//if invalid, m will have value 0, else will have value 1
	if(count($m)<1)
		echo "Error in URL";
	else {	
		//Splitting the URL to get :user & :repo
		list($url,$url1,$url2,$username,$repo) = explode('/',$url);
		//Creating our api url with the extracted :user and :repo and adding "/issues" at the end
		$url = "https://api.github.com/repos/".$username."/".$repo."/issues";
		$url1 = $url;
		$count=1;
		//For traversing all the pages
		while(true){
			$url = $url1."?page=".$count."&per_page=100";
			$count+=1;
			//echo $url;
			//Initiating curl
			$ch = curl_init();
			//assigning the created URL to curl
			curl_setopt($ch, CURLOPT_URL,$url);
			//Setting User Agent 
			curl_setopt($ch, CURLOPT_USERAGENT, "vigneshkumarsof94");
			//Switching off peer verification to avoid peer verification errors
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			//To accept the response as JSON
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
			//Will return the response, if false will print
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			//Executing the CURL
			$result=curl_exec($ch);
			//Check for errors in CURL and display the error message
			if($errno = curl_errno($ch)) {
				$error_message = curl_strerror($errno);
				echo "CURL error ({$errno}):\n {$error_message}";
			}
			// Closing CURL
			curl_close($ch);
			//Decode the json into new_result array
			$new_result=json_decode($result,true);
			//If the pages are exhausted, it returns zero elemt array which will be our breaking condition
			if(count($new_result) < 1)
				break;
			foreach($new_result as $i){
				//extracting the created_at key's value from each object of the result (new_result)
				//and pushing the values to issues array
				if(count($i) == 19)	
				  array_push($issues, $i["created_at"]);
			}
		}
		//Identifying the current time (TimeStamp Format)
		$current_time = time();
		//Variables to store the count of all the scenarios
		$number_of_openIssues = 0;
		$issue_lt_24hr = 0;
		$issue_gt_24hrs = 0;
		$issue_gt_7days = 0;
		
		//Traversing through each of the issues' created date
		foreach ($issues as $t){
			//all the issues that are retrieved are open, hence incrementing openIssues counter
			$number_of_openIssues+=1;
			//Splitting date and time to obtain the timestamp value of this dateTime
			list($datevalue,$timevalue) = explode('T', $t);
			list($timevalue,) = explode('Z', $timevalue);
			list($y,$m,$d) = explode('-',$datevalue);
			list($h,$mi,$s) = explode(':',$timevalue);
			//Creating the TimeStamp for this current issues' created dateTime
			$timestamp = mktime($h,$mi,$s,$m,$d,$y);
			//Finding out the difference between current timestamp and the issue created timestamp
			$diff = $current_time - $timestamp;
			//if diff is less than 86400 - issue has been created less than 24 Hours ago
			if($diff <= 86400)
					$issue_lt_24hr+=1;
			//if diff is greater than 86400 and less than 604800 - issue has been created more than 24 hours ago but less than 7 days ago
			elseif(($diff >86400)and($diff<=604800))
					$issue_gt_24hrs+=1;
			//else the issue has been created more than 7 days ago
			else
				$issue_gt_7days+=1;
		}
		//Displaying the Output
		print_r("<html><title>Shippable App</title><body>");
		print_r("<ul><li>Number of Open Issues : ".$number_of_openIssues."");
		print_r("</li><li>Number of open issues that were opened in the last 24 hours : ".$issue_lt_24hr."");
		print_r("</li><li>Number of open issues that were opened after 24 hours and before 7 days: ".$issue_gt_24hrs."");
		print_r("</li><li>Number of open issues that were opened before 7 days : ".$issue_gt_7days."");
		print_r("</li></ul></body></html>");
	}
}
else{
	//If URL is not got as a paramater of request, displaying an error
	echo "Error in recieving data";
}
//Back button
print_r('<html><br><a href="index.php">Back</a></html>');
?>
