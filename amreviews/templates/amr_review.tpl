<{$category_path}>

<hr/>

<table border="0" cellpadding="2" cellspacing="0" class="outer">
    <tr>
        <td class="itemHead"><span class="itemTitle" style="font-weight: bold;"><{$title}></span></td>
    </tr>
    <tr>
        <td class="itemInfo">
            <!-- info header -->
            <{if $reviewer_show == 1}>
                <span class="itemPoster"><{$reviewed_by}> <a
                            href="<{$xoops_url}>/userinfo.php?uid=<{$reviewer_uid}>"><{$reviewer_name}></a> <{$gen_on}></span>
            <{/if}>
            <span class="itemPostDate"><{$date}></span>
            <span class="itemPoster">(<{$views}> <{$readscap}>)</span>
        </td>
    </tr>
    <tr class="itemBody">
        <td>
            <!-- content table -->
            <table border="0">
                <tr>
                    <td>
                        <!-- highlight image -->
                        <{if $hiliteimg_switch eq 0}>
                            <a href="<{$xoops_url}><{$photopath}>/<{$imagefilename}>" target="_blank"><img
                                        src="<{$xoops_url}><{$photopath}>/thumb/<{$imagefilename}>" align="right"
                                        border="0" alt="<{$imagefilename}>"/></a>
                        <{/if}>
                        <{if $hiliteimg_switch eq 1}>
                            <a href="<{$xoops_url}><{$photopath}>/<{$imagefilename}>" rel="lightbox"><img
                                        src="<{$xoops_url}><{$photopath}>/thumb/<{$imagefilename}>" align="right"
                                        border="0" alt="<{$imagefilename}>"/></a>
                        <{/if}>

                        <{if $showsubtitle == 1}>
                            <span class="amreviewSubtitle"><{$subtitle}></span>
                            <br/>
                        <{/if}>

                        <br/>
                        <strong><{$our_ratingcap}></strong> <{$our_rating}>
                        <!--<br />
                        <strong><{$user_ratingcap}></strong> <a href="<{$xoops_url}>/modules/<{$mod_dir}>/rate.php?id=<{$id}>"><img src="<{$xoops_url}>/modules/<{$mod_dir}>/assets/images/<{$imgFileName}>" title="<{$imgALT}>" alt="<{$imgALT}>" /></a>
                        -->
                        <br/>
                        <table border="0" cellpadding="0" cellspacing="0" style="width: auto;">
                            <tr>
                                <td>
                                    <strong><{$user_ratingcap}></strong>&nbsp;
                                </td>
                                <td>
                                    <{if $voted neq 1}><!-- onMouseover="window.status='ww'; return true;" onMouseout="window.status=' '; return true" -->
                                    <ul class="star-rating">
                                        <li class="current-rating" style="width:<{$user_rating_star}>px;">
                                            Currently <{$user_rating}>/5 Stars.
                                        </li>
                                        <li><a href="javascript:;" onclick="location='rate.php?rate=1&amp;id=<{$id}>'"
                                               title="Rate this 1 star out of 5" class="one-star">1 star</a></li>
                                        <li><a href="javascript:;" onclick="location='rate.php?rate=2&amp;id=<{$id}>'"
                                               title="Rate this 2 stars out of 5" class="two-stars">2 stars</a></li>
                                        <li><a href="javascript:;" onclick="location='rate.php?rate=3&amp;id=<{$id}>'"
                                               title="Rate this 3 stars out of 5" class="three-stars">3 stars</a></li>
                                        <li><a href="javascript:;" onclick="location='rate.php?rate=4&amp;id=<{$id}>'"
                                               title="Rate this 4 stars out of 5" class="four-stars">4 stars</a></li>
                                        <li><a href="javascript:;" onclick="location='rate.php?rate=5&amp;id=<{$id}>'"
                                               title="Rate this 5 stars out of 5" class="five-stars">5 stars</a></li>
                                        <{/if}>
                                        <{if $voted eq 1}>
                                        <ul class="star-rating"
                                            title="<{$user_rating}>/5 stars from <{$user_votes}> votes.">
                                            <li class="current-rating" style="width:<{$user_rating_star}>px;"><span
                                                        title="title"><{$user_rating}>/5 Stars.</span></li>
                                            <li class="one-star"><span class="hide">1 star</span></li>
                                            <li class="two-stars"><span class="hide">2 stars</span></li>
                                            <li class="three-stars"><span class="hide">3 stars</span></li>
                                            <li class="four-stars"><span class="hide">4 stars</span></li>
                                            <li class="five-stars"><span class="hide">5 stars</span></li>
                                            <{/if}>
                                        </ul>
                                </td>
                            </tr>
                        </table>


                        <br/>
                        <strong><{$item_detailscap}></strong><br/>
                        <{$item_details}>

                    </td>
                </tr>
            </table>
            <hr width="80%"/>
            <table border="0">
                <tr>
                    <td>
                        <div class="itemText">
                            <{$review}>
                        </div>


                        <{if $numpages neq 1}>
                            <table border="0" align="center" style="width: 98%;">
                                <tr>
                                    <td>
                                        <em><{$pagenum}> <{$pageofint}> <{$pageof}> <{$pagenumint}></em>
                                    </td>
                                    <td style="text-align: right;">
                                        <{$pageprev}> <strong>::</strong> <{$pagenext}>
                                    </td>
                                </tr>
                            </table>
                        <{/if}>

                    </td>
                </tr>
            </table>
            <!-- end content table -->
        </td>
    </tr>
    <tr>
        <td class="itemFoot">

            <!-- back -->
            <a href="<{$xoops_url}>/modules/<{$mod_dir}>/"><img src="<{xoModuleIcons16 back.png}>" alt="<{$backcap}>"
                                                                title="<{$backcap}>"/></a>
            <!-- switch for print -->
            <{if $print_switch == 1}>
                <a href="<{$xoops_url}>/modules/<{$mod_dir}>/print.php?id=<{$id}>" target="_blank"><img
                            src="<{xoModuleIcons16 printer.png}>" alt="<{$printcap}>" title="<{$printcap}>"/></a>
            <{/if}>
            <!-- switch for e-mail -->
            <{if $email_switch == 1}>
                <a href="<{$xoops_url}>/modules/<{$mod_dir}>/email.php?id=<{$id}>"><img
                            src="<{xoModuleIcons16 mail_forward.png}>" alt="<{$emailcap}>" title="<{$emailcap}>"/></a>
            <{/if}>
            <!-- switch for PDF -->
            <{if $pdf_switch == 1}>
                <a href="<{$xoops_url}>/modules/<{$mod_dir}>/makepdf.php?id=<{$id}>" target="_blank"><img
                            src="<{xoModuleIcons16 pdf.png}>" alt="<{$emailcap}>" title="<{$pdfcap}>"/></a>
            <{/if}>
            <!-- switch edit for admin -->
            <{if $isadmin == 1}>
                <a href="<{$xoops_url}>/modules/<{$mod_dir}>/admin/review.php?op=edit&id=<{$id}>"><img
                            src="<{xoModuleIcons16 edit.png}>" alt="<{$emailcap}>" title="<{$editcap}>"/></a>
            <{/if}>
            <!-- switch delete for admin -->
            <{if $isadmin == 1}>
                <a href="<{$xoops_url}>/modules/<{$mod_dir}>/admin/review.php?op=del&id=<{$id}>"><img
                            src="<{xoModuleIcons16 delete.png}>" alt="<{$emailcap}>" title="<{$deletecap}>"/></a>
            <{/if}>

        </td>
    </tr>
</table>

<{if $allowcomments eq 1}>

    <!-- comments code -->
    <div style="text-align: center; padding: 3px; margin: 3px;">
        <{$commentsnav}>
        <{$lang_notice}>
    </div>
    <div style="margin: 3px; padding: 3px;">
        <!-- start comments loop -->
        <{if $comment_mode == "flat"}>
            <{include file="db:system_comments_flat.html"}>
        <{elseif $comment_mode == "thread"}>
            <{include file="db:system_comments_thread.html"}>
        <{elseif $comment_mode == "nest"}>
            <{include file="db:system_comments_nest.html"}>
        <{/if}>
        <!-- end comments loop -->
    </div>
    <!-- end comments code -->
<{/if}>

