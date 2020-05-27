<{include file="db:amreviews_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title">Cat </h2></div>

    <table class="table table-striped">
        <thead>
        <tr>
        </tr>
        </thead>
        <tbody>
        <tr>

            <td><{translate key="CAT_ID" dir=$dirname}></td>
            <td><{$cat.id}></td>
        </tr>
        <tr>
            <td><{translate key="CAT_PID" dir=$dirname}></td>
            <td><{$cat.pid}></td>
        </tr>
        <tr>
            <td><{translate key="CAT_TITLE" dir=$dirname}></td>
            <td><{$cat.title}></td>
        </tr>
        <tr>
            <td><{translate key="CAT_DESCRIPTION" dir=$dirname}></td>
            <td><{$cat.description}></td>
        </tr>
        <tr>
            <td><{translate key="CAT_WEIGHT" dir=$dirname}></td>
            <td><{$cat.weight}></td>
        </tr>
        <tr>
            <td><{translate key="CAT_SHOWME" dir=$dirname}></td>
            <td><{$cat.showme}></td>
        </tr>
        <tr>
            <td><{translate key="ACTION" dir=$dirname}></td>
            <td>
                <!--<a href="cat.php?op=view&id=<{$cat.id}>" title="<{translate key="_PREVIEW" dir=$dirname}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{translate key="_PREVIEW" dir=$dirname}>" title="<{translate key="_PREVIEW" dir=$dirname}>"</a>&nbsp;-->
                <{if $xoops_isadmin == true}>
                <a href="cat.php?op=edit&id=<{$cat.id}>" title="<{translate key="_EDIT" dir=$dirname}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{translate key="_EDIT" dir=$dirname}>" title="<{translate key="_EDIT" dir=$dirname}>"></a>
                    &nbsp;
                <a href="admin/cat.php?op=delete&id=<{$cat.id}>" title="<{translate key="_DELETE" dir=$dirname}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{translate key="_DELETE" dir=$dirname}>" title="<{translate key="_DELETE" dir=$dirname}>"</a>
                <{/if}>
            </td>
        </tr>
        </tbody>

    </table>
</div>
<div id="pagenav"><{$pagenav}></div>
<{$commentsnav}> <{$lang_notice}>
<{if $comment_mode == "flat"}>
    <{include file="db:system_comments_flat.tpl"}>
<{elseif $comment_mode == "thread"}>
    <{include file="db:system_comments_thread.tpl"}>
<{elseif $comment_mode == "nest"}>
    <{include file="db:system_comments_nest.tpl"}>
<{/if}>
<{include file="db:amreviews_footer.tpl"}>
