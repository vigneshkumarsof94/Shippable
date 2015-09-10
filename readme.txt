Github - Open issue tracker
---------------------------

input format : https://www.github.com/:username/:repo

Technology Used : 
-----------------
	* PHP 5.5.12 with CURL
	* JSON
	* HTML with CSS and BOOTSTRAP
	* GITHUB APIs
	
Approach : 
----------
	I have used basic CURL to make a API request to Github. The result is then processed using PHP and then displayed out to the User.
	* Step - 1 :
		* Input the URL from the User
		* Validate the URL
	* Step - 2 :
		* If the input URL is valid, then create the URL for the API request using the data from input URL.
		* Make the API request and process the JSON response to get the created date of all the open issues.
	* Step - 3 :
		* Calculate the difference between each of the created timestamp and current timeStamp and classify them as one of the 3 categories ( 1. Less than 24Hrs, 2. Greater than 24Hrs but less than 7days, 3. Greater than 7days ) and increment the corresponding count.
	* Step - 4 :
		* The final output is then displayed to the user.
		
Improvements that can be made with more time :
----------------------------------------------
	* The URL validation can be done more effectively.
	* The UI can be made more interactive.
	* Other errors that can occur could have been handled well, given more time.
	* Could have been able to more clearly understand the working of the APIs
	