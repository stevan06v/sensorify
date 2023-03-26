#!/bin/bash
chmod 777 git-publisher.sh

# clear images in ./app/upload/
sudo rm -r ./app/uploads/*

# publish to github 
git add .
git commit -m "$1"
git push