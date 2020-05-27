<table class="outer">
    <tr class="head">
        <th><{translate key="ID" dir=$dirname}></th>
        <th><{translate key="UID" dir=$dirname}></th>
        <th><{translate key="CATID" dir=$dirname}></th>
        <th><{translate key="WEIGHT" dir=$dirname}></th>
        <th><{translate key="TITLE" dir=$dirname}></th>
        <th><{translate key="SUBTITLE" dir=$dirname}></th>
        <th><{translate key="IMAGE_FILE" dir=$dirname}></th>
        <th><{translate key="IMAGE_ALIGN" dir=$dirname}></th>
        <th><{translate key="OUR_RATING" dir=$dirname}></th>
        <th><{translate key="REVIEWER_IP" dir=$dirname}></th>
        <th><{translate key="TEASER" dir=$dirname}></th>
        <th><{translate key="ITEM_DETAILS" dir=$dirname}></th>
        <th><{translate key="REVIEW" dir=$dirname}></th>
        <th><{translate key="KEYWORDS" dir=$dirname}></th>
        <th><{translate key="DATE" dir=$dirname}></th>
        <th><{translate key="DATE_PUBLISH" dir=$dirname}></th>
        <th><{translate key="DATE_END" dir=$dirname}></th>
        <th><{translate key="VIEWS" dir=$dirname}></th>
        <th><{translate key="PAGETITLE" dir=$dirname}></th>
        <th><{translate key="METAHEADERS" dir=$dirname}></th>
        <th><{translate key="COMMENTS" dir=$dirname}></th>
        <th><{translate key="NOTIFY" dir=$dirname}></th>
        <th><{translate key="VALIDATED" dir=$dirname}></th>
        <th><{translate key="SHOWME" dir=$dirname}></th>
        <th><{translate key="HIGHLIGHT" dir=$dirname}></th>
        <th><{translate key="NOHTML" dir=$dirname}></th>
        <th><{translate key="NOSMILEY" dir=$dirname}></th>
        <th><{translate key="NOXCODE" dir=$dirname}></th>
        <th><{translate key="NOIMAGE" dir=$dirname}></th>
        <th><{translate key="NOBR" dir=$dirname}></th>
    </tr>
    <{foreach item=reviews from=$block}>
        <tr class="<{cycle values = 'even,odd'}>">
            <td>
                <{$reviews.id}>
                <{$reviews.uid}>
                <{$reviews.catid}>
                <{$reviews.weight}>
                <{$reviews.title}>
                <{$reviews.subtitle}>
                <{$reviews.image_file}>
                <{$reviews.image_align}>
                <{$reviews.our_rating}>
                <{$reviews.reviewer_ip}>
                <{$reviews.teaser}>
                <{$reviews.item_details}>
                <{$reviews.review}>
                <{$reviews.keywords}>
                <{$reviews.date}>
                <{$reviews.date_publish}>
                <{$reviews.date_end}>
                <{$reviews.views}>
                <{$reviews.pagetitle}>
                <{$reviews.metaheaders}>
                <{$reviews.comments}>
                <{$reviews.notify}>
                <{$reviews.validated}>
                <{$reviews.showme}>
                <{$reviews.highlight}>
                <{$reviews.nohtml}>
                <{$reviews.nosmiley}>
                <{$reviews.noxcode}>
                <{$reviews.noimage}>
                <{$reviews.nobr}>
            </td>
        </tr>
    <{/foreach}>
</table>
