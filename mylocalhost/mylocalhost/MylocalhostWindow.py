# -*- Mode: Python; coding: utf-8; indent-tabs-mode: nil; tab-width: 4 -*-
### BEGIN LICENSE
# This file is in the public domain
### END LICENSE

from locale import gettext as _

from gi.repository import Gtk # pylint: disable=E0611
import logging
logger = logging.getLogger('mylocalhost')

from mylocalhost_lib import Window
from mylocalhost.AboutMylocalhostDialog import AboutMylocalhostDialog
from mylocalhost.PreferencesMylocalhostDialog import PreferencesMylocalhostDialog

# See mylocalhost_lib.Window.py for more details about how this class works
class MylocalhostWindow(Window):
    __gtype_name__ = "MylocalhostWindow"
    
    def finish_initializing(self, builder): # pylint: disable=E1002
        """Set up the main window"""
        super(MylocalhostWindow, self).finish_initializing(builder)

        self.AboutDialog = AboutMylocalhostDialog
        self.PreferencesDialog = PreferencesMylocalhostDialog

        # Code for other initialization actions should be added here.

        self.addButton = self.builder.get_object("addButton")
        self.firstValue = self.builder.get_object("firstValue")
        self.secondValue = self.builder.get_object("secondValue")

    def on_addButton_clicked(self, widget):
        print  self.firstValue.get_text()
