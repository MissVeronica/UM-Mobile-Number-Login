## UM Mobile Number Login
Ultimate Member additional Login option: Mobile Number.
### Mobile Number Login Options
Two options for the use of Mobile Number Login are available:

1. The UM Forms Designer Username or email Login field also accepts a Mobile Number for identification of the User.

2. The UM Login Form can have a Mobile Number Form text field as the only identification of the User for Login.
### UM Forms Designer
For the first option change the Title/Label etc in current setup.

For the second option replace current Username or Email Login field with your Mobile Number Field.

Set the "mobile_number" meta key value Validation to "Unique Metakey value".

Use the Password field like the default setup for Login.
### Mobile Number Requirements
If mobile number contains blank/spaces and some of these characters <code>+ ( ) - ext</code>  the stored meta value must have exact match for identification. All other characters must be digits and no other alphabetic characters are allowed in the mobile number.

Example of a USA phone or mobile number:  +1 (123) 456-7890 ext 9876

Example of a European phone or mobile number: +49 160-5556-417
### Additional UM error messages:
Mobile number not found

Invalid mobile number

There are more than one user registered with this mobile number
### Mobile Number Meta Key
If you are using another meta_key than "mobile_number" replace the default meta_key value in the source.php line 11

### Installation
Add the php source code to your child-theme's functions.php file.

or use the "Code Snippets" plugin: https://wordpress.org/plugins/code-snippets/
