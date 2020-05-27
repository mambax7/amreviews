<?php namespace XoopsModules\Amreviews\Locale;

/**
 *
 * Class to define MetaCat module constant values. These constants are
 * used to make the code easier to read and to keep values in central
 * location if they need to be changed.  These should not normally need
 * to be modified. If they are to be modified it is recommended to change
 * the value(s) before module installation. Additionally the module may not
 * work correctly if trying to upgrade if these values have been changed.
 *
 **/
interface fr_FR
{
    public const INTERFACE_CONSTANT = 'FR-Interface constant';
    /**
     * Admin header menu.
     */
    public const GENERALSET = 'FR-Prefs FRENCH';
    public const GOTOMOD = 'FR-Go to mod';
    public const HELP = 'FR-Help';
    public const MODULEADMIN = 'FR-Admin :';
    public const INDEX = 'FR-Index';
    public const CAT = 'FR-Categories';
    public const REVIEWS = 'FR-Reviews';
    public const IMAGES = 'FR-Images';
    public const PERMS = 'FR-Permissions';
    public const ABOUT = 'FR-About';
    /**
     * Misc. (used on more than one page)
     */
    public const SERVERSTATS = 'FR-Server Information';
    public const UPLOADMAX = 'FR-Maximum upload size: ';
    public const POSTMAX = 'FR-Maximum post size: ';
    public const UPLOADS = 'FR-Uploads allowed: ';
    public const UPLOAD_ON = 'FR-On';
    public const UPLOAD_OFF = 'FR-Off';
    public const GDIMGSPPRT = 'FR-GD image lib supported: ';
    public const GDIMGON = 'FR-Yes';
    public const GDIMGOFF = 'FR-No';
    public const GDIMGVRSN = 'FR-GD image lib version: ';
    public const DBUPDATED = 'FR-Database updated!';
    public const DBNOUPDATED = 'FR-Database not updated!';
    public const DBCONFMDEL = 'FR-Are you sure you want to delete this item?';
    public const DBDELETED = 'FR-Item deleted!';
    public const DBNOTDELETED = 'FR-Item not deleted!';
    public const CLICKEDIT = 'FR-Click to edit.';
    public const CLICKDELETE = 'FR-Click to delete.';
    public const STATUSSHOW = 'FR-Status: Published.';
    public const STATUSHIDE = 'FR-Status: Hidden.';
    public const FRMCAPNOHTML = 'FR-&nbsp;Allow HTML.';
    public const FRMCAPNOBR = 'FR-&nbsp;Convert line breaks (deselect when using WYSIWYG editors).';
    public const FRMCAPNOSMLY = 'FR-&nbsp;Allow XOOPS smiley icons.';
    public const FRMCAPNOXCDE = 'FR-&nbsp;Allow XOOPS codes.';
    public const FRMCAPNOXIMG = 'FR-&nbsp;Allow display of images with XOOPS codes.';
    public const IMGCONFDEL = 'FR-Are you sure you want to delete this image?';
    public const IMGCONFDELIU = 'FR-Are you sure you want to delete this image?<br>There are %d review(s) using this image!';
    /**
     * index.php
     */
    public const SUMMARY = 'FR-Module Stats';
    public const WAITVALCAP = 'FR-Validation:';
    public const WAITVAL = 'FR-%s reviews are waiting to be <a href=\'validate.php\'>validated</a>.';
    public const REVIEWTOTCAP = 'FR-No. reviews:';
    public const REVIEWTOT = 'FR-%s <a href=\'review.php\'>reviews</a>.';
    public const CATETOTCAP = 'FR-No. categories:';
    public const CATETOT = 'FR-%s <a href=\'category.php\'>categories</a>.';
    public const CATTBLCAP = 'FR-Categories';
    public const VIEWSCAP = 'FR-No. views:';
    public const VIEWS = 'FR-%s total <a href=\'review.php\'>reviews</a> views.';
    public const PUBLISHEDCAP = 'FR-Published:';
    public const PUBLISHED = 'FR-%s <a href=\'review.php\'>reviews</a> have been published.';
    public const HIDDENCAP = 'FR-Hidden:';
    public const HIDDEN = 'FR-%s <a href=\'review.php\'>reviews</a> are hidden (includes unvalidated <a href=\'review.php\'>reviews</a>).';
    /**
     * category.php
     */
    public const CATCAPTION = 'FR-Add a category:';
    public const CATCAPSAVE = 'FR-Save';
    public const CATCAPTIONED = 'FR-Edit a category:';
    public const CATCAPSAVEED = 'FR-Save changes';
    /**
     * catform.inc.php
     */
    public const CATCAPTTL = 'FR-Category title:';
    public const CATCAPDESC = 'FR-Description:';
    public const CATCAPPAR = 'FR-Parent category:';
    public const CATCAPPARSLT = 'FR-Select parent as required:';
    public const CATCAPSRT = 'FR-Weight:';
    public const CATCAPDSPLY = 'FR-Publish:';
    public const CATCAPDSPLYTXT = 'FR-&nbsp;Select to show this category.';
    /**
     * review.php
     */
    public const REVIEWTBLCAP = 'FR-Reviews:';
    public const REVCAPID = 'FR-ID';
    public const REVCAPTTL = 'FR-Title';
    public const FRMCAPLNKPRVW = 'FR-Click to preview';
    public const REVCAPTION = 'FR-Add a review:';
    public const REVCAPSAVE = 'FR-Save';
    public const REVCAPEDIT = 'FR-Edit review:';
    /**
     * reviewform.inc.php
     */
    //const _REVCAPTTL = 'FR-Review title:';
    public const REVCAPSUBTTL = 'FR-Subtitle:';
    public const CAPSAUTHOR = 'FR-Author:';
    public const CAPSDETAILS = 'FR-Item details:';
    public const CAPSTEASER = 'FR-Teaser:';
    public const CAPSMAINREVIEW = 'FR-Main review:';
    public const CAPSKEYWORDS = 'FR-Keywords:';
    public const CAPSKEYWORDSDSC = 'FR-Add comma separated list of keywords for meta headers and site search.<br> Example: &quot;key, word, for, search, meta tags&quot;';
    public const CATCAP = 'FR-Category:';
    public const CATCAPSLT = 'FR-Select a category';
    public const CAPDSPLYREV = 'FR-Publish:';
    public const CAPDSPLYREVTXT = 'FR-display this review.';
    public const CAPSDDATE = 'FR-Published date:';
    public const CAPSSTARTDATE = 'FR-Start date:';
    public const CAPSSTARTDTBX = 'FR-Set when to start display of review (de-select to remove display restriction).<br>';
    public const CAPSSTARTDTYN = 'FR-<br>Remove start date: ';
    public const CAPSENDDATE = 'FR-End date:';
    public const CAPSENDDTBX = 'FR-Set when to end display of review (de-select to remove display restriction).<br>';
    public const CAPSENDDTYN = 'FR-<br>Remove expiry date: ';
    public const PAGETTL = 'FR-Review title as page title:';
    //const _PAGETTLDSC =    'The default page title behaviour - can be set individually in review.';
    public const PAGETTL_OPT_0 = 'FR-None: default XOOPS page title';
    public const PAGETTL_OPT_1 = 'FR-Yes: &lt;module name&gt; - &lt;review title&gt;';
    public const PAGETTL_OPT_2 = 'FR-Yes: &lt;review title&gt; - &lt;module name&gt;';
    public const KEYWORD = 'FR-Keyword meta header options:';
    public const KEYWORD_OPT_0 = 'FR-None: default XOOPS meta tags';
    public const KEYWORD_OPT_1 = 'FR-Yes: review\s meta tags only';
    public const KEYWORD_OPT_2 = 'FR-Yes: review\'s and XOOPS meta tags';
    public const CAPCOMMENTS = 'FR-Allow comments:';
    public const CAPCOMMENTSTXT = 'FR-&nbsp;Allow comments for this review.';
    /**
     * Image.php
     */
    public const IMGUPLOAD = 'FR-Upload images:';
    public const IMGUPFILE = 'FR-Select image:';
    public const IMGUPBUTTON = 'FR-Upload';
    public const IMGUPLOADFNL = 'FR-<b>Final upload path:</b> ';
    public const IMGUPLOADTMP = 'FR-<b>Temp upload path:</b> ';
    public const IMGUPLOADMAX = 'FR-<b>Max. file size:</b> ';
    public const IMGUPLOADFN = 'FR-&nbsp;Select to keep original filename.';
    public const IMGUPLOADED = 'FR-Image uploaded successfully';
    public const DELETEIMGCAP = 'FR-Delete an image:';
    public const SELECTIMGCAP = 'FR-Select image:';
    public const HIWIDTH = 'FR-Default highlight width:';
    public const THUMBWIDTH = 'FR-Default thumbnail width:';
    public const DELTHUMBS = 'FR-Delete thumbnails:';
    public const DELTHUMBSCAP = 'FR-';
    public const DELIMAGEBUT = 'FR-Delete';
    public const DELIMG = 'FR-Delete image:';
    public const IMGMAINDEL = 'FR-Main image........';
    public const IMGHIGHDEL = 'FR-Highlight image...';
    public const IMGTHUMBDEL = 'FR-Thumbnail image...';
    public const IMGDELERR = 'FR-<b>Please note:</b> One or more of the images could not be deleted. Either the file(s) do not exist, or I do not have sufficient permissions.';
    public const IMGRETURN = 'FR-Return to image admin';
    public const IMGDELETING = 'FR-Deleting:';
    /**
     * perms.php
     */
    public const CATPERMTTL = 'FR-Category permissions';
    public const CATPERMDSC = 'FR-Select who can view which category:';
    // 0.1 Alpha 2

