<{if $reviewsRows > 0}>
    <div class="outer">
        <form name="select" action="reviews.php?op=" method="POST"
              onsubmit="if(window.document.select.op.value ==='') {return false;} else if (window.document.select.op.value ==='delete') {return deleteSubmitValid('reviewsId[]');} else if (isOneChecked('reviewsId[]')) {return true;} else {alert('<{translate key="AM_REVIEWS_SELECTED_ERROR" dir=$dirname}>'); return false;}">
            <input type="hidden" name="confirm" value="1">
            <div class="floatleft">
                <select name="op">
                    <option value=""><{translate key="SELECT" dir=$dirname}></option>
                    <option value="delete"><{translate key="SELECTED_DELETE" dir=$dirname}></option>
                </select>
                <input id="submitUp" class="formButton" type="submit" name="submitselect" value="<{translate key="_SUBMIT" dir=$dirname}>" title="<{translate key="_SUBMIT" dir=$dirname}>">
            </div>
            <div class="floatcenter0">
                <div id="pagenav"><{$pagenav}></div>
            </div>


            <table class="$reviews" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"></th>
                    <th class="left"><{$selectorid}></th>
                    <th class="left"><{$selectoruid}></th>
                    <th class="left"><{$selectorcatid}></th>
                    <th class="left"><{$selectorweight}></th>
                    <th class="left"><{$selectortitle}></th>
                    <th class="left"><{$selectorsubtitle}></th>
                    <th class="left"><{$selectorimage_file}></th>
                    <th class="left"><{$selectorimage_align}></th>
                    <th class="left"><{$selectorour_rating}></th>
                    <th class="left"><{$selectorreviewer_ip}></th>
                    <th class="left"><{$selectorteaser}></th>
                    <th class="left"><{$selectoritem_details}></th>
                    <th class="left"><{$selectorreview}></th>
                    <th class="left"><{$selectorkeywords}></th>
                    <th class="left"><{$selectordate}></th>
                    <th class="left"><{$selectordate_publish}></th>
                    <th class="left"><{$selectordate_end}></th>
                    <th class="center"><{$selectorviews}></th>
                    <th class="left"><{$selectorpagetitle}></th>
                    <th class="left"><{$selectormetaheaders}></th>
                    <th class="left"><{$selectorcomments}></th>
                    <th class="left"><{$selectornotify}></th>
                    <th class="left"><{$selectorvalidated}></th>
                    <th class="left"><{$selectorshowme}></th>
                    <th class="left"><{$selectorhighlight}></th>
                    <th class="left"><{$selectornohtml}></th>
                    <th class="left"><{$selectornosmiley}></th>
                    <th class="left"><{$selectornoxcode}></th>
                    <th class="left"><{$selectornoimage}></th>
                    <th class="left"><{$selectornobr}></th>

                    <th class="center width5"><{translate key="FORM_ACTION" dir=$dirname}></th>
                </tr>
                <{foreach item=reviewsArray from=$reviewsArrays}>
                    <tr class="<{cycle values="odd,even"}>">

                        <td align="center" style="vertical-align:middle;"><input type="checkbox" name="reviews_id[]" title="reviews_id[]" id="reviews_id[]" value="<{$reviewsArray.reviews_id}>"></td>
                        <td class='left'><{$reviewsArray.id}></td>
                        <td class='left'><{$reviewsArray.uid}></td>
                        <td class='left'><{$reviewsArray.catid}></td>
                        <td class='left'><{$reviewsArray.weight}></td>
                        <td class='left'><{$reviewsArray.title}></td>
                        <td class='left'><{$reviewsArray.subtitle}></td>
                        <td class='left'><{$reviewsArray.image_file}></td>
                        <td class='left'><{$reviewsArray.image_align}></td>
                        <td class='left'><{$reviewsArray.our_rating}></td>
                        <td class='left'><{$reviewsArray.reviewer_ip}></td>
                        <td class='left'><{$reviewsArray.teaser}></td>
                        <td class='left'><{$reviewsArray.item_details}></td>
                        <td class='left'><{$reviewsArray.review}></td>
                        <td class='left'><{$reviewsArray.keywords}></td>
                        <td class='left'><{$reviewsArray.date}></td>
                        <td class='left'><{$reviewsArray.date_publish}></td>
                        <td class='left'><{$reviewsArray.date_end}></td>
                        <td class='center'><{$reviewsArray.views}></td>
                        <td class='left'><{$reviewsArray.pagetitle}></td>
                        <td class='left'><{$reviewsArray.metaheaders}></td>
                        <td class='left'><{$reviewsArray.comments}></td>
                        <td class='left'><{$reviewsArray.notify}></td>
                        <td class='left'><{$reviewsArray.validated}></td>
                        <td class='left'><{$reviewsArray.showme}></td>
                        <td class='left'><{$reviewsArray.highlight}></td>
                        <td class='left'><{$reviewsArray.nohtml}></td>
                        <td class='left'><{$reviewsArray.nosmiley}></td>
                        <td class='left'><{$reviewsArray.noxcode}></td>
                        <td class='left'><{$reviewsArray.noimage}></td>
                        <td class='left'><{$reviewsArray.nobr}></td>


                        <td class="center width5"><{$reviewsArray.edit_delete}></td>
                    </tr>
                <{/foreach}>
            </table>
            <br>
            <br>
            <{else}>
            <table width="100%" cellspacing="1" class="outer">
                <tr>

                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"></th>
                    <th class="left"><{$selectorid}></th>
                    <th class="left"><{$selectoruid}></th>
                    <th class="left"><{$selectorcatid}></th>
                    <th class="left"><{$selectorweight}></th>
                    <th class="left"><{$selectortitle}></th>
                    <th class="left"><{$selectorsubtitle}></th>
                    <th class="left"><{$selectorimage_file}></th>
                    <th class="left"><{$selectorimage_align}></th>
                    <th class="left"><{$selectorour_rating}></th>
                    <th class="left"><{$selectorreviewer_ip}></th>
                    <th class="left"><{$selectorteaser}></th>
                    <th class="left"><{$selectoritem_details}></th>
                    <th class="left"><{$selectorreview}></th>
                    <th class="left"><{$selectorkeywords}></th>
                    <th class="left"><{$selectordate}></th>
                    <th class="left"><{$selectordate_publish}></th>
                    <th class="left"><{$selectordate_end}></th>
                    <th class="center"><{$selectorviews}></th>
                    <th class="left"><{$selectorpagetitle}></th>
                    <th class="left"><{$selectormetaheaders}></th>
                    <th class="left"><{$selectorcomments}></th>
                    <th class="left"><{$selectornotify}></th>
                    <th class="left"><{$selectorvalidated}></th>
                    <th class="left"><{$selectorshowme}></th>
                    <th class="left"><{$selectorhighlight}></th>
                    <th class="left"><{$selectornohtml}></th>
                    <th class="left"><{$selectornosmiley}></th>
                    <th class="left"><{$selectornoxcode}></th>
                    <th class="left"><{$selectornoimage}></th>
                    <th class="left"><{$selectornobr}></th>

                    <th class="center width5"><{translate key="FORM_ACTION" dir=$dirname}></th>
                </tr>
                <tr>
                    <td class="errorMsg" colspan="11">There are no $reviews</td>
                </tr>
            </table>
    </div>
    <br>
    <br>
<{/if}>
