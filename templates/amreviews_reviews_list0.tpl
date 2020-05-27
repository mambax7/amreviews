<{include file="db:amreviews_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title"><strong>Reviews</strong></h2></div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th><{translate key="REVIEWS_ID" dir=$dirname}></th>
            <th><{translate key="REVIEWS_UID" dir=$dirname}></th>
            <th><{translate key="REVIEWS_CATID" dir=$dirname}></th>
            <th><{translate key="REVIEWS_WEIGHT" dir=$dirname}></th>
            <th><{translate key="REVIEWS_TITLE" dir=$dirname}></th>
            <th><{translate key="REVIEWS_SUBTITLE" dir=$dirname}></th>
            <th><{translate key="REVIEWS_IMAGE_FILE" dir=$dirname}></th>
            <th><{translate key="REVIEWS_IMAGE_ALIGN" dir=$dirname}></th>
            <th><{translate key="REVIEWS_OUR_RATING" dir=$dirname}></th>
            <th><{translate key="REVIEWS_REVIEWER_IP" dir=$dirname}></th>
            <th><{translate key="REVIEWS_TEASER" dir=$dirname}></th>
            <th><{translate key="REVIEWS_ITEM_DETAILS" dir=$dirname}></th>
            <th><{translate key="REVIEWS_REVIEW" dir=$dirname}></th>
            <th><{translate key="REVIEWS_KEYWORDS" dir=$dirname}></th>
            <th><{translate key="REVIEWS_DATE" dir=$dirname}></th>
            <th><{translate key="REVIEWS_DATE_PUBLISH" dir=$dirname}></th>
            <th><{translate key="REVIEWS_DATE_END" dir=$dirname}></th>
            <th><{translate key="REVIEWS_VIEWS" dir=$dirname}></th>
            <th><{translate key="REVIEWS_PAGETITLE" dir=$dirname}></th>
            <th><{translate key="REVIEWS_METAHEADERS" dir=$dirname}></th>
            <th><{translate key="REVIEWS_COMMENTS" dir=$dirname}></th>
            <th><{translate key="REVIEWS_NOTIFY" dir=$dirname}></th>
            <th><{translate key="REVIEWS_VALIDATED" dir=$dirname}></th>
            <th><{translate key="REVIEWS_SHOWME" dir=$dirname}></th>
            <th><{translate key="REVIEWS_HIGHLIGHT" dir=$dirname}></th>
            <th><{translate key="REVIEWS_NOHTML" dir=$dirname}></th>
            <th><{translate key="REVIEWS_NOSMILEY" dir=$dirname}></th>
            <th><{translate key="REVIEWS_NOXCODE" dir=$dirname}></th>
            <th><{translate key="REVIEWS_NOIMAGE" dir=$dirname}></th>
            <th><{translate key="REVIEWS_NOBR" dir=$dirname}></th>
            <th width="80"><{translate key="ACTION" dir=$dirname}></th>
        </tr>
        </thead>
        <{foreach item=reviews from=$reviews}>
            <tbody>
            <tr>

                <td><{$reviews.id}></td>
                <td><{$reviews.uid}></td>
                <td><{$reviews.catid}></td>
                <td><{$reviews.weight}></td>
                <td><{$reviews.title}></td>
                <td><{$reviews.subtitle}></td>
                <td><img src="<{$xoops_url}>/uploads/amreviews/images/<{$reviews.image_file}>" style="max-width:100px" alt="reviews"></td>
                <td><{$reviews.image_align}></td>
                <td><{$reviews.our_rating}></td>
                <td><{$reviews.reviewer_ip}></td>
                <td><{$reviews.teaser}></td>
                <td><{$reviews.item_details}></td>
                <td><{$reviews.review}></td>
                <td><{$reviews.keywords}></td>
                <td><{$reviews.date}></td>
                <td><{$reviews.date_publish}></td>
                <td><{$reviews.date_end}></td>
                <td><{$reviews.views}></td>
                <td><{$reviews.pagetitle}></td>
                <td><{$reviews.metaheaders}></td>
                <td><{$reviews.comments}></td>
                <td><{$reviews.notify}></td>
                <td><{$reviews.validated}></td>
                <td><{$reviews.showme}></td>
                <td><{$reviews.highlight}></td>
                <td><{$reviews.nohtml}></td>
                <td><{$reviews.nosmiley}></td>
                <td><{$reviews.noxcode}></td>
                <td><{$reviews.noimage}></td>
                <td><{$reviews.nobr}></td>
                <td>
                <a href="reviews.php?op=view&id=<{$reviews.id}>" title="<{translate key="_PREVIEW" dir=$dirname}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{translate key="_PREVIEW" dir=$dirname}>" title="<{translate key="_PREVIEW" dir=$dirname}>"</a>
                    <{if $xoops_isadmin == true}>
                <a href="reviews.php?op=edit&id=<{$reviews.id}>" title="<{translate key="_EDIT" dir=$dirname}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{translate key="_EDIT" dir=$dirname}>" title="<{translate key="_EDIT" dir=$dirname}>"></a>
                <a href="admin/reviews.php?op=delete&id=<{$reviews.id}>" title="<{translate key="_DELETE" dir=$dirname}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{translate key="_DELETE" dir=$dirname}>" title="<{translate key="_DELETE" dir=$dirname}>"</a>
                    <{/if}>
                </td>
            </tr>
            </tbody>
        <{/foreach}>
    </table>
</div>

<{$pagenav}>
<{$commentsnav}> <{$lang_notice}>
<{if $comment_mode == "flat"}>
    <{include file="db:system_comments_flat.tpl"}>
<{elseif $comment_mode == "thread"}>
    <{include file="db:system_comments_thread.tpl"}>
<{elseif $comment_mode == "nest"}>
    <{include file="db:system_comments_nest.tpl"}>
<{/if}>
<{include file="db:amreviews_footer.tpl"}>
