{include:{$BACKEND_CORE_PATH}/layout/templates/head.tpl}
{include:{$BACKEND_CORE_PATH}/layout/templates/structure_start_module.tpl}
 
  

{form:add}
	<div class="box horizontal">
		<div class="heading">
			<h3>{$lblAddWidget|ucfirst}</h3>
		</div>
		<div class="content">
			<fieldset>
				<p>
					<label for="label">{$lblLabel|ucfirst}<abbr title="{$lblRequiredField}">*</abbr></label>
					{$txtLabel} {$txtLabelError}
				</p>
				<p>
					<label for="label">{$lblListId|ucfirst}<abbr title="{$lblRequiredField}">*</abbr></label>
					{$txtListId} {$txtListIdError}
				</p>
	
			</fieldset>
		</div>
	</div>

	<div class="fullwidthOptions">
		<div class="buttonHolderRight">
			<input id="addButton" class="inputButton button mainButton" type="submit" name="add" value="{$lblAdd|ucfirst}" />
		</div>
	</div>
{/form:add}

{include:{$BACKEND_CORE_PATH}/layout/templates/structure_end_module.tpl}
{include:{$BACKEND_CORE_PATH}/layout/templates/footer.tpl}
