<{include file="db:amreviews_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title">Reviews </h2></div>

    <table class="table table-striped">
        <thead>
        <tr>
        </tr>
        </thead>
        <tbody>
        <tr>

            <td><{translate key="REVIEWS_ID" dir=$dirname}></td>
            <td><{$reviews.id}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_UID" dir=$dirname}></td>
            <td><{$reviews.uid}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_CATID" dir=$dirname}></td>
            <td><{$reviews.catid}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_WEIGHT" dir=$dirname}></td>
            <td><{$reviews.weight}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_TITLE" dir=$dirname}></td>
            <td><{$reviews.title}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_SUBTITLE" dir=$dirname}></td>
            <td><{$reviews.subtitle}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_IMAGE_FILE" dir=$dirname}></td>
            <td><img src="<{$xoops_url}>/uploads/amreviews/images/<{$reviews.image_file}>" alt="reviews" class="img-responsive"></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_IMAGE_ALIGN" dir=$dirname}></td>
            <td><{$reviews.image_align}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_OUR_RATING" dir=$dirname}></td>
            <td><{$reviews.our_rating}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_REVIEWER_IP" dir=$dirname}></td>
            <td><{$reviews.reviewer_ip}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_TEASER" dir=$dirname}></td>
            <td><{$reviews.teaser}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_ITEM_DETAILS" dir=$dirname}></td>
            <td><{$reviews.item_details}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_REVIEW" dir=$dirname}></td>
            <td><{$reviews.review}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_KEYWORDS" dir=$dirname}></td>
            <td><{$reviews.keywords}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_DATE" dir=$dirname}></td>
            <td><{$reviews.date}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_DATE_PUBLISH" dir=$dirname}></td>
            <td><{$reviews.date_publish}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_DATE_END" dir=$dirname}></td>
            <td><{$reviews.date_end}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_VIEWS" dir=$dirname}></td>
            <td><{$reviews.views}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_PAGETITLE" dir=$dirname}></td>
            <td><{$reviews.pagetitle}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_METAHEADERS" dir=$dirname}></td>
            <td><{$reviews.metaheaders}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_COMMENTS" dir=$dirname}></td>
            <td><{$reviews.comments}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_NOTIFY" dir=$dirname}></td>
            <td><{$reviews.notify}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_VALIDATED" dir=$dirname}></td>
            <td><{$reviews.validated}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_SHOWME" dir=$dirname}></td>
            <td><{$reviews.showme}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_HIGHLIGHT" dir=$dirname}></td>
            <td><{$reviews.highlight}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_NOHTML" dir=$dirname}></td>
            <td><{$reviews.nohtml}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_NOSMILEY" dir=$dirname}></td>
            <td><{$reviews.nosmiley}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_NOXCODE" dir=$dirname}></td>
            <td><{$reviews.noxcode}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_NOIMAGE" dir=$dirname}></td>
            <td><{$reviews.noimage}></td>
        </tr>
        <tr>
            <td><{translate key="REVIEWS_NOBR" dir=$dirname}></td>
            <td><{$reviews.nobr}></td>
        </tr>
        <tr>
            <td><{translate key="ACTION" dir=$dirname}></td>
            <td>
                <!--<a href="reviews.php?op=view&id=<{$reviews.id}>" title="<{translate key="_PREVIEW" dir=$dirname}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{translate key="_PREVIEW" dir=$dirname}>" title="<{translate key="_PREVIEW" dir=$dirname}>"</a>&nbsp;-->
                <{if $xoops_isadmin == true}>
                <a href="reviews.php?op=edit&id=<{$reviews.id}>" title="<{translate key="_EDIT" dir=$dirname}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{translate key="_EDIT" dir=$dirname}>" title="<{translate key="_EDIT" dir=$dirname}>"></a>
                    &nbsp;
                <a href="admin/reviews.php?op=delete&id=<{$reviews.id}>" title="<{translate key="_DELETE" dir=$dirname}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{translate key="_DELETE" dir=$dirname}>" title="<{translate key="_DELETE" dir=$dirname}>"</a>
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

