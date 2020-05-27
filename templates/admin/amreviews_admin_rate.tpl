<{if $rateRows > 0}>
    <div class="outer">
        <form name="select" action="rate.php?op=" method="POST"
              onsubmit="if(window.document.select.op.value ==='') {return false;} else if (window.document.select.op.value ==='delete') {return deleteSubmitValid('rateId[]');} else if (isOneChecked('rateId[]')) {return true;} else {alert('<{translate key="AM_RATE_SELECTED_ERROR" dir=$dirname}>'); return false;}">
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


            <table class="$rate" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"></th>
                    <th class="left"><{$selectorid}></th>
                    <th class="left"><{$selectorreview_id}></th>
                    <th class="left"><{$selectorrating}></th>
                    <th class="left"><{$selectoruid}></th>
                    <th class="left"><{$selectoruser_ip}></th>
                    <th class="left"><{$selectoruser_browser}></th>
                    <th class="left"><{$selectortitle}></th>
                    <th class="left"><{$selectortext}></th>
                    <th class="left"><{$selectordate_created}></th>
                    <th class="left"><{$selectorshowme}></th>
                    <th class="left"><{$selectorvalidated}></th>
                    <th class="left"><{$selectoruseful}></th>

                    <th class="center width5"><{translate key="FORM_ACTION" dir=$dirname}></th>
                </tr>
                <{foreach item=rateArray from=$rateArrays}>
                    <tr class="<{cycle values="odd,even"}>">

                        <td align="center" style="vertical-align:middle;"><input type="checkbox" name="rate_id[]" title="rate_id[]" id="rate_id[]" value="<{$rateArray.rate_id}>"></td>
                        <td class='left'><{$rateArray.id}></td>
                        <td class='left'><{$rateArray.review_id}></td>
                        <td class='left'><{$rateArray.rating}></td>
                        <td class='left'><{$rateArray.uid}></td>
                        <td class='left'><{$rateArray.user_ip}></td>
                        <td class='left'><{$rateArray.user_browser}></td>
                        <td class='left'><{$rateArray.title}></td>
                        <td class='left'><{$rateArray.text}></td>
                        <td class='left'><{$rateArray.date_created}></td>
                        <td class='left'><{$rateArray.showme}></td>
                        <td class='left'><{$rateArray.validated}></td>
                        <td class='left'><{$rateArray.useful}></td>


                        <td class="center width5"><{$rateArray.edit_delete}></td>
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
                    <th class="left"><{$selectorreview_id}></th>
                    <th class="left"><{$selectorrating}></th>
                    <th class="left"><{$selectoruid}></th>
                    <th class="left"><{$selectoruser_ip}></th>
                    <th class="left"><{$selectoruser_browser}></th>
                    <th class="left"><{$selectortitle}></th>
                    <th class="left"><{$selectortext}></th>
                    <th class="left"><{$selectordate_created}></th>
                    <th class="left"><{$selectorshowme}></th>
                    <th class="left"><{$selectorvalidated}></th>
                    <th class="left"><{$selectoruseful}></th>

                    <th class="center width5"><{translate key="FORM_ACTION" dir=$dirname}></th>
                </tr>
                <tr>
                    <td class="errorMsg" colspan="11">There are no $rate</td>
                </tr>
            </table>
    </div>
    <br>
    <br>
<{/if}>
