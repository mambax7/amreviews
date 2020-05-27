<{if $bookmarks != 0}>
    <{include file="db:system_bookmarks.tpl"}>
<{/if}>

<{if $fbcomments != 0}>
    <{include file="db:system_fbcomments.tpl"}>
<{/if}>

<div class="left"><{$copyright}></div>
<{if $xoops_isadmin}>
    <div class="center bold"><a href="<{$admin}>"><{translate key="ADMIN" dir=$dirname}></a></div>
<{/if}>

<{include file='db:system_notification_select.tpl'}>
