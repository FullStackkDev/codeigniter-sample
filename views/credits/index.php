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

<h3><a id="credits"></a><?php echo $this->lang->line('menu_credits');?></h3>
<p><?php echo $this->lang->line('bambooinvoice_logo');?> 
  was developed by <a href="http://www.derekallard.com/">Derek Allard</a>, president of <a href="http://www.darkhorse.to/">Dark Horse Consulting</a>. It was built on top of the excellent <a href="http://www.codeigniter.com/">CodeIgniter</a> <acronym title="Hypertext Preprocessor">PHP</acronym> framework. I'd like to gratefully acknowledge <a href="http://www.cubist.ca/">Cliff Persaud</a> for his input and insight into the design the <?php echo $this->lang->line('bambooinvoice_logo');?> logo. </p>
<p>To contact the author, write <span id="emailaddr">info [at] bambooinvoice [dot] org</span>.</p>
<p><strong>Very special thanks to:</strong></p>
<ul>
    <li><a href="http://www.ci2.ca">Marc Arbour</a> for French translation</li>
    <li><a href="http://www.alexwilliams.ca/">Alex Williams</a></li>
    <li><a href="http://www.michael-schlieper.de">Micha Schlieper</a> for German translation</li>
    <li>Willem de Boer for Dutch translation</li>
    <li><a href="http://www.cruzate.com">Victor Cevic</a> for Spanish translation</li>
    <li><a href="http://www.sogotech.com/">SoGo   Technology</a> for Romanian translation</li>
    <li><span id="q_115384e94a228caa_2"> <a href="http://www.finazzo.net/">Matt Finazzo</a></span> for Portuguese translation </li>
    <li><a href="http://www.boxless.info/">Todor Georgiev</a> for the Bulgarian translation </li>
</ul>
<p>[ <a href="#top">back to top</a> ] </p>

<?php
$this->load->view('footer');
?>