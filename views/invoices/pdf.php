<?php
/**
 *  This file is essentially a stripped down version of /views/invoices/view.php
 * Any changes you make to that formatting, you may consider adding to this.
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $page_title;?></title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
<style type="text/css">
/**
 * Invoice view styles notes
 *
 * This file NEEDS a locally located stylesheet to generate the appropriate formatting for 
 * transformation into a PDF.  If you alter this file (and you are encouraged to do so) just
 * keep in mind that all of your formatting must be located here.  You might also find that
 * there is limited or no support for a specific CSS style you want (ie: floating) and you'll
 * need to work around with old-school tables.  Sorry for that... ;)  
 */

body {
	margin: 0.5in;
}
h1, h2, h3, h4, h5, h6, li, blockquote, p, th, td {
	font-family: Helvetica, Arial, Verdana, sans-serif; /*Trebuchet MS,*/
}
h1, h2, h3, h4 {
	color: #5E88B6;
	font-weight: normal;
}
h4, h5, h6 {
	color: #5E88B6;
}
h2 {
	margin: 0 auto auto auto;
	font-size: x-large;
}

h2 span {
	text-transform: uppercase;
}
li, blockquote, p, th, td {
	font-size: 80%;
}
ul {
	list-style: url(img/bullet.gif) none;
}
table {
  width: 100%;
}
td p {
	font-size: small;
	margin: 0;
}

th {
	color: #FFF;
	text-align: left;
	background-color:#000000;
}
.bamboo_invoice_bam {
	color: #5E88B6;
	font-weight: bold;
	text-transform: capitalize;
}
.bamboo_invoice_inv {
	font-weight: bold;
	font-variant: small-caps;
	color: #333;	
}
#footer {
	border-top: 1px solid #CCC;
	text-align: right;
	font-size: 6pt;
	color: #999999;
}
#footer a {
	color: #999999;
	text-decoration: none;
}
table.stripe {
  border-collapse: collapse;
}

table.stripe td {
  border-bottom: 1pt solid black;
}
</style>
</head>
<body>

<table>
  <tr>
    <td width="60%"><p><strong><?php echo $this->lang->line('invoice_invoice') . ' ' . $row->invoiceNumber;?></strong><br />
        <strong><?php echo date('F j, Y', mysql_to_unix($row->dateIssued));?></strong></p>
	</td>
    <td><h2><?php
if (isset($company_logo)) {
	echo $company_logo;
}
?><?php echo $companyInfo->company_name;?> <span><?php echo $this->lang->line('invoice_invoice');?></span></h2>

      <p>
        <?php echo $companyInfo->address1;?>
        <?php if ($companyInfo->address2 != '') {echo '<br />' . $companyInfo->address2;}?><br />
        <?php echo $companyInfo->city;?>,
        <?php echo $companyInfo->province;?><br />
        <?php echo $companyInfo->country;?> 
        <?php echo $companyInfo->postal_code;?><br />
        <?php echo auto_link(prep_url($companyInfo->website));?>
      </p>
	</td>
  </tr>
</table>
<h3><?php echo $this->lang->line('invoice_bill_to');?>
  <?php echo $row->name;?>
</h3>
<p>
  <?php echo $row->address1;?>
  <?php if ($row->address2 != '') {echo ', ' . $row->address2;}?>
  <br />
  <?php echo $row->city;?>,
  <?php echo $row->province;?><br />
  <?php echo $row->country;?> 
  <?php echo $row->postal_code;?><br />
  <?php echo auto_link(prep_url($row->website));?>
</p>


  <h4><?php echo $this->lang->line('invoice_work_description');?></h4>

	<table class="invoice_items stripe">
		<tr>
			<th><p><?php echo $this->lang->line('invoice_quantity');?></p></th>
			<th><?php echo $this->lang->line('invoice_work_description');?></th>
			<th><?php echo $this->lang->line('invoice_amount');?></th>
			<th><?php echo $this->lang->line('invoice_total');?></th>
		</tr>
		<?php foreach ($items->result() as $item):?>
		<tr valign="top">
			<td><p><?php echo $item->quantity;?></p></td>
			<td><?php echo auto_typography(str_replace(array('\n', '\r'), "\n", $item->work_description));?></td>
			<td><p><?php echo $this->settings_model->getSetting('currency_symbol') . $item->amount;?> <?php if ($item->taxable == 0){echo '(' . $this->lang->line('invoice_not_taxable') . ')';}?></p></td>
			<td><p><?php echo $this->settings_model->getSetting('currency_symbol') . number_format($item->quantity * $item->amount, 2, '.', '');?></p></td>
		</tr>
		<?php endforeach;?>
	</table>

	<p>
	<?php echo $total_no_tax;?>
	<?php echo $tax_info;?>
    <?php echo $total_with_tax;?>
	</p>
  <p><strong><?php echo $this->lang->line('invoice_payment_term');?>: <?php echo $this->settings_model->getSetting('days_payment_due');?> <?php echo $this->lang->line('date_days');?></strong></p>
	<p><?php echo auto_typography($row->invoice_note);?></p>

<div id="footer">
<?php if ($this->settings_model->getSetting('display_branding') == 'y'):?>
  <p><?php echo $this->lang->line('invoice_generated_by');?> 
    <?php echo $this->lang->line('bambooinvoice_logo');?><br />
    <a href="http://www.bambooinvoice.org/">http://www.bambooinvoice.org</a></p>
<?php endif;?>
</div>
</body>
</html>
