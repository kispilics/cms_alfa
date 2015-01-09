{include file="admin/admin_header.tpl"}

	
	<div id="main">
			
			{if $ok neq '' or $error neq ''}
			<div class="full_w">
				{if $ok neq ''}
					<div class="n_ok"><p>{$ok}</p></div>
				{/if}
				{if $error neq ''}
					<div class="n_error"><p>{$error}</p></div>		
				{/if}
			</div>
			{/if}
			
			<div class="full_w">
				<div class="h_title">{$table_title}</div>
				{$form->html_form}
			</div>
			
		</div>
	
{include file="admin/admin_footer.tpl"}