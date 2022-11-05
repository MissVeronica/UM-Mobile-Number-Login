## UM Mobile Number Login
Ultimate Member additional Login option: Mobile Number together with a new Mobile and Phone Number Custom Validation for Registration and Profile Forms.
### Mobile Number Login Options
Three options for the use of Mobile Number Login are available:

1. The UM Forms Designer Username or email Login field also accepts a Mobile Number for identification of the User.

2. The UM Login Form can have a Mobile Number Form text field as the only identification of the User for Login.

3. code snippet for mobile_number or change to phone_number in the two $args['mobile_number'] for adding this number to user_login at registration

### UM Forms Designer
#### Login Form
For the first option change the Title/Label etc in current setup.

For the second option replace current Username or Email Login field with your Mobile Number Field.

Use the Password field like the default setup for Login.
#### Registration and Profile Form
Set the "mobile_number" meta key value Validation to "Custom Validation" and add the Validation as <code>unique_mobile_number</code>.
### Mobile Number Validation
Custom UM Field Validation: <code>unique_mobile_number</code> 

If mobile number contains blank/spaces and some of these characters <code>+ ( ) - .</code>  the stored meta value must have exact match for identification. All other characters must be digits and no other alphabetic characters are allowed in the mobile number.

Example of a USA phone or mobile number:  +1 (123) 456-7890

Example of a European phone or mobile number: +49 123-4567-890
### Additional UM error messages:
#### Login
Mobile number not found

Invalid mobile number

There are more than one user registered with this mobile number
#### Registration and Profile Form Validation
There is a user registered with this mobile number
### Mobile Number Meta Key
If you are using another meta_key than "mobile_number" replace the default meta_key value in the source.php line 11

### Installation
Add the php source code to your child-theme's functions.php file.

or use the "Code Snippets" plugin: https://wordpress.org/plugins/code-snippets/

### Add on
1. Code snippet for changing input fields of Mobile/Phone Numbers to be type="tel" instead of type="text".

2. Code snippet for making display of Mobile/Phone Numbers clickable by using the link href="tel:"
