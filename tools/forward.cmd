rem use forward.cmd joomlapath com_name

md %1\administrator\components\%2\
md %1\components\%2\
copy /y ..\components\%2\administrator\*.* %1\administrator\components\%2\
copy /y ..\components\%2\component\*.* %1\components\%2\