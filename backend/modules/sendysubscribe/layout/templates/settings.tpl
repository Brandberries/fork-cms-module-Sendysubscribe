{include:{$BACKEND_CORE_PATH}/layout/templates/head.tpl}
{include:{$BACKEND_CORE_PATH}/layout/templates/structure_start_module.tpl}

<div class="pageTitle">
	<h2>{$lblModuleSettings|ucfirst}: {$lblSendysubscribe}</h2>
</div>


{form:settings}
	<div class="box horizontal">
		<div class="heading">
			<h3>{$lblApplication|ucfirst}</h3>
		</div>
		<div class="options">
			{$msgSendysubscribeHelp}
		</div>
		<div class="options">
			<p>
				<label for="label">{$lblApiUrl|ucfirst}<abbr title="{$lblRequiredField}">*</abbr></label>
				{$txtApiUrl}{$txtApiUrlError}
			</p>
			<p>
				<label for="label">{$lblApiKey|ucfirst}<abbr title="{$lblRequiredField}">*</abbr></label>
				{$txtApiKey} {$txtApiKeyError}
			</p>
		</div>
	</div>

	<div class="fullwidthOptions">
		<div class="buttonHolderRight">
			<input id="save" class="inputButton button mainButton" type="submit" name="save" value="{$lblSave|ucfirst}" />
		</div>
	</div>
{/form:settings}

{include:{$BACKEND_CORE_PATH}/layout/templates/structure_end_module.tpl}
{include:{$BACKEND_CORE_PATH}/layout/templates/footer.tpl}