<{if $catRows > 0}>
    <div class="outer">
        <form name="select" action="cat.php?op=" method="POST"
              onsubmit="if(window.document.select.op.value ==='') {return false;} else if (window.document.select.op.value ==='delete') {return deleteSubmitValid('catId[]');} else if (isOneChecked('catId[]')) {return true;} else {alert('<{translate key="AM_CAT_SELECTED_ERROR" dir=$dirname}>'); return false;}">
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


            <table class="$cat" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"></th>
                    <th class="left"><{$selectorid}></th>
                    <th class="left"><{$selectorpid}></th>
                    <th class="left"><{$selectortitle}></th>
                    <th class="left"><{$selectordescription}></th>
                    <th class="left"><{$selectorweight}></th>
                    <th class="left"><{$selectorshowme}></th>

                    <th class="center width5"><{translate key="FORM_ACTION" dir=$dirname}></th>
                </tr>
                <{foreach item=catArray from=$catArrays}>
                    <tr class="<{cycle values="odd,even"}>">

                        <td align="center" style="vertical-align:middle;"><input type="checkbox" name="cat_id[]" title="cat_id[]" id="cat_id[]" value="<{$catArray.cat_id}>"></td>
                        <td class='left'><{$catArray.id}></td>
                        <td class='left'><{$catArray.pid}></td>
                        <td class='left'><{$catArray.title}></td>
                        <td class='left'><{$catArray.description}></td>
                        <td class='left'><{$catArray.weight}></td>
                        <td class='left'><{$catArray.showme}></td>


                        <td class="center width5"><{$catArray.edit_delete}></td>
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
                    <th class="left"><{$selectorpid}></th>
                    <th class="left"><{$selectortitle}></th>
                    <th class="left"><{$selectordescription}></th>
                    <th class="left"><{$selectorweight}></th>
                    <th class="left"><{$selectorshowme}></th>

                    <th class="center width5"><{translate key="FORM_ACTION" dir=$dirname}></th>
                </tr>
                <tr>
                    <td class="errorMsg" colspan="11">There are no $cat</td>
                </tr>
            </table>
    </div>
    <br>
    <br>
<{/if}>
