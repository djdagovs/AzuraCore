<?php
namespace App\Doctrine\Filter;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;

class SoftDelete extends SQLFilter
{
    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias)
    {
        if (!isset($targetEntity->fieldMappings['deleted_at'])) {
            return '';
        }

        // Check for whether filter is being called from within a proxy and exempt from filter if so.
        $has_proxy = false;
        $backtrace = debug_backtrace();
        foreach ($backtrace as $log) {
            if (stristr($log['class'], 'Proxy') !== false) {
                $has_proxy = true;
            }
        }

        if ($has_proxy) {
            return '';
        } else {
            return $targetTableAlias . '.deleted_at IS NULL';
        }
    }
}