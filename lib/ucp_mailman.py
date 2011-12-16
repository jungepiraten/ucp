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
    hostname = ""
    description = ""
    subscribe_policy = 0
    members = ""
    archive = ""

    def __init__(self, listname):
        try:
            mailman_list_object = MailList.MailList(listname, False)
        except Errors.MMUnknownListError:
            mailman_list_object = False

        self.listname = listname
	self.hostname = mailman_list_object.host_name
        self.description = mailman_list_object.description
        self.subscribe_policy = mailman_list_object.subscribe_policy
        self.members = set(mailman_list_object.members)
        self.archive = mailman_list_object.GetBaseArchiveURL()

# Liefert eine Liste von UCPMailingLists
def getLists():
    names = Utils.list_names()
    names.sort()

    mailinglists = []
    for n in names:
        mailinglists.append(UCPMailingList(n))

    return mailinglists

if __name__ == '__main__':
    members = set(sys.argv)
    for list in getLists():
        print list.listname + "," + list.hostname + "," + list.description + "," + list.archive + "," + str(list.subscribe_policy) + "," + str(' '.join(list.members.intersection(members)))

