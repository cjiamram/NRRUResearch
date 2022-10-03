<?php

/**
 * Modified: 2020-05-25T06:42:59+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;
class WorkbookChartLineFormat extends Entity
{
    /**
     * @return string
     */
    public function getColor()
    {
        if (!$this->isPropertyAvailable("Color")) {
            return null;
        }
        return $this->getProperty("Color");
    }
    /**
     * @var string
     */
    public function setColor($value)
    {
        $this->setProperty("Color", $value, true);
    }
}