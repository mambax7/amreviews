<?php namespace XoopsModules\Amreviews\Locale\En_US;

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
interface En_US
{
    public const ERROR_BAD_DEL_PATH2 = 'Could not delete %s directory';
    //Latest Version Check

    public const INTERFACE_CONSTANT = 'Interface constant';
    /**
     * Admin header menu.
     */
    public const GENERALSET = 'Prefs English';
    public const GOTOMOD = 'Go to mod';
    public const HELP = 'Help';
    public const ADMIN = 'Admin :';
    public const MODULEADMIN = 'admin';
    public const INDEX = 'Index';
    public const CAT = 'Categories';
    public const REVIEWS = 'Reviews';
    public const IMAGES = 'Images';
    public const PERMS = 'Permissions';
    public const ABOUT = 'About';
    /**
     * Misc. (used on more than one page)
     */
    public const SERVERSTATS = 'Server Information';
    public const UPLOADMAX = 'Maximum upload size: ';
    public const POSTMAX = 'Maximum post size: ';
    public const UPLOADS = 'Uploads allowed: ';
    public const UPLOAD_ON = 'On';
    public const UPLOAD_OFF = 'Off';
    public const GDIMGSPPRT = 'GD image lib supported: ';
    public const GDIMGON = 'Yes';
    public const GDIMGOFF = 'No';
    public const GDIMGVRSN = 'GD image lib version: ';
    public const DBUPDATED = 'Database updated!';
    public const DBNOUPDATED = 'Database not updated!';
    public const DBCONFMDEL = 'Are you sure you want to delete this item?';
    public const DBDELETED = 'Item deleted!';
    public const DBNOTDELETED = 'Item not deleted!';
    public const CLICKEDIT = 'Click to edit.';
    public const CLICKDELETE = 'Click to delete.';
    public const STATUSSHOW = 'Status: Published.';
    public const STATUSHIDE = 'Status: Hidden.';
    public const FRMCAPNOHTML = '&nbsp;Allow HTML.';
    public const FRMCAPNOBR = '&nbsp;Convert line breaks (deselect when using WYSIWYG editors).';
    public const FRMCAPNOSMLY = '&nbsp;Allow XOOPS smiley icons.';
    public const FRMCAPNOXCDE = '&nbsp;Allow XOOPS codes.';
    public const FRMCAPNOXIMG = '&nbsp;Allow display of images with XOOPS codes.';
    public const IMGCONFDEL = 'Are you sure you want to delete this image?';
    public const IMGCONFDELIU = 'Are you sure you want to delete this image?<br>There are %d review(s) using this image!';
    /**
     * index.php
     */
    public const SUMMARY = 'Module Stats';
    public const WAITVALCAP = 'Validation:';
    public const WAITVAL = '%s reviews are waiting to be <a href=\'validate.php\'>validated</a>.';
    public const REVIEWTOTCAP = 'No. reviews:';
    public const REVIEWTOT = '%s <a href=\'review.php\'>reviews</a>.';
    public const CATETOTCAP = 'No. categories:';
    public const CATETOT = '%s <a href=\'category.php\'>categories</a>.';
    public const CATTBLCAP = 'Categories';
    public const VIEWSCAP = 'No. views:';
    public const VIEWS = '%s total <a href=\'review.php\'>reviews</a> views.';
    public const PUBLISHEDCAP = 'Published:';
    public const PUBLISHED = '%s <a href=\'review.php\'>reviews</a> have been published.';
    public const HIDDENCAP = 'Hidden:';
    public const HIDDEN = '%s <a href=\'review.php\'>reviews</a> are hidden (includes unvalidated <a href=\'review.php\'>reviews</a>).';
    /**
     * category.php
     */
    public const CATCAPTION = 'Add a category:';
    public const CATCAPSAVE = 'Save';
    public const CATCAPTIONED = 'Edit a category:';
    public const CATCAPSAVEED = 'Save changes';
    /**
     * catform.inc.php
     */
    public const CATCAPTTL = 'Category title:';
    public const CATCAPDESC = 'Description:';
    public const CATCAPPAR = 'Parent category:';
    public const CATCAPPARSLT = 'Select parent as required:';
    public const CATCAPSRT = 'Weight:';
    public const CATCAPDSPLY = 'Publish:';
    public const CATCAPDSPLYTXT = '&nbsp;Select to show this category.';
    /**
     * review.php
     */
    public const REVIEWTBLCAP = 'Reviews:';
    public const REVCAPID = 'ID';
    public const REVCAPTTL = 'Title';
    public const FRMCAPLNKPRVW = 'Click to preview';
    public const REVCAPTION = 'Add a review:';
    public const REVCAPSAVE = 'Save';
    public const REVCAPEDIT = 'Edit review:';
    /**
     * reviewform.inc.php
     */
    //public const _REVCAPTTL = 'Review title:';
    public const REVCAPSUBTTL = 'Subtitle:';
    public const CAPSAUTHOR = 'Author:';
    public const CAPSDETAILS = 'Item details:';
    public const CAPSTEASER = 'Teaser:';
    public const CAPSMAINREVIEW = 'Main review:';
    public const CAPSKEYWORDS = 'Keywords:';
    public const CAPSKEYWORDSDSC = 'Add comma separated list of keywords for meta headers and site search.<br> Example: &quot;key, word, for, search, meta tags&quot;';
    public const CATCAP = 'Category:';
    public const CATCAPSLT = 'Select a category';
    public const CAPDSPLYREV = 'Publish:';
    public const CAPDSPLYREVTXT = 'display this review.';
    public const CAPSDDATE = 'Published date:';
    public const CAPSSTARTDATE = 'Start date:';
    public const CAPSSTARTDTBX = 'Set when to start display of review (de-select to remove display restriction).<br>';
    public const CAPSSTARTDTYN = '<br>Remove start date: ';
    public const CAPSENDDATE = 'End date:';
    public const CAPSENDDTBX = 'Set when to end display of review (de-select to remove display restriction).<br>';
    public const CAPSENDDTYN = '<br>Remove expiry date: ';
    public const PAGETTL = 'Review title as page title:';
    //public const _PAGETTLDSC =    'The default page title behaviour - can be set individually in review.';
    public const PAGETTL_OPT_0 = 'None: default XOOPS page title';
    public const PAGETTL_OPT_1 = 'Yes: &lt;module name&gt; - &lt;review title&gt;';
    public const PAGETTL_OPT_2 = 'Yes: &lt;review title&gt; - &lt;module name&gt;';
    public const KEYWORD = 'Keyword meta header options:';
    public const KEYWORD_OPT_0 = 'None: default XOOPS meta tags';
    public const KEYWORD_OPT_1 = 'Yes: review\s meta tags only';
    public const KEYWORD_OPT_2 = 'Yes: review\'s and XOOPS meta tags';
    public const CAPCOMMENTS = 'Allow comments:';
    public const CAPCOMMENTSTXT = '&nbsp;Allow comments for this review.';
    /**
     * Image.php
     */
    public const IMGUPLOAD = 'Upload images:';
    public const IMGUPFILE = 'Select image:';
    public const IMGUPBUTTON = 'Upload';
    public const IMGUPLOADFNL = '<b>Final upload path:</b> ';
    public const IMGUPLOADTMP = '<b>Temp upload path:</b> ';
    public const IMGUPLOADMAX = '<b>Max. file size:</b> ';
    public const IMGUPLOADFN = '&nbsp;Select to keep original filename.';
    public const IMGUPLOADED = 'Image uploaded successfully';
    public const DELETEIMGCAP = 'Delete an image:';
    public const SELECTIMGCAP = 'Select image:';
    public const HIWIDTH = 'Default highlight width:';
    public const THUMBWIDTH = 'Default thumbnail width:';
    public const DELTHUMBS = 'Delete thumbnails:';
    public const DELTHUMBSCAP = '';
    public const DELIMAGEBUT = 'Delete';
    public const DELIMG = 'Delete image:';
    public const IMGMAINDEL = 'Main image........';
    public const IMGHIGHDEL = 'Highlight image...';
    public const IMGTHUMBDEL = 'Thumbnail image...';
    public const IMGDELERR = '<b>Please note:</b> One or more of the images could not be deleted. Either the file(s) do not exist, or I do not have sufficient permissions.';
    public const IMGRETURN = 'Return to image admin';
    public const IMGDELETING = 'Deleting:';
    /**
     * perms.php
     */
    public const CATPERMTTL = 'Category permissions';
    public const CATPERMDSC = 'Select who can view which category:';
    // 0.1 Alpha 2

