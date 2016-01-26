<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=<{$xoops_charset}>"/>
    <meta http-equiv="content-language" content="<{$xoops_langcode}>"/>
    <meta name="keywords" content="<{$xoops_meta_keywords}>"/>
    <meta name="description" content="<{$xoops_meta_description}>"/>
    <meta name="rating" content="<{$xoops_meta_rating}>"/>
    <meta name="author" content="<{$xoops_meta_author}>"/>
    <meta name="copyright" content="<{$xoops_meta_copyright}>"/>
    <meta name="generator" content="XOOPS"/>
    <!-- <meta name="robots" content="<{$xoops_meta_robots}>" /> -->
    <meta name="robots" content="noindex, nofollow"/>

    <title><{$printtitle}></title>

    <link rel="stylesheet" type="text/css" media="all" href="<{$xoops_url}>/modules/<{$mod_dir}>/assets/css/style.css"/>

    <script language="Javascript1.2" type="text/javascript">
        <!--
        function printpage() {
            window.print();
        }
        //-->
    </script>

</head>
<body class="printBody" onload="printpage()" s>

<div class="printContainer">
    <!--<div><{$id}></div>-->

    <div class="printTitle"><{$title}></div>
    <div class="printSubTitle"><{$subtitle}></div>
    <div class="printDate"><{$reviewedBy}> <a
                href="<{$xoops_url}>/userinfo.php?uid=<{$reviewer_uid}>"><{$reviewer_name}></a> <{$gen_on}> <{$date}>
    </div>
    <hr/>

    <table border="0" width="100%">
        <tr>
            <td valign="top">
                <strong><{$our_ratingcap}></strong> <{$our_rating}>

                <table border="0" cellpadding="0" cellspacing="0" style="width: auto;">
                    <tr>
                        <td>
                            <strong><{$user_ratingcap}></strong>&nbsp;
                        </td>
                        <td>
                            <ul class="star-rating" title="<{$user_rating}>/5 stars from <{$user_votes}> votes.">
                                <li class="current-rating" style="width:<{$user_rating_star}>px;"><span
                                            title="title"><{$user_rating}>/5 Stars.</span></li>
                                <li class="one-star"><span class="hide">1 star</span></li>
                                <li class="two-stars"><span class="hide">2 stars</span></li>
                                <li class="three-stars"><span class="hide">3 stars</span></li>
                                <li class="four-stars"><span class="hide">4 stars</span></li>
                                <li class="five-stars"><span class="hide">5 stars</span></li>
                            </ul>
                        </td>
                    </tr>
                </table>

                <br/>
                <strong><{$itemDetailscap}></strong><br/>
                <{$itemDetails}>

            </td>
            <td>
                <img src="<{$xoops_url}><{$photopath}>/thumb/<{$imagefilename}>" align="right" border="0"
                     alt="<{$imagefilename}>"/>
            </td>
        </tr>
    </table>

    <div class="printReviewText">
        <{$review}>
    </div>
    <hr/>
    <div class="printFooter"><{$publishedOn}> <{$publishedBy}> - <a href="<{$xoops_url}>"><{$xoops_url}></a><br/>
        <a href="<{$xoops_url}>/modules/<{$mod_dir}>/review.php?id=<{$id}>"><{$xoops_url}>/modules/<{$mod_dir}>
            /review.php?id=<{$id}></a></div>

</div>

</body>
</html>
