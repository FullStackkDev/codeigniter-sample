<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

$lang['actions_cancel'] = 'Annuleer';
$lang['actions_change'] = 'Verander';
$lang['actions_create_invoice'] = 'Factuur aanmaken';
$lang['actions_delete'] = 'Verwijder';
$lang['actions_edit'] = 'Wijzig';
$lang['actions_required_fields'] = 'Verplichte Velden';
$lang['actions_select_below'] = 'selecteer hieronder';

$lang['bambooinvoice_logo'] = '<span class=\'bamboo_invoice_bam\'>Bamboo</span><span class=\'bamboo_invoice_inv\'>Invoice</span>';
$lang['bambooinvoice_version'] = 'Version';

$lang['clients_add_contact'] = 'Contact Toevoegen';
$lang['clients_address1'] = 'Adres1';
$lang['clients_address2'] = 'Adres2';
$lang['clients_assigned_to_them'] = 'facturen gekoppeld aan dit contact. U staat op het punt om deze klant <strong class="error">permanent te verwijderen</strong> en <strong class="error">alle aan dit contact gekoppelde facturen</strong>. Weet u zeker dat u wilt doorgaan?';
$lang['clients_cancel_add_contact'] = 'Annuleer Contact toevoegen';
$lang['clients_city'] = 'Stad';
$lang['clients_client_has'] = 'Deze klant heeft ';
$lang['clients_clients_registered'] = 'klanten geregistreerd';
$lang['clients_contact_add'] = 'Niet mogelijk dit contact toe te voegen. Voornaam, Achternaam en een geldig E-mail adres zijn verplicht.';
$lang['clients_contact_delete_fail'] = 'Unable to delete this contact.';  // NEEDS BETTER TRANSLATION
$lang['clients_contacts'] = 'Contacten';
$lang['clients_country'] = 'Land';
$lang['clients_create_new_client'] = 'Nieuwe Klant Aanmaken';
$lang['clients_created'] = 'Nieuwe Klant Aanmaken'; // NEEDS BETTER TRANSLATION
$lang['clients_delete_all_invoices'] = 'Verwijder Klant en alle Facturen';
$lang['clients_delete_client'] = 'Verwijder Klant';
$lang['clients_delete_contact'] = 'Verwijder Contact';
$lang['clients_deleted'] = 'Verwijder Klant'; // NEEDS BETTER TRANSLATION
$lang['clients_deleted_error'] = 'Client could not be deleted'; // NEEDS TRANSLATION
$lang['clients_edit_client'] = 'Wijzig Klant';
$lang['clients_edit_contact'] = 'Wijzig Contact';
$lang['clients_edited'] = 'Client Edited Successfully'; // TO BE TRANSLATED
$lang['clients_edited_contact_info'] = 'Wijzig Contact'; // NEEDS BETTER TRANSLATION
$lang['clients_email'] = 'E-mail';
$lang['clients_first_name'] = 'Voornaam';
$lang['clients_id'] = 'Klant Id';
$lang['clients_last_name'] = 'Achternaam';
$lang['clients_name'] = 'KlantNaam';
$lang['clients_no_invoice_listed'] = 'There are no contacts currently listed for'; // TO BE TRANSLATED
$lang['clients_new_contact_fail'] = 'Niet mogelijk dit contact toe te voegen. Voornaam, Achternaam en een geldig E-mail adres zijn verplicht.';
$lang['clients_phone'] = 'Telefoonnummer';
$lang['clients_postal'] = 'Postcode';
$lang['clients_province'] = 'Provincie/Staat';
$lang['clients_save_client'] = 'Klant Opslaan';
$lang['clients_to'] = 'naar';
$lang['clients_update_client'] = 'Update Klant';
$lang['clients_website'] = 'Website';
$lang['clients_you_have'] = 'U heeft';

$lang['error_date_fill'] = 'Er is een fout opgetreden. Wees er zeker van dat u de datum in het formaat YYYY-MM-DD ingevoerd heeft, en dat het bedrag alleen uit numerieke gegevens mag bestaan.';
$lang['error_date_format'] = 'De datum moet in het volgende formaat ingevoerd worden YYYY-MM-DD';
$lang['error_email_recipients'] = 'Selecteer op z\'n minst 1 ontvanger voor deze factuur';
$lang['error_field_required'] = 'Dit veld is verplicht';
$lang['error_login_password'] = 'Voer een wachtwoord in';
$lang['error_login_username'] = 'Voer een gebruikersnaam in';
$lang['error_problem_editing'] = 'Er is een probleem opgetreden tijens het wijzigen van deze factuur.  Opgetreden fout: invoice_controller_edit';
$lang['error_problem_inserting'] = 'Probleem met invoeren';
$lang['error_problem_saving'] = 'Er is een probleem met de factuur te versturen.';
$lang['error_selection'] = 'De selectie die u heeft gemaakt bevat geen facturen.';

