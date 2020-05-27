<div class="header">
    <span class="left"><b><{translate key="TITLE" dir=$dirname}></b>&#58;&#160;</span>
    <span class="left"><{translate key="DESC" dir=$dirname}></span><br>
</div>
<div class="head">
    <{if $adv != ''}>
        <div class="center"><{$adv}></div>
    <{/if}>
</div>
<br>
<ul class="nav nav-pills">
    <li class="active"><a href="<{$amreviews_url}>"><{translate key="INDEX" dir=$dirname}></a></li>

    <li><a href="<{$amreviews_url}>/reviews.php"><{translate key="REVIEWS" dir=$dirname}></a></li>
    <li><a href="<{$amreviews_url}>/cat.php"><{translate key="CAT" dir=$dirname}></a></li>
    <li><a href="<{$amreviews_url}>/rate.php"><{translate key="RATE" dir=$dirname}></a></li>
</ul>

<br>
