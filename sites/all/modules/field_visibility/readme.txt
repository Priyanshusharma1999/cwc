============================
Field Visibility
============================

Description
============
Field Visibility module Provides a method for hiding or displaying fields when
editing a node to a user based on their role. This works differently than
field_access that is an "opt-in". This uses an "opt-out" model where all fields
are visible by default unless turned off for that role. All default or existing
values of the field are maintained.

Installation
============
1. Copy the module in sites/all/module or modules directory and install it.
2. Configuration settings are found under Admin > Structure > Field Visibility.
Each content type you have defined in your site will be listed. Select the
content type whose fields you wish to hide. By default, all fields are selected.
Uncheck any fields that you don't want that user role to see when editing the
node type.

Uninstallation
===============
1. Disable the module from 'admin >> modules'.
2. Uninstall the module


MAINTAINERS
============
Shelane French: https://www.drupal.org/u/shelane
Justin Shinn: https://www.drupal.org/u/justinshinn

Lawrence Livermore National Laboratory is operated by Lawrence Livermore
National Security, LLC, for the U.S. Department of Energy, National Nuclear
Security Administration under Contract DE-AC52-07NA27344.

Disclaimer
This document was prepared as an account of work sponsored by an agency of the
United States government. Neither the United States government nor Lawrence
Livermore National Security, LLC, nor any of their employees makes any warranty,
expressed or implied, or assumes any legal liability or responsibility for the
accuracy, completeness, or usefulness of any information, apparatus, product,
or process disclosed, or represents that its use would not infringe privately
owned rights. Reference herein to any specific commercial product, process, or
service by trade name, trademark, manufacturer, or otherwise does not
necessarily constitute or imply its endorsement, recommendation, or favoring by
the United States government or Lawrence Livermore National Security, LLC. The
views and opinions of authors expressed herein do not necessarily state or
reflect those of the United States government or Lawrence Livermore National
Security, LLC, and shall not be used for advertising or product endorsement
purposes.