$lang['invoice_all_clients'] = 'Alle Klanten';
$lang['invoice_all_invoices'] = 'All Rekeningen';
$lang['invoice_amount'] = 'Bedrag';
$lang['invoice_amount_error'] = 'Voer een bedrag in';
$lang['invoice_amount_numbers_only'] = 'Alleen numerieke gegevens';
$lang['invoice_bill_to'] = 'Rekening voor';
$lang['invoice_client'] = 'Klant';
$lang['invoice_client_id'] = 'Klant Id';
$lang['invoice_closed'] = 'Gesloten';
$lang['invoice_comment'] = 'Opmerkingen';
$lang['invoice_contact_add'] = 'Er zijn geen contacten beschikbaar om deze factuur naar te sturen. Om deze toe te voegen, gebruik de';
$lang['invoice_date_issued'] = 'Datum Uitgifte';
$lang['invoice_date_issued_full'] = 'Datum Uitgifte (in het formaat YYYY-MM-DD)';
$lang['invoice_date_paid_full'] = 'Datum Betaald (in het formaat YYYY-MM-DD)';
$lang['invoice_email_demo'] = 'Om misbruik van deze demo te voorkomen worden de e-mails <em>niet</em> verstuurd. Om een copy van de PDF te bekijken selecteer &ldquo;Cre&#235;er factuur&rdquo; uit het menu.';
$lang['invoice_email_invoice_to'] = 'E-mail factuur naar';
$lang['invoice_email_message'] = 'E-mail bericht';
$lang['invoice_email_no_recipient'] = 'Ga terug en selecteer naar wie deze factuur gestuurd moet worden.';
$lang['invoice_email_success'] = 'Factuur succesvol verstuurd. U kunt hieronder de factuur geschiedenis bekijken.';
$lang['invoice_export_to'] = 'Exporteer uw factuur data naar';
$lang['invoice_generated_by'] = 'Invoice generated by'; // TO BE TRANSLATED
$lang['invoice_history_comments'] = 'Factuur Geschiedenis &amp; Reacties';
$lang['invoice_invoice'] = 'Factuur';
$lang['invoice_invoice_delete_success'] = 'Factuur succesvol verwijderd';
$lang['invoice_invoice_edit_success'] = 'Factuur succesvol gewijzigd';
$lang['invoice_is_tax_exempt'] = 'is belastingvrij';
$lang['invoice_last_used'] = 'laatst gebruikte nummer ';
$lang['invoice_new_invoice'] = 'Nieuwe Factuur';
$lang['invoice_new_invoice_error'] = 'Nieuwe Factuur Fout';
$lang['invoice_new_invoice_to'] = 'Nieuwe factuur voor';
$lang['invoice_no_payments_entered'] = 'Geen betalingen zijn ingevoerd deze factuur. Om een betaling in te voeren gebruik de &quot;Betaling Invoeren&quot; optie in het menu.';
$lang['invoice_not_sent'] = 'Factuur nog niet verstuurt naar klant. Om deze factuur te versturen gebruik de &quot;E-mail Factuur&quot; optie in het menu.';
$lang['invoice_not_taxable'] = 'Niet Belastbaar';
$lang['invoice_not_unique'] = 'Het factuurnummer is niet uniek';
$lang['invoice_note'] = 'Factuur Notitie';
$lang['invoice_note_max_chars'] = '(max. 255 karakters)';
$lang['invoice_no_invoice_match'] = 'There are no invoices in the system that match that criteria'; // TO BE TRANSLATED
$lang['invoice_number'] = 'Factuur Nummer';
$lang['invoice_open'] = 'Open';
$lang['invoice_or'] = 'of';
$lang['invoice_or_new_client'] = 'of voeg een nieuwe klant toe';
$lang['invoice_overdue'] = 'Achterstallig';
$lang['invoice_overdue_invoices'] = 'Achterstallige factu(u)r(en)';
$lang['invoice_payment_enter'] = 'Toevoegen Betaling voor';
$lang['invoice_payment_history'] = 'Betalings geschiedenis';
$lang['invoice_payment_success'] = 'Factuur betaling succesvol ingevoerd.';
$lang['invoice_payment_term'] = 'Betalingscondities';
$lang['invoice_premenently_delete'] = 'BI U staat op het punt om  <strong class="error">permanent te verwijderen</strong>, factuur';
$lang['invoice_problem_creating'] = 'Er was een probleem bij het aanmaken van uw factuur.';
$lang['invoice_quantity'] = 'Quantity'; // NEEDS BETTER TRANSLATION
$lang['invoice_return_invoice_view'] = 'terug naar factuur bekijken';
$lang['invoice_save_edited_invoice'] = 'Gewijzigde Factuur Opslaan';
$lang['invoice_select_client'] = 'Selecteer klant';
$lang['invoice_send_to'] = 'Stuur deze factuur naar';
$lang['invoice_sent_to'] = 'Factuur verstuurd naar';
$lang['invoice_status'] = 'Status';
$lang['invoice_summary'] = 'Samenvatting';
$lang['invoice_sure_delete'] = 'Weet u zeker dat u dit wilt doen? ';
$lang['invoice_tax1_description'] = 'Naam van het type belasting';
$lang['invoice_tax1_rate'] = 'Belastingtarief1';
$lang['invoice_tax2_description'] = 'Naam van het 2e type belasting';
$lang['invoice_tax2_rate'] = 'Belastingtarief2';
$lang['invoice_tax_exempt'] = 'Let op: Deze klant is van belastingen vrijgesteld';
$lang['invoice_tax_status'] = 'Belasting Status';
$lang['invoice_taxable'] = 'Belastbaar';
$lang['invoice_there_are_currently'] = 'Er zijn op dit moment';
$lang['invoice_total'] = 'Totaal';
$lang['invoice_work_description'] = 'Werk Omschrijving';
$lang['invoice_you_may_now'] = 'U kunt nu';

