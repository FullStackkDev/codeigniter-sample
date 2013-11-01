<?php
$this->load->view('header');
?>
<h2><a id="top"></a><?php echo $this->lang->line('bambooinvoice_logo');?> <?php echo $page_title;?></h2>

<div class="work_description">
<p><strong><?php echo $this->lang->line('menu_see_also');?>:</strong><br />
  <?php echo anchor ('credits', $this->lang->line('menu_credits'));?> | <?php echo anchor ('changelog', $this->lang->line('menu_changelog'));?> | <?php echo anchor ('changelog#roadmap', $this->lang->line('menu_roadmap'));?> | <?php echo anchor ('changelog#bugs', $this->lang->line('menu_bugs'));?></a></p>
</div>

<?php
if ($this->lang->line('notice_english_only') != '') {
	echo '<p class="error">' . $this->lang->line('notice_english_only') . '</p>';
}
?>

<h3><a id="changelog"></a><?php echo $this->lang->line('menu_changelog');?></h3>
<h4>From  0.8.3 to 0.8.4</h4>
<ul>
    <li>Made most fields in settings optional.</li>
</ul>

<h4>From  0.8.2 to 0.8.3</h4>
<ul>
    <li>Added itemized invoice capability. This involved a major re-architecting of the underlying code.</li>
    <li>Added per item tax information (you can mark individual items as taxable or not) </li>
    <li>Some models autoloaded now</li>
    <li>Removed the deprecated &quot;scripts&quot; used</li>
    <li>Added a monthly title when looking at invoices in summary format to quickly tell invoices from different months</li>
    <li>Added some additional checks to prevent accidental editing of administrator data</li>
    <li>Added a settings option to toggle on and off &quot;Invoice gererated by BambooInvoice&quot; from the footer of invoices</li>
    <li>Added the ability to save PDF invoices on the server </li>
	<li>Added a utilities panel to the root system</li>
	<li>Added a database backup tool to utilities</li>
	<li>Added a PHP info tool to utilities</li>
	<li>Added Portuguese as a language option</li>
	<li>Added Bulgarian as a language option</li>
	<li>Bamboo now uses your setting for &quot;days due&quot; to determine if an invoice is overdue or not</li>
	<li>Intelligent handling of &quot;days due&quot; when displaying invoice status</li>
	<li>Modified the layout and behaviour of the settings menu</li>
	<li>Modified a few error messages to give clearer meanings</li>
    <li>Fixed a bug that caused the logo to not load into the PDF on some setups </li>
    <li>Fixed a bug that caused &quot;€&quot; to render as glitch in the PDF </li>
    <li>Fixed a bug that prevented some cc'ing when sending</li>
    <li>Fixed a bug that prevented  special characters from rendering in a client name when searching dynamically </li>
    <li>Fixed a bug that caused an error when invoice number was left blank</li>
    <li>Fixed a bug that caused overpaid invoices not to register as closed, in fact - rebuilt most of the &quot;status&quot; code to elimiate bugs </li>
</ul>
<h4><strong>Notes</strong></h4>
<ul>
    <li>In order to accomodate itemized invoices, amount, work_description, and some tax information was migrated to a new table &quot;invoice_items&quot;.</li>
    <li>Previously, due to an oversight, an invoice was considered &quot;closed&quot; if the amount paid was &gt;= the amount owing <em>not considering</em> tax. This has been changed. For example, a $100 invoice with $7 tax will not be considered &quot;closed&quot; until $107 (or more) is entered in the payment. Previously, $100 would have marked it closed. </li>
    <li>Some lines lack appropriate translation, or are machine translated. I'd be grateful for any improvements non-English speakers could suggst.  </li>
