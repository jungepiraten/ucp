#!/usr/bin/env python
# module.py
#
# Stellt ein paar Funktionen fuer das Mailman Interface im UCP bereit
#

import sys
sys.path.append("/usr/lib/mailman/bin")
import paths
from Mailman import Errors
from Mailman import MailList
from Mailman import Utils

# Klasse fuer die Mailinglisten;
# auf die notwendigen Attribute reduziert.
class UCPMailingList:
    listname = ""
    description = ""
    subscribe_policy = 0
    has_member = ""

    def __init__(self, listname, member):
        try:
            mailman_list_object = MailList.MailList(listname, False)
        except Errors.MMUnknownListError:
            mailman_list_object = False

        self.listname = listname
        self.description = mailman_list_object.description
        self.subscribe_policy = mailman_list_object.subscribe_policy
        if member in mailman_list_object.members:
            self.has_member = 1
        else:
            self.has_member = 0

# Liefert eine Liste von UCPMailingLists
def getLists(member):
    names = Utils.list_names()
    names.sort()

    mailinglists = []
    for n in names:
        mailinglists.append(UCPMailingList(n, member))

    return mailinglists

if __name__ == '__main__':
    member = ''
    if len(sys.argv) > 1:
        member = sys.argv[1]
    for list in getLists(member):
        print list.listname + "," + list.description + "," + str(list.subscribe_policy) + "," + str(list.has_member)

