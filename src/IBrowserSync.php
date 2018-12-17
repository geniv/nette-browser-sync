<?php declare(strict_types=1);

use GeneralForm\ITemplatePath;


/**
 * Interface IBrowserSync
 *
 * @author  geniv
 */
interface IBrowserSync extends ITemplatePath
{

    /**
     * Set check by url.
     *
     * @param bool $state
     */
    public function setCheckByUrl(bool $state);
}
