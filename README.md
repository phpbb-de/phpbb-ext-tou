# phpBB 3.2 & 3.3 Extension - phpBB.de Terms of Use

## Installation

Copy the content of this repository via git clone:

	git clone https://github.com/phpbb-de/phpbb-ext-tou.git ext/phpbbde/tou

or create the following directory structure in your phpBB-root directory:

	ext/phpbbde/tou

and copy the repository content to it.

Go to "ACP" > "Customise" > "Extensions" and enable the "Terms of Use" extension.

## Permissions

This extension adds one administrator permission. The permission can be found at "Administrative 
permissions" in the tab 'Misc' > 'Can manage “Terms of Use“'. The role "Full Admin" gets it 
automatically on install or update to v1.1.0. 

## Development

If you find a bug, please report it on https://github.com/phpbb-de/phpbb-ext-tou

## Automated Testing

We will use automated unit tests including functional tests in the future to prevent regressions. Check out our travis build below:

3.2.x: [![Build Status](https://travis-ci.org/phpbb-de/phpbb-ext-tou.png?branch=3.2.x)](http://travis-ci.org/phpbb-de/phpbb-ext-tou)

## License

[GPLv2](license.txt)