    public const REVCAP_VISIBLE = 'Visible:';
    public const REVCAP_ACTIONS = 'Actions:';
    public const THUMBNAIL_INFO = 'This will also create thumbnail and highlight images';
    public const ERROR_UNSUPPORTED_TYPE = 'This will also create thumbnail and highlight images';
    public const ERROR_PHOTO_NOT_UPLOADED = 'Error: photo not uploaded';
    public const ERROR_NOT_MOVED_TO_TEMP = 'File could not be moved to local temp dir';
    public const ERROR_PERMISSIONS_NOT_CHANGED = 'I was unable to change the temp file\'s permissions';
    public const ERROR_FILE_NOT_COPIED = 'Sorry, I was unable to copy the uploaded file from:';
    public const ERROR_TEMP_NOT_DELETED = 'I was unable to delete the temp copy of the uploaded file:';
    public const ERROR_FILE_EXISTS_RENAMED = 'already exists in the photo directory, so I have renamed it to';
    //generic values
    public const AM_ERROR_BAD_PHP = 'The module requires PHP <b>%s</b>, but <b>%s</b> is installed';
    public const AM_ERROR_BAD_XOOPS = 'The module requires XOOPS <b>%s</b>, but <b>%s</b> is installed';
    //global permissons
    //    public const PERMISSIONS = 'Global permissions';
    public const PERMISSIONS_DSC = 'Select Groups that can:';
    public const PERMISSIONS_GLOBAL_4 = 'Rate by User';
    public const PERMISSIONS_GLOBAL_8 = 'Submit by User';
    public const PERMISSIONS_GLOBAL_16 = 'Auto approve';
    //permissions
    public const PERMISSIONS_GLOBAL = 'Permissions';
    public const PERMISSIONS_GLOBAL_DESC = 'Select Groups that can:';
    public const PERMISSIONS_APPROVE = 'Approve';
    public const PERMISSIONS_APPROVE_DESC = 'Select Groups that can Approve';
    public const PERMISSIONS_SUBMIT = 'Submit';
    public const PERMISSIONS_SUBMIT_DESC = 'Select Groups that can Submit';
    public const PERMISSIONS_VIEW = 'View';
    public const PERMISSIONS_VIEW_DESC = 'Select Groups that can View';
    //Permissions
    public const PERMISSIONS_NOPERMSSET = 'Permission cannot be set: No Rate created yet! Please create a Rate first.';
    // server Info -----------------------------------------------
    public const DOWN_IMAGEINFO = 'Server status';
    public const DOWN_NOTSET = 'Upload path not set';
    public const DOWN_SERVERPATH = 'Server path to XOOPS root: ';
    public const DOWN_UPLOADPATH = 'Current upload path: ';
    public const DOWN_METAVERSION = "<span style='font-weight: bold;'>Downloads meta version:</span> ";
    public const DOWN_SPHPINI = "<span style='font-weight: bold;'>Information taken from PHP ini file:</span>";
    public const DOWN_SAFEMODESTATUS = 'Safe mode status: ';
    public const DOWN_REGISTERGLOBALS = 'Register globals: ';
    public const DOWN_SERVERUPLOADSTATUS = 'Server uploads status: ';
    public const DOWN_MAXUPLOADSIZE = 'Max upload size permitted (upload_max_filesize directive in php.ini): ';
    public const DOWN_MAXPOSTSIZE = 'Max post size permitted (post_max_size directive in php.ini): ';
    public const DOWN_SAFEMODEPROBLEMS = ' (This may cause problems)';
    //    public const DOWN_GDLIBSTATUS = 'GD library support: ';
    //    public const DOWN_GDLIBVERSION = 'GD Library version: ';
    public const DOWN_GDON = "<span style='font-weight: bold;'>Enabled</span> (Thumbsnails available)";
    public const DOWN_GDOFF = "<span style='font-weight: bold;'>Disabled</span> (No thumbnails available)";
    public const DOWN_OFF = "<span style='font-weight: bold;'>OFF</span>";
    public const DOWN_ON = "<span style='font-weight: bold;'>ON</span>";
    public const DOWN_CATIMAGE = 'Category images';
    public const DOWN_SCREENSHOTS = 'Screenshot images';
    public const DOWN_MAINIMAGEDIR = 'Main images';
    public const DOWN_FCATIMAGE = 'Category image path';
    public const DOWN_FSCREENSHOTS = 'Screenshot image path';
    public const DOWN_FMAINIMAGEDIR = 'Main image path';
    public const DOWN_FUPLOADIMAGETO = 'Upload image: ';
    public const DOWN_FUPLOADPATH = 'Upload path:';
    public const DOWN_FUPLOADURL = 'Upload URL:';
    public const DOWN_FOLDERSELECTION = 'Select upload destination';
    public const DOWN_FSHOWSELECTEDIMAGE = 'Display selected image';
    public const DOWN_FUPLOADIMAGE = 'Upload new image to selected destination';
    public const DOWN_MEMORYLIMIT = 'Memory Limit';
    public const DOWN_UPLOADPATHDSC = 'Note. Upload path *MUST* contain the full server path of your upload folder.';
    /**
     * Defines for index.php
     */
    public const NAVBCTOP = 'Top'; // Navigation BreadCrumbs 'Top'
    /**
     * index.php - reviews listing.
     */
    public const REVIEWEDBY = 'Reviewed by:';
    public const NOREVIEWCAP = 'There are currently no reviews in this category.';
    public const NOPERMCATMSG = 'You do not have permission to view this category. Do you need to log in?';
    /**
     * Generic that can go anywhere and notice messages.
     */
    public const GENON = 'on';
    public const READCAP = 'reads';
    /**
     * review.php
     */
    public const SUBTTLCAP = 'Subtitle:';
    public const STARALTNORATE = 'Not rated.';
    public const OURRATECAP = 'Our rating:';
    public const USERRATECAP = 'User rating:';
    public const USERRATEALT = 'Our users have rated this: %s/5 from %s votes.'; // first %s replaced with vote, second with number of votes.
    public const DETAILSCAP = 'Item details:';
    public const BACKCAP = 'Back';
    public const PRINTCAP = 'Click for printer friendly version';
    public const EMAILCAP = 'Click to send to friend';
    public const PDFCAP = 'Click for PDF version';
    public const RSSCAP = 'RSS feed.';
    public const EDITCAP = 'Click to edit';
    public const DELETECAP = 'Click to delete';
    public const PAGENEXT = 'next';
    public const PAGEPREV = 'prev';
    public const PAGENUM = 'Page';
    public const PAGEOF = 'of';
    /**
     * rate.php
     */
    public const ALRDYVTD = 'It appears you\'ve already voted!';
    public const VOTED_THANKS = 'Thanks for your vote!';
    public const DBVOTEFAIL = 'Sorry, there was an error and your vote was not recorded.';
    public const RATEPGNM = 'Submit rating';
    public const RATEFRMCAP = 'Rate';
    public const RATETYPECAP = 'Type:';
    public const RATETYPEONLY = 'Rate only';
    public const RATETYPERANDC = 'Rate and comment';
    public const RATETYPECOMM = 'Comment only';
    public const CAPRATE = 'Rating:';
    public const CAPRATESLT = 'Select a rating';
    public const CAPRATE1 = '*';
    public const CAPRATE2 = '* *';
    public const CAPRATE3 = '* * *';
    public const CAPRATE4 = '* * * *';
    public const CAPRATE5 = '* * * * *';
    public const FRMCAPSDTTL = 'Subject:';
    public const COMMENTTXT = 'Comments:';
    public const RATESUBMIT = 'Submit';
    public const RATERESET = 'Reset';
    /**
     * Print.php
     */
    public const PRINTAUTHOR = 'Reviewed by:';
    public const PRINTPUBBY = 'Review published on:';
    // email.php
    public const MD_EMAILHEADTTL = 'E-mail Event to friend';
    public const MD_EMAILYOURNAME = 'Your name:';
    public const MD_EMAILYOUREMAIL = 'Your e-mail:';
    public const MD_EMAILRECIPIENT = 'Recipient:';
    public const MD_EMAILMESSAGE = 'Your message:';
    public const MD_EMAILMESSAGEDESC = 'This will be included in the e-mail.';
    public const MD_EMAILSEND = 'send';
    public const MD_EMAILSET = 'reset';
    public const MD_EMAILSECNOTE = '<strong>Please note:</strong> Some security information will be sent along with the e-mail to help trace anyone who abuses this service.';
    public const MD_EMAILNOTON = 'This feature is not enabled.';
    // makepdf.php and associated PDF
    public const MD_PDFPOSTEDON = 'Posted on: ';
    public const MD_PDFPAGE = 'Page';
    public const PDF_NOT_INSTALLED = 'TCPDF for XOOPS not installed';
    //public const _PRINTPUBBY = 'Review published on:';
    public const VOTED = 'Voted';
    public const NAME = 'AM Reviews';
    public const DESC = 'A reviews module for XOOPS';
    /**
     * xoops_version.php - config options
     */
    public const INDXCOL = 'Category columns:';
    public const INDXCOLDSC = 'Number of columns in category.';
    public const DATEFRMT = 'Review page date format:';
    public const DATEFRMTDSC = 'Define the date format in review page. See PHP\'s <a href=\'http://www.php.net/date\' target=\'_blank\'>date format page</a> for the different date format characters you can use.';
    public const DATEFRMTINDX = 'Review list date format:';
    public const DATEFRMTINDXDSC = 'Define the date format in reviews list on index. See PHP\'s <a href=\'http://www.php.net/date\' target=\'_blank\'>date format page</a> for the different date format characters you can use.';
    public const DATEFRMTPRT = 'Print page date format:';
    public const DATEFRMTPRTDSC = 'Define the date format for the print version. See PHP\'s <a href=\'http://www.php.net/date\' target=\'_blank\'>date format page</a> for the different date format characters you can use.';
    public const DATEFRMTPDF = 'PDF page date format:';
    public const DATEFRMTPDFDSC = 'Define the date format for the PDF version. See PHP\'s <a href=\'http://www.php.net/date\' target=\'_blank\'>date format page</a> for the different date format characters you can use.';
    public const SHWRVWDBY = 'Show reviewer:';
    public const SHWRVWDBYDSC = ' ';
    public const DETAILTPL = 'Item details template:';
    public const DETAILTPLDSC = 'Template for items details field in review.';
    public const INCREMENTADMIN = 'Do not increment admin views:';
    public const INCREMENTADMINDSC = 'Do not increment review views/reads for admins.';
    public const DETAILTPLTXT = '<b>Part No:</b>';
    public const EDITADMIN = 'Admin editor:';
    public const EDITADMINDSC = ' ';
    public const PHOTOPATH = 'Photo location:';
    public const PHOTOPATHDSC = 'The location of review photos.';
    public const MAXUPADMIN = 'Maximum file size admin:';
    public const MAXUPADMINDSC = 'Maximum file size for photos in the admin area. In Kilobytes (KB)';
    public const SHWPRINT = 'Printable version:';
    public const SHWPRINTDSC = 'Allow printable version.';
    public const ALLOWEMAIL = 'E-mail to friend:';
    public const ALLOWEMAILDSC = 'Allow e-mail to friend feature.';
    public const EMLLOGGEDIN = 'Log in to use e-mail to friend:';
    public const EMLLOGGEDINDSC = ' ';
    public const OPTION_EMLOWNMSG = 'Allow own message';
    public const OPTION_EMLOWNMSGDSC = 'Allow user to add their own message to e-mail.';
    public const OPTION_EMLMSGSBJCT = 'E-mail subject';
    public const OPTION_EMLMSGSBJCTDSC = 'the text that will appear in the e-mail\'s subject field.';
    public const OPTION_EMLMSGSUBJECT = 'A friend recommended this Review';
    public const OPTION_EMLMSGCHRS = 'No. characters in own message';
    public const OPTION_EMLMSGCHRSDSC = 'the maximum number of characters user is allowed to send in own message.';
    public const OPTION_EMAILTXT = 'E-mail message';
    public const OPTION_EMAILTXTSC = 'The text that will be sent in the e-mail to a friend message.';
    public const OPTION_EMAILTXTMSG = 'Hello';
    public const IMGHIGHWIDTH = 'Default highlight image width:';
    public const IMGHIGHWIDTHDSC = 'Set the default width of highlight images (these appear in the review listings under categories).';
    public const IMGTHUMBWIDTH = 'Default thumbnail image width:';
    public const IMGTHUMBWIDTHDSC = 'Set the default width of thumbnail images (these appear in the review article).';
    public const SHOWSUBCATS = 'Show sub categories:';
    public const SHOWSUBCATSDSC = 'This will show the first level of subcategories.';
    public const HIDENOPERMCATS = 'Hide no access categories:';
    public const HIDENOPERMCATSDSC = 'Hide categories to those who do not have access permissions.';
    public const PAGETTLDEF = 'Default page title:';
    public const PAGETTLDEFDSC = 'The default page title behaviour - can be set individually in review.';
    public const PAGETTLDEF_OPT_0 = 'None: default XOOPS page title';
    public const PAGETTLDEF_OPT_1 = 'Yes: &lt;module name&gt; - &lt;review title&gt;';
    public const PAGETTLDEF_OPT_2 = 'Yes: &lt;review title&gt; - &lt;module name&gt;';
    public const PAGEMETADEF = 'Default page meta header:';
    public const PAGEMETADEFDSC = 'The default page meta header behaviour - can be set individually in review.';
    public const PAGEMETADEF_OPT_0 = 'None: default XOOPS meta tags';
    public const PAGEMETADEF_OPT_1 = 'Yes: review\'s meta tags only';
    public const PAGEMETADEF_OPT_2 = 'Yes: review\'s and XOOPS meta tags';
    public const LOGGEDINVOTE = 'Logged in to vote:';
    public const LOGGEDINVOTEDSC = 'Whether or not the user has to be logged in to vote.';
    public const ALLOWPDF = 'PDF version:';
    public const ALLOWPDFDSC = 'Allow PDF page version';
    public const HILITEIMG = 'Highlight image:';
    public const HILITEIMGDSC = 'How to show highlight image.';
    public const HILITEIMG_OPT_0 = 'New window';
    public const HILITEIMG_OPT_1 = 'Lightbox';
    /**
     * admin/menu.php
     */
    public const MENU1 = 'Index';
    public const MENU2 = 'Categories';
    public const MENU3 = 'Reviews';
    public const MENU4 = 'Images';
    public const MENU5 = 'Permissions';
    //    public const ERROR_COLUMN = 'Error Column';
    //    public const UPGRADEFAILED0 = 'Upgrade 1 Failed';
    //    public const UPGRADEFAILED1 = 'Upgrade 1 Failed';
    //    public const UPGRADEFAILED2 = 'Upgrade 2 Failed';
    //preferences
    //    if (!defined('_CONFIG_SAVED'))
    public const CONFIG_SAVED = 'Saved';
    public const CONFIG_MAINPAGE = 'Main page';
    public const CONFIG_MESSAGE = 'Message to be displayed before the form';
    public const CONFIG_EDITOR = 'Editor';
    public const CONFIG_COPYMESSAGE = 'Propose a copy of this message';
    //testdata
    public const GENERATE_TESTDATA = 'Generate Test Data';
    //    public const ADD_SAMPLEDATA = 'Add Sample Data';
    public const ERROR_DATA_LOAD = "Couldn't load the data";
    //    public const SAMPLEDATA_SUCCESS = 'Data Uploaded successfully';
    //    public const ERROR_BAD_XOOPS = 'This module requires XOOPS %s+ (%s installed)';
    public const ERROR_BAD_PH = 'This module requires PHP version %s+ (%s installed)';
    //    public const ERROR_TAG_REMOVAL = 'Could not remove tags from Tag Module';
    public const AUTHOR_LOGOIMG = '/assets/images/xoopsproject_logo.png';
    public const RATESTAREXT = 'png';
    //Index
    public const STATISTICS = 'Amreviews statistics';
    public const THEREARE_REVIEWS = "There are <span class='bold'>%s</span> Reviews in the database";
    public const THEREARE_CATEGORY = "There are <span class='bold'>%s</span> Category in the database";
    public const THEREARE_RATING = "There are <span class='bold'>%s</span> Rating in the database";
    //Buttons
    public const ADD_REVIEWS = 'Add new Reviews';
    public const REVIEWS_LIST = 'List of Reviews';
    public const ADD_CAT = 'Add new Category';
    public const CAT_LIST = 'List of Category';
    public const ADD_RATE = 'Add new Rating';
    public const RATE_LIST = 'List of Rating';
    //General
    public const FORMOK = 'Registered successfull';
    public const FORMDELOK = 'Deleted successfull';
    public const FORMSUREDEL = "Are you sure to Delete: <span class='bold red'>%s</span></b>";
    public const FORMSURERENEW = "Are you sure to Renew: <span class='bold red'>%s</span></b>";
    public const FORMUPLOAD = 'Upload';
    public const FORMIMAGE_PATH = 'File presents in %s';
    public const FORM_ACTION = 'Action';
    public const SELECT = 'Select action for selected item(s)';
    public const SELECTED_DELETE = 'Delete selected item(s)';
    public const SELECTED_ACTIVATE = 'Activate selected item(s)';
    public const SELECTED_DEACTIVATE = 'De-activate selected item(s)';
    public const SELECTED_ERROR = 'You selected nothing to delete';
    public const CLONED_OK = 'Record cloned successfully';
    public const CLONED_FAILED = 'Cloning of the record has failed';
    // Reviews
    public const REVIEWS_ADD = 'Add a review';
    public const REVIEWS_CATID = 'Category';
    public const REVIEWS_COMMENTS = 'Comments';
    public const REVIEWS_DATE = 'Date';
    public const REVIEWS_DATE_END = 'Date end';
    public const REVIEWS_DATE_PUBLISH = 'Published';
    public const REVIEWS_DESC = 'Description';
    public const REVIEWS_DELETE = 'Delete reviews';
    public const REVIEWS_EDIT = 'Edit reviews';
    public const REVIEWS_HIGHLIGHT = 'Highlight';
    public const REVIEWS_ID = 'ID';
    public const REVIEWS_IMAGE_ALIGN = 'Alignment';
    public const REVIEWS_IMAGE_FILE = 'File';
    public const REVIEWS_ITEM_DETAILS = 'Details';
    public const REVIEWS_KEYWORDS = 'Keywords';
    public const REVIEWS_METAHEADERS = 'Meta headers';
    public const REVIEWS_NOBR = 'No breaks';
    public const REVIEWS_NOHTML = 'Allow HTML';
    public const REVIEWS_NOIMAGE = 'X-Images';
    public const REVIEWS_NOSMILEY = 'Smiley';
    public const REVIEWS_NOTIFY = 'Notify';
    public const REVIEWS_NOXCODE = 'X-Codes';

