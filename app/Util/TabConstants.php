<?php
namespace jericho\Util;

/**
 * This class contains a list of constants, for identifying with tab on the View Property Flip screen
 * to make active, after navigating away from this screen, and then navigatin back. There is a constant
 * for every tab.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-05
 *
 */
class TabConstants
{
	const ACTIVE_TAB = 'active_tab';
	const GENERAL_TAB = 'general_tab';
	const ATTORNEYS_TAB = 'attorney_tab';
	const ESTATE_AGENTS_TAB = 'estate_agents_tab';
	const CONTRACTORS_TAB = 'contractors_tab';
	const BANKS_TAB = 'banks_tab';
	const MILESTONES_TAB = 'milestones_tab';
	const NOTES_TAB = 'notes_tab';
	const DOCUMENTS_TAB = 'documents_tab';
	const DIARY_TAB = 'diary_tab';
	const TRANSACTIONS_TAB = 'transactions_tab';
}