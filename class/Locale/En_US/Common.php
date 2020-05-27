<?php namespace XoopsModules\Amreviews\Locale\En_US;

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * Wfdownloads module
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package         wfdownload
 * @since           3.23
 * @author          Xoops Development Team
 */
interface Common
{
    public const GDLIBSTATUS = 'GD library support: ';
    public const GDLIBVERSION = 'GD Library version: ';
    public const GDOFF = "<span style='font-weight: bold;'>Disabled</span> (No thumbnails available)";
    public const GDON = "<span style='font-weight: bold;'>Enabled</span> (Thumbsnails available)";
    public const IMAGEINFO = 'Server status';
    public const MAXPOSTSIZE = 'Max post size permitted (post_max_size directive in php.ini): ';
    public const MAXUPLOADSIZE = 'Max upload size permitted (upload_max_filesize directive in php.ini): ';
    public const MEMORYLIMIT = 'Memory limit (memory_limit directive in php.ini): ';
    public const METAVERSION = "<span style='font-weight: bold;'>Downloads meta version:</span> ";
    public const OFF = "<span style='font-weight: bold;'>OFF</span>";
    public const ON = "<span style='font-weight: bold;'>ON</span>";
    public const SERVERPATH = 'Server path to XOOPS root: ';
    public const SERVERUPLOADSTATUS = 'Server uploads status: ';
    public const SPHPINI = "<span style='font-weight: bold;'>Information taken from PHP ini file:</span>";
    public const UPLOADPATHDSC = 'Note. Upload path *MUST* contain the full server path of your upload folder.';
    public const PRINT = "<span style='font-weight: bold;'>Print</span>";
    public const PDF = "<span style='font-weight: bold;'>Create PDF</span>";
    public const UPGRADEFAILED0 = "Update failed - couldn't rename field '%s'";
    public const UPGRADEFAILED1 = "Update failed - couldn't add new fields";
    public const UPGRADEFAILED2 = "Update failed - couldn't rename table '%s'";
    public const ERROR_COLUMN = 'Could not create column in database : %s';
    public const ERROR_BAD_XOOPS = 'This module requires XOOPS %s+ (%s installed)';
    public const ERROR_BAD_PHP = 'This module requires PHP version %s+ (%s installed)';
    public const ERROR_TAG_REMOVAL = 'Could not remove tags from Tag Module';
    public const FOLDERS_DELETED_OK = 'Upload Folders have been deleted';
    // Error Msgs
    public const ERROR_BAD_DEL_PATH = 'Could not delete %s directory';
    public const ERROR_BAD_REMOVE = 'Could not delete %s';
    public const ERROR_NO_PLUGIN = 'Could not load plugin';
    //Help
    //    public const DIRNAME = basename(dirname(dirname(__DIR__))));
    //public const HELP_HEADER', __DIR__ . ' / help / helpheader . tpl';
    public const BACK_2_ADMIN = 'Back to Administration of ';
    public const OVERVIEW = 'Overview';
    //public const HELP_DIR', __DIR__);

