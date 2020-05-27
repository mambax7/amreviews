<div id="about">
    <table class="width90 floatcenter0">
        <tr>
            <td class="aligntop width45">
                <fieldset>
                    <legend class="Slideshow_MediumTitle bold shadowlight"><{$moduleName}></legend>
                    <div>
                        <img class="logo" src="<{translate key="XOOPS_URL" dir=$dirname}>/modules/<{$module_dirname}>/<{$module_image}>" alt=""><br>
                        <label> Version : </label>
                        <text><{$module_version}></text>
                        <br>
                        <!--label><{translate key="ABOUT_RELEASEDATE" dir=$dirname}></label><text><{$module_release}></text><br /-->
                        <label><{translate key="ABOUT_DESCRIPTION" dir=$dirname}></label>
                        <text><{$module_description}></text>
                        <br>
                        <label><{translate key="ABOUT_AUTHOR" dir=$dirname}></label>
                        <text><{$module_author}></text>
                        <br>
                        <label><{translate key="ABOUT_CREDITS" dir=$dirname}></label>
                        <text><{$module_credits}></text>
                        <br>
                        <label><{translate key="ABOUT_LICENSE" dir=$dirname}></label>
                        <text><a class="tooltip" href="<{$module_license_url}>" rel="external" title="<{$module_license}><br><{$module_license_url}>"><{$module_license}></a></text>
                    </div>
                </fieldset>
                <fieldset>
                    <legend class="Slideshow_MediumTitle bold shadowlight"><{translate key="ABOUT_MODULE_INFO" dir=$dirname}></legend>
                    <div>
                        <label><{translate key="ABOUT_RELEASEDATE" dir=$dirname}></label>
                        <text class="bold"><{$module_update_date}></text>
                        <br>
                        <label><{translate key="ABOUT_MODULE_STATUS" dir=$dirname}></label>
                        <text><{$module_status}></text>
                        <br>
                        <label><{translate key="ABOUT_WEBSITE" dir=$dirname}></label>
                        <text><a class="tooltip" href="<{$module_website_url}>" rel="external" title="<{$module_website_name}> - <{$module_website_url}>"><{$module_website_name}></a></text>
                        <br>
                    </div>
                </fieldset>
                <fieldset>
                    <legend class="Slideshow_MediumTitle bold shadowlight"><{translate key="ABOUT_AUTHOR_INFO" dir=$dirname}></legend>
                    <div>
                        <label><{translate key="ABOUT_AUTHOR_NAME" dir=$dirname}></label>
                        <text><{$module_author}></text>
                        <br>
                        <label><{translate key="ABOUT_WEBSITE" dir=$dirname}></label>
                        <text><a class="tooltip" href="<{$author_website_url}>" rel="external" title="<{$author_website_name}><br><{$author_website_url}>"><{$author_website_name}></a></text>
                        <br>
                    </div>
                </fieldset>
            </td>
            <td class="aligntop width50">
                <{if $changelog}>
                    <fieldset>
                        <legend class="Slideshow_MediumTitle bold shadowlight"><{translate key="ABOUT_CHANGELOG" dir=$dirname}></legend>
                        <div class="txtchangelog"><{$changelog}></div>
                    </fieldset>
                <{/if}>
            </td>
        </tr>
    </table>
</div>
