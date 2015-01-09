{include file="admin/admin_header.tpl"}

	
	<div id="main">
			
			
			<div class="full_w">
				<div class="h_title">{$table_title}</div>
				<br /><br />
				{foreach from=$message key=key item=item}
					<div>
						<div>
							<div>
								<p><strong>{$item.name}</strong><span style="float:right;">{$item.date}</span></p>
							</div>
						</div>
						<div>
							<p>{$item.email}</p>
						</div>
						<div>
							<p>{$item.phone}</p>
						</div>
						<div>
							<p>{$item.message}</p>
						</div>
						<div class="pagination">
							<a href="admin_contact/show/">Back</a>
						</div>
					</div>
				{/foreach}
			</div>
			
		</div>
	
{include file="admin/admin_footer.tpl"}