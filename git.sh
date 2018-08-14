#!/bin/bash
# 一键发布工具

# 使用前需要提权 chmod +x ./git.sh

# git checkout master
git add -A
git commit -m 'commit'
git pull
git push
# git checkout RELEASE
# git merge master -m 'merge'
# git pull
# git push
# source $(cd $(dirname ${BASH_SOURCE:-$0});pwd)"/"tag.sh
# git push --tag
# git checkout master
