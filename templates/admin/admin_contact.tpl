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
				<div class="h_title">{$table_title}
				{if $excel_export eq 'on'}
					<a href="{$smarty.get.class}/export/" style="color:#fff;">
						<span style="float:right;padding-right:15px;">Exporte Excel File</span>
						<span style="float:right;padding-bottom:16px;" class="table-icon excel"></span> 
					</a>
					{/if}
				</div>
				<table>
					<thead>
						<tr>
							{foreach from=$table_fieldName key=key item=i}
								<th scope="col">{$i}</th>
							{/foreach}
						</tr>
					</thead>
						
					<tbody>
						
						<p style="display:none;">{counter start=0 skip=1}</p>
						{foreach from=$listing key=data item=i}
						{if $i.viewed eq 0}
						<tr>
							<td class="align-center"><strong><big>{counter}</big></strong></td>
							<td class="align-center"><strong><big>{$i.name}</big></strong></td>
							<td class="align-center"><strong><big>{$i.date}</big></strong></td>
							
							<td style="text-align:center;">
								{if $set_edit_link eq 'on'}
								<a href="{$read}{$i.id}" class="table-icon contact" title="Read" style="margin-right:25px;"></a>
								{/if}
								{if $set_delete_link eq 'on'}
								<a style="cursor: pointer;" class="table-icon delete" title="Delete" onclick="myFunction('{$delete}{$i.id}')"></a>
								{/if}
							</td>

						</tr>
						{else}
						<tr>
							<td class="align-center">{counter}</td>
							<td class="align-center">{$i.name}</td>
							<td class="align-center">{$i.date}</td>

							<td style="text-align:center;">
								{if $set_edit_link eq 'on'}
								<a href="{$read}{$i.id}" class="table-icon read" title="Read" style="margin-right:25px;"></a>
								{/if}
								{if $set_delete_link eq 'on'}
								<a style="cursor: pointer;" class="table-icon delete" title="Delete" onclick="myFunction('{$delete}{$i.id}')"></a>
								{/if}
							</td>
						</tr>
						{/if}
						{/foreach}
						
					</tbody>
				</table>
				
				<div class="entry">
					<div class="pagination">
						
						{$page_turner}
						
					</div>
				</div>
			</div>
		</div>
{include file="admin/admin_footer.tpl"}