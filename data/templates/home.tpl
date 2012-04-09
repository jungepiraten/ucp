{include file="header.tpl"}
<p class="greeting">Willkommen, {$user}!</p>

{if $showAddMail}
<p class="note">Deinem Account sind noch keine Mailadressen zugeordnet. Um die Funktionen dieses Panels voll nutzen zu k&ouml;nnen, solltest du <a href="?module=profile&amp;do=add_mail">eine Mailadresse eintragen</a>.</p>
{elseif $showVerify}
<p class="note">Deine Mailadresse wurde bisher noch nicht verifiziert. Ohne Verifizierung stehen einige Funktionen (wie das vereinfachte Abonnieren von Mailinglisten) nicht zur 
Verf&uuml;gung. <a href="?module=profile&amp;do=verify_mail&amp;mail={$userMail}">Jetzt verifizieren</a>.</p>
{else}
<p class="note">Dein Account ist verifiziert - Es kann los gehen :).</p>
{/if}
{include file="footer.tpl"}
