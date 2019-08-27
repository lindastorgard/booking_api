#Our Style Guide

###General concepts

The first line of all .php files should be exactly "<?php"
All files must only use UTF-8
Always use UTC timezone to store date and time
Use camelCase for variable naming
Never use global variables, except for superglobals
Variables should always be declared at the top of the block they are used in
Avoid calling functions in global namespace
Use single quotation marks
###Indentation and whitespace

Use two spaces for indentation
Do not leave whitespace at the end of lines
Be as strict as is sensible to enforce 80 character lines
Limit to three levels of indentation within functions
###Brackets and braces

Opening braces should always be placed at the end of the line
Closing braces should always be placed at the start of their own line
Never leave conditional statements unbraced or unindented
###Spaces

Opening brackets should not have a space after, closing brackets should not have a space before
Commas separating variable lists should have a space or newline after, no whitespace before
A space should surround all type operators (+, -, *, / etc.)
###Classes

Properties should use $camelCase
Methods should use camelCase()
Methods should avoid becoming longer than 20-50 lines
###Databases

Tables should use PascalCase
Columns should use snake_case
Primary keys should be called id
Foreign key column names do not need special identification
###Commenting

For inline comments, double-slash comments (//) should be used
Inline comments should have indentation
Inline comments can span multiple lines, prefixed with the double-slash
Block comments should only be used to provide class and method documentation in the form of doc blocks