    //help multi-page
    public const DISCLAIMER = 'Disclaimer';
    public const LICENSE = 'License';
    public const SUPPORT = 'Support';
    //Sample Data
    public const ADD_SAMPLEDATA = 'Import Sample Data (will delete ALL current data)';
    public const SAMPLEDATA_SUCCESS = 'Sample Date uploaded successfully';
    public const SAVE_SAMPLEDATA = 'Export Tables to YAML';
    public const SHOW_SAMPLE_BUTTON = 'Show Sample Button?';
    public const SHOW_SAMPLE_BUTTON_DESC = 'If yes, the "Add Sample Data" button will be visible to the Admin. It is Yes as a default for first installation.';
    public const EXPORT_SCHEMA = 'Export DB Schema to YAML';
    public const EXPORT_SCHEMA_SUCCESS = 'Export DB Schema to YAML was a success';
    public const EXPORT_SCHEMA_ERROR = 'ERROR: Export of DB Schema to YAML failed';
    public const ADD_SAMPLEDATA_OK = 'Are you sure to Import Sample Data? (It will delete ALL current data)';
    public const HIDE_SAMPLEDATA_BUTTONS = 'Hide the Import buttons)';
    public const SHOW_SAMPLEDATA_BUTTONS = 'Show the Import buttons)';
    public const CONFIRM = 'Confirm';
    //letter choice
    public const BROWSETOTOPIC = "<span style='font-weight: bold;'>Browse items alphabetically</span>";
    public const OTHER = 'Other';
    public const ALL = 'All';
    // block defines
    public const ACCESSRIGHTS = 'Access Rights';
    public const ACTION = 'Action';
    public const ACTIVERIGHTS = 'Active Rights';
    public const BADMIN = 'Block Administration';
    public const BLKDESC = 'Description';
    public const CBCENTER = 'Center Middle';
    public const CBLEFT = 'Center Left';
    public const CBRIGHT = 'Center Right';
    public const SBLEFT = 'Left';
    public const SBRIGHT = 'Right';
    public const SIDE = 'Alignment';
    public const TITLE = 'Title';
    public const VISIBLE = 'Visible';
    public const VISIBLEIN = 'Visible In';
    public const WEIGHT = 'Weight';
    public const PERMISSIONS = 'Permissions';
    public const BLOCKS = 'Blocks Admin';
    public const BLOCKS_DESC = 'Blocks/Group Admin';
    public const BLOCKS_MANAGMENT = 'Manage';
    public const BLOCKS_ADDBLOCK = 'Add a new block';
    public const BLOCKS_EDITBLOCK = 'Edit a block';
    public const BLOCKS_CLONEBLOCK = 'Clone a block';
    //myblocksadmin
    public const AGDS = 'Admin Groups';
    public const BCACHETIME = 'Cache Time';
    public const BLOCKS_ADMIN = 'Blocks Admin';
    //Template Admin
    public const TPLSETS = 'Template Management';
    public const GENERATE = 'Generate';
    public const FILENAME = 'File Name';
    //Menu
    public const ADMENU_MIGRATE = 'Migrate';
    public const FOLDER_YES = 'Folder "%s" exist';
    public const FOLDER_NO = 'Folder "%s" does not exist. Create the specified folder with CHMOD 777.';
    public const SHOW_DEV_TOOLS = 'Show Development Tools Button?';
    public const SHOW_DEV_TOOLS_DESC = 'If yes, the "Migrate" Tab and other Development tools will be visible to the Admin.';
    public const ADMENU_FEEDBACK = 'Feedback';
    //Latest Version Check
    public const NEW_VERSION = 'New Version: ';
    //DirectoryChecker
    public const AVAILABLE = "<span style='color: #008000;'>Available</span>";
    public const NOTAVAILABLE = "<span style='color: #ff0000;'>Not available</span>";
    public const NOTWRITABLE = "<span style='color: #ff0000;'>Should have permission ( %d ), but it has ( %d )</span>";
    public const CREATETHEDIR = 'Create it';
    public const SETMPERM = 'Set the permission';
    public const DIRCREATED = 'The directory has been created';
    public const DIRNOTCREATED = 'The directory cannot be created';
    public const PERMSET = 'The permission has been set';
    public const PERMNOTSET = 'The permission cannot be set';
    //FileChecker
    //public const AVAILABLE = "<span style='color: green;'>Available</span>";
    //public const NOTAVAILABLE = "<span style='color: red;'>Not available</span>";
    //public const NOTWRITABLE = "<span style='color: red;'>Should have permission ( %d ), but it has ( %d )</span>";
    //public const COPYTHEFILE = 'Copy it';
    //public const CREATETHEFILE = 'Create it';
    //public const SETMPERM = 'Set the permission';

    public const FILECOPIED = 'The file has been copied';
    public const FILENOTCOPIED = 'The file cannot be copied';
    //public const PERMSET = 'The permission has been set';
    //public const PERMNOTSET = 'The permission cannot be set';

