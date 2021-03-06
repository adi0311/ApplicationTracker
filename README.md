# ApplicationTracker

A PHP application where Student and Faculty can apply for leave. Once applied they can track the status of their leave application. First the application would be received by Acad person who either accepts or rejects the application. Once accepted by the Acad person, application is forwarded to the HOD who finally accepts or rejects the application.

## System Requirements

<ul>
  <li>PHP</li>
  <li>Xampp</li>
  <li>Git</li>
</ul>

## Get Started

<ol>
  <li>Install PHP, Xampp and Git on your system.</li>
  <li>Fork this repository.</li>
  <li>Create a NewFolder inside htdocs folder of Xampp directory.</li>
  <li>Open the terminal and change directory to the folder created inside htdocs.</li>
  <li>run commands:
    <ul>
      <li>git init</li>
      <li>git remote add origin https://github.com/your_user_name/ApplicationTracker</li>
      <li>git pull origin master</li>
    </ul>
  </li>
  <li>Now run the Apache and MySQL from the Xampp Control Panel.</li>
  <li>Go to PhpMyAdmin from localhost and create a new database table named <strong>file tracking</strong>.</li>
  <li>Click on <strong>file tracking</strong> and then navigate to <strong>SQL</strong>. Paste the content of file_tracking.sql in it and click <strong>Go</strong>.</li>
  <li>Application is now ready to go!</li>
 </ol>
 
 ## ScreenShots
 
 ### 1. Login Page
 
 ![Login](https://github.com/adi0311/ApplicationTracker/blob/master/screenshots/Login.png)
 
 ### 2. Fresh Application Page
 ![Application](https://github.com/adi0311/ApplicationTracker/blob/master/screenshots/Application_View.png)
 
 ### 3. Application Status Page
 ![Status Page](https://github.com/adi0311/ApplicationTracker/blob/master/screenshots/Status_Student.png)
 
 ### 4. HOD Leave Status Page
 ![HOD Status Page](https://github.com/adi0311/ApplicationTracker/blob/master/screenshots/Hod_Status_of_leave.png)
 
 ### 5. HOD Accepted and Rejected Leaves Page
 ![HOD Accepted Rejected](https://github.com/adi0311/ApplicationTracker/blob/master/screenshots/Hod_Acc_Rej_View.png)
 
 ### 6. Acad Admin Pending Leaves Page
 ![Acad Check](https://github.com/adi0311/ApplicationTracker/blob/master/screenshots/Academic_Pending_Check.png)
 
 ### 7. Acad Admin Accepted and Rejected Leaves Page
 ![Acad Accepted Rejected](https://github.com/adi0311/ApplicationTracker/blob/master/screenshots/Academic_Acc_Rej_View.png)
 
 ### 8. Acad Admin Check for Eligibility of Leave Page
 ![Eligibility Check](https://github.com/adi0311/ApplicationTracker/blob/master/screenshots/Acadmic_Check_Eligibility.png)
