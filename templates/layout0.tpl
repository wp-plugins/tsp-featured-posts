<!-- // Side bar featured item with title -->
<article id="post-{$ID}" {$post_class}>
	<div id="tspfp_article" class="layout_default layout0">
		<div id="full">
			{if isset($first_img) }
				<img align="left" src="{$first_img}" alt="{$long_title}" width="{$widththumb}" height="{$heightthumb}"/>
			{elseif isset($first_video)}
				<code>{$first_video}</code>
			{/if}
			<header class="entry-header">
				<span class="entry-title"><a target="{$target}" href="{$permalink}" title="{$long_title}">{$long_title}</a></span>
			</header><!-- .entry-header -->
			<span class="entry-summary">{$text}</span>
		</div>
		<footer class="entry-meta">
			{$wp_link_pages}
			{$edit_post_link}
		</footer><!-- .entry-meta -->
	</div>   
</article><!-- #post-{$ID} -->