    public const REVIEWS_NOBR_DESC = '&nbsp;Convert line breaks (deselect when using WYSIWYG editors).';
    public const REVIEWS_NOHTML_DESC = '&nbsp;Allow HTML.';
    public const REVIEWS_NOIMAGE_DESC = '&nbsp;Allow display of images with XOOPS codes.\'';
    public const REVIEWS_NOSMILEY_DESC = '&nbsp;Allow XOOPS smiley icons.';
    public const REVIEWS_NOTIFY_DESC = 'Notify';
    public const REVIEWS_NOXCODE_DESC = '&nbsp;Allow XOOPS codes.';

    public const REVIEWS_OUR_RATING = 'Our Rating';
    public const REVIEWS_PAGETITLE = 'Title';
    public const REVIEWS_REVIEW = 'Review';
    public const REVIEWS_REVIEWER_IP = 'Reviewer IP';
    public const REVIEWS_SHOWME = 'Show me';
    public const REVIEWS_SUBTITLE = 'Subtitle';
    public const REVIEWS_TEASER = 'Teaser';
    public const REVIEWS_TITLE = 'Title';
    public const REVIEWS_UID = 'User';
    public const REVIEWS_VALIDATED = 'Validated';
    public const REVIEWS_VIEWS = 'Views';
    public const REVIEWS_WEIGHT = 'Weight';
    // Cat
    public const CAT_ADD = 'Add Category';
    public const CAT_EDIT = 'Edit Category';
    public const CAT_DELETE = 'Delete Category';
    public const CAT_ID = 'ID';
    public const CAT_PID = 'Parent Category';
    public const CAT_TITLE = 'Title';
    public const CAT_DESCRIPTION = 'Description';
    public const CAT_DESC = 'Description';
    public const CAT_WEIGHT = 'Weight';
    public const CAT_SHOWME = 'Show me';
    // Rate
    public const RATE_ADD = 'Add a rate';
    public const RATE_EDIT = 'Edit rate';
    public const RATE_DELETE = 'Delete rate';
    public const RATE_ID = 'ID';
    public const RATE_DESC = 'Description';
    public const RATE_REVIEW_ID = 'Review ID';
    public const RATE_RATING = 'Rating';
    public const RATE_UID = 'User';
    public const RATE_USER_IP = 'User IP';
    public const RATE_USER_BROWSER = 'User Browser';
    public const RATE_TITLE = 'Ttitle';
    public const RATE_TEXT = 'Text';
    public const RATE_DATE_CREATED = 'Submitted';
    public const RATE_SHOWME = 'Show me';
    public const RATE_VALIDATED = 'Validated';
    public const RATE_USEFUL = 'Useful';
    //Errors
    //public const UPGRADEFAILED0 = "Update failed - couldn't rename field '%s'";
    //public const UPGRADEFAILED1 = "Update failed - couldn't add new fields";
    //public const UPGRADEFAILED2 = "Update failed - couldn't rename table '%s'";
    //public const ERROR_COLUMN = 'Could not create column in database : %s';
    //public const ERROR_BAD_XOOPS = 'This module requires XOOPS %s+ (%s installed)';
    //public const ERROR_BAD_PHP = 'This module requires PHP version %s+ (%s installed)';
    //public const ERROR_TAG_REMOVAL = 'Could not remove tags from Tag Module';
    //directories
    //public const AVAILABLE = "<span style='color : #008000;'>Available. </span>";
    //public const NOTAVAILABLE = "<span style='color : #ff0000;'>is not available. </span>";
    //public const NOTWRITABLE = "<span style='color : #ff0000;'>" . ' should have permission ( %1$d ), but it has ( %2$d )' . '</span>';
    //public const CREATETHEDIR = 'Create it';
    //public const SETMPERM = 'Set the permission';
    //public const DIRCREATED = 'The directory has been created';
    //public const DIRNOTCREATED = 'The directory can not be created';
    //public const PERMSET = 'The permission has been set';
    //public const PERMNOTSET = 'The permission can not be set';
    //public const VIDEO_EXPIREWARNING = 'The publishing date is after expiration date!!!';
    //Sample Data
    //public const ADD_SAMPLEDATA = 'Import Sample Data (will delete ALL current data)';
    //public const SAMPLEDATA_SUCCESS = 'Sample Date uploaded successfully';

