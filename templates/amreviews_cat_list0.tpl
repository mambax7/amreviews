<{include file="db:amreviews_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title"><strong>Cat</strong></h2></div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th><{translate key="CAT_ID" dir=$dirname}></th>
            <th><{translate key="CAT_PID" dir=$dirname}></th>
            <th><{translate key="CAT_TITLE" dir=$dirname}></th>
            <th><{translate key="CAT_DESCRIPTION" dir=$dirname}></th>
            <th><{translate key="CAT_WEIGHT" dir=$dirname}></th>
            <th><{translate key="CAT_SHOWME" dir=$dirname}></th>
            <th width="80"><{translate key="ACTION" dir=$dirname}></th>
        </tr>
        </thead>
        <{foreach item=cat from=$cat}>
            <tbody>
            <tr>

                <td><{$cat.id}></td>
                <td><{$cat.pid}></td>
                <td><{$cat.title}></td>
                <td><{$cat.description}></td>
                <td><{$cat.weight}></td>
                <td><{$cat.showme}></td>
                <td>
                <a href="cat.php?op=view&id=<{$cat.id}>" title="<{translate key="_PREVIEW" dir=$dirname}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{translate key="_PREVIEW" dir=$dirname}>" title="<{translate key="_PREVIEW" dir=$dirname}>"</a>
                    <{if $xoops_isadmin == true}>
                <a href="cat.php?op=edit&id=<{$cat.id}>" title="<{translate key="_EDIT" dir=$dirname}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{translate key="_EDIT" dir=$dirname}>" title="<{translate key="_EDIT" dir=$dirname}>"></a>
                <a href="admin/cat.php?op=delete&id=<{$cat.id}>" title="<{translate key="_DELETE" dir=$dirname}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{translate key="_DELETE" dir=$dirname}>" title="<{translate key="_DELETE" dir=$dirname}>"</a>
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