    //image config
    public const IMAGE_WIDTH = 'Image Display Width';
    public const IMAGE_WIDTH_DSC = 'Display width for image';
    public const IMAGE_HEIGHT = 'Image Display Height';
    public const IMAGE_HEIGHT_DSC = 'Display height for image';
    public const IMAGE_CONFIG = '<span style="color: #FF0000; font-size: Small;  font-weight: bold;">--- EXTERNAL Image configuration ---</span> ';
    public const IMAGE_CONFIG_DSC = '';
    public const IMAGE_UPLOAD_PATH = 'Image Upload path';
    public const IMAGE_UPLOAD_PATH_DSC = 'Path for uploading images';
    public const IMAGE_FILE_SIZE = 'Image File Size (in Bytes)';
    public const IMAGE_FILE_SIZE_DSC = 'The maximum file size of the image file (in Bytes)';
    //Preferences
    public const TRUNCATE_LENGTH = 'Number of Characters to truncate to the long text field';
    public const TRUNCATE_LENGTH_DESC = 'Set the maximum number of characters to truncate the long text fields';
    //Module Stats
    public const STATS_SUMMARY = 'Module Statistics';
    public const TOTAL_CATEGORIES = 'Categories:';
    public const TOTAL_ITEMS = 'Items';
    public const TOTAL_OFFLINE = 'Offline';
    public const TOTAL_PUBLISHED = 'Published';
    public const TOTAL_REJECTED = 'Rejected';
    public const TOTAL_SUBMITTED = 'Submitted';
    public const GLOBAL_NOTIFY = 'Allow Facebook comments in the form';
    public const GLOBAL_NOTIFY_DESC = 'Allow Facebook comments in the form';
    public const CATEGORY_NOTIFY = 'Allow Facebook comments in the form';
    public const CATEGORY_NOTIFY_DESC = 'Allow Facebook comments in the form';
    public const FILE_NOTIFY = 'Allow Facebook comments in the form';
    public const FILE_NOTIFY_DESC = 'Allow Facebook comments in the form';
    public const GLOBAL_NEWCATEGORY_NOTIFY = 'Allow Facebook comments in the form';
    public const GLOBAL_NEWCATEGORY_NOTIFY_CAPTION = 'Allow Facebook comments in the form';
    public const GLOBAL_NEWCATEGORY_NOTIFY_DESC = 'Allow Facebook comments in the form';
    public const GLOBAL_NEWCATEGORY_NOTIFY_SUBJECT = 'Allow Facebook comments in the form';
    public const GLOBAL_FILEMODIFY_NOTIFY = 'Allow Facebook comments in the form';
    public const GLOBAL_FILEMODIFY_NOTIFY_CAPTION = 'Allow Facebook comments in the form';
    public const GLOBAL_FILEMODIFY_NOTIFY_DESC = 'Allow Facebook comments in the form';
    public const GLOBAL_FILEMODIFY_NOTIFY_SUBJECT = 'Allow Facebook comments in the form';
    public const GLOBAL_FILEBROKEN_NOTIFY = 'Allow Facebook comments in the form';
    public const GLOBAL_FILEBROKEN_NOTIFY_CAPTION = 'Allow Facebook comments in the form';
    public const GLOBAL_FILEBROKEN_NOTIFY_DESC = 'Allow Facebook comments in the form';
    public const GLOBAL_FILEBROKEN_NOTIFY_SUBJECT = 'Allow Facebook comments in the form';
    public const GLOBAL_FILESUBMIT_NOTIFY = 'Allow Facebook comments in the form';
    public const GLOBAL_FILESUBMIT_NOTIFY_CAPTION = 'Allow Facebook comments in the form';
    public const GLOBAL_FILESUBMIT_NOTIFY_DESC = 'Allow Facebook comments in the form';
    public const GLOBAL_FILESUBMIT_NOTIFY_SUBJECT = 'Allow Facebook comments in the form';
    public const GLOBAL_NEWFILE_NOTIFY = 'Allow Facebook comments in the form';
    public const GLOBAL_NEWFILE_NOTIFY_CAPTION = 'Allow Facebook comments in the form';
    public const GLOBAL_NEWFILE_NOTIFY_DESC = 'Allow Facebook comments in the form';
    public const GLOBAL_NEWFILE_NOTIFY_SUBJECT = 'Allow Facebook comments in the form';
    public const CATEGORY_FILESUBMIT_NOTIFY = 'Allow Facebook comments in the form';
    public const CATEGORY_FILESUBMIT_NOTIFY_CAPTION = 'Allow Facebook comments in the form';
    public const CATEGORY_FILESUBMIT_NOTIFY_DESC = 'Allow Facebook comments in the form';
    public const CATEGORY_FILESUBMIT_NOTIFY_SUBJECT = 'Allow Facebook comments in the form';
    public const CATEGORY_NEWFILE_NOTIFY = 'Allow Facebook comments in the form';
    public const CATEGORY_NEWFILE_NOTIFY_CAPTION = 'Allow Facebook comments in the form';
    public const CATEGORY_NEWFILE_NOTIFY_DESC = 'Allow Facebook comments in the form';
    public const CATEGORY_NEWFILE_NOTIFY_SUBJECT = 'Allow Facebook comments in the form';
    public const FILE_APPROVE_NOTIFY = 'Allow Facebook comments in the form';
    public const FILE_APPROVE_NOTIFY_CAPTION = 'Allow Facebook comments in the form';
    public const FILE_APPROVE_NOTIFY_DESC = 'Allow Facebook comments in the form';
    public const FILE_APPROVE_NOTIFY_SUBJECT = 'Allow Facebook comments in the form';
    // Help
    //    public const BACK_2_ADMIN = 'Back to Administration of ';
    //    public const OVERVIEW = 'Overview';
    // The name of this module
    //public const NAME = 'YYYYY Module Name';

    //public const HELP_DIR', __DIR__);

    //help multi-page
    //    public const DISCLAIMER = 'Disclaimer';
    //    public const LICENSE = 'License';
    //    public const SUPPORT = 'Support';
    //public const REQUIREMENTS = 'Requirements';
    //public const CREDITS = 'Credits';
    //public const HOWTO = 'How To';
    //public const UPDATE = 'Update';
    //public const INSTALL = 'Install';
    //public const HISTORY = 'History';
    //public const HELP1 = 'YYYYY';
    //public const HELP2 = 'YYYYY';
    //public const HELP3 = 'YYYYY';
    //public const HELP4 = 'YYYYY';
    //public const HELP5 = 'YYYYY';
    //public const HELP6 = 'YYYYY';

    // Permissions Groups
    public const GROUPS = 'Groups access';
    public const GROUPS_DESC = 'Select general access permission for groups.';
    public const ADMINGROUPS = 'Admin Group Permissions';
    public const ADMINGROUPS_DESC = 'Which groups have access to tools and permissions page';
    //Menu
    public const ADMENU1 = 'Home';
    public const ADMENU2 = 'Reviews';
    public const ADMENU3 = 'Category';
    public const ADMENU4 = 'Rating';
    public const ADMENU5 = 'Feedback';
    public const ADMENU6 = 'Migrate';
    public const ADMENU7 = 'About';
    public const ADMENU8 = 'Permissions';

}
