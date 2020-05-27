<table class="outer">
    <tr class="head">
        <th><{translate key="ID" dir=$dirname}></th>
        <th><{translate key="PID" dir=$dirname}></th>
        <th><{translate key="TITLE" dir=$dirname}></th>
        <th><{translate key="DESCRIPTION" dir=$dirname}></th>
        <th><{translate key="WEIGHT" dir=$dirname}></th>
        <th><{translate key="SHOWME" dir=$dirname}></th>
    </tr>
    <{foreach item=cat from=$block}>
        <tr class="<{cycle values = 'even,odd'}>">
            <td>
                <{$cat.id}>
                <{$cat.pid}>
                <{$cat.title}>
                <{$cat.description}>
                <{$cat.weight}>
                <{$cat.showme}>
            </td>
        </tr>
    <{/foreach}>
</table>