$lang['login_caps_lock'] = 'BI Wees er zeker van dat u uw <em>Caps Lock</em> niet ingedruk heeft';
$lang['login_forgot_password'] = 'BI Wachtwoord vergeten';
$lang['login_login'] = 'BI Inloggen';
$lang['login_logout'] = 'BI Uitloggen';
$lang['login_logout_confirm'] = 'BI U staat op het punt uit te loggen. Weet u zeker dat u dit wilt doen?';
$lang['login_logout_success1'] = "U bent succesvol uitgelogd. Als u wilt kunt u ";
$lang['login_logout_success2'] = 'opnieuw inloggen';
$lang['login_password'] = 'BI Wachtwoord';
$lang['login_password_email'] = "kan uw wachtwoord e-mailen naar het e-mail adres waarmee u geregistreerd bent. Als u het vergeten bent en het wilt resetten kunt hier het onderstaande formulier invoeren.";
$lang['login_password_email1'] = 'Uw wachtwoord is succesvol veranderd. Uw nieuwe wachtwoord is';
$lang['login_password_email2'] = 'en kan nu gebruikt worden om ';
$lang['login_password_fail'] = "Er is iets mis gegaan. Ik weet dat dit niet een foutmelding is waarmee je wat kunt, maar het ziet er naar uit dat er wat veranderd zal moeten worden";
$lang['login_password_reset_demo'] = 'Voor de demo is deze functie uitgeschakeld, maar u zou een e-mail hebben ontvangen met reset informatie.';
$lang['login_password_reset_disabled'] = 'Voor de demo is het wijzigen van het wachtwoord uitgeschakeld.';
$lang['login_password_reset_email1'] = 'Iemand (waarschijnlijk u), heeft een wachtwoord wijziging aangevraagd voor uw BambooInvoice account.';
$lang['login_password_reset_email2'] = 'Om het nu te resetten, volg de link naar onze website:';
$lang['login_password_reset_email3'] = "Als u deze aanvraag niet gedaan heeft, negeer deze e-mail dan, excuses voor het ongemak.";
$lang['login_password_reset_title'] = 'BambooInvoice Wachtwoord Wijzigen';
$lang['login_password_reset_unable'] = 'Niet mogelijk uw wachtwoord te wijzigen. Probeer opnieuw.';
$lang['login_password_sent'] = 'Uw veranderde wachtwoord is verstuurd naar';
$lang['login_password_submit'] = 'BI Wachtwoord verstuurd';
$lang['login_password_success'] = 'Uw wachtwoord veranderen is succesvol verlopen en is gemaild.';
$lang['login_remember_me'] = 'BI Herinner mij';
$lang['login_username'] = 'BI E-mail';
$lang['login_wrong_password'] = 'BI Sorry, de gebruikersnaam en/of wachtwoord is niet gevonden of was verkeerd. Probeer het nogmaals.';