</ul>
<h4>From  0.8.1 to 0.8.2 (released Sept 13, 2007) </h4>
<ul>
    <li>Change to flashdata instead of standard userdata for sessions,  reducing the code volume and complexity</li>
    <li>Many settings such as address are no longer required fields </li>
    <li>Code cleanup, and moved many more queries into models (that's getting old now, I know)</li>
    <li>Added a few more missing language variables, around user messages in client creation</li>
    <li>Changed meta tags to noindex for the non-demo version of Bamboo to prevent accidental search engine inclusion </li>
    <li>Romanian language file</li>
    <li>Fixed a bug in the dutch language file causing headers not to be sent</li>
    <li>Fixed a bug that caused an error when invoices were only mailed to yourself</li>
    <li>Fixed a bug that sometimes incorrectly reported closed and overdue invoices </li>
    <li>Fixed a bug where change the date paid wasn't sticking</li>
    <li>Fixed a bug where some closed invoices weren't registering as such in the non-ajax calls </li>
    <li>Fixed a bug where the logo didn't go on the PDF invoice (D&eacute;j&agrave; vu all over again...) </li>
</ul>
<h4>From  0.8.0a to 0.8.1</h4>
<ul>
    <li>Code cleanup, and moved many more queries into models </li>
    <li>Adjusted the maximum length of the username and password fields to allow for 50 and 100 respectively</li>
    <li>Change in the PDF plugin helper for greater compatibility</li>
    <li>Removed the default user/pass from the login page for non-demo uses</li>
    <li>Added Spanish as a language </li>
    <li>Fixed a bug where some currency symbols weren't recognized </li>
</ul>
<h4>From  0.8.0 to 0.8.0a</h4>
<ul>
    <li>Fixed a bug where textarea newlines were converted into '\n'</li>
    <li>Added a few missing language variables</li>
    <li>Fixed a bug where the calendar wasn't changing dates.</li>
    <li>Added Dutch as a language </li>
</ul>
<h4>From 0.76 to 0.8.0</h4>
<ul>
	<li>Quarterly reports added</li>
    <li>Year to Date graph added</li>
    <li>Significant overhaul to the way languages are handled to allow for internationalization </li>
    <li>Added language files for French and German </li>
    <li>Added ability to customize the currency symbol (ie: $ vs &#163; vs &#165;)</li>
    <li>Fixed up the password reset option, and enabled it</li>
    <li>Added bambooinvoice_version flag for easier upgrade path</li>
    <li>Added a demo_flag for easier developer maintenanceWhen set to &quot;y&quot; Bamboo runs in demo mode</li>
    <li>Added configurable date-based reports</li>
    <li>Added an actual changelog page</li>
	<li>Removed the "payment terms" option for individual invoices, and implemented a global preference</li>
    <li>Cleaned up some <del>grammer</del> <ins>grammar</ins>, spelling, and wording </li>
	<li>Updated the userguide to reflect recent changes</li>
    <li>Removed short tag references for greater compatibility</li>
    <li>Added a routine to install to check for required PHP versions, libraries, and writable folders</li>
    <li>Fixed a bug where the wrong invoice number was reported when deleting</li>
    <li>Fixed a bug where closed was reporting non-closed invoices</li>
    <li>Fixed a bug where export to XML defaulted to wrong data</li>
    <li>Fixed a bug where the logo didn't go on the PDF invoice</li>
    <li>Fixed a bug where page_title didn't show in settings</li>
	<li>Removed many unused legacy files, scripts and functions, and better organized some files</li>
	<li>Moved Bamboo to CodeIgniter 1.5.4, resulting in numerous security and stability enhancements</li>
</ul>
<h4>From 0.75 to 0.76</h4>
<ul>
    <li>Upgraded to CodeIgniter 1.5.3</li>
    <li>Fixed and enhanced reporting functionality</li>
    <li>Squashed a few bugs</li>
    <li>Squashed more bugs</li>
    <li>Boy, many bugs got squashed  </li>
    <li>Added a few new model functions to allow for more potent reports down the road   </li>
</ul>
<h4>From 0.73 to 0.75</h4>
<ul>
    <li>Upgraded to CodeIgniter 1.5.2 </li>
    <li>Fixed a bug preventing email from being sent</li>
    <li>Changed the userauth system to simplify it.</li>
    <li>Fixed a bug in PDF generation </li>
</ul>
<h4>From 0.72 to 0.73</h4>
<ul>
  <li>Further code cleanup</li>
  <li>Remove all  known outstanding bugs </li>
</ul>
<h4>From 0.71 to 0.72</h4>
<ul>
  <li>Bug fixes, changes related to installing in non-root environment </li>
</ul>
<h4>From 0.7 to 0.71</h4>
<ul>
  <li>Some minor code cleanup</li>
  <li>Invoice homepage AJAX bug fixed</li>
  <li>Included missing .htaccess file in download </li>
</ul>
<h4>From 0.6 to 0.7 </h4>
<ul>
  <li>Upgraded from CodeIgniter 1.32 to 1.33</li>
  <li>Fixed a few bugs and streamlined a bit of code</li>
  <li>Modified code so that BambooInvoice can install  in any sub directory or alias.</li>
  <li>Wrote installation script</li>
  <li>Graphical installation guide </li>
</ul>
<p>[ <a href="#top">back to top</a> ] </p>


<h3><a id="roadmap"></a><?php echo $this->lang->line('menu_roadmap');?></h3>
<ul>
  <li>Ability to add contacts during company creation</li>
  <li>Ability to edit ajax-added client contacts</li>
  <li>Option to email thank you messages when payment entered</li>
  <li>Personal comments under invoice history</li>
  <li>Make taxes editable on a per-client basis </li>
  <li>Common task invoice entry (for constantly recurring services to different clients)ie: hosting, design, etc</li>
  <li>Custom logo uploads (partially solved in 0.74) </li>
  <li>Recurring invoices</li>
  <li>Automated tax reminders</li>
  <li>Write proper documentation (d'oh)</li>
  <li>More reports and graphs (client/invoice tree view)</li>
  <li>Expand/rebuild user management system</li>
  <li>Redesign interface (yeah, really)</li>
  <li>Verify support for other databases besides MySQL (with CodeIgniter's growth, this should be largely taken care of, but is untested) </li>
</ul>
<p>[ <a href="#top">back to top</a> ] </p>
<h3><a id="bugs"></a><?php echo $this->lang->line('menu_bugs');?></h3>
<p>Please report any bugs or other feedback to <a href="http://www.derekallard.com/">Derek Allard</a> (<span id="emailaddr">info [at] bambooinvoice [dot] org</span>) </p>
<p>[ <a href="#top">back to top</a> ] </p>


<?php
$this->load->view('footer');
?>