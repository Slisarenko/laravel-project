<?php


namespace App\Exceptions;

abstract class ErrorException extends \Exception
{
    protected $detail = '';

    /**
     * @return mixed
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @param string $detail
     * @return $this
     */
    public function setDetail($detail): self
    {
        $this->detail = $detail;

        return $this;
    }
}
