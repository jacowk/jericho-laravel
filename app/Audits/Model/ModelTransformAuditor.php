<?php
namespace jericho\Audits\Model;

use Illuminate\Support\Arr;

/**
 * A class that receives an array of audit properties, and initiates transformation
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-31
 *
 */
class ModelTransformAuditor
{
	public function audit($data, $transformations)
	{
		$modelTransformer = new ModelTransformer();
		$old_new = array('old', 'new');
		if ($transformations != null)
		{
			foreach ($transformations as $key => $value)
			{
				foreach ($old_new as $array_value)
				{
					$transform_key = $array_value . '.' . $key;
					if (Arr::has($data, $transform_key))
					{
						$data = $modelTransformer->transform($data, $transform_key, $value[0], $value[1]);
					}
				}
			}
		}
		return $data;
	}
}
