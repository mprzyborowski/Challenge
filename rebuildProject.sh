#!/bin/bash
CONSOLE="bin/console"

DEFAULT_COLOR='\033[0m'
COLOR_LIGHT_BLUE='\033[1;34m'



echo -e ""
echo -e "${COLOR_LIGHT_BLUE} Start processes to clear & prepare project data ${DEFAULT_COLOR}"

echo -e ""
echo -e "${COLOR_LIGHT_BLUE} Clear cache data ${DEFAULT_COLOR}"
rm -rf var/cache/*

echo -e ""
echo -e "${COLOR_LIGHT_BLUE} Clear project database & create new ${DEFAULT_COLOR}"
php ${CONSOLE} d:d:d --force
php ${CONSOLE} d:d:c
php ${CONSOLE} d:s:update --force

echo -e ""
echo -e "${COLOR_LIGHT_BLUE} Build entities ${DEFAULT_COLOR}"
php ${CONSOLE} d:g:entities AppBundle

echo -e ""
echo -e "${COLOR_LIGHT_BLUE} Insert default data ${DEFAULT_COLOR}"
php y | ${CONSOLE} doctrine:fixtures:load

# echo -e ""
# echo -e "${COLOR_LIGHT_BLUE} Reload elastic search indexes ${DEFAULT_COLOR}"
# php ${CONSOLE} f:e:p


echo -e ""
echo -e "${COLOR_LIGHT_BLUE} End Processes ${DEFAULT_COLOR}"