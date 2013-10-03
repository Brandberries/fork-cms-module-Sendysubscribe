{include:{$BACKEND_CORE_PATH}/layout/templates/head.tpl}
{include:{$BACKEND_CORE_PATH}/layout/templates/structure_start_module.tpl}

<div class="box horizontal">
	<div class="heading">
		<h3>{$lblListWidget|ucfirst}</h3>
	</div>
	<div class="content">

		{option:datagrid}
			<div class="datagridHolder">
				{$datagrid}
			</div>
		{/option:datagrid}
	
		<div class="buttonHolderRight">
			<a href="{$var|geturl:'add'}" class="button icon iconAdd" title="{$lblAdd|ucfirst}">
				<span>{$lblAdd|ucfirst}</span>
			</a>
		</div>
	</div>
</div>

{include:{$BACKEND_CORE_PATH}/layout/templates/structure_end_module.tpl}
{include:{$BACKEND_CORE_PATH}/layout/templates/footer.tpl}