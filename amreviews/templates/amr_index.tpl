<{$category_path}>

<hr/>

<table border="0" cellpadding="2">
    <tr>
        <!-- Start category loop -->
        <{foreach item=category from=$categories}>
        <td>
            <a href="<{$xoops_url}>/modules/<{$mod_dir}>/index.php?id=<{$category.id}>"><{$category.cat_title}></a>
            <!-- <span style="font-size: smaller;">(<{$category.rev_count}>)</span> -->
            <{if $category.subcatsswitch == 1}>
                <br/>
                <span class="amreviewSubcats"><{$category.subcats}></span>
            <{/if}>
            <br/>
        </td>

        <{if $category.newrow == 1}>
    </tr>
    <tr>
        <{/if}>
        <{/foreach}>
        <!-- End category loop -->
    </tr>
</table>

<hr class="cat_divider"/>


<{if $noreviews != 1}>
    <{foreach item=reviews from=$reviews}>
        <table border="0" cellpadding="2" cellspacing="0" class="outer">
            <tr>
                <td class="amreviewHead"><span class="itemTitle"><a
                                href="<{$xoops_url}>/modules/<{$mod_dir}>/review.php?id=<{$reviews.id}>"><{$reviews.title}></a></span>
                </td>
            </tr>
            <tr>
                <td class="itemInfo">
                    <!-- info header -->
                    <{if $reviews.reviewer_show == 1}>
                        <span class="itemPoster"><{$reviewed_by}> <a
                                    href="<{$xoops_url}>/userinfo.php?uid=<{$reviews.reviewer_uid}>"><{$reviews.reviewer_name}></a> <{$gen_on}></span>
                    <{/if}>
                    <span class="itemPostDate"><{$reviews.date}></span>
                </td>
            </tr>
            <tr>
                <td class="itemBody">
                    <a href="<{$xoops_url}>/modules/<{$mod_dir}>/review.php?id=<{$reviews.id}>"><img
                                src="<{$xoops_url}><{$reviews.photopath}>/highlight/<{$reviews.imagefilename}>"
                                alt="<{$reviews.title}>" align="<{$reviews.image_align}>" border="0"
                                style="padding: 3px;"/></a>

                    <p class="itemText">
                        <{$reviews.teaser}>
                    </p>
                </td>
            </tr>
            <tr>
                <td class="itemFoot"><!-- footer -->
                    <span class="itemPermaLink">review link</span>
                </td>
            </tr>
        </table>
        <br/>
    <{/foreach}>
<{/if}>
<{if $noreviews == 1}>
    <table class="amreviewnoreviewscap">
        <tr>
            <td><{$noreviewscap}></td>
        </tr>
    </table>
<{/if}>


<hr class="cat_divider"/>

<p>notification options and comments will go down here - no comments for
    category and listings?</p>
