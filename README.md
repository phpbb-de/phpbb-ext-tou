# phpBB 3.2 Extension - phpBB.de Terms of Use

## Installation

Clone into ext/phpbbde/tou:

    git clone https://github.com/phpbb-de/phpbb-ext-tou ext/phpbbde/tou

Go to "ACP" > "Customise" > "Extensions" and enable the "phpBB.de tou" extension.

## Use
If you want to change the terms of use, this is currently only possible manually. You will need to increase the version of the terms in the database and additionally replace the terms in the language file (ucp.php) or go to ext/phpbbde/tou/event/main.php and replace the line:

	//$this->template->assign_var('L_TERMS_OF_USE', 'TEST');
by

	$this->template->assign_var('L_TERMS_OF_USE', 'TEST');
	
and replace the text "TEST" by your new terms of use text. This avoids changing the language files. Note that you will have to do this change again when updating the Extension.

## Development

If you find a bug, please report it on https://github.com/phpbb-de/phpbb-ext-tou

## Automated Testing

We will use automated unit tests including functional tests in the future to prevent regressions. Check out our travis build below:

master: [![Build Status](https://travis-ci.org/phpbb-de/phpbb-ext-tou.png?branch=master)](http://travis-ci.org/phpbb-de/phpbb-ext-tou)

## License

[GPLv2](license.txt)
