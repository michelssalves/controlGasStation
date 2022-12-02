<!-- ::  
@%__APPDIR__%mode.com con:cols=60 lines=8
@echo off && setlocal EnableDelayedExpansion

title <nul & title Add Send Versionamento

for /f "tokens=2delims==." %%i in (
'%__APPDIR__%\wbem\wmic.exe OS Get localdatetime /value^|findstr [0-9]'
) do set "_d=%%i" && call set "filedatetime=!_d:~6,2!-!_d:~4,2!-!_d:~0,4! - !_d:~8,2!:!_d:~10,2!

echo/ Data Layout : !_d:~6,2!/!_d:~4,2!/!_d:~0,4!- !_d:~8,2!:!_d:~10,2!

:loop
for /f "tokens=*delims= " %%i in ('%__APPDIR__%CScript.exe //NoLogo "%~f0?.wsf"')do set "_message=%%~i"
echo/!_message!|%__APPDIR__%findstr.exe [a-Z] >nul || goto :loop

cmd.exe /v /c git add -A
cmd.exe /v /c git commit -am "!_message! Ref: !filedatetime! -> %username%"
cmd.exe /v /c git push -u origin main

%__APPDIR__%timeout.exe -1 & endlocal & goto :EOF
# --><job><script language="vbscript">
Input=InputBox("Digite Mensagem: ", "Novo Versionamento: "): wsh.echo Input: Set Input=Nothing
</script></job>