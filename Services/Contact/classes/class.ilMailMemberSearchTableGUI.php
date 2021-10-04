<?php declare(strict_types=1);
/* Copyright (c) 1998-2009 ILIAS open source, Extended GPL, see docs/LICENSE */

/**
 * @author Nadia Matuschek <nmatuschek@databay.de>
 */
class ilMailMemberSearchTableGUI extends ilTable2GUI
{
    public function __construct(ilMailMemberSearchGUI $a_parent_obj, string $a_parent_cmd)
    {
        global $DIC;

        $obj_id = ilObject::_lookupObjectId($a_parent_obj->ref_id);
        $this->setId('mmsearch_' . $obj_id);
        parent::__construct($a_parent_obj, $a_parent_cmd);
        $this->lng->loadLanguageModule('crs');
        $this->lng->loadLanguageModule('grp');
        $this->setTitle($this->lng->txt('members'));

        $this->setFormAction($this->ctrl->getFormAction($a_parent_obj));
        $this->ctrl->clearParameters($a_parent_obj);

        $this->setRowTemplate('tpl.mail_member_search_row.html', 'Services/Contact');

        $this->addColumn('', '', '1%', true);
        $this->addColumn($this->lng->txt('login'), 'login', '22%');
        $this->addColumn($this->lng->txt('name'), 'name', '22%');
        $this->addColumn($this->lng->txt('role'), 'role', '22%');

        $this->setSelectAllCheckbox('user_ids[]');
        $this->setShowRowsSelector(true);
        
        $this->addMultiCommand('sendMailToSelectedUsers', $this->lng->txt('mail_members'));
        $this->addCommandButton('cancel', $this->lng->txt('cancel'));
    }

    protected function fillRow($a_set) : void
    {
        foreach ($a_set as $key => $value) {
            $this->tpl->setVariable(strtoupper($key), $value);
        }
    }
}
