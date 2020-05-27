<{include file="db:amreviews_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title"><strong>Rate</strong></h2></div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th><{translate key="RATE_ID" dir=$dirname}></th>
            <th><{translate key="RATE_REVIEW_ID" dir=$dirname}></th>
            <th><{translate key="RATE_RATING" dir=$dirname}></th>
            <th><{translate key="RATE_UID" dir=$dirname}></th>
            <th><{translate key="RATE_USER_IP" dir=$dirname}></th>
            <th><{translate key="RATE_USER_BROWSER" dir=$dirname}></th>
            <th><{translate key="RATE_TITLE" dir=$dirname}></th>
            <th><{translate key="RATE_TEXT" dir=$dirname}></th>
            <th><{translate key="RATE_DATE_CREATED" dir=$dirname}></th>
            <th><{translate key="RATE_SHOWME" dir=$dirname}></th>
            <th><{translate key="RATE_VALIDATED" dir=$dirname}></th>
            <th><{translate key="RATE_USEFUL" dir=$dirname}></th>
            <th width="80"><{translate key="ACTION" dir=$dirname}></th>
        </tr>
        </thead>
        <{foreach item=rate from=$rate}>
            <tbody>
            <tr>

                <td><{$rate.id}></td>
                <td><{$rate.review_id}></td>
                <td><{$rate.rating}></td>
                <td><{$rate.uid}></td>
                <td><{$rate.user_ip}></td>
                <td><{$rate.user_browser}></td>
                <td><{$rate.title}></td>
                <td><{$rate.text}></td>
                <td><{$rate.date_created}></td>
                <td><{$rate.showme}></td>
                <td><{$rate.validated}></td>
                <td><{$rate.useful}></td>
                <td>
                <a href="rate.php?op=view&id=<{$rate.id}>" title="<{translate key="_PREVIEW" dir=$dirname}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{translate key="_PREVIEW" dir=$dirname}>" title="<{translate key="_PREVIEW" dir=$dirname}>"</a>
                    <{if $xoops_isadmin == true}>
                <a href="rate.php?op=edit&id=<{$rate.id}>" title="<{translate key="_EDIT" dir=$dirname}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{translate key="_EDIT" dir=$dirname}>" title="<{translate key="_EDIT" dir=$dirname}>"></a>
                <a href="admin/rate.php?op=delete&id=<{$rate.id}>" title="<{translate key="_DELETE" dir=$dirname}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{translate key="_DELETE" dir=$dirname}>" title="<{translate key="_DELETE" dir=$dirname}>"</a>
                    <{/if}>
                </td>
            </tr>
            </tbody>
        <{/foreach}>
    </table>
</div>
<{$pagenav}>
<{$commentsnav}> <{$lang_notice}>
<{if $comment_mode == "flat"}> <{include file="db:system_comments_flat.tpl"}> <{elseif $comment_mode == "thread"}> <{include file="db:system_comments_thread.tpl"}> <{elseif $comment_mode == "nest"}> <{include file="db:system_comments_nest.tpl"}> <{/if}>
<{include file="db:amreviews_footer.tpl"}>
