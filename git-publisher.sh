#!/bin/bash
clear
# sudo file-rights
chmod 777 git-publisher.sh
rm -r ./app/.idea/ && rm -r ./app/.vscode/
git pull
# clear images in ./app/upload/
rm -r ./app/upload/*
# publish to github
git add .
git commit -m "$1"
git push