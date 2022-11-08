#!/bin/bash
while inotifywait -e close_write /home/bb/file.xlsx; do
raw="/home/bb2/file.xlsx"
move="/home/bb/xlsx/247hd.xlsx"
echo "file.xlsx Modified... "
	cp $raw $move
        sleep 10
        python3 /home/bb/xlsx/Xcel2Json.py
        echo "Converted XLSX to JSON... "
        sleep 2
        echo "Parsing JSON... "
        php /home/bb/xlsx/parseXLSX.php
        echo "Uploading to Database.."
        php /home/bb/xlsx/upload.php
        echo "DONE!"

done
