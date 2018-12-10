# Junior_Developer_Application

# For email capabilities to work please change relevent code in signin_action_page.php 

# If you have any questions please dont hasitate to contact me 

# All features tested and working at time of release 

#Create a user registration and login system using the approach below

#Create a database with the following relational tables

#"users" with fields - id, username, password, email, status, type_id

#"user_types" with fields - id, type_description, access_level (type_id as above will relate to this table's id column)

#Create a page with a form to capture a new registration or login if the user already exists. The form must work as follows

#The fields captured must be “Username”, “Password” when logging in and additionally “Email” and “User type” when registering. (logging #in #or registering can be decided by a tickbox)

#The password must be encrypted before inserting into the database

#“User Type” must be a dropdown consisting of 2 options “Sales” and “Operations” (these 2 options must be added to the table created in 
#step 1)

#The POST of the form must happen using jQuery’s AJAX function using type JSON.

#A response message must be given to the user after the AJAX call has been made. The return message must also return as JSON to the 
page, #in order to be used in a div that will house the message. The response message can be either one of the following:

#“User successfully registered” – green message

#“Username already exists” – blue message

#“User successfully registered, but could not send activation email” – orange message.

#If an error occurred or if the message would be different from one of the above, then print it our accordingly, using a red message

#If a user logged in successfully, no return message is necessary because a page redirect will happen (see step 5)

#If the registration database insert from above form was successful the script needs to send an “activation” email before returning the 
successful/failed message in JSON.

#The email must contain a link that needs to be clicked in order to set the user’s “status” to 1 as opposed to the default value of 0.

#Only once a user’s status is 1 must they be able to login.

#When a user login was successful a session containing the user credentials must be setup in order to verify page access.

#After a user successfully logged in, they must be directed to a page that prints out the following in list format:

#If a user’s type is “Sales”, they must see a list of all the users added to the database, the user info they will be able to see is 
“username”, “type_description”

#If a users’s type is “Operations”, they must see a list of all users added to the database, the user info they will be able to see is“username”, “type_description”, “email” and “status”.

#While a user is logged in, a Logout button should be visible. The logout button should clear all session data and redirect the user back #to the login page.
