#!/bin/bash 
# Absolute path to this script, e.g. /home/user/bin/foo.sh
SCRIPT=$(readlink -f "$0")
# Absolute path this script is in, thus /home/user/bin

# Setting variables
PROJECT_NAME="Laravel Core"
DB_NAME="betech_blab"
CURRENT_DIR=$(dirname "$SCRIPT")
DB_INSTALL_ORG_DIR="$CURRENT_DIR/origin"
DB_INSTALL_DIR="$CURRENT_DIR/$DB_NAME"

echo '----------------------------------------------'
echo "	$PROJECT_NAME database install              "
echo '----------------------------------------------'

# Print variables
echo "Current directory path: 	[$CURRENT_DIR]"
echo "Database install origin folder:	[$DB_INSTALL_ORG_DIR]"
echo "Database install folder:	[$DB_INSTALL_DIR]"
echo "Database name:                  [$DB_NAME]"

CONNECT_SQL_CMD="mysql -uroot --default-character-set=utf8 $DB_NAME"
files="$DB_INSTALL_DIR/*"
for file in $files
do
    cp $DB_INSTALL_ORG_DIR/$(basename $file) $DB_INSTALL_DIR/$(basename $file)
    echo "Import file: $(basename $file)..."
    $CONNECT_SQL_CMD < $DB_INSTALL_DIR/$(basename $file)
    echo "Import file: $(basename $file) success!!!"
done