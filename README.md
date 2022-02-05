## UM Mobile Number Login
Ultimate Member additional login option: Mobile Number.

Two options for the use of Mobile Number Login are avilable:

1. The UM Forms Designer Username or email Login field also accepts a Mobile Number for identification of the User.

2. The UM Login Form can have a Mobile Number Form text field as the only identification of the User for Login.
### Mobile Number Requirements
May start with + sign and may contain spaces/blanks among the digits.

If mobile number contains + sign and/or blank/spaces the stored meta value must have exact match for identification.

All characters are digits and no other alphabetic characters in the mobile number.
### Additional UM error messages:
Mobile number not found

Invalid mobile number

There are more than one user registered with this mobile number
### Mobile Number Meta Key
If you are using another meta_key than "mobile_number" replace the default meta_key value in the source.php line 11

### Installation
Add the php source code to your child-theme's functions.php file.

or use the "Code Snippets" plugin: https://wordpress.org/plugins/code-snippets/
