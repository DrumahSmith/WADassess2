#############################################################################
                         Uniform Server Zero XI 
#############################################################################
 16-9-2013
#############################################################################

-----------
Introuction
-----------
 The Uniform Server Zero is designed for portability, emphasis is
 given to reducing code size. The Uniform Server Zero achieves this
 through a modular implementation. Install only modules (plugins)
 you require these are listed in the documentation plugin section:
 ZeroXI_documentation_1_0_0.exe

------------------------
Install module (plugins)
------------------------

 All plugins are installed as follows:
  1) Copy a plugin to folder UniServerZ
  2) Double click on the downloaded plugin
  3) This starts the extraction process
  4) If requested allow overwriting of existing files.

----------------------
Additional Information
----------------------

The Strawberry Perl plugin is a perl environment for MS Windows allowing
you to run and develop perl applications.

The mini Strawberry Perl is a cutdown version suitable for AWSTats.

------------------------------------------------------------
Installing The Uniform Server Zero XI Strawberry Perl plugin
------------------------------------------------------------

The extraction procedure is identical for all plugins, proceed as follows:

1) Download required Perl plugin installation file ZeroXI_strawberry_perl_mini_5_18_1_1.exe
2) Save to folder UniServerZ.
3) If running, stop Uniform Server.
4) Double click on the above installation file.
   This runs the self extracting archive.
5) If prompted allow overwriting of existing files.
6) If you wish, delete the installation file, it is no longer required.

----
PERL
----
Perl runs as CGI note the following:

1) Folder UniServerZ\cgi-bin is created, Contains test scripts 
2) Perl UniController menu option is enabled.
     From this menu change the shebang as appropiate.
     View test page to confirm Perl operation.
3) Place your Perl CGI scripts in folder UniServerZ\cgi-bin


--------------------------------------o0o------------------------------------
            Copyright 2002-2014 The Uniform Server Development Team
                            All rights reserved.


