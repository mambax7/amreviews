<{include file="db:amreviews_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title">Rate </h2></div>

    <table class="table table-striped">
        <thead>
        <tr>
        </tr>
        </thead>
        <tbody>
        <tr>

            <td><{translate key="RATE_ID" dir=$dirname}></td>
            <td><{$rate.id}></td>
        </tr>
        <tr>
            <td><{translate key="RATE_REVIEW_ID" dir=$dirname}></td>
            <td><{$rate.review_id}></td>
        </tr>
        <tr>
            <td><{translate key="RATE_RATING" dir=$dirname}></td>
            <td><{$rate.rating}></td>
        </tr>
        <tr>
            <td><{translate key="RATE_UID" dir=$dirname}></td>
            <td><{$rate.uid}></td>
        </tr>
        <tr>
            <td><{translate key="RATE_USER_IP" dir=$dirname}></td>
            <td><{$rate.user_ip}></td>
        </tr>
        <tr>
            <td><{translate key="RATE_USER_BROWSER" dir=$dirname}></td>
            <td><{$rate.user_browser}></td>
        </tr>
        <tr>
            <td><{translate key="RATE_TITLE" dir=$dirname}></td>
            <td><{$rate.title}></td>
        </tr>
        <tr>
            <td><{translate key="RATE_TEXT" dir=$dirname}></td>
            <td><{$rate.text}></td>
        </tr>
        <tr>
            <td><{translate key="RATE_DATE_CREATED" dir=$dirname}></td>
            <td><{$rate.date_created}></td>
        </tr>
        <tr>
            <td><{translate key="RATE_SHOWME" dir=$dirname}></td>
            <td><{$rate.showme}></td>
        </tr>
        <tr>
            <td><{translate key="RATE_VALIDATED" dir=$dirname}></td>
            <td><{$rate.validated}></td>
        </tr>
        <tr>
            <td><{translate key="RATE_USEFUL" dir=$dirname}></td>
            <td><{$rate.useful}></td>
        </tr>
        <tr>
            <td><{translate key="ACTION" dir=$dirname}></td>
            <td>
                <!--<a href="rate.php?op=view&id=<{$rate.id}>" title="<{translate key="_PREVIEW" dir=$dirname}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{translate key="_PREVIEW" dir=$dirname}>" title="<{translate key="_PREVIEW" dir=$dirname}>"</a>&nbsp;-->
                <{if $xoops_isadmin == true}>
                <a href="rate.php?op=edit&id=<{$rate.id}>" title="<{translate key="_EDIT" dir=$dirname}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{translate key="_EDIT" dir=$dirname}>" title="<{translate key="_EDIT" dir=$dirname}>"></a>
                    &nbsp;
                <a href="admin/rate.php?op=delete&id=<{$rate.id}>" title="<{translate key="_DELETE" dir=$dirname}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{translate key="_DELETE" dir=$dirname}>" title="<{translate key="_DELETE" dir=$dirname}>"</a>
                <{/if}>
            </td>
        </tr>
        </tbody>

    </table>
</div>
<div id="pagenav"><{$pagenav}></div>
<{$commentsnav}> <{$lang_notice}>
<{if $comment_mode == "flat"}> <{include file="db:system_comments_flat.tpl"}> <{elseif $comment_mode == "thread"}> <{include file="db:system_comments_thread.tpl"}> <{elseif $comment_mode == "nest"}> <{include file="db:system_comments_nest.tpl"}> <{/if}>
<{include file="db:amreviews_footer.tpl"}>
