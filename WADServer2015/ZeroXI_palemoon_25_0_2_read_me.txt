#############################################################################
                         Uniform Server Zero XI 
#############################################################################
 28-10-2014
#############################################################################

----
Note
----
Pale Moon's support for Windows XP was dropped from version 25.0.0 onwards.

-----------
Introuction
-----------
 The Uniform Server Zero is designed for portability, emphasis is
 given to reducing code size. The Uniform Server Zero achieves this
 through a modular implementation. Install only modules (plugins)
 you require these are listed in the documentation plugin section:
 ZeroXI_documentation_1_1_2.exe

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

------------------
Pale Moon Portable
------------------
 Pale Moon Portable is an optimised browser for running from a USB memory
 stick. It is built on Firefox’s official source code. However this has
 been optimised for speed, memory use and size resulting in a fast browser
 with a minimum footprint. In addition Pale Moon Portable is easily configured.

-------------------------------------------
The Uniform Server Zero XI Pale Moon plugin
-------------------------------------------
 Uniform server automatically detects the presence of Pale Moon Portable and
 uses this instead of your PC’s default browser. Apart from a pre-configured
 User.ini file no modifications have been made to Pale Moon Portable. This
 is important especially if you wish to manually upgrade to the latest
 version obtainable from  http://www.palemoon.org/ Upgrading is covered in
 "PALE MOON UPGRADE" section below.    

------------------------------------------------------
Installing The Uniform Server Zero XI Pale Moon plugin
------------------------------------------------------

 The extraction procedure is identical for all plugins, proceed as follows:

 1) Download required Pale Moon Portable plugin installation file
    for example ZeroXI_palemoon_25_0_2.exe
 2) Save to folder UniServerZ.
 3) If running, stop Uniform Server.
 4) Double click on the above installation file.
    This runs the self extracting archive.
 5) If prompted allow overwriting of existing files.
 6) If you wish, delete the installation file, it is no longer required.

-----------------
PALE MOON UPGRADE
-----------------
 If a newer version of Pale Moon Portable is released before the Uniform
 Server plugin is updated you can manually upgrade as follows.
 Note: Only use official binaries from http://www.palemoon.org/ see their
       section on illegal redistributions. Using official binaries tightens
       security by preventing viruses and malware which unofficial version
       may contain.

 1) With the exception of file User.ini delete all files
    and folders in C:\UniServerZ\core\palemoon

 2) Download the latest (32-bit) version of Pale Moon Portable 
    from http://www.palemoon.org/
    Download link http://www.palemoon.org/palemoon-portable.shtml
    Current version: Palemoon-Portable-25.0.2.win32.exe
    Save to folder:  C:\UniServerZ\core\palemoon

 3) Extract contents of the downloaded file:
    Navigate to folder C:\UniServerZ\core\palemoon
    Double click file Palemoon-Portable-25.0.2.win32.exe
    This runs the 7-Zip self-extracting archive.
    No need to change the default path. Click Extract button.

 4) If you wish to save space, delete the installation file
    Palemoon-Portable-25.0.2.win32.exe, it is no longer required.

 5) Create a user profile:
    First time Palemoon-Portable.exe is run a user profile is created.
    This process is automatic, to start the process double click on file
    Palemoon-Portable.exe and wait for it to complete.

    Note: It takes a relatively long time, on completion the browser is
    opened. You can set personal preferences as required. Note preferences
    required by UniServer have been pre-configured in the User.ini
    configuration file. When you have finished close the bowser.
    The browser is now ready to run from UniController as and when required. 

USER CONFIGURATION FILE
-----------------------
 After an upgrade there are two configuration files Palemoon-Portable.ini
 and User.ini located in folder C:\UniServerZ\core\palemoon

 The User.ini file is a modified copy of Palemoon-Portable.ini
 Note: The user configuration is used instead of Palemoon-Portable.ini
 which, can be deleted to save space.

 Between releases of Pale Moon there may be minor changes to
 Palemoon-Portable.ini, before deleting this file check for differences
 between Palemoon-Portable.ini and User.ini add changes to the User.ini file.
 Uniform Server modifications are shown in the next section.

PALE MOON PORTABLE User.ini
---------------------------
  The User.ini file is a modified copy of Palemoon-Portable.ini file.
  Modifications are made to the "User preferences" and "Global preferences"
  sections these are identified by commonent lines containing "US-" 

  Currently there are four additional lines added to the end of the
  "User preferences" section and a single change to the "Global preferences"
  section as shown below:

  ; ========================================
  ; 		** User preferences **
  ; ========================================

  ;(1 US- Enable proxy to use PAC file)
  network.proxy.type=2

  ;(2 US- Set PAC file either url or path defined by environment variable US_PAC)
  network.proxy.autoconfig_url=%US_PAC%|"/

  ;(3 US- Start-up page blank)
  browser.startup.page=0

  ;(4 US- Start-up unable to restore last session)
  browser.sessionstore.resume_from_crash=false

  ; ========================================
  ; 		** Global preferences **
  ; ========================================

  [Options]
  DeleteTemp=true
  MultipleInstances=true
  RunWait=true
  ;ShowSplash=true
  ;(5 US- No splash screen)
  ShowSplash=false
  WriteLog=false 


--------------------------------------o0o------------------------------------
            Copyright 2002-2014 The Uniform Server Development Team
                            All rights reserved.