    //public const MAINTAINEDBY = 'is maintained by the';

    public const EDITOR_ADMIN = 'Editor: Admin';
    public const EDITOR_ADMIN_DESC = 'Select the Editor to use by the Admin';
    public const EDITOR_USER = 'Editor: User';
    public const EDITOR_USER_DESC = 'Select the Editor to use by the User';
    public const KEYWORDS = 'Keywords';
    public const KEYWORDS_DESC = 'Insert here the keywords (separate by comma)';
    public const ADMINPAGER = 'Admin: records / page';
    public const ADMINPAGER_DESC = 'Admin: # of records shown per page';
    public const USERPAGER = 'User: records / page';
    public const USERPAGER_DESC = 'User: # of records shown per page';
    public const MAXSIZE = 'Max size';
    public const MAXSIZE_DESC = 'Set a number of max size uploads file in byte';
    public const MIMETYPES = 'Mime Types';
    public const MIMETYPES_DESC = 'Set the mime types selected';
    public const IDPAYPAL = 'Paypal ID';
    public const IDPAYPAL_DESC = 'Insert here your PayPal ID for donactions.';
    public const ADVERTISE = 'Advertisement Code';
    public const ADVERTISE_DESC = 'Insert here the advertisement code';
    public const BOOKMARKS = 'Social Bookmarks';
    public const BOOKMARKS_DESC = 'Show Social Bookmarks in the form';
    public const FBCOMMENTS = 'Facebook comments';
    public const FBCOMMENTS_DESC = 'Allow Facebook comments in the form';
    public const UPDATE_SUCCESS = 'Update Successful';
}
