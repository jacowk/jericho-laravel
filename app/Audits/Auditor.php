<?php
namespace jericho\Audits;

/**
 * This interface is for logging audits for the system. Many to many relationships and pivot tables, specifically
 * attach and detach methods, are not audited by the OwenIt\Auditing\Auditable library. Seperate auditing
 * had to be built for this system wide. 
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-26
 *
 */
interface Auditor
{
	public function log();
}