$lang['menu_bugs'] = 'Bugs';
$lang['menu_catchphrase'] = 'Simpel,<br />Mooi,<br />Open Source,<br />Online Factureren';
$lang['menu_catchphrase_nobreak'] = 'Simpel, Mooi, Open Source, Online Factureren';
$lang['menu_changelog'] = 'Change Log';
$lang['menu_clients'] = 'Klanten';
$lang['menu_credits'] = 'Kredieten';
$lang['menu_delete_invoice'] = 'Verwijder Factuur';
$lang['menu_did_you_know'] = 'Wist u dat?';
$lang['menu_edit_invoice'] = 'Wijzig Factuur';
$lang['menu_email_invoice'] = 'E-mail Factuur';
$lang['menu_enter_payment'] = 'Betaling Invoeren';
$lang['menu_faq'] = 'Veelgestelde Vragen';
$lang['menu_generate_pdf'] = 'Genereer PDF';
$lang['menu_help'] = 'Help';
$lang['menu_invoice_summary'] = 'Factuur Overzicht';
$lang['menu_invoices'] = 'Facturen';
$lang['menu_logout'] = 'Uitloggen';
$lang['menu_new_invoice'] = 'Nieuwe Factuur';
$lang['menu_print_invoice'] = 'Print Factuur';
$lang['menu_reports'] = 'Raportages';
$lang['menu_roadmap'] = 'Roadmap';
$lang['menu_root_system'] = 'Root System';
$lang['menu_see_also'] = 'Zie ook';
$lang['menu_settings'] = 'Instellingen';
$lang['menu_utilties'] = 'Utilities'; // TO BE TRANSLATED

$lang['notice_english_only'] = '';
$lang['notice_generated_by'] = 'Gemaakt door';

$lang['reports_back_to_reports'] = 'terug naar raportages';
$lang['reports_collected'] = 'collected'; // TO BE TRANSLATED
$lang['reports_end_date'] = 'BI Eind Datum (yyyy-mm-dd)';
$lang['reports_first_quarter'] = 'eerste kwartaal';
$lang['reports_fourth_quarter'] = 'vierde kwartaal';
$lang['reports_generate_report'] = 'Genereer raport';
$lang['reports_invoices_issued_year'] = 'invoices issued this year'; // TO BE TRANSLATED
$lang['reports_legend'] = 'BI Legenda';
$lang['reports_second_quarter'] = 'tweede kwartaal';
$lang['reports_start_date'] = 'BI Start Datum (yyyy-mm-dd)';
$lang['reports_third_quarter'] = 'derde kwartaal';
$lang['reports_year_to_date'] = 'BI Jaar naar datum';
$lang['reports_yearly_income'] = 'BI Jaarlijks Inkomen';

$lang['settings_company_name'] = 'Bedrijfsnaam';
$lang['settings_currency_symbol'] = 'Valuta Symbool';
$lang['settings_currency_type'] = 'Currency Type';
$lang['settings_days_payment_due'] = 'Dagen tot factuur verloopt';
$lang['settings_default_note'] = 'Standaard Factuur notitie';
$lang['settings_display_branding'] = 'Display BambooInvoice Branding'; // TO BE TRANSLATED
$lang['settings_logo'] = 'Logo';
$lang['settings_modifys_fail'] = 'Er is een probleem opgetreden bij het veranderen van uw instellingen';
$lang['settings_modifys_success'] = 'Instellingen succesvol veranderd';
$lang['settings_note_max_chars'] = '(max 255 karakters)';
$lang['settings_primary_contact'] = 'Eerste Contact';
$lang['settings_primary_email'] = 'Eerste Contact E-mail';
$lang['settings_save_settings'] = 'Instellingen Opslaan';
$lang['settings_save_invoices'] = 'Instellingen Factuur';
$lang['settings_save_invoices_warning'] = '<strong>Warning:</strong> Turning this off will remove all currently saved invoices.';
$lang['settings_settings_default'] = 'Deze instellingen zijn standaard';
$lang['settings_short_language'] = 'du';
$lang['settings_tax_code'] = 'Uw belasting nummer/code';
$lang['settings_will_use'] = 'wordt gebruikt als u facturen of klanten aanmaakt.';

$lang['utilities_phpinfo'] = 'PHP info';
$lang['utilities_phpinfo_not_available'] = 'This feature is not available in the demo.';

$lang['menu_did_you_know_quotes'] = array(
					"BambooINVOICE is uitgebracht onder de GPL license.",
					"Uw instellingen kunnen te allen tijde worden gewijzigd in het &ldquo;instellingen&rdquo; menu.",
					"Het help bestand is nog groeiende. Bezoek BambooINVOICE.org voor de laatste versie!",
					"U kunt een nieuwe klant aanmaken vanuit het &ldquo;klanten&rdquo; menu, of vlak voordat u een factuur aanmaakt!",
					"Een enkele stam bamboe, geplant als klein plantje, bereikt zijn ultieme hoogte in minder dan een jaar!",
					"De bamboe plant zijn lange leven is in China een symbool voor lang leven. In India is het een symbool voor vriendschap."
					);

?>