    public const REVCAP_VISIBLE = 'FR-Visible:';
    public const REVCAP_ACTIONS = 'FR-Actions:';
    public const THUMBNAIL_INFO = 'FR-This will also create thumbnail and highlight images';
    public const ERROR_UNSUPPORTED_TYPE = 'FR-This will also create thumbnail and highlight images';
    public const ERROR_PHOTO_NOT_UPLOADED = 'FR-Error: photo not uploaded';
    public const ERROR_NOT_MOVED_TO_TEMP = 'FR-File could not be moved to local temp dir';
    public const ERROR_PERMISSIONS_NOT_CHANGED = 'FR-I was unable to change the temp file\'s permissions';
    public const ERROR_FILE_NOT_COPIED = 'FR-Sorry, I was unable to copy the uploaded file from:';
    public const ERROR_TEMP_NOT_DELETED = 'FR-I was unable to delete the temp copy of the uploaded file:';
    public const ERROR_FILE_EXISTS_RENAMED = 'FR-already exists in the photo directory, so I have renamed it to';
    //generic values
    public const AM_ERROR_BAD_PHP = 'FR-The module requires PHP <b>%s</b>, but <b>%s</b> is installed';
    public const AM_ERROR_BAD_XOOPS = 'FR-The module requires XOOPS <b>%s</b>, but <b>%s</b> is installed';
    //global permissons
    public const PERMISSIONS = 'FR-Global permissions';
    public const PERMISSIONS_DSC = 'FR-Select Groups that can:';
    public const PERMISSIONS_GLOBAL_4 = 'FR-Rate by User';
    public const PERMISSIONS_GLOBAL_8 = 'FR-Submit by User';
    public const PERMISSIONS_GLOBAL_16 = 'FR-Auto approve';
    //permissions
    public const PERMISSIONS_GLOBAL = 'FR-Permissions';
    public const PERMISSIONS_GLOBAL_DESC = 'FR-Select Groups that can:';
    public const PERMISSIONS_APPROVE = 'FR-Approve';
    public const PERMISSIONS_APPROVE_DESC = 'FR-Select Groups that can Approve';
    public const PERMISSIONS_SUBMIT = 'FR-Submit';
    public const PERMISSIONS_SUBMIT_DESC = 'FR-Select Groups that can Submit';
    public const PERMISSIONS_VIEW = 'FR-View';
    public const PERMISSIONS_VIEW_DESC = 'FR-Select Groups that can View';
    //Permissions
    public const PERMISSIONS_NOPERMSSET = 'FR-Permission cannot be set: No Rate created yet! Please create a Rate first.';
    // server Info -----------------------------------------------
    public const DOWN_IMAGEINFO = 'FR-Server status';
    public const DOWN_NOTSET = 'FR-Upload path not set';
    public const DOWN_SERVERPATH = 'FR-Server path to XOOPS root: ';
    public const DOWN_UPLOADPATH = 'FR-Current upload path: ';
    public const DOWN_METAVERSION = "<span style='font-weight: bold;'>Downloads meta version:</span> ";
    public const DOWN_SPHPINI = "<span style='font-weight: bold;'>Information taken from PHP ini file:</span>";
    public const DOWN_SAFEMODESTATUS = 'FR-Safe mode status: ';
    public const DOWN_REGISTERGLOBALS = 'FR-Register globals: ';
    public const DOWN_SERVERUPLOADSTATUS = 'FR-Server uploads status: ';
    public const DOWN_MAXUPLOADSIZE = 'FR-Max upload size permitted (upload_max_filesize directive in php.ini): ';
    public const DOWN_MAXPOSTSIZE = 'FR-Max post size permitted (post_max_size directive in php.ini): ';
    public const DOWN_SAFEMODEPROBLEMS = 'FR- (This may cause problems)';
    public const DOWN_GDLIBSTATUS = 'FR-GD library support: ';
    public const DOWN_GDLIBVERSION = 'FR-GD Library version: ';
    public const DOWN_GDON = "<span style='font-weight: bold;'>Enabled</span> (Thumbsnails available)";
    public const DOWN_GDOFF = "<span style='font-weight: bold;'>Disabled</span> (No thumbnails available)";
    public const DOWN_OFF = "<span style='font-weight: bold;'>OFF</span>";
    public const DOWN_ON = "<span style='font-weight: bold;'>ON</span>";
    public const DOWN_CATIMAGE = 'FR-Category images';
    public const DOWN_SCREENSHOTS = 'FR-Screenshot images';
    public const DOWN_MAINIMAGEDIR = 'FR-Main images';
    public const DOWN_FCATIMAGE = 'FR-Category image path';
    public const DOWN_FSCREENSHOTS = 'FR-Screenshot image path';
    public const DOWN_FMAINIMAGEDIR = 'FR-Main image path';
    public const DOWN_FUPLOADIMAGETO = 'FR-Upload image: ';
    public const DOWN_FUPLOADPATH = 'FR-Upload path:';
    public const DOWN_FUPLOADURL = 'FR-Upload URL:';
    public const DOWN_FOLDERSELECTION = 'FR-Select upload destination';
    public const DOWN_FSHOWSELECTEDIMAGE = 'FR-Display selected image';
    public const DOWN_FUPLOADIMAGE = 'FR-Upload new image to selected destination';
    public const DOWN_MEMORYLIMIT = 'FR-Memory Limit';
    public const DOWN_UPLOADPATHDSC = 'FR-Note. Upload path *MUST* contain the full server path of your upload folder.';
    /**
     * Defines for index.php
     */
    public const NAVBCTOP = 'FR-Top'; // Navigation BreadCrumbs 'Top'
    /**
     * index.php - reviews listing.
     */
    public const REVIEWEDBY = 'FR-Reviewed by:';
    public const NOREVIEWCAP = 'FR-There are currently no reviews in this category.';
    public const NOPERMCATMSG = 'FR-You do not have permission to view this category. Do you need to log in?';
    /**
     * Generic that can go anywhere and notice messages.
     */
    public const GENON = 'FR-on';
    public const READCAP = 'FR-reads';
    /**
     * review.php
     */
    public const SUBTTLCAP = 'FR-Subtitle:';
    public const STARALTNORATE = 'FR-Not rated.';
    public const OURRATECAP = 'FR-Our rating:';
    public const USERRATECAP = 'FR-User rating:';
    public const USERRATEALT = 'FR-Our users have rated this: %s/5 from %s votes.'; // first %s replaced with vote, second with number of votes.
    public const DETAILSCAP = 'FR-Item details:';
    public const BACKCAP = 'FR-Back';
    public const PRINTCAP = 'FR-Click for printer friendly version';
    public const EMAILCAP = 'FR-Click to send to friend';
    public const PDFCAP = 'FR-Click for PDF version';
    public const RSSCAP = 'FR-RSS feed.';
    public const EDITCAP = 'FR-Click to edit';
    public const DELETECAP = 'FR-Click to delete';
    public const PAGENEXT = 'FR-next';
    public const PAGEPREV = 'FR-prev';
    public const PAGENUM = 'FR-Page';
    public const PAGEOF = 'FR-of';
    /**
     * rate.php
     */
    public const ALRDYVTD = 'FR-It appears you\'ve already voted!';
    public const VOTED = 'FR-Thanks for your vote!';
    public const DBVOTEFAIL = 'FR-Sorry, there was an error and your vote was not recorded.';
    public const RATEPGNM = 'FR-Submit rating';
    public const RATEFRMCAP = 'FR-Rate';
    public const RATETYPECAP = 'FR-Type:';
    public const RATETYPEONLY = 'FR-Rate only';
    public const RATETYPERANDC = 'FR-Rate and comment';
    public const RATETYPECOMM = 'FR-Comment only';
    public const CAPRATE = 'FR-Rating:';
    public const CAPRATESLT = 'FR-Select a rating';
    public const CAPRATE1 = 'FR-*';
    public const CAPRATE2 = 'FR-* *';
    public const CAPRATE3 = 'FR-* * *';
    public const CAPRATE4 = 'FR-* * * *';
    public const CAPRATE5 = 'FR-* * * * *';
    public const FRMCAPSDTTL = 'FR-Subject:';
    public const COMMENTTXT = 'FR-Comments:';
    public const RATESUBMIT = 'FR-Submit';
    public const RATERESET = 'FR-Reset';
    /**
     * Print.php
     */
    public const PRINTAUTHOR = 'FR-Reviewed by:';
    public const PRINTPUBBY = 'FR-Review published on:';
    // email.php
    public const MD_EMAILHEADTTL = 'FR-E-mail Event to friend';
    public const MD_EMAILYOURNAME = 'FR-Your name:';
    public const MD_EMAILYOUREMAIL = 'FR-Your e-mail:';
    public const MD_EMAILRECIPIENT = 'FR-Recipient:';
    public const MD_EMAILMESSAGE = 'FR-Your message:';
    public const MD_EMAILMESSAGEDESC = 'FR-This will be included in the e-mail.';
    public const MD_EMAILSEND = 'FR-send';
    public const MD_EMAILSET = 'FR-reset';
    public const MD_EMAILSECNOTE = 'FR-<strong>Please note:</strong> Some security information will be sent along with the e-mail to help trace anyone who abuses this service.';
    public const MD_EMAILNOTON = 'FR-This feature is not enabled.';
    // makepdf.php and associated PDF
    public const MD_PDFPOSTEDON = 'FR-Posted on: ';
    public const MD_PDFPAGE = 'FR-Page';
    public const PDF_NOT_INSTALLED = 'FR-TCPDF for XOOPS not installed';
    //const _PRINTPUBBY = 'FR-Review published on:';
    //    public const VOTED = 'FR-Voted';
    public const NAME = 'FR-AM Reviews';
    public const DESC = 'FR-A reviews module for XOOPS';
    /**
     * xoops_version.php - config options
     */
    public const INDXCOL = 'FR-Category columns:';
    public const INDXCOLDSC = 'FR-Number of columns in category.';
    public const DATEFRMT = 'FR-Review page date format:';
    public const DATEFRMTDSC = 'FR-Define the date format in review page. See PHP\'s <a href=\'http://www.php.net/date\' target=\'_blank\'>date format page</a> for the different date format characters you can use.';
    public const DATEFRMTINDX = 'FR-Review list date format:';
    public const DATEFRMTINDXDSC = 'FR-Define the date format in reviews list on index. See PHP\'s <a href=\'http://www.php.net/date\' target=\'_blank\'>date format page</a> for the different date format characters you can use.';
    public const DATEFRMTPRT = 'FR-Print page date format:';
    public const DATEFRMTPRTDSC = 'FR-Define the date format for the print version. See PHP\'s <a href=\'http://www.php.net/date\' target=\'_blank\'>date format page</a> for the different date format characters you can use.';
    public const DATEFRMTPDF = 'FR-PDF page date format:';
    public const DATEFRMTPDFDSC = 'FR-Define the date format for the PDF version. See PHP\'s <a href=\'http://www.php.net/date\' target=\'_blank\'>date format page</a> for the different date format characters you can use.';
    public const SHWRVWDBY = 'FR-Show reviewer:';
    public const SHWRVWDBYDSC = 'FR- ';
    public const DETAILTPL = 'FR-Item details template:';
    public const DETAILTPLDSC = 'FR-Template for items details field in review.';
    public const INCREMENTADMIN = 'FR-Do not increment admin views:';
    public const INCREMENTADMINDSC = 'FR-Do not increment review views/reads for admins.';
    public const DETAILTPLTXT = 'FR-<b>Part No:</b>';
    public const EDITADMIN = 'FR-Admin editor:';
    public const EDITADMINDSC = 'FR- ';
    public const PHOTOPATH = 'FR-Photo location:';
    public const PHOTOPATHDSC = 'FR-The location of review photos.';
    public const MAXUPADMIN = 'FR-Maximum file size admin:';
    public const MAXUPADMINDSC = 'FR-Maximum file size for photos in the admin area. In Kilobytes (KB)';
    public const SHWPRINT = 'FR-Printable version:';
    public const SHWPRINTDSC = 'FR-Allow printable version.';
    public const ALLOWEMAIL = 'FR-E-mail to friend:';
    public const ALLOWEMAILDSC = 'FR-Allow e-mail to friend feature.';
    public const EMLLOGGEDIN = 'FR-Log in to use e-mail to friend:';
    public const EMLLOGGEDINDSC = 'FR- ';
    public const OPTION_EMLOWNMSG = 'FR-Allow own message';
    public const OPTION_EMLOWNMSGDSC = 'FR-Allow user to add their own message to e-mail.';
    public const OPTION_EMLMSGSBJCT = 'FR-E-mail subject';
    public const OPTION_EMLMSGSBJCTDSC = 'FR-the text that will appear in the e-mail\'s subject field.';
    public const OPTION_EMLMSGSUBJECT = 'FR-A friend recommended this Review';
    public const OPTION_EMLMSGCHRS = 'FR-No. characters in own message';
    public const OPTION_EMLMSGCHRSDSC = 'FR-the maximum number of characters user is allowed to send in own message.';
    public const OPTION_EMAILTXT = 'FR-E-mail message';
    public const OPTION_EMAILTXTSC = 'FR-The text that will be sent in the e-mail to a friend message.';
    public const OPTION_EMAILTXTMSG = 'FR-Hello';
    public const IMGHIGHWIDTH = 'FR-Default highlight image width:';
    public const IMGHIGHWIDTHDSC = 'FR-Set the default width of highlight images (these appear in the review listings under categories).';
    public const IMGTHUMBWIDTH = 'FR-Default thumbnail image width:';
    public const IMGTHUMBWIDTHDSC = 'FR-Set the default width of thumbnail images (these appear in the review article).';
    public const SHOWSUBCATS = 'FR-Show sub categories:';
    public const SHOWSUBCATSDSC = 'FR-This will show the first level of subcategories.';
    public const HIDENOPERMCATS = 'FR-Hide no access categories:';
    public const HIDENOPERMCATSDSC = 'FR-Hide categories to those who do not have access permissions.';
    public const PAGETTLDEF = 'FR-Default page title:';
    public const PAGETTLDEFDSC = 'FR-The default page title behaviour - can be set individually in review.';
    public const PAGETTLDEF_OPT_0 = 'FR-None: default XOOPS page title';
    public const PAGETTLDEF_OPT_1 = 'FR-Yes: &lt;module name&gt; - &lt;review title&gt;';
    public const PAGETTLDEF_OPT_2 = 'FR-Yes: &lt;review title&gt; - &lt;module name&gt;';
    public const PAGEMETADEF = 'FR-Default page meta header:';
    public const PAGEMETADEFDSC = 'FR-The default page meta header behaviour - can be set individually in review.';
    public const PAGEMETADEF_OPT_0 = 'FR-None: default XOOPS meta tags';
    public const PAGEMETADEF_OPT_1 = 'FR-Yes: review\'s meta tags only';
    public const PAGEMETADEF_OPT_2 = 'FR-Yes: review\'s and XOOPS meta tags';
    public const LOGGEDINVOTE = 'FR-Logged in to vote:';
    public const LOGGEDINVOTEDSC = 'FR-Whether or not the user has to be logged in to vote.';
    public const ALLOWPDF = 'FR-PDF version:';
    public const ALLOWPDFDSC = 'FR-Allow PDF page version';
    public const HILITEIMG = 'FR-Highlight image:';
    public const HILITEIMGDSC = 'FR-How to show highlight image.';
    public const HILITEIMG_OPT_0 = 'FR-New window';
    public const HILITEIMG_OPT_1 = 'FR-Lightbox';
    /**
     * admin/menu.php
     */
    public const MENU1 = 'FR-Index';
    public const MENU2 = 'FR-Categories';
    public const MENU3 = 'FR-Reviews';
    public const MENU4 = 'FR-Images';
    public const MENU5 = 'FR-Permissions';
    public const ERROR_COLUMN = 'FR-Error Column';
    public const UPGRADEFAILED0 = 'FR-Upgrade 1 Failed';
    public const UPGRADEFAILED1 = 'FR-Upgrade 1 Failed';
    public const UPGRADEFAILED2 = 'FR-Upgrade 2 Failed';
    //preferences
    //    if (!defined('_CONFIG_SAVED'))
    public const CONFIG_SAVED = 'FR-Saved';
    public const CONFIG_MAINPAGE = 'FR-Main page';
    public const CONFIG_MESSAGE = 'FR-Message to be displayed before the form';
    public const CONFIG_EDITOR = 'FR-Editor';
    public const CONFIG_COPYMESSAGE = 'FR-Propose a copy of this message';
    //testdata
    public const GENERATE_TESTDATA = 'FR-Generate Test Data';
    public const ADD_SAMPLEDATA = 'FR-Add Sample Data';
}
