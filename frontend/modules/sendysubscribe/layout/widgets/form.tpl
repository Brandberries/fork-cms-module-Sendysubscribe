

{form:add}
	<div class="box">
		<div class="content">
			<div id="confirm"></div>
			<div id="error"></div>
			<fieldset>
				<p>
					<label for="name">{$lblName|ucfirst}</label>
					{$txtName}
				</p>
				<p>
					<label for="email">{$lblEmail|ucfirst}<abbr title="{$lblRequiredField}">*</abbr></label>
					{$txtEmail}
				</p>
				{$hidWidgetId}
	
			</fieldset>
		</div>
	</div>

	<div class="fullwidthOptions">
		<div class="buttonHolderRight">
			<input class="inputSubmit subscribeBtn" type="submit" name="add" value="{$lblSubscribe|trim|ucfirst}" />
		</div>
	</div>
{/form:add}