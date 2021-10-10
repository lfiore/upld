<?php 
//SESSION CSFR
define ('CSRF_ERROR',"CSRF token mismatch");
//ADMIN
define('NOT_ADMIN',"You are not authorised to perform this action. Please log in.");
//Register Page
define('REGISTER_ALL_FIELD_NEEDED',"Please make sure all fields are filled in");
define('REGISTER_MAIL_NOT_VALID',"The email you entered is invalid");
define('MAILS_NOT_IDENTICAL',"The email and confirmation email do not match");
define('PSW_TOO_SHORT',"Please enter a longer password (8 characters minimum)");
define('PSWS_NOT_IDENTICAL',"The password and confirmation password do not match");
define('ACCOUNT_CREATED',"Your account has been created and you have been logged in");
define('MAIL_ALREADY_IN_USE',"An account already exists with that email");
//Account Page
define('NO_IMAGE_LIST',"You haven't uploaded any images yet!");
define('ACCOUNT_PAGE_TITLE',"Your account");
define('ACCOUNT_PAGE_DESC',"Welcome to your account. You can view all of your uploads here, see the upload time and delete them");
define('ACCOUNT_DEL_IMAGE',"DELETE image");
define('UPLOAD_TIME',"uploaded");
//Contact Page
define('CONTACT_PAGE_TITLE',"Contact");
define('CONTACT_PAGE_DESC',"If you would like to contact us, please email ". CONTACT_EMAIL);
//Ban Page
define('NOT_NUMERIC_ID',"Oops, that ID appears to be invalid. User IDs should be numberic");
define('CANNOT_BAN_ADMIN',"You cannot ban an admin");
define('BAN_SUCCESS',"User has been banned and all data has been removed");
//Delete Page 
define('IMAGE_ID_NOT_VALID',"Oops, that ID appears to be invalid. IDs should have 5 characters and contain letters and numbers only.");
define('DELETE_NO_IMAGE',"Hmm, no image exists with that ID. Maybe it was deleted or you typed in the URL incorrectly?");
define('DELETE_IMAGE_SUCCESS',"The image with the following id has been removed:");
//Moderate Page 
define('NOT_VALID_IP',"Oops, that IP address appears to be invalid");
define('NO_IP_OR_ID',"no ID or IP address specified");
define('NO_IMAGES_USER',"No images found for this user");
define('MODERATE_PAGE_TITLE',"Account moderation for");
define('BAN_USER',"Click here to ban this user and delete all images");
define('IMAGES_LIST_IP',"These are all of the images uploaded with the specified IP address");
//Login/Logout Pages
define('ERROR_NO_MAIL_OR_PSW',"Please make sure you enter both an email address and password");
define('NOT_VALID_MAIL',"Please enter a valid email address");
define('INVALID_LOGIN',"Sorry, no account exists with this email and password");
define('BANNED_USER_LOGIN',"This account has been banned");
define('LOGIN_SUCCESS',"You have been logged in");
define('LOGOUT_SUCCESS',"You have been log out");
define('LOGIN_PAGE_TITLE',"Log in");
define('LOGIN_PAGE_DESC',"Log in to your account to manage your uploads");
define('FORGOT_PSW',"Forgot your password? Click here!");
define('PSW_LABEL_PLACEHOLDER',"password...");
//View Page 
define('IMAGE_REMOVED',"This image has been deleted.");
define('VIEW_LINK',"preview link (email &amp; chat)");
define('VIEW_DIRECT_LINK',"direct link (websites &amp; backgrounds)");
define('VIEW_HTML',"html code (websites)");
define('VIEW_BBCODE',"bb code (forums)");
define('VIEW_BBCODE_WITH_LINK',"linked bb code (forums)");
define('VIEW_ID_IMG',"image ID:");
define('VIEW_IMG_SIZE',"image dimensions:");
define('VIEW_IMG_WEIGHT',"image size:");
define('VIEW_IMG_TYPE',"image type:");
define('VIEW_IMG_UPLOAD_TIME',"upload time:");
define('VIEW_IMG_IP_FROM',"uploader IP:");
define('REPORT_IMAGE',"report this image");
define('DELETE_IMAGE',"DELETE this image");
define('VIEW_OTHERS_FROM_SAME_IP',"view all images uploaded with this IP address");
define('VIEW_OTHERS_FROM_SAME_USER',"view user's other uploaded images");
//Upload Page 
define('NO_ANON_UPLOAD',"Anonymous uploads have been disabled, please register or log in to upload");
define('NO_REMOTE_UPLOAD',"Remote downloading is not enabled on this installation");
define('ONLY_ONE_UPLOAD_METHOD',"Please only choose one image to upload.");
define('NO_IMAGE_SELECTED',"Please choose either an image on your computer to upload or a remote image to download.");
define('NOT_VALID_URL',"Sorry, this URL is invalid");
define('DOMAIN_NOT_PERMITTED',"Sorry, downloads from this domain have not been allowed by the administrator");
define('TOO_BIG_FILE',"Sorry, this file is too big");
define('INVALID_IMAGE',"Sorry, this does not appear to be a valid image");
define('INVALID_EXTENSION',"Sorry, this extension is not allowed.");
define('UPLOAD_ERROR',"File upload error. Error code:");
define('ERROR_CODE_WEBSITE',"See here for error codes: <a href='http://php.net/manual/en/features.file-upload.errors.php' target='_blank'>http://php.net/manual/en/features.file-upload.errors.php</a>");
//Message Page
define('MESSAGE_TITLE',"Message");
//Register Page 
define('REGISTER_PAGE_TITLE',"Register");
define('REGISTER_PAGE_DESC',"You can register an account which will allow you to keep track of your uploaded images");
define('REGISTER_LABEL_PLACEHOLDER_MAIL',"email...");
define('REGISTER_LABEL_PLACEHOLDER_MAIL_CONFIRM',"confirm email...");
define('REGISTER_LABEL_PLACEHOLDER_PSW',"password... (8 characters minimum)");
define('REGISTER_LABEL_PLACEHOLDER_PSW_CONFIRM',"confirm password... (8 characters minimum)");
define('REGISTER_LABEL_REGISTER_BUTTON',"Register");
//Main Page 
define('WELCOME_MAIN_TITLE',"Welcome to ".SITE_NAME);
define('WELCOME_MAIN_DESC_1',SITE_NAME." is a free, online image host. Simply click the button below to start uploading!");
define('WELCOME_MAIN_DESC_2',"Before uploading, you can register an account (or log in if you already have one) and manager your uploads later");
define('WHY_USE_TITLE',"Why use ".SITE_NAME."?");
define('WHY_USE_GRATIS',"It's completely <span class='black'>free</span>!");
define('WHY_USE_ACCOUNT',"You can create an account and <span class='black'>manage all of your uploads</span>");
define('WHY_USE_REMOTE_UPLOAD',"<span class='black'>Download files remotely!</span>");
define('WHY_USE_FILE_EXT_ALLOWED',"The following image types are allowed:");
define('WHY_USE_MAX_SIZE',"The files size may be up to ");
define('WHY_USE_FRIENDLY_URL',"<span class='black'>Short, easy to remember</span> URLs!");
//Upload box
define('UPLOAD_BUTTON',"click here to select an image");
define('UPLOAD_BUTTON_CANCEL',"wait, I want to upload something else!");
define('UPLOAD_REMOTE_BUTTON',"download remote image");
define('UPLOAD_REMOTE_PLACEHOLDER',"Want to download your image remotely? Paste the link here (http://)");
//TC Page 
define('TC_PAGE_TITLE',"Terms &amp; Conditions");
define('TC_PAGE_TERMS_DESC',"You must not use ".SITE_NAME." to upload any of the following:");
define('TC_PAGE_NO_COPYRIGHT_IMG',"Copyrighted images (images owned by someone else) unless you have explicit permission");
define('TC_PAGE_NO_ILLEGAL_IMAGE',"Images which are considered illegal");
define('TC_PAGE_INFO_DESC',"Things to note when using ".SITE_NAME.":");
define('TC_PAGE_IP_NOTICE',"When uploading an image, your IP address will be stored. We will not provide this information to anybody unless requested by law enforcement authorities..");
define('TC_PAGE_IMG_DEL_NOTICE',SITE_NAME." has the right to remove any images at it's discretion");
//Report Page 
define('IMAGE_ALREADY_REPORTED',"This image has already been reported and is under review");
define('IMAGE_ALREADY_CHECKED',"This image has already been reported, and after review was deemed to be acceptable.");
define('IMAGE_REPORTED_NOTICE',"This image has been reported and will be reviewed. Thank you.");
//Report Mail
define('REPORT_IMAGE_MAIL_TITLE',"An image has been reported: ");
define('REPORT_IMAGE_MAIL_TEXT',"The following image has been reported:");
//Password reset
define('PSW_RESET_PAGE_TITLE',"Reset Password");
define('PSW_RESET_PAGE_DESC',"Forgot your password? Insert here your email andress. If an account is associated with it, we will send an email with a new passwordd shortly.");
define('PSW_RESET_EMAIL_PLACEHOLDER',"email...");
define('PSW_RESET_CONFIRM',"Send Request");
define('PSW_RESET_MAIL_TITLE',"Reset Password - ".SITE_NAME);
define('PSW_RESET_MAIL_TEXT',"Hi,\n You has request a new password for your account at ".SITE_NAME.". Your new password is");
define('PSW_RESET_NOTICE',"A new password will be send to your email address shortly");
//Change Password
define('CHANGE_PASSWORD',"Change password");
define('ACCOUNT_PAGE_PASSWORD_TITLE',"Change password");
define('ACCOUNT_PAGE_PASSWORD_DESC',"With this form you can change your password.");
define('PSW_CHANGED',"Password changed");
//Change Email
define('EMAIL_CHANGED',"Email changed");
define('ACCOUNT_PAGE_EMAIL_TITLE',"Change email");
define('ACCOUNT_PAGE_EMAIL_DESC',"With this form you can change the email associated with your account.");
define('MAIL_LABEL_PLACEHOLDER',"old email");
define('CHANGE_EMAIL',"Change email");
//FAQ Page 
define('FAQ_TITLE',"FAQs");
define('FAQ_Q1',"is ".SITE_NAME ." really free?");
define('FAQ_A1',"Yes! It is 100% free to use");
define('FAQ_Q2',"Which types of image can I upload?");
define('FAQ_A2',"You can upload images with the following extensions: <span class='black'>PNG, JPG, GIF, WEBP</span>");
define('FAQ_Q3',"Can I upload big images?");
define('FAQ_A3',"Yes! You can upload any image up to ");
define('FAQ_Q4',"Will you delete my image after X days?");
define('FAQ_A4',"Nope. We will only delete your image if it is against our terms &amp; conditions");
define('FAQ_Q5',"Can people browse through uploaded images?");
define('FAQ_A5',"Nope. Every upload is given a random, non-sequential ID");
//Header 
define('GO_UPLOAD',"upload");
define('GO_LOGOUT',"Logout");
define('GO_LOGIN',"Login");
define('GO_REGISTER',"Register");
define('YOUR_ACCOUNT',"My Account");
//Footer
define('GO_FAQ',"FAQ");
define('GO_TC',"Terms &amp; Conditions");
define('GO_CONTACT',"Contact");
// PAGINATION
define ('INVALID_PAGE_NUMBER',"Invalid page number");
define ('PAGINATION_FIRST',"First");
define ('PAGINATION_NEXT',"Next");
define ('PAGINATION_PREVIOUS',"Previous");
define ('PAGINATION_LAST',"Last");
?>