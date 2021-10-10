<?php 
//SESSION CSFR
define ('CSRF_ERROR',"CSRF token mismatch");
//ADMIN
define('NOT_ADMIN',"Non sei autorizzato ad effettuare questa azione.");
//Register Page
define('REGISTER_ALL_FIELD_NEEDED',"Tutti i campi devono essere compilati");
define('REGISTER_MAIL_NOT_VALID',"L'email che hai inserito non è valida");
define('MAILS_NOT_IDENTICAL',"L'email che hai inserito non combacia con l'email di conferma che hai inserito");
define('PSW_TOO_SHORT',"Inserisci una password più lunga (almeno 8 caratteri)");
define('PSWS_NOT_IDENTICAL',"La password e la password di conferma inserite non combaciano");
define('ACCOUNT_CREATED',"Il tuo account è stato creato ed hai già effettuato l'accesso");
define('MAIL_ALREADY_IN_USE',"Un account abbinato a questa email esiste già");
//Account Page
define('NO_IMAGE_LIST',"Non hai ancora caricato immagini!");
define('ACCOUNT_PAGE_TITLE',"Il tuo account");
define('ACCOUNT_PAGE_DESC',"Benvenuto nel tuo account. Puoi visualizzare tutte le immagini caricate qui, vedere la data di caricamento e cancellarle.");
define('ACCOUNT_DEL_IMAGE',"CANCELLA immagine");
define('UPLOAD_TIME',"caricato il");
//Contact Page
define('CONTACT_PAGE_TITLE',"Contatti");
define('CONTACT_PAGE_DESC',"Se hai bisogno di contattarci, mandaci una email a ". CONTACT_EMAIL);
//Ban Page
define('NOT_NUMERIC_ID',"Questo ID non sembra valido, gli id degli utenti devono essere numerici");
define('CANNOT_BAN_ADMIN',"Non puoi bannare un amministratore.");
define('BAN_SUCCESS',"L'utente è stato bannato e tutti i suoi dati sono stati rimossi.");
//Delete Page 
define('IMAGE_ID_NOT_VALID',"Questo ID non sembra essere valido.");
define('DELETE_NO_IMAGE',"Non esiste alcuna immagine con questo ID, potrebbe già essere stata cancellata");
define('DELETE_IMAGE_SUCCESS',"L'immagine con il seguente id è stata rimossa:");
//Moderate Page 
define('NOT_VALID_IP',"Questo indirizzo IP non sembra essere valido");
define('NO_IP_OR_ID',"Nessun ID o IP specificato");
define('NO_IMAGES_USER',"Non è stata trovata alcuna immagine per questo utente");
define('MODERATE_PAGE_TITLE',"Moderazione per");
define('BAN_USER',"Clicka qui per bannare questo utente e rimuovere tutte le sue immagini");
define('IMAGES_LIST_IP',"Queste sono tutte le immagini caricate da questo IP");
//Login/Logout Pages
define('ERROR_NO_MAIL_OR_PSW',"Inserisci sia l'indirizzo email e la password");
define('NOT_VALID_MAIL',"Inserisci un indirizzo email valido");
define('INVALID_LOGIN',"Non esiste alcun account con questo indirizzo email e password");
define('BANNED_USER_LOGIN',"Questo account è stato bannato");
define('LOGIN_SUCCESS',"Hai effettuato l'accesso");
define('LOGOUT_SUCCESS',"Hai effettuato il log out");
define('LOGIN_PAGE_TITLE',"Log in");
define('LOGIN_PAGE_DESC',"Effetua l'accesso con il tuo account per gestire le tue immagini caricate.");
define('FORGOT_PSW',"Dimenticato la Password? Clicca qui");
define('PSW_LABEL_PLACEHOLDER',"password...");
//View Page 
define('IMAGE_REMOVED',"Questa immagine è stata cancellata.");
define('VIEW_LINK',"Link di anteprima (email &amp; chat)");
define('VIEW_DIRECT_LINK',"Link diretto (siti web &amp; backgrounds)");
define('VIEW_HTML',"Codice HTML (website)");
define('VIEW_BBCODE',"BBcode (forum)");
define('VIEW_BBCODE_WITH_LINK',"BBCode con link (forum)");
define('VIEW_ID_IMG',"Id immagine:");
define('VIEW_IMG_SIZE',"Dimensioni immagine:");
define('VIEW_IMG_WEIGHT',"Peso immagine:");
define('VIEW_IMG_TYPE',"Tipo di immagine:");
define('VIEW_IMG_UPLOAD_TIME',"Data di caricamento:");
define('VIEW_IMG_IP_FROM',"IP dell'uploader:");
define('REPORT_IMAGE',"Segnala questa immagine");
define('DELETE_IMAGE',"Cancella questa immagine");
define('VIEW_OTHERS_FROM_SAME_IP',"Visualizza tutte le immagini caricate da questo indirizzo IP.");
define('VIEW_OTHERS_FROM_SAME_USER',"Visualizza le altre immagini caricate da questo utente.");
//Upload Page 
define('NO_ANON_UPLOAD',"I caricamenti da anonimo sono stati disattivati, <a href='register.php'>crea un account</a> o <a href='login.php'>effettua il log in</a> per caricare");
define('NO_REMOTE_UPLOAD',"Il caricamento da remoto non è stato abilitato");
define('ONLY_ONE_UPLOAD_METHOD',"Puoi utilizzare solo un metodo di caricamento alla volta.");
define('NO_IMAGE_SELECTED',"Carica almeno una immagine o dal tuo pc o da remoto.");
define('NOT_VALID_URL',"Questo indirizzo non è valido");
define('DOMAIN_NOT_PERMITTED',"I caricamenti da questo dominio non sono stati abilitati dall'amministratore");
define('TOO_BIG_FILE',"Questo file è troppo grosso");
define('INVALID_IMAGE',"Questa non sembra essere una immagine valida");
define('INVALID_EXTENSION',"Questa estensione non è permessa.");
define('UPLOAD_ERROR',"Errore durante il caricamento del file. Codice Dell'errore:");
define('ERROR_CODE_WEBSITE',"Visita questo indirizzo per i codici di errore: <a href='http://php.net/manual/en/features.file-upload.errors.php' target='_blank'>http://php.net/manual/en/features.file-upload.errors.php</a>");
//Message Page
define('MESSAGE_TITLE',"Messaggio");
//Register Page 
define('REGISTER_PAGE_TITLE',"Registrati");
define('REGISTER_PAGE_DESC',"Puoi registrare un account che ti permetterà di tenere traccia delle tue immagini caricate");
define('REGISTER_LABEL_PLACEHOLDER_MAIL',"email...");
define('REGISTER_LABEL_PLACEHOLDER_MAIL_CONFIRM',"confirm email...");
define('REGISTER_LABEL_PLACEHOLDER_PSW',"password... (8 characters minimum)");
define('REGISTER_LABEL_PLACEHOLDER_PSW_CONFIRM',"confirm password... (8 characters minimum)");
define('REGISTER_LABEL_REGISTER_BUTTON',"Register");
//Main Page 
define('WELCOME_MAIN_TITLE',"Benvenuto su ".SITE_NAME);
define('WELCOME_MAIN_DESC_1',SITE_NAME." è un hosting di immagini privato, utilizzato per gli articoli di <a href='https://videogamezone.eu'>videogamezone.eu</a>. Clicca sul bottone sotto per cominciare a caricare immagini.");
define('WELCOME_MAIN_DESC_2',"Prima di caricare immagini, devi registrare un account (o effettuare il log-in, se ne possiedi già uno) che ti permetterà anche di gestire i tuoi caricamenti.");
define('WHY_USE_TITLE',"Perché usare ".SITE_NAME."?");
define('WHY_USE_GRATIS',"È completamente <span class='black'>gratuito</span>!");
define('WHY_USE_ACCOUNT',"Puoi creare un account e <span class='black'>gestire tutti i tuoi caricamenti</span>");
define('WHY_USE_REMOTE_UPLOAD',"Carica  <span class='black'>immagini da remoto</span>");
define('WHY_USE_FILE_EXT_ALLOWED',"I seguenti tipi di immagini sono ammessi:");
define('WHY_USE_MAX_SIZE',"I file possono pesare al massimo");
define('WHY_USE_FRIENDLY_URL',"URL <span class='black'>Brevi, facili da ricordare</span>!");
//Upload box
define('UPLOAD_BUTTON',"Clicca qui per selezionare una immagine");
define('UPLOAD_BUTTON_CANCEL',"Aspetta, voglio caricare qualcos'altro!");
define('UPLOAD_REMOTE_BUTTON',"Carica immagini remote");
define('UPLOAD_REMOTE_PLACEHOLDER',"Vuoi caricare la tua immagine da remoto? Incolla l'indirizzo qui (http://)");
//TC Page 
define('TC_PAGE_TITLE',"Termini e Condizioni di Utilizzo");
define('TC_PAGE_TERMS_DESC',"Non puoi usare " .SITE_NAME. " per caricare nessuna delle seguenti:");
define('TC_PAGE_NO_COPYRIGHT_IMG',"Immagini sotto copyright (immagini possedute da qualcun'altro) salvo esplicito permesso");
define('TC_PAGE_NO_ILLEGAL_IMAGE',"Immagini che sono considerate illegali");
define('TC_PAGE_INFO_DESC',"Da tenere a mente che quando si utilizza".SITE_NAME.":");
define('TC_PAGE_IP_NOTICE',"Quando si carica una immagine, il tuo indirizzo IP verrà salvato. Non divulgheremo questa informazione a terzi se non richiesto dalle forze di polizia.");
define('TC_PAGE_IMG_DEL_NOTICE',SITE_NAME." ha il diritto di rimuovere qualsiasi immagine a sua discrezione");
//Report Page 
define('IMAGE_ALREADY_REPORTED',"Questa immagine è già stata segnalata ed è in attesa di essere valutata");
define('IMAGE_ALREADY_CHECKED',"Questa immagine è già stata segnalata e, dopo la visione da parte della moderazione, è stata ritenuta accettabile.");
define('IMAGE_REPORTED_NOTICE',"Questa immagine è stata segnalata e verrà valutata dalla moderazione, grazie.");
//Report Mail
define('REPORT_IMAGE_MAIL_TITLE',"Una immagine è stata segnalata: ");
define('REPORT_IMAGE_MAIL_TEXT',"La seguente immagine è stata segnalata:");
//Password reset
define('PSW_RESET_PAGE_TITLE',"Reset Password");
define('PSW_RESET_PAGE_DESC',"Hai dimenticato la password? inserisci il tuo indirizzo e-mail qui sotto. Se un account associato con quella email esiste, riceverai via email una nuova password.");
define('PSW_RESET_EMAIL_PLACEHOLDER',"email...");
define('PSW_RESET_CONFIRM',"Invia richiesta");
define('PSW_RESET_MAIL_TITLE',"Reset Password - ".SITE_NAME);
define('PSW_RESET_MAIL_TEXT',"Ciao,\n Hai richiesto un recupero password del tuo account su ".SITE_NAME.". La tua nuova password è");
define('PSW_RESET_NOTICE',"Una nuova password ti è stata inviata via email");
define('PSW_CHANGED',"Password cambiata");
//Change Password
define('CHANGE_PASSWORD',"Cambia password");
define('ACCOUNT_PAGE_PASSWORD_TITLE',"Cambia Password");
define('ACCOUNT_PAGE_PASSWORD_DESC',"Con questo form puoi cambiare la tua password.");
define('PSW_CHANGED',"Password cambiata");
//Change Email
define('EMAIL_CHANGED',"Email cambiata");
define('ACCOUNT_PAGE_EMAIL_TITLE',"Cambia l'email");
define('ACCOUNT_PAGE_EMAIL_DESC',"Con questo form puoi cambiare l'email associata al tuo account.");
define('MAIL_LABEL_PLACEHOLDER',"vecchia email");
define('CHANGE_EMAIL',"Cambia email");
//FAQ Page 
define('FAQ_TITLE',"FAQs");
define('FAQ_Q1',SITE_NAME ." è veramente gratuito?");
define('FAQ_A1',"Si, il suo uso è completamente gratuito.");
define('FAQ_Q2',"Quali tipologie di file posso caricare?");
define('FAQ_A2',"Puoi caricare le seguenti estensioni di file: <span class='black'>PNG, JPG, GIF, WEBP</span>");
define('FAQ_Q3',"Posso caricare grosse immagini?");
define('FAQ_A3',"Si! puoi caricare qualsiasi immagine fino ad un peso di ");
define('FAQ_Q4',"Cancellerete le mie immagini dopo X giorni?");
define('FAQ_A4',"No. Cancelleremo le tue immagini solo se sono contro i nostri termini e condizioni di utilizzo.");
define('FAQ_Q5',"Can people browse through uploaded images?");
define('FAQ_A5',"Nope. Every upload is given a random, non-sequential ID");
//Header 
define('GO_UPLOAD',"upload");
define('GO_LOGOUT',"Logout");
define('GO_LOGIN',"Login");
define('GO_REGISTER',"Iscriviti");
define('YOUR_ACCOUNT',"Il mio account");
//Footer
define('GO_FAQ',"FAQ");
define('GO_TC',"Termini e Condizioni di Utilizzo");
define('GO_CONTACT',"Contatti");
// PAGINATION
define ('INVALID_PAGE_NUMBER',"Numero di pagina non valido");
define ('PAGINATION_FIRST',"Prima");
define ('PAGINATION_NEXT',"Prossima");
define ('PAGINATION_PREVIOUS',"Precedente");
define ('PAGINATION_LAST',"Ultima");
?>