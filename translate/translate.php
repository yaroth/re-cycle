<?php

print "<!DOCTYPE html>\n";
print "<html lang=\"en\">\n";
"<body>\n";

print "<div id=\"google_translate_element\"></div>\n";

print "<script type=\"text/javascript\">\n";
print "function googleTranslateElementInit() {\n";
print "  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');\n";
print "}\n";
print "</script>\n";

echo "please translate";
print "<script type=\"text/javascript\" src=\"//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit\"></script>\n";

print "</body>\n";
print "</html>\n";

?>
