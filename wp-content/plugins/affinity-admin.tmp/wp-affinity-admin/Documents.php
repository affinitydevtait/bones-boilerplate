<?
/**
 * Documents - Advanced Custom Fields Serials
 * Documents - Plugins (List of common Plugins we use)
 * Documents - Documentation / Guidelines
 * Documents - Client Help Guides
 */
class WP_Documents {
	
	/**
	 * [WP_Documents description]
	 */
	public function WP_Documents() {
		
	}

	public function get_documents_tab_content() {
		?>
		<p>Client &amp; Project Manager Documents to go here!</p>
		<?
	}

	public function get_developers_tab_content() {
		?>
		<h2>Advanced Custom Field Serials</h2>

		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="repeater">Repeater</label></th>
				<td>
					<p>QJF7-L4IX-UCNP-RF2W</p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="repeater">Options</label></th>
				<td>
					<p>OPN8-FA4J-Y2LW-81LS</p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="repeater">Gallery</label></th>
				<td>
					<p>GF72-8ME6-JS15-3PZC</p>
				</td>
			</tr>
		</table>


		<h2>Plugins</h2>

		<p>This is a list of plugins we commonly use;</p>

		<ul>
			<li>Advanced Custom Fields</li>
			<li>Contact Form 7</li>
			<li>Breadcrumb NavXT</li>
			<li>Simple Google Sitemap XML</li>
			<li>Search Regex</li>
			<li>SEO Ultimate</li>
			<li>Post Types Order</li>
		</ul>
		<?
	}
}
?>