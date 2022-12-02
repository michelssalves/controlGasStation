@echo off

REM defina a data abaixo
set filedatetime=%date%-
set filedatetime=%filedatetime:~0,2%-%filedatetime:~3,2%-%filedatetime:~6,4%

set /p message="Digite o comentário do commit: "
git add -A
git commit -am "%message% -> %filedatetime% -> %username%"
git push -u origin main