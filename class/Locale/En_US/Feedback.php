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
 * feedback plugin for xoops modules
 *
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 * @package        general
 * @since          1.0
 * @min_xoops      2.5.9
 * @author         XOOPS - Website:<https://xoops.org>
 */
interface Feedback
{
    public const FORM_TITLE = 'Send a feedback';
    public const RECIPIENT = 'Recipient';
    //    public const NAME = 'Name';
    public const NAME_PLACEHOLER = 'Please enter your name';
    public const SITE = 'Website';
    public const SITE_PLACEHOLER = 'Please enter your website';
    public const MAIL = 'Email';
    public const MAIL_PLACEHOLER = 'Please enter your email';
    public const TYPE = 'Type of feedback';
    public const TYPE_SUGGESTION = 'Suggestions';
    public const TYPE_BUGS = 'Bugs';
    public const TYPE_TESTIMONIAL = 'Testimonials';
    public const TYPE_FEATURES = 'Features';
    public const TYPE_OTHERS = 'Misc';
    public const TYPE_CONTENT = 'Feedback content';
    public const SEND_FOR = 'Feedback for module ';
    public const SEND_SUCCESS = 'Feedback successfully sent';
    public const SEND_ERROR = 'An errror occured when feedback was sent!';
}
