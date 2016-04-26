<?php
// mehrere Empfänger
$empfaenger  = 'max@example.com' . ', '; // beachten Sie das Komma
$empfaenger .= 'moritz@example.com';

// Betreff
$betreff = 'Geburtstags-Erinnerungen für August';

// Nachricht
$nachricht = '
<html>
<head>
  <title>Geburtstags-Erinnerungen für August</title>
</head>
<body>
  <p>Hier sind die Geburtstage im August:</p>
  <table>
    <tr>
      <th>Person</th><th>Tag</th><th>Monat</th><th>Jahr</th>
    </tr>
    <tr>
      <td>Julia</td><td>3.</td><td>August</td><td>1970</td>
    </tr>
    <tr>
      <td>Tom</td><td>17.</td><td>August</td><td>1973</td>
    </tr>
  </table>
</body>
</html>
';

// für HTML-E-Mails muss der 'Content-type'-Header gesetzt werden
$header  = 'MIME-Version: 1.0' . "\r\n";
$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// zusätzliche Header
$header .= 'To: Simone <simone@example.com>, Andreas <andreas@example.com>' . "\r\n";
$header .= 'From: Geburtstags-Erinnerungen <geburtstag@example.com>' . "\r\n";
$header .= 'Cc: geburtstagsarchiv@example.com' . "\r\n";
$header .= 'Bcc: geburtstagscheck@example.com' . "\r\n";

// verschicke die E-Mail
mail($empfaenger, $betreff, $nachricht, $header);